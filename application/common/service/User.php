<?php
namespace app\common\service;

use app\common\model\User as UserModel;
use app\common\service\PointLog as PointLogService;
use app\common\service\Sms as SmsService;
use think\Db;

class User extends Base{

	public function __construct(){
		parent::__construct();
		$UserModel=new UserModel();
		$this->model=$UserModel;
	}

	public function add($data){
		if($data['password']){
			$data['password']=md5('zm_'.md5($data['password']));
		}
		return parent::add($data);
	}

	public function save($map=[],$data){
		//新密码为空时不更新密码
		if(!$data['password']){
			unset($data['password']);
		}else{
			$data['password']=md5('zm_'.md5($data['password']));
		}
		return parent::save($map,$data);
	}

	/*
	* 获取注册验证码
	*/
	public function getRegisterCode($mobile){
		if(!$mobile){
			return ['status'=>0,'msg'=>'请输入手机号码'];
		}
		//开发者模式不检测手机号码
		if(!config('app_debug')){
			//检测手机号是否注册
			$user=parent::count(['mobile'=>$mobile]);
			if($user){
				return ['status'=>0,'msg'=>'该手机号已被注册'];
			}
		}
		//过期时间，开发者模式5秒,生产模式60秒
		$time=config('app_debug')?5:60;		
		//检测重复获取
		if(cache($mobile.'_code')){
			return ['status'=>0,'msg'=>cache($mobile.'_code')+$time-time().'秒后重新获取'];
		}
		$code=rand(100000, 999999);
		// 发送短信
		$SmsService=new SmsService();
		$SmsService->sendRegister($mobile,$code);
		//验证码写入session
		session($mobile.'_code',$code);
		//将时间写入缓存
		cache($mobile.'_code',time(), $time);
		return ['status'=>1,'code'=>$code];
	}

	/*
	* 检测注册验证码是否正确
	*/	
	public function checkRegisterCode($mobile,$code){
		if(!$mobile||!$code){
			return false;
		}
		return session($mobile.'_code')==$code;
	}

	/*
	* 获取找回密码验证码
	*/
	public function getFindCode($mobile){
		if(!$mobile){
			return ['status'=>0,'msg'=>'请输入手机号码'];
		}
		//开发者模式不检测手机号码
		if(!config('app_debug')){
			//检测手机号是否注册
			$user=parent::count(['mobile'=>$mobile]);
			if($user){
				return ['status'=>0,'msg'=>'该手机号已被注册'];
			}
		}
		//过期时间，开发者模式5秒,生产模式60秒
		$time=config('app_debug')?5:60;		
		//检测重复获取
		if(cache($mobile.'_find_code')){
			return ['status'=>0,'msg'=>cache($mobile.'_find_code')+$time-time().'秒后重新获取'];
		}
		$code=rand(100000, 999999);
		// 发送短信
		$SmsService=new SmsService();
		$SmsService->sendFind($mobile,$code);
		//验证码写入session
		session($mobile.'_find_code',$code);
		//将时间写入缓存
		cache($mobile.'_find_code',time(), $time);
		return ['status'=>1,'code'=>$code];
	}

	/*
	* 检测找回验证码是否正确
	*/	
	public function checkFindCode($mobile,$code){
		if(!$mobile||!$code){
			return false;
		}
		return session($mobile.'_find_code')==$code;
	}	

	/*
	* 注册用户
	*/
	public function register($user_name,$mobile,$password,$pid){
		$data=[
			'user_name'=>$user_name,
			'mobile'=>$mobile,
			'password'=>md5('zm_'.md5($password)),
			'register_time'=>time(),
			'status'=>'normal',
			'pid'=>$pid
		];
		$res=parent::add($data);
		if($res){
			return SUCCESS;
		}else{
			return REGISTER_ERROR;
		}
	}

	/*
	* 找回密码
	*/
	public function find_password($mobile,$password){
		$map['mobile']=$mobile;
		$data['password']=$password;
		$res=$this->save($map,$data);
		if($res){
			return SUCCESS;
		}else{
			return REGISTER_ERROR;
		}		
	}

	/*
	* 登录
	*/
	public function login($user_name,$password){
		
		$info=parent::find(['user_name|mobile'=>$user_name]);
		if(!$info){
			return USER_EMPTY;
		}
		if($info['password']!=md5('zm_'.md5($password))){
			return PASSWORD_ERROR;
		}

		session('id',$info['id']);
		return SUCCESS;
	}	

	/*
	* 生成token
	*/
	public function createToken($id){
		$token=md5(time());
		$res=parent::save(['id'=>$id],['token'=>$token]);
		return $res?$token:false;
	}

	/*
	* 获取推荐列表
	*/
	public function getRecommendList($uid){
		//获取推荐人
		$map['pid']=$uid;
		$data=parent::paginate($map);
		//获取推广盈利
		$PointLogService=new PointLogService();
		foreach ($data as &$value) {
			$map=[
				'uid'=>$uid,
				'action_uid'=>$value['id']
			];
			$value['point']=$PointLogService->sum($map,'num');
			$value['register_time']=date('Y-m-d');
		}
		return $data;
	}

	/*
	* 提现操作
	*/
	public function withdrawals($uid,$data){
		$arr['uid']=$uid;
		$arr['point']=$data['point'];
		$arr['ali_id']=$data['ali_id'];
		$arr['create_time']=time();
		$arr['status']=0;
		// 启动事务
		Db::startTrans();
		try{
			//记录提现信息
			$id=Db::name('withdrawals')->insertGetId($arr);
			//扣除用户积分
			Db::name('user')->where('id',$uid)->setDec('point',$data['point']);
			//记录积分日志
			$point_data=[
				'uid'=>$uid,
				'object_id'=>$id,
				'num'=>$data['point'],
				'create_time'=>time(),
				'type'=>2
			];
			Db::name('point_log')->insert($point_data);
		    // 提交事务
		    Db::commit();			
			return $id;
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return ERROR;			
		}
	}

	/*
	* 获取推广员信息
	*/
	public function getParents($uid){
		//一级推广员
		$map['id']=$uid;
		$parent1=parent::find($map);
		if(!$parent1['pid']){
			return false;
		}
		$data=[];
		array_push($data,['level'=>1,'uid'=>$parent1['pid']]);
		//二级推广员
		$map['id']=$parent1['pid'];
		$parent2=parent::find($map);
		if(!$parent2['pid']){
			return $data;
		}
		array_push($data,['level'=>2,'uid'=>$parent2['pid']]);
		//三级推广员
		$map['id']=$parent2['pid'];
		$parent3=parent::find($map);
		if(!$parent3['pid']){
			return $data;
		}
		array_push($data,['level'=>3,'uid'=>$parent3['pid']]);
		return $data;
	}

	/*
	* 修改密码
	*/
	public function changePassword($password_old,$password){
		$map['id']=session('id');
		$info=$this->find($map);
		if($info['password']!=md5('zm_'.md5($password_old))){
			return PASSWORD_ERROR;
		}
		$data['password']=$password;
		return $this->save($map,$data);
	}
}