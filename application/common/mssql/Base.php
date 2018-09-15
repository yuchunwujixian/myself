<?php
namespace app\common\mssql;

use think\Db;
use think\Model;

class Base
{
	public function __construct($table){
//        $this->model = Db::connect('sqlserver.db')->table($table);
         $this->model = db($table, 'sqlserver.db');
	}
}