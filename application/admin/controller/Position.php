<?php
namespace app\admin\controller;

use app\common\service\Position as PositionService;
use app\common\service\Adsense as AdsenseService;
class Position extends Base{

	/*
	* 广告位列表
	*/
	public function index(){
		if(request()->isAjax()){
			//排序
			$order=input('get.sort')." ".input('get.order');
			//limit
			$limit=input('get.offset').",".input('get.limit');

			$PositionService=new PositionService();
			$total=$PositionService->count($map);
			$rows=$PositionService->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);
		}else{
			return $this->fetch();
		}		
	}

	/*
	* 添加广告位
	*/
	public function add(){
		if(request()->isAjax()){
			$row=input('post.row/a');

			$PositionService=new PositionService();
			$res=$PositionService->add($row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			return $this->fetch();
		}  		
	}

	/*
	* 删除广告位
	*/
	public function delete(){
		$ids=input('get.ids');
		$PositionService=new PositionService();
		$map['id']=['in',$ids];
		$res=$PositionService->delete($map);
		return AjaxReturn($res);
	}

	/*
	* 编辑广告位
	*/
	
	public function edit(){
    	$PositionService=new PositionService();

		if(request()->isAjax()){
			$row=input('post.row/a');
			$map['id']=input('post.id');

			$res=$PositionService->save($map,$row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			$map['id']=input('get.ids');
			$row=$PositionService->find($map);
			$this->assign('row',$row);
			return $this->fetch();
		}
	}	

	/*
	* 广告列表
	*/
	public function adsense(){
		if(request()->isAjax()){
			//排序
			$order=input('get.sort')." ".input('get.order');
			//limit
			$limit=input('get.offset').",".input('get.limit');
			if(input('get.pid')){
				$map['pid']=input('get.pid');
			}

			$AdsenseService=new AdsenseService();
			$total=$AdsenseService->count($map);
			$rows=$AdsenseService->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);
		}else{
			return $this->fetch();
		}		
	}

	/*
	* 添加广告
	*/
	public function adsenseAdd(){
		if(request()->isAjax()){
			$row=input('post.row/a');

			$AdsenseService=new AdsenseService();
			$res=$AdsenseService->add($row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			return $this->fetch();
		}
	}

	/*
	* 编辑广告
	*/
	public function adsenseEdit(){
    	$AdsenseService=new AdsenseService();

		if(request()->isAjax()){
			$row=input('post.row/a');
			$map['id']=input('post.id');

			$res=$AdsenseService->save($map,$row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			$map['id']=input('get.ids');
			$row=$AdsenseService->find($map);
			$this->assign('row',$row);
			return $this->fetch();
		}
	}

	/*
	* 删除广告
	*/
	public function adsenseDelete(){
		$ids=input('get.ids');
		$AdsenseService=new AdsenseService();
		$map['id']=['in',$ids];
		$res=$AdsenseService->delete($map);
		return AjaxReturn($res);
	}
}
