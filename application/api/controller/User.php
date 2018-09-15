<?php
namespace app\api\controller;

use app\common\service\User as UserService;
class User extends Common{

	/*
	* 获取注册验证码
	*/
	public function getRegisterCode(){
		$mobile=input('mobile');
		if(!$mobile){
			return $this->json("",0,"请输入手机号");
		}
		$UserService=new UserService();
		$res=$UserService->getRegisterCode($mobile);
		if($res['status']==1){
			if(config('app_debug')){
				return $this->json($res['code']);
			}else{
				return $this->json("",1,"获取成功");
			}
		}else{
			return $this->json("",0,$res['msg']);
		}
	}

	/*
	* 获取找回密码验证码
	*/
	public function getFindCode(){
		$mobile=input('mobile');
		if(!$mobile){
			return $this->json("",0,"请输入手机号");
		}
		$UserService=new UserService();
		//检测手机号是否注册
		$user=$UserService->find(['mobile'=>$mobile]);
		if(!$user){
			return $this->json("",0,'该手机号尚未注册');
		}

		$res=$UserService->getFindCode($mobile);
		if($res['status']==1){
			if(config('app_debug')){
				return $this->json($res['code']);
			}else{
				return $this->json("",1,"获取成功");
			}
		}else{
			return $this->json("",0,$res['msg']);
		}
	}	

	/*
	* 注册
	*/
	public function register(){
		$UserService=new UserService();
		$mobile=input('post.mobile');
		if(!$mobile){
			return $this->json("",0,'请输入手机号');
		}
		//检测手机号是否注册
		$user=$UserService->find(['mobile'=>input('post.mobile')]);
		if($user){
			return $this->json("",0,'该手机号已经被注册');
		}
		//检测验证码
		$code=input('post.code');
		if(!$code){
			return $this->json('',0,'请输入验证码');
		}
		$password=input('post.password');
		if(!$password){
			return $this->json("",0,'请输入密码');
		}
		//验证
		if(!$UserService->checkRegisterCode($mobile,$code)){
			return $this->json("",0,"验证码不正确");
		}

		//检测推荐人是否存在
		if(input('post.recommender')){
			$recommender=$UserService->find(['mobile'=>input('post.recommender')]);
			if(!$recommender){
				return $this->json("",0,'推荐人不存在');
			}
			$pid=$recommender['id'];
		}

		$res=$UserService->register("",$mobile,$password,$pid);
		if($res>0){
			return $this->json(['id'=>$res]);
		}else{
			return $this->json("",0,getErrorInfo($res));
		}
	}

	/*
	* 找回密码
	*/
	public function find(){
		$UserService=new UserService();
		$mobile=input('post.mobile');
		if(!$mobile){
			return $this->json("",0,'请输入手机号');
		}
		//检测手机号是否注册
		$user=$UserService->find(['mobile'=>input('post.mobile')]);
		if(!$user){
			return $this->json("",0,'该手机号尚未注册');
		}
		//检测验证码
		$code=input('post.code');
		if(!$code){
			return $this->json('',0,'请输入验证码');
		}
		$password=input('post.password');
		if(!$password){
			return $this->json("",0,'请输入密码');
		}
		//验证
		if(!$UserService->checkFindCode($mobile,$code)){
			if(config('app_debug')){
				return $this->json("",0,"验证码不正确".session($mobile.'_find_code'));
			}else{
				return $this->json("",0,"验证码不正确");
			}
		}

		$res=$UserService->find_password($mobile,$password);
		if($res>0){
			return $this->json(['id'=>$res]);
		}else{
			return $this->json("",0,getErrorInfo($res));
		}
	}

	/*
	* 登录
	*/
	public function login(){
		$mobile=input('post.mobile');
		if(!$mobile){
			return $this->json("",0,'请输入手机号');
		}
		$password=input('post.password');
		if(!$password){
			return $this->json("",0,'请输入密码');
		}
		$UserService=new UserService();		
		$res=$UserService->login($mobile,$password);
		if($res<=0){
			return $this->json("",0,getErrorInfo($res));
		}
		//生成token
		$token=$UserService->createToken(session('id'));
		if($token){
			return $this->json(['token'=>$token]);
		}else{
			return $this->json("",0,"登录失败");
		}		
	}
}