<?php
namespace app\admin\controller;
use app\common\service\Order as OrderService;

class Index extends Base{

    public function index(){
        $Order=db('order');
        //未处理订单
        $OrderPost=$Order->where('status',1)->count();
        $this->assign('OrderPost',$OrderPost);
    	return $this->fetch();
    }

    public function dashboard(){
        $User=db('user');
        $Order=db('order');
    	//用户数量
    	$user=$User->count();
    	$this->assign('user',$user);
    	//商品
    	$goods=db('goods')->count();
    	$this->assign('goods',$goods);   
    	//订单
    	$order=$Order->count();
    	$this->assign('order',$order);
    	//总收入
    	$price=$Order->where('status',99)->sum('price');
    	$this->assign('price',$price);
        //获取一周订单图表数据
        $start=strtotime(date('Y-m-d',strtotime("-7 days")));
        $end=time();
        $map['create_time']=['BETWEEN',[$start,$end]];
        $list=$Order->where($map)->select();
        $DateData=[];
        foreach ($list as $value) {
            $DateData[date('Y-m-d',$value['create_time'])]['createdata'][]=$value;
            if($value['status']>0){
                $DateData[date('Y-m-d',$value['create_time'])]['paydata'][]=$value;
            }            
        }
        $OrderData=[];
        for ($i=$start; $i <=$end ; $i=$i+86400) { 
            $date=date('Y-m-d',$i);
            $OrderData['column'][]=$date;
            $OrderData['createdata'][]=count($DateData[$date]['createdata']);
            $OrderData['paydata'][]=count($DateData[$date]['paydata']);
        }
        $this->assign('OrderData',json_encode($OrderData));
        //今日注册
        $RegisterToday=$User->where('register_time','>=',strtotime(date("Y-m-d")))->count();
        $this->assign('RegisterToday',$RegisterToday);
        //今日登录
        $LoginToday=$User->where('login_time','>=',strtotime(date("Y-m-d")))->count();
        $this->assign('LoginToday',$LoginToday);
        //今日订单
        $OrderToday=$Order->where('create_time','>=',strtotime(date("Y-m-d")))->count();
        $this->assign('OrderToday',$OrderToday);
        //未处理订单
        $OrderPost=$Order->where('status',1)->count();
        $this->assign('OrderPost',$OrderPost);
        //近一周订单
        $this->assign('OrderWeek',count($list));
        //近一月订单
        $start=strtotime(date('Y-m-d',strtotime("-30 days")));
        $map['create_time']=['BETWEEN',[$start,$end]];
        $OrderMonth=$Order->where($map)->count();  
        $this->assign('OrderMonth',$OrderMonth);  
    	return $this->fetch();
    }
}
