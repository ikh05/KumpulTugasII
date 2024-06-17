<?php 

class Controller {
	protected $data = [];
	protected function model($model){
		include_once ("../app/models/".$model.".php");
		return new $model;		
	}
	protected function view($href, $data = []){
		include_once "../app/views/".$href.".php";
	}
	protected function clearData($data){
		foreach ($data as $key => $value) $data[$key] = htmlspecialchars($value);
		return $data;
	}

}