<?php
namespace app\api\controller;

use app\common\service\GoodsCategory as GoodsCategoryService;
use app\common\service\Goods as GoodsService;
class Goods extends Common{

	/*
	* 商品列表
	*/
	public function index(){

		$map['status']='normal';

		if($type=='')
		//排序
		$order="weigh desc";
		if(input('get.order')=='volume'){
			$order.=',volume desc';
		}
		if(input('get.order')=='price'){
			$order.=',price asc';
		}

		if(input('get.keyword')){
			$map['goods_name']=['like','%'.input('get.keyword').'%'];
		}

		$GoodsService=new GoodsService();
		$rows=$GoodsService->paginate($map,'*',$order);
		return $this->json($rows);
	}

	/*
	* 商品分类
	*/
	public function category(){
		$category_id=input('get.category_id');
		//获取全部分类
		$GoodsCategoryService=new GoodsCategoryService();
		$rows=$GoodsCategoryService->select([],"*","weigh desc");
		//转换为树形结构
		$rows=\util\Tree::makeTree(collection($rows)->toArray(), ['primary_key' => 'category_id','parent_key'=>'pid','primary_index'=>false]);
		if($category_id){
			foreach ($rows as $key => $value) {
				if($value['category_id']==$category_id){
					$rows[$key]['active']=1;
					if($value['son']){
						$rows[$key]['son'][0]['active']=1;
						$category_id=$value['son'][0]['category_id'];
						$son=$rows[$key]['son'];
					}
				}else{
					foreach ($value['son'] as $k => $v) {
						if($v['category_id']==$category_id){
							$rows[$key]['active']=1;
							$rows[$key]['son'][$k]['active']=1;
							$son=$rows[$key]['son'];
						}
					}
				}
			}
		}
		if(!$category_id){
			$rows[0]['active']=1;
			$rows[0]['son'][0]['active']=1;
			$son=$rows[0]['son'];
			$category_id=$rows[0]['son'][0]['category_id'];
		}
		$data['category']=$rows;
		//获取商品列表
		$ids=array_map(function($v){
			return $v['category_id'];
		},$son);
		$GoodsService=new GoodsService();
		$map['status']='normal';
		$map['category_id']=['in',$ids];
		$rows=$GoodsService->select($map,'*','weigh desc');
		$goods=[];
		foreach ($rows as $key => $value) {
			$goods[$value['category_id']][]=$value->toArray();
		}
		foreach ($son as $key => $value) {
			$son[$key]['goods']=$goods[$value['category_id']]?$goods[$value['category_id']]:[];
		}
		$data['category_son']=$son;
		return $this->json($data);		
	}

	/*
	* 商品详情
	*/
	public function detail(){
		$GoodsService=new GoodsService();
		$map['goods_id']=input('get.goods_id');
		$info=$GoodsService->find($map);
		if($info['sku']){
			$info['sku']=$info->sku;
			foreach($info['sku'] as $value){
				$sku_data[$value['attr_value']]=$value;
			}
			$info['sku_data']=$sku_data;
		}
		//替换图片信息
		$info['description']=str_replace("/uploads",'http://'. $_SERVER['SERVER_NAME'].'/uploads',$info['description']);
		$data['info']=$info;
		return $this->json($data);
	}

	/*
	* 购物车
	*/
	public function cart(){
		//排序
		$order="weigh desc";
		//条件
		$map['sku_id']=['in',input('get.ids')];

		$GoodsService=new GoodsService();
		$rows=$GoodsService->getGoodsListBySkuId($map);
		$data['data']=$rows;
		$data['total']=count($rows);
		return $this->json($data);		
	}
}