<?php
namespace app\admin\controller;

use app\common\model\User as UserModel;
use app\common\mssql\MsModel;
use app\common\service\User as UserService;
use app\common\service\PointLog as PointLogService;
use app\common\service\Withdrawals as WithdrawalsService;

class User extends Base{

	public function _initialize(){
		parent::_initialize();
		//模型
		$UserModel=new UserModel();
		$this->model=$UserModel;
		//服务
		$UserService=new UserService();
		$this->service=$UserService;
	}

	public function index(){
		if(request()->isAjax()){
			// 排序
			$order=input('get.sort')." ".input('get.order');
			// limit
			$limit=input('get.offset').",".input('get.limit');

			//查询
			$map['id|user_name|mobile|nickname|email']=['like','%'.input('get.search').'%'];

			$total=$this->service->count($map);
			$rows=$this->service->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);
		}else{
			return $this->fetch();
		}
	}

	public function add(){
		if(request()->isAjax()){
			$row=input('post.row/a');
			$res=$this->service->add($row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			return $this->fetch();
		}
	}

	public function edit(){
		if(request()->isAjax()){
			$row=input('post.row/a');
			$map['id']=input('post.id');
			$res=$this->service->save($map,$row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			$map['id']=input('get.ids');
			$row=$this->service->find($map);
			$this->assign('row',$row);
			return $this->fetch();
		}		
	}

	public function delete(){
		$ids=input('get.ids');
		$map['id']=['in',$ids];
		$res=$this->service->delete($map);
		return AjaxReturn($res);
	}

	public function point(){
		if(request()->isAjax()){
			// 排序
			$order=input('get.sort')." ".input('get.order');
			// limit
			$limit=input('get.offset').",".input('get.limit');

			//查询
			if(input('get.uid')){
				$map['uid']=input('get.uid');
			}
			
			$PointLogService=new PointLogService();
			$total=$PointLogService->count($map);
			$rows=$PointLogService->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);			
		}else{

			return $this->fetch();
		}
	}

	/*
	* 提现列表
	*/
	public function withdrawals(){
		if(request()->isAjax()){
			// 排序
			$order=input('get.sort')." ".input('get.order');
			// limit
			$limit=input('get.offset').",".input('get.limit');

			//查询
			if(input('get.uid')){
				$map['uid']=input('get.uid');
			}
			
			$WithdrawalsService=new WithdrawalsService();
			$total=$WithdrawalsService->count($map);
			$rows=$WithdrawalsService->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);			
		}else{

			return $this->fetch();
		}
	}

	/*
	* 拒绝申请
	*/
	public function withdrawalsMulti(){
		$action=input('action');
   		$ids=input('ids');
		$map['id']=['in',$ids];
		$WithdrawalsService=new WithdrawalsService();
		switch ($action) {
			//拒绝
			case 'refuse':
				$res=$WithdrawalsService->refuse($map);
				break;
			case 'pass':
				$res=$WithdrawalsService->pass($map);
				break;
			case 'transfer':
				$res=$WithdrawalsService->transfer($map);
				break;
		}
		return AjaxReturn($res);    		
	}

    /*
    * 同步商品
    */
    public function userSync(){
        $res = array('code' => 0, 'msg' => '操作失败');
        $msmodel = new MsModel();//远程
        $result = $msmodel->userSync('cu_customer');
        if ($result){
            $res = $result;
        }
        return json($res);
    }
}