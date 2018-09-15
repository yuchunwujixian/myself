<?php
namespace app\common\service;

use app\common\model\Content as ContentModel;

class Content extends Base{

	public function __construct(){
		parent::__construct();
		$ContentModel=new ContentModel();
		$this->model=$ContentModel;
	}
	
}