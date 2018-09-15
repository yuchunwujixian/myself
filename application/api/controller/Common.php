<?php
namespace app\api\controller;

class Common{
	public function __construct(){
		header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求  
		header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With');
		header("Access-Control-Allow-Credentials: true");
		if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		    exit();
		}
	}

	/*
	* 返回json格式数据
	*/
	public function json($data=[],$status=1,$msg="获取成功"){
		return json(['data'=>$data,'status'=>$status,'msg'=>$msg]);
	}
}