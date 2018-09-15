<?php
namespace app\admin\controller;

use think\Controller;
use app\common\service\Admin;

class Base extends Common{

	public function _initialize(){
		//登录检测
		$Admin=new Admin();
		if(!$Admin->loginCheck()){
			return $this->redirect('login/index');
		}
		parent::_initialize();
	}
}