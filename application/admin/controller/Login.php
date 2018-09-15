<?php
namespace app\admin\controller;

use think\Controller;
use app\common\service\Admin;

class Login extends Common{

    public function index(){
    	if(request()->isGet()){
    		
    		return $this->fetch();
    	}

    	if(request()->isPost()){
    		$admin_name=input('post.admin_name');
    		if(!$admin_name){
    			return AjaxReturn(USERNAME_NOT);
    		}
    		$password=input('post.password');
    		if(!$password){
    			return AjaxReturn(PASSWORD_NOT);
    		}

    		$Admin=new Admin();
    		$res=$Admin->login($admin_name,$password);
    		if($res>0){
                if(request()->isAjax()){
                    return AjaxReturn($res,['url'=>url('admin/index/index')]);
                }else{
                    return $this->redirect('admin/index/index');
                }
    		}else{
    			return AjaxReturn($res);
    		}
    	}
    }

    public function out(){
        $Admin=new Admin();
        $Admin->loginOut();  
        return $this->redirect('login/index');
    }
}
