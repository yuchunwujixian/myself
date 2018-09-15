<?php
namespace app\admin\controller;

use app\common\service\ContentCategory;
use app\common\service\Content as ContentService;
class Content extends Base{

    /*
    * 分类管理
    */
    public function category(){

		if(request()->isAjax()){
			//排序
			$order=input('get.sort')." ".input('get.order');
			//limit
			$limit=input('get.offset').",".input('get.limit');

			$ContentCategory=new ContentCategory();
			$total=$ContentCategory->count($map);
			$rows=$ContentCategory->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);
		}else{
			return $this->fetch();
		}
    }

    /*
    * 添加分类
    */
    public function categoryAdd(){
		if(request()->isAjax()){
			$row=input('post.row/a');

			$ContentCategory=new ContentCategory();
			$res=$ContentCategory->add($row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			
			return $this->fetch();
		}    	
    }

    /*
    * 分类编辑
    */
    public function categoryEdit(){
    	$ContentCategory=new ContentCategory();

		if(request()->isAjax()){
			$row=input('post.row/a');
			$map['category_id']=input('post.category_id');

			$res=$ContentCategory->save($map,$row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			$map['category_id']=input('get.ids');
			$row=$ContentCategory->find($map);
			$this->assign('row',$row);
			return $this->fetch();
		}	    	
    }

    /*
    * 删除分类
    */
    public function categoryDelete(){
		$ids=input('get.ids');
		$map['category_id']=['in',$ids];

		$ContentCategory=new ContentCategory();
		$res=$ContentCategory->delete($map);
		return AjaxReturn($res);    	
    }

    /*
    * 商品管理
    */
    public function index(){
    	$ContentService=new ContentService();

		if(request()->isAjax()){
			//排序
			$order=input('get.sort')." ".input('get.order');
			//limit
			$limit=input('get.offset').",".input('get.limit');

			$total=$ContentService->count($map);
			$rows=$ContentService->select($map,'*',$order,$limit);
			return json(['total'=>$total,'rows'=>$rows]);
		}else{
			return $this->fetch();
		}    	
    }

    /*
    * 添加商品
    */
    public function add(){
		if(request()->isAjax()){
			$row=input('post.row/a');
			$ContentService=new ContentService();
			$res=$ContentService->add($row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			//获取分类列表
			$ContentCategory=new ContentCategory();
			$map['status']='normal';
			$category=$ContentCategory->select($map);
			$this->assign('category',$category);
			return $this->fetch();
		}
    }  

    /*
    * 商品编辑
    */  
   	public function edit(){
   		$ContentService=new ContentService();

		if(request()->isAjax()){
			$row=input('post.row/a');

			$map['content_id']=input('post.content_id');
			$res=$ContentService->save($map,$row);
			return AjaxReturn($res,getErrorInfo($res));
		}else{
			//获取分类列表
			$ContentCategory=new ContentCategory();
			$map['status']='normal';
			$category=$ContentCategory->select($map);
			$this->assign('category',$category);
			//商品详情
			$map=[];
			$map['Content_id']=input('get.ids');
			$row=$ContentService->find($map);
			$this->assign('row',$row);
			return $this->fetch();
		}   		
   	}

   	/*
   	* 删除商品
   	*/
   	public function delete(){
   		$ids=input('get.ids');
		$map['Content_id']=['in',$ids];
		$ContentService=new ContentService();
		$res=$ContentService->delete($map);
		return AjaxReturn($res);     		
   	}

   	/*
   	* 商品操作
   	*/
   	public function multi(){		
   		$action=input('action');
   		$ids=input('get.ids');
		$map['Content_id']=['in',$ids];
		$ContentService=new ContentService();
		if(!$action){
			return AjaxReturn(UPDATA_FAIL);   
		}
		$data[$action]=input('params');
		$res=$ContentService->save($map,$data);
		return AjaxReturn($res);
   	}
}
