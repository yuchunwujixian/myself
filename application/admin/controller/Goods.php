<?php
namespace app\admin\controller;

use app\common\service\GoodsCategory;
use app\common\service\Goods as GoodsService;
use app\common\mssql\MsModel;
class Goods extends Base{

    /*
    * 分类管理
    */
    public function category(){

		if(request()->isAjax()){
			//排序
			$order=input('get.sort')." ".input('get.order');

			if(input('get.search')){
				$map['category_name']=['like','%'.input('get.search').'%'];
			}			

			$GoodsCategory=new GoodsCategory();
			$total=$GoodsCategory->count($map);
			$rows=$GoodsCategory->select($map,'*',$order);
			//转为树形
			$rows=\util\Tree::makeTreeForHtml(collection($rows)->toArray(), ['primary_key' => 'category_id','parent_key'=>'pid']);
			//名称加上分级
			foreach ($rows as &$value) {
				$value['category_name']='|—'.str_repeat('—',$value['level']).$value['category_name'];
				$data[]=$value;
			}
			return json(['total'=>$total,'rows'=>$data]);
		}else{
			return $this->fetch();
		}
    }

    /*
    * 添加分类
    */
    public function categoryAdd(){
    	$GoodsCategory=new GoodsCategory();
		if(request()->isAjax()){
			$row=input('post.row/a');

			$res=$GoodsCategory->add($row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			//获取分类列表	
			$rows=$GoodsCategory->select();
			//转为树形
			$rows=\util\Tree::makeTreeForHtml(collection($rows)->toArray(), ['primary_key' => 'category_id','parent_key'=>'pid']);			
			$this->assign('category',$rows);
			return $this->fetch();
		}    	
    }

    /*
    * 分类编辑
    */
    public function categoryEdit(){
    	$GoodsCategory=new GoodsCategory();

		if(request()->isAjax()){
			$row=input('post.row/a');
			$map['category_id']=input('post.category_id');

			$res=$GoodsCategory->save($map,$row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			$map['category_id']=input('get.ids');
			$row=$GoodsCategory->find($map);
			$this->assign('row',$row);
			//获取分类列表	
			$rows=$GoodsCategory->select();
			//转为树形
			$rows=\util\Tree::makeTreeForHtml(collection($rows)->toArray(), ['primary_key' => 'category_id','parent_key'=>'pid']);			
			$this->assign('category',$rows);			
			return $this->fetch();
		}	    	
    }

    /*
    * 删除分类
    */
    public function categoryDelete(){
		$ids=input('get.ids');
		$map['category_id']=['in',$ids];

		$GoodsCategory=new GoodsCategory();
		$res=$GoodsCategory->delete($map);
		return AjaxReturn($res);
    }

    /*
    * 商品管理
    */
    public function index(){
    	$GoodsService=new GoodsService();

		if(request()->isAjax()){
			//排序
			$order="weigh desc,goods_id desc";
			//limit
			$limit=input('get.offset').",".input('get.limit');

			if(input('get.search')){
				$map['goods_name']=['like','%'.input('get.search').'%'];
			}

			$total=$GoodsService->count($map);
			$rows=$GoodsService->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);
		}else{
			return $this->fetch();
		}    	
    }

    /*
    * 添加商品
    */
    public function add(){
    	$GoodsService=new GoodsService();
		if(request()->isAjax()){
			$row=input('post.row/a');
			$sku=input('post.sku/a');
			
			$res=$GoodsService->add($row,$sku);
			return AjaxReturn($res>0?1:0,getErrorInfo($res));
		}else{
			//获取分类列表
			$GoodsCategory=new GoodsCategory();
			$map['status']='normal';
			$category=$GoodsCategory->select($map);
			$this->assign('category',$category);
			//获取类型列表
			$attr=$GoodsService->getAttributeList([],'*','weigh desc');
			$this->assign('attr',$attr['rows']);
			return $this->fetch();
		}
    }  

    /*
    * 商品编辑
    */  
   	public function edit(){
   		$GoodsService=new GoodsService();

		if(request()->isAjax()){
			$row=input('post.row/a');
			$sku=input('post.sku/a');

			$goods_id=input('post.goods_id');

			$res=$GoodsService->save($goods_id,$row,$sku);
			return AjaxReturn($res>0?1:0,getErrorInfo($res));
		}else{
			//获取分类列表
			$GoodsCategory=new GoodsCategory();
			$map['status']='normal';
			$category=$GoodsCategory->select($map);
			$this->assign('category',$category);
			//商品详情
			$map=[];
			$map['goods_id']=input('get.ids');
			$row=$GoodsService->find($map);
			$row['sku']=collection($row['sku'])->toArray();
			$this->assign('row',$row);
			//处理sku信息
			$sku=[];
			foreach ($row['sku'] as $key => $value) {
				$sku[$value['attr_value']]=$value;
			}
			$this->assign('sku',$sku);
			//获取类型列表
			$attr=$GoodsService->getAttributeList([],'*','weigh desc');
			$this->assign('attr',$attr['rows']);			
			return $this->fetch();
		}   		
   	}

   	/*
   	* 删除商品
   	*/
   	public function delete(){
   		$ids=input('get.ids');
		$map['goods_id']=['in',$ids];
		$GoodsService=new GoodsService();
		$res=$GoodsService->delete($map);
		return AjaxReturn($res);     		
   	}

   	/*
   	* 商品操作
   	*/
   	public function multi(){		
   		$action=input('action');
   		$ids=input('get.ids');
		$map['goods_id']=['in',$ids];
		$GoodsService=new GoodsService();
		if(!$action){
			return AjaxReturn(UPDATA_FAIL);   
		}
		$data[$action]=input('params');
		$res=$GoodsService->save($map,$data);
		return AjaxReturn($res);
   	}

   	/*
   	* 商品规格
   	*/
   	public function spec(){
    	$GoodsService=new GoodsService();

		if(request()->isAjax()){
			//排序
			$order=input('get.sort')." ".input('get.order');
			//limit
			$limit=input('get.offset').",".input('get.limit');
			$data=$GoodsService->getSpecList($map,'*',$order,$limit);
			return json($data);
		}else{
			return $this->fetch();
		}
   	}

   	/*
   	* 添加商品规格
   	*/
   	public function specAdd(){
		if(request()->isAjax()){
			$row=input('post.row/a');
			$value=input('post.value/a');

			$GoodsService=new GoodsService();
			$res=$GoodsService->addSpec($row,$value);
			return AjaxReturn($res,getErrorInfo($res));
		}else{

			return $this->fetch();
		}   		
   	}

   	/*
   	* 编辑商品规格
   	*/
   	public function specEdit(){
   		$GoodsService=new GoodsService();

		if(request()->isAjax()){
			$row=input('post.row/a');
			$value=input('post.value/a');
			$spec_id=input('post.spec_id');
			$res=$GoodsService->updateSpec($spec_id,$row,$value);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			$map['spec_id']=input('get.ids');
			$row=$GoodsService->getSpecInfo($map);
			$this->assign('row',$row);
			return $this->fetch();
		}     		
   	}

   	/*
   	* 删除商品规格
   	*/
   	public function specDelete(){
   		$ids=input('get.ids');
		$GoodsService=new GoodsService();
		$res=$GoodsService->deleteSpec($ids);
		return AjaxReturn($res);    		
   	}

   	/*
   	* 删除规格属性
   	*/
   	public function specValueDelete(){
   		$id=input('get.id');
   		$GoodsService=new GoodsService();
		$res=$GoodsService->deleteSpecValue($id);
		return AjaxReturn($res);    
   	}

   	/*
   	* 编辑规格属性
   	*/
   	public function specValueEdit(){
   		$id=input('post.id');
   		$name=input('post.name');
   		$GoodsService=new GoodsService();
		$res=$GoodsService->editSpecValue($id,$name);
		return AjaxReturn($res);    
   	}

   	/*
   	* 商品类型
   	*/
   	public function attribute(){
    	$GoodsService=new GoodsService();

		if(request()->isAjax()){
			//排序
			$order=input('get.sort')." ".input('get.order');
			//limit
			$limit=input('get.offset').",".input('get.limit');
			$data=$GoodsService->getAttributeList($map,'*',$order,$limit);
			return json($data);
		}else{
			return $this->fetch();
		}
   	}

   	/*
   	* 添加商品类型
   	*/
   	public function attributeAdd(){
   		$GoodsService=new GoodsService();
		if(request()->isAjax()){
			$row=input('post.row/a');

			$res=$GoodsService->addAttribute($row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			//获取规格列表
			$spec=$GoodsService->getSpecList([],'*',"weigh desc");
			$this->assign('spec',$spec['rows']);
			return $this->fetch();
		}   		
   	}

   	/*
   	* 编辑商品类型
   	*/
   	public function attributeEdit(){
   		$GoodsService=new GoodsService();

		if(request()->isAjax()){
			$row=input('post.row/a');

			$map['attr_id']=input('post.attr_id');
			$res=$GoodsService->updateAttribute($map,$row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			//商品类型详情
			$map['attr_id']=input('get.ids');
			$row=$GoodsService->getAttributeInfo($map);
			$row['spec_id_array']=explode(',', $row['spec_id_array']);
			$this->assign('row',$row);
			//获取规格列表
			$spec=$GoodsService->getSpecList([],'*',"weigh desc");
			$this->assign('spec',$spec['rows']);			
			return $this->fetch();
		}     		
   	}

   	/*
   	* 获取商品类型详情
   	*/
   	public function attributeInfo(){
   		$GoodsService=new GoodsService();
   		$map['attr_id']=input('attr_id');
   		$info=$GoodsService->getAttributeInfo($map)->toArray();
   		//获取规格
   		$map=[
   			'spec_id'=>['in',$info['spec_id_array']]
   		];
   		$spec_list=$GoodsService->getSpecList($map);
   		$info['spec_list']=collection($spec_list['rows'])->toArray();
   		return $info;
   	}

   	/*
   	* 删除商品类型
   	*/
   	public function attributeDelete(){
   		$ids=input('get.ids');
		$GoodsService=new GoodsService();
		$res=$GoodsService->deleteAttribute($ids);
		return AjaxReturn($res);    		
   	}

   	/*
   	* 获取商品sku信息
   	*/
   	public function skuByCode(){
   		$code=input('get.code');
   		$GoodsService=new GoodsService();
   		$map['code']=$code;
   		$info=$GoodsService->getSkuInfo($map);
   		return AjaxReturn($info?1:0,$info);
   	}

   	/*
   	* 查询商品信息
   	*/
   	public function getGoodsInfo(){
   		$map['goods_name']=input('get.goods_name');
   		$GoodsService=new GoodsService();
   		$data=$GoodsService->find($map);
   		return json($data);
   	}   	

   	/*
   	* 查询商品信息
   	*/
   	public function getGoodsList(){
   		$map['goods_name']=['like','%'.input('get.goods_name').'%'];
   		$GoodsService=new GoodsService();
   		$data=$GoodsService->select($map);
   		foreach ($data as $key => $value) {
   			foreach ($value->sku as $v) {
   				$sku=$v->toArray();
	   			$sku['goods']=$value;
	   			$list[]=$sku;
   			}
   		}
   		return json($list);
   	}

    /*
    * 同步分类
    */
    public function categorySync(){
        $res = array('code' => 0, 'msg' => '操作失败');
        $msmodel = new MsModel();//远程
        $result = $msmodel->categorySync('sz_goodsclass');
        if ($result){
            $res = $result;
        }
        return json($res);
    }

    /*
    * 同步商品
    */
    public function goodsSync(){
        $res = array('code' => 0, 'msg' => '操作失败');
        $msmodel = new MsModel();//远程
        $result = $msmodel->goodsSync('sz_goods');
        if ($result){
            $res = $result;
        }
        return json($res);
    }
}
