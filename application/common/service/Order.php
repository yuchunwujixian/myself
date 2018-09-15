<?php
namespace app\common\service;

use think\Db;
use app\common\model\Order as OrderModel;
use app\common\service\Goods as GoodsService;
use app\common\service\User as UserService;
use app\common\service\Config as ConfigService;

class Order extends Base{

	public function __construct(){
		parent::__construct();
		$OrderModel=new OrderModel();
		$this->model=$OrderModel;
	}

	/*
	* 创建订单
	*/
	public function create($goods,$link_name,$mobile,$address,$post_type=""){
		//代发货  [该项目没有在线支付流程]
		$data['status']=1;
		//获取订单号
		$data['order_no']=$this->createOrderNo();
		//获取订单金额
		$data['price']=$this->getOrderPrice($goods);
		//联系人
		$data['link_name']=$link_name;
		//手机号码
		$data['mobile']=$mobile;
		//收货地址
		$data['address']=$address;
		//配送方式
		$data['post_type']=$post_type;
		//关联用户
		$data['uid']=session('id');
		//添加时间
		$data['create_time']=time();
		//更新时间
		$data['update_time']=time();
		// 启动事务
		Db::startTrans();
		try{
			//写入订单表
		    $order_id=Db::name('order')->insertGetId($data);
		    //写入订单商品表
		    foreach ($goods as $value) {
		    	$sku_info=Db::name('goods_sku')->where('sku_id',$value['sku_id'])->find();
		    	$goods_info=Db::name('goods')->where('goods_id',$sku_info['goods_id'])->find();

		    	$order_shop[]=[
		    		'order_id'=>$order_id,
		    		'goods_name'=>$goods_info['goods_name'],
		    		'sku_name'=>$sku_info['sku_name'],
		    		'price'=>$sku_info['price'],
		    		'picture'=>$goods_info['picture'],
		    		'num'=>$value['num']
		    	];
		    }
		    Db::name('order_goods')->insertAll($order_shop);
		    // 提交事务
		    Db::commit();
		    return $order_id;
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return ORDER_ADD_FAIL;
		}
	}

	/*
	* 生成订单号
	*/
	public function createOrderNo(){
		return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
	}

	/*
	* 获取订单金额
	*/
	public function getOrderPrice($goods){
		if(!$goods||!is_array($goods)){
			return 0;
		}
		$total=0;
		$goods_sku=Db::name('goods_sku');
		foreach ($goods as $value) {
			$price=$goods_sku->where('sku_id',$value['sku_id'])->value('price');
			$total+=$price*$value['num'];
		}
		return $total;
	}

	/*
	* 获取订单信息
	*/
	public function select($map=[],$field="*",$order="",$limit="",$join=""){
		$res=parent::select($map,$field,$order,$limit,$join);
		foreach ($res as &$value) {
			$value['status_name']=$value->status_name;
			$value['goods']=$value->goods;

		}
		return $res;
	}

	/*
	* 分页获取订单信息
	*/
	public function paginate($map=[],$field="*",$order="",$pageSize=10,$join=""){
		$res=parent::paginate($map,$field,$order,$pageSize,$join);
		foreach ($res as &$value) {
			$value['status_name']=$value->status_name;
			$value['goods']=$value->goods;

		}
		return $res;		
	}

	/*
	* 确认收货
	*/
	public function confirm($map){
		$res=parent::save($map,['status'=>99]);
		return $res;	
	}

	/*
	* 确认关闭订单
	*/
	public function close($map){
		$res=parent::save($map,['status'=>-1]);
		return $res;	
	}

	/*
	* 支付成功
	*/
	public function paySuccess($order_id){
		$map['order_id']=$order_id;
		//获取订单信息
		$order_info=parent::find($map);
		//修改订单状态
		$data['status']=1;
		$res=parent::save($map,$data);
		if($res>0){
			//修改订单更新时间
			parent::save($map,['update_time'=>time()]);
			//推广分成
			$this->returns($order_info);
			return $res;
		}else{
			return ORDER_PAY_UPDATE_FAIL;
		}
	}

	/*
	* 订单奖励分成
	*/
	public function returns($order_info){
		$UserService=new UserService();
		//获取推广员列表
		$parents=$UserService->getParents($order_info['uid']);
		if(!$parents){
			return false;
		}
		//获取配置信息
		$ConfigService=new ConfigService();
		$config=$ConfigService->find();

		foreach ($parents as $key=>$value) {
			//积分来源用户
			$action_uid=$key==0?$order_info['uid']:$parents[$key-1]['uid'];
			//执行分成操作
			$this->returnsDo($value['uid'],$action_uid,$value['level'],$config['shop'],$order_info);
		}
	}

	/*
	* 执行奖励操作
	*/
	private function returnsDo($uid,$action_uid,$level,$config,$order_info){
		$ratio=$config['return'.$level]?$config['return'.$level]:0;
		$point=$order_info['price']*$ratio;
		if(!$point){
			return false;
		}
		// 启动事务
		Db::startTrans();
		try{
			//返还用户积分
			Db::name('user')->where('id',$order_info['uid'])->setInc('point',$point);		    
			//记录积分日志
			$point_data=[
				'uid'=>$order_info['uid'],
				'object_id'=>$order_info['order_id'],
				'action_uid'=>$action_uid,
				'num'=>$point,
				'create_time'=>time(),
				'type'=>1
			];
			Db::name('point_log')->insert($point_data);
			// 提交事务
		    Db::commit();
		    return $order_id;
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return false;
		}		
	}
}