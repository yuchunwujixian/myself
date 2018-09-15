<?php
namespace app\admin\controller;

use app\common\mssql\MsModel;
use app\common\service\Order as OrderService;
use app\common\service\Config;
class Order extends Base{

    /*
    * 订单管理
    */
    public function index($status=null){
    	$OrderService=new OrderService();
    	//超过72小时自动收货
    	$time=72*3600;
    	$map['post_time']=['<',time()-$time];
    	$map['status']=2;
    	$OrderService->save($map,['status'=>99]);

		if(request()->isAjax()){
			$map=[];
			//排序
			$order="order_id desc";
			//limit
			$limit=input('get.offset').",".input('get.limit');

			//订单状态
			if($status!=null){
				$map['status']=$status;
			}

			$total=$OrderService->count($map);
			$rows=$OrderService->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);
		}else{
			$this->assign('status',$status);
			return $this->fetch();
		}    	
    }	

    /*
    * 发货
    */
   	public function post(){
   		$OrderService=new OrderService();
		if(request()->isAjax()){
			$map['order_id']=input('post.order_id');
			$data=input('post.row/a');
			$data['status']=2;
			$data['post_time']=time();
			$res=$OrderService->save($map,$data);
			return AjaxReturn($res);
		}else{
			//获取订单详情
			$map['order_id']=input('get.ids');
			$row=$OrderService->find($map);
			$this->assign('row',$row);
			//获取配送方式
			$ConfigService=new Config();
			$config=$ConfigService->find();		
			$postType=$config['shop']['postType'];
			$this->assign('postType',$postType);		
			return $this->fetch();
		}   		
   	}

    /*
    * 关闭订单
    */
   	public function close(){
   		$ids=input('get.ids');
		$map['order_id']=['in',$ids];
		$OrderService=new OrderService();
		$res=$OrderService->close($map);
		return AjaxReturn($res);       		
   	}

    /*
    * 同步订单
    */
    public function orderSync(){
        $res = array('code' => 0, 'msg' => '操作失败');
        $msmodel = new MsModel();//远程
        $result = $msmodel->orderSync('kf_outorderdoc');
        if ($result){
            $res = $result;
        }
        return json($res);
    }
}