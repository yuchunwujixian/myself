<?php
namespace app\common\service;

use app\common\model\Admin as AdminModel;
class Admin extends Base{

	public function __construct(){
		parent::__construct();
		$AdminModel=new AdminModel();
		$this->model=$AdminModel;
	}

	/*
	* 登录检测
	*/
	public function loginCheck(){
		return session('?admin_id');
	}

	/*
	* 登录
	*/
	public function login($admin_name,$password,$map=[]){
		$AdminModel=new AdminModel();
		$map['admin_name']=$admin_name;
		$info=$AdminModel->where($map)->find();
		if(!$info){
			return USER_EMPTY;
		}
		if($info['password']!=md5('zm_'.md5($password))){
			return PASSWORD_ERROR;
		}

		session('admin_id',$info['admin_id']);
		session('admin_name',$info['admin_name']);
		session('group_id',$info['group_id']);
		return SUCCESS;
	}

	/*
	* 退出登录
	*/
	public function loginOut(){
		session('admin_id',null);
	}

	/*
	* 修改资料
	*/
	public function save($map,$data){
		if($data['password']){
			$data['password']=md5('zm_'.md5($data['password']));
		}
		return parent::save($map,$data);
	}

	/*
	* 添加用户
	*/
	public function add($data){
		if($data['password']){
			$data['password']=md5('zm_'.md5($data['password']));
		}
		return parent::add($data);
	}

	/*
	* 通过id获取用户信息
	*/
	public function getInfoById($id){
		return $this->model->get($id);
	}
}