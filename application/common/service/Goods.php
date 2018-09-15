<?php
namespace app\common\service;

use app\common\model\Goods as GoodsModel;
use app\common\model\GoodsSpec as GoodsSpecModel;
use app\common\model\GoodsSku as GoodsSkuModel;
use app\common\model\GoodsSpecValue as GoodsSpecValueModel;
use app\common\model\Attribute as AttributeModel;
use think\Db;

class Goods extends Base{

	public function __construct(){
		parent::__construct();
		$GoodsModel=new GoodsModel();
		$this->model=$GoodsModel;
	}

	/*
	* 添加商品
	*/
	public function add($data,$sku){
		if($sku){
			//获取sku商品信息
			list($data,$sku)=$this->getSkuData($data,$sku);
		}
		// 启动事务
		Db::startTrans();
		try{
			//写入主表数据
			$data['create_time']=time();
			$goods_id=Db::name('goods')->insertGetId($data);
			//写入sku表
			if($sku){
				$sku=array_map(function($v) use ($goods_id){
					$v['goods_id']=$goods_id;
					return $v;
				},$sku);
				Db::name('goods_sku')->insertAll($sku);
			}
		    // 提交事务
		    Db::commit();
		    return $goods_id;			
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return $e->getMessage();
		}
	}

	/*
	* 编辑商品
	*/
	public function save($goods_id,$data,$sku){
		if($sku){
			//获取sku商品信息
			list($data,$sku)=$this->getSkuData($data,$sku);
		}
		// 启动事务
		Db::startTrans();
		try{
			//写入主表数据
			$data['update_time']=time();
			Db::name('goods')->where(['goods_id'=>$goods_id])->update($data);
			//写入sku表
			if($sku){
				//清空sku
				Db::name('goods_sku')->where(['goods_id'=>$goods_id])->delete();
				//重新保存
				$sku=array_map(function($v) use ($goods_id){
					$v['goods_id']=$goods_id;
					return $v;
				},$sku);
				Db::name('goods_sku')->insertAll($sku);
			}
		    // 提交事务
		    Db::commit();
		    return $goods_id;			
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return $e->getMessage();
		}				
	}

	/*
	* 删除商品
	*/
	public function delete($map){
		Db::startTrans();
		try{
			Db::name('goods')->where($map)->delete();
			Db::name('goods_sku')->where($map)->delete();
		    // 提交事务
		    Db::commit();			
			return SUCCESS;
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return $e->getMessage();
		}		
	}

	/*
	* 获取sku商品信息
	*/
	public function getSkuData($data,$sku){
		$price=0;
		$stock=0;
		$new_sku=[];
		//商品规格信息
		$spec_format=$this->getSpecFormat();
		$spec_value_format=$this->getSpecValueFormat();
		foreach ($sku as $key => $value) {
			$sku_data=[];
			$_attr_value=[];
			$attr_value=[];
			$attr_value_array=[];
			//自动商品主图
			if(!$data['picture']&&$value['image']){
				$data['picture']=$value['image'];
			}		
			//价格处理
			if($price==0||$value['price']<$price){
				$price=$value['price'];
			}
			//库存处理
			$stock+=$value['stock'];
			//规格排序
			foreach (explode(';',$key) as $k => $v) {
				$arr=explode(':',$v);
				$_attr_value[$arr[0]]=$arr;
			}
			sort($_attr_value);
			foreach ($_attr_value as $k => $v) {
				$attr_value[]=implode(":",$v);
				$attr_value_array[]=$v;
			}
			//sku 名称处理
			$sku_name=array_map(function($v) use ($spec_value_format){
				return $spec_value_format[$v[1]]['spec_value_name'];
			},$attr_value_array);
			$sku_name=implode("/",$sku_name);
			//sku 数据
			$sku_data=[
				'code'=>$value['code'],
				'sku_name'=>$sku_name,
				'attr_value'=>implode(";",$attr_value),
				'attr_value_array'=>json_encode($attr_value_array),
				'price'=>$value['price'],
				'stock'=>$value['stock'],
				'image'=>$value['image'],
				'create_time'=>time()
			];
			$new_sku[]=$sku_data;
		}
		//商品主表信息
		$data['price']=$price;
		$data['stock']=$stock;
		$spec=[];
		foreach ($data['spec'] as $k => $v) {
			$_spec=$spec_format[$k];
			$_spec['values']=array_map(function($v) use ($spec_value_format){
				return $spec_value_format[$v];
			},$v);
			$spec[]=$_spec;
		}
		$data['recommend']=json_encode($data['recommend']);
		$data['spec']=json_encode($data['spec']);
		$data['spec_array']=json_encode($spec);
		return [$data,$new_sku];
	}

	/*
	* 获取商品规格格式化信息
	*/
	public function getSpecFormat(){
		$GoodsSpecModel=new GoodsSpecModel();
		$this->model=$GoodsSpecModel;	
		$rows=parent::select();
		foreach ($rows as $key => $value) {
			$_data[$value->spec_id]=$value->toArray();
		}	
		return $_data;
	}

	/*
	* 获取商品规格属性值格式化信息
	*/
	public function getSpecValueFormat(){
		$GoodsSpecValueModel=new GoodsSpecValueModel();
		$this->model=$GoodsSpecValueModel;	
		$rows=parent::select();
		foreach ($rows as $key => $value) {
			$_data[$value->spec_value_id]=$value->toArray();
		}	
		return $_data;
	}	

	/*
	* 获取商品规格列表
	*/
	public function getSpecList($map=[],$field="*",$order="",$limit="",$join=""){
		$GoodsSpecModel=new GoodsSpecModel();
		$this->model=$GoodsSpecModel;
		$count=parent::count($map);
		$rows=parent::select($map,$field,$order,$limit,$join);
		foreach ($rows as &$value) {
			$value['values']=$value->values;
		}
		return ['total'=>$count,'rows'=>$rows];
	}

	/*
	* 添加商品规格
	*/
	public function addSpec($data,$value){
		$GoodsSpecModel=new GoodsSpecModel();
		$spec_id=$GoodsSpecModel->insertGetId($data);
		if(!$spec_id){
			return false;
		}
		$arr=[];
		foreach ($value as $v) {
			$arr[]=[
				'spec_id'=>$spec_id,
				'spec_value_name'=>$v,
				'create_time'=>time()
			];
		}
		$GoodsSpecValueModel=new GoodsSpecValueModel();
		$res=$GoodsSpecValueModel->insertAll($arr);
		return $res?1:0;
	}

	/*
	* 更新商品规格信息
 	*/
 	public function updateSpec($spec_id,$data,$value){
 		$map['spec_id']=$spec_id;
 		$GoodsSpecModel=new GoodsSpecModel();
		$this->model=$GoodsSpecModel;
		//获取原始信息
		$old_data=parent::find($map);
		//更新基础信息
		$res=parent::save($map,$data);	
		//添加新增属性
		$GoodsSpecValueModel=new GoodsSpecValueModel();
		$arr=[];
		foreach ($value as $k=>$v) {
			if(!$GoodsSpecValueModel->where('spec_value_id',$k)->count()){
				$arr[]=[
					'spec_id'=>$spec_id,
					'spec_value_name'=>$v,
					'create_time'=>time()
				];
			}
		}
		if($arr){
			$res1=$GoodsSpecValueModel->insertAll($arr);
		}
		//更新商品相关信息
		if($res&&$old_data['spec_name']!=$data['spec_name']){
			//处理新旧数据
			$str=str_replace("\\","\\\\",unicode_encode($old_data['spec_name']));
			$str1=str_replace("\\","\\\\",unicode_encode($data['spec_name']));
	 		//获取规格所属分类
	 		$attrList=Db::name('attribute')->whereOr('spec_id_array',$spec_id)->whereOr('spec_id_array','like','%,'.$spec_id.',%')->whereOr('spec_id_array','like','%,'.$spec_id)->whereOr('spec_id_array','like',$spec_id.',%')->field('attr_id')->fetchSql(false)->select();
	 		$attr_ids=array_map(function($v){
	 			return $v['attr_id'];
	 		},$attrList);
	 		//修改该分类关联规格信息
	 		$update_sql='update '.config('database.prefix').'goods set spec_array=REPLACE (spec_array,'."'".'"'.$str.'"'."'".','."'".'"'.$str1.'"'."'".') WHERE attr_id in ('.implode(",",$attr_ids).')';
	 		Db::execute($update_sql);
		}
		return ($res||$res1)?1:0;
 	}

	/*
	* 获取商品规格信息
	*/
	public function getSpecInfo($map){
		$GoodsSpecModel=new GoodsSpecModel();
		$this->model=$GoodsSpecModel;
		return parent::find($map);
	}

	/*
	* 删除商品规格
	*/
	public function deleteSpec($ids){
		$map['spec_id']=['in',$ids];
 		$GoodsSpecModel=new GoodsSpecModel();
		$this->model=$GoodsSpecModel;
		//删除基础信息
		$res=parent::delete($map);
		//删除属性信息
		$GoodsSpecValueModel=new GoodsSpecValueModel();
		$res1=$GoodsSpecValueModel->where($map)->delete();		
		return ($res||$res1)?1:0;	
	}

	/*
	* 删除规格属性
	*/
	public function deleteSpecValue($ids){
		$map['spec_value_id']=['in',$ids];
		$GoodsSpecValueModel=new GoodsSpecValueModel();
		$res=$GoodsSpecValueModel->where($map)->delete();		
		return ($res)?1:0;	
	}

	/*
	* 编辑规格属性
	*/
	public function editSpecValue($spec_value_id,$spec_value_name){
		$map['spec_value_id']=$spec_value_id;
		$GoodsSpecValueModel=new GoodsSpecValueModel();
		$data['spec_value_name']=$spec_value_name;
		$data['update_time']=time();
		$res=$GoodsSpecValueModel->where($map)->update($data);		
		return ($res)?1:0;	
	}

	/*
	* 获取商品类型
	*/
	public function getAttributeList($map=[],$field="*",$order="",$limit="",$join=""){
		$AttributeModel=new AttributeModel();
		$this->model=$AttributeModel;
		$count=parent::count($map);
		$rows=parent::select($map,$field,$order,$limit,$join);
		return ['total'=>$count,'rows'=>$rows];		
	}

	/*
	* 添加商品类型
	*/
	public function addAttribute($data){
		$data['spec_id_array']=implode($data['spec_id_array'], ',');
		$AttributeModel=new AttributeModel();
		$this->model=$AttributeModel;
		return parent::add($data);		
	}

	/*
	* 更新商品类型
	*/
	public function updateAttribute($map,$data){
		$data['spec_id_array']=implode($data['spec_id_array'], ',');
		$AttributeModel=new AttributeModel();
		$this->model=$AttributeModel;
		return parent::save($map,$data);				
	}

	/*
	* 获取商品类型详情
	*/
	public function getAttributeInfo($map){
		$AttributeModel=new AttributeModel();
		$this->model=$AttributeModel;
		$info=parent::find($map);		
		return $info;
	}

	public function getGoodsListBySkuId($map){
		$GoodsSkuModel=new GoodsSkuModel();
		$this->model=$GoodsSkuModel;
		$list=parent::select($map);
		foreach ($list as &$value) {
			$value->goods->toArray();
		}
		return $list;
	}

	/*
	* 获取商品sku信息
	*/	
	public function getSkuInfo($map){
		$GoodsSkuModel=new GoodsSkuModel();
		$this->model=$GoodsSkuModel;
		$info=parent::find($map);
		if($info){
			$info['goods']=$info->goods;
		}
		return $info;		
	}
}