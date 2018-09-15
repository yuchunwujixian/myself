<?php
namespace app\admin\controller;

use app\common\service\Config as ConfigService;
class Config extends Base{

	public function index(){
		
		if(request()->isAjax()){
			$ConfigService=new ConfigService();
			$key=input('post.key');
			$data=input('post.row/a');
			$res=$ConfigService->set($key,$data);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			
			return $this->fetch();
		}
	}
}