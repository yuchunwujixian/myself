<?php
namespace app\common\service;

use app\common\model\GoodsCategory as GoodsCategoryModel;

class GoodsCategory extends Base{

	public function __construct(){
		parent::__construct();
		$GoodsCategoryModel=new GoodsCategoryModel();
		$this->model=$GoodsCategoryModel;
	}
}