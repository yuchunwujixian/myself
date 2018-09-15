<?php
namespace app\admin\controller;

use app\common\service\Admin as AdminService;
use app\common\service\Group as GroupService;

class Admin extends Base {

	public function _initialize() {
		parent::_initialize();
		//服务
		$AdminService  = new AdminService();
		$this->service = $AdminService;
	}

	/*
		* 会员列表
	*/
	public function index() {
		if (request()->isAjax()) {
			// 排序
			$order = input('get.sort') . " " . input('get.order');
			// limit
			$limit = input('get.offset') . "," . input('get.limit');

			//查询
			if (input('get.search')) {
				$map['admin_id|admin_name|mobile|nickname|email|qq'] = ['like', '%' . input('get.search') . '%'];
			}

			$total = $this->service->count($map);
			$rows  = $this->service->select($map, '*', $order, $limit);
			return json(['total' => $total, 'rows' => $rows]);
		} else {
			return $this->fetch();
		}
	}

	/*
		* 添加会员
	*/
	public function add() {
		if (request()->isAjax()) {
			$row = input('post.row/a');
			$res = $this->service->add($row);
			return AjaxReturn($res, getErrorInfo($res));
		} else {
			//会员组
			$GroupService = new GroupService();
			$group        = $GroupService->select();
			$this->assign('group', $group);
			return $this->fetch();
		}
	}

	/*
		    * 编辑会员
	*/
	public function edit() {

		if (request()->isAjax()) {
			$row = input('post.row/a');

			$map['admin_id'] = input('post.admin_id');
			$res             = $this->service->save($map, $row);
			return AjaxReturn($res, getErrorInfo($res));
		} else {
			//会员组
			$GroupService = new GroupService();
			$group        = $GroupService->select();
			$this->assign('group', $group);

			$map['admin_id'] = input('get.ids');
			$row             = $this->service->find($map);
			$this->assign('row', $row);
			return $this->fetch();
		}
	}

	/*
		* 个人信息
	*/
	public function info() {
		if (request()->isAjax()) {
			$row = input('post.row/a');
			if (empty($row['password'])) {
				unset($row['password']);
			}
			$map['admin_id'] = session('admin_id');
			$res             = $this->service->save($map, $row);
			return AjaxReturn($res, getErrorInfo($res));
		} else {
			$map['admin_id'] = session('admin_id');
			$row             = $this->service->find($map);
			$this->assign('row', $row);
			return $this->fetch();
		}
	}
}