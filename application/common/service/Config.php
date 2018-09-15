<?php
namespace app\common\service;

use app\common\model\Config as ConfigModel;

class Config extends Base{

	public function __construct(){
		parent::__construct();
		$ConfigModel=new ConfigModel();
		$this->model=$ConfigModel;
	}	

	public function set($key,$value){
		return parent::save(['id'=>1],[$key=>$value]);
	}

	public function find(){
		return parent::find(['id'=>1]);
	}
}