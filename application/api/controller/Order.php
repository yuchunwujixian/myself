<?php
namespace app\api\controller;

use app\common\service\GoodsCategory;
use app\common\service\Goods as GoodsService;
use app\common\service\Order as OrderService;
use app\common\service\User as UserService;
use app\common\service\Config;
class Order extends Common{

	public function __construct(){
		parent::__construct();
		$this->user=new UserService();
		if(!input('token')){
			echo json_encode(['status'=>-1,'msg'=>'请登录']);
			exit();
		}
		$userinfo=$this->user->find(['token'=>input('token')]);
		if(!$userinfo){
			echo json_encode(['status'=>-1,'msg'=>'请登录']);
			exit();
		}
		session('id',$userinfo['id']);
		$this->userinfo=$userinfo;
	}	

	/*
	* 购买
	*/
	public function buy(){
		//排序
		$order="weigh desc";
		//条件
		$map['sku_id']=['in',input('get.ids')];

		$GoodsService=new GoodsService();
		$rows=$GoodsService->getGoodsListBySkuId($map);
		$data['list']=$rows;
		$data['total']=count($rows);
		
		return $this->json($data);
	}

	/*
	* 获取配送方式
	*/
	public function getPostType(){
		//获取配置信息
		$ConfigService=new Config();
		$config=$ConfigService->find();		
		$postType=$config['shop']['postType'];
		foreach ($postType['value'] as $key => $value) {
			$data[]=[
				'text'=>$value,
				'value'=>$value
			];
		}
		return $this->json($data);
	}

	/*
	* 创建订单
	*/
	public function create(){
		$OrderService=new OrderService();
		$res=$OrderService->create(input('post.goods/a'),input('post.linkname'),input('post.mobile'),input('post.address'));
		if($res>0){
			return $this->json(['order_id'=>$res],1,"订单提交成功");
		}else{
			return $this->json("",0,getErrorInfo($res));
		}
	}

	/*
	* 获取订单列表
	*/
	public function index(){
		$OrderService=new OrderService();
		$map['uid']=session('id');
		if(input('?get.status')&&input('get.status')!='all'){
			$map['status']=input('get.status');
		}
		$list=$OrderService->paginate($map,"*","order_id desc");
		return $this->json($list);
	}

	/*
	* 确认收货
	*/
	public function confirm(){
		$order_id=input('get.order_id');
		$map['order_id']=$order_id;
		$map['uid']=session('id');
		$OrderService=new OrderService();
		$res=$OrderService->confirm($map);
		if($res>0){
			return $this->json($res,1,"操作成功");
		}else{
			return $this->json("",0,getErrorInfo($res));
		}
	}

	/*
	* 关闭订单
	*/
	public function close(){
		$order_id=input('get.order_id');
		$map['order_id']=$order_id;
		$map['uid']=session('id');
		$OrderService=new OrderService();
		$res=$OrderService->close($map);
		if($res>0){
			return $this->json($res,1,"操作成功");
		}else{
			return $this->json("",0,getErrorInfo($res));
		}		
	}

	/* 
	* 测试
	*/
	public function test(){
		$OrderService=new OrderService();
		$res=$OrderService->paySuccess(2);
	}

}