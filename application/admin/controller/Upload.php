<?php
namespace app\admin\controller;


class Upload extends Base{
	
	/*
	* 图片上传
	*/
	public function index(){
	    // 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('file');
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public/uploads');
	    if($info){
	        return json(['code'=>1,'msg'=>"",'data'=>['url'=>'/uploads/'.str_replace('\\','/', $info->getSaveName())]]);
	    }else{
	        // 上传失败获取错误信息
	        return json(['code'=>0,'msg'=>$file->getError()]);
	    }
	}
}