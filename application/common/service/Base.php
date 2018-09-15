<?php
namespace app\common\service;

class Base{

	public function __construct(){
		
	}

	public $with="";

	/*
	* 添加数据
	*/
	public function add($data){
		$res=$this->model->save($data);
		if($res){
			return SUCCESS;
		}else{
			return ADD_FAIL;
		}
	}

	public function addGetId($data){
		$res=$this->model->insertGetId($data);
		if($res){
			return $res;
		}else{
			return ADD_FAIL;
		}
	}	


	/*
	* 分页查询数据
	*/
	public function paginate($map=[],$field="*",$order="",$pageSize=10,$join=""){
		$res=$this->model->where($map)->with($this->with)->join($join)->field($field)->order($order)->paginate($pageSize);
		return $res;
	}

	/*
	* 查询列表数据
	*/
	public function select($map=[],$field="*",$order="",$limit="",$join=""){
		$res=$this->model->where($map)->with($this->with)->join($join)->field($field)->order($order)->limit($limit)->select();
		return $res;
	}

	/*
	* 查询总数
	*/
	public function count($map=[]){
		$res=$this->model->where($map)->count();
		return $res;
	}

	/*
	* 求和
	*/
	public function sum($map=[],$field){
		$res=$this->model->where($map)->sum($field);
		return $res?$res:0;
	}	

	/*
	* 查询单条数据
	*/
	public function find($map){
		$res=$this->model->where($map)->find();
		return $res;
	}

	/*
	* 查询某列数据
	*/
	public function value($map,$value){
		return $this->model->where($map)->value($value);
	}

	/*
	* 更新数据
	*/
	public function save($map=[],$data){
		$res=$this->model->save($data,$map);
		if($res){
			return SUCCESS;
		}else{
			return UPDATA_FAIL;
		}		
	}

	/*
	* 删除数据
	*/
	public function delete($map){
		$res=$this->model->where($map)->delete();
		if($res){
			return SUCCESS;
		}else{
			return DELETE_FAIL;
		}		
	}

}