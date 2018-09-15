<?php
namespace app\api\controller;

use app\common\service\Content as ContentService;

class Content extends Common{

    /* 
    * 内容详情 
    */
    public function info(){
        $id=input('get.content_id');
        $ContentService=new ContentService();
        $map['content_id']=$id;
        $info=$ContentService->find($map);
        return $this->json($info);
    }
}