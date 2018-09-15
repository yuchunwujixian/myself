<?php
namespace app\common\service;

use app\common\model\Adsense as AdsenseModel;

class Adsense extends Base{
	public function __construct(){
		parent::__construct();
		$AdsenseModel=new AdsenseModel();
		$this->model=$AdsenseModel;
	}	
}