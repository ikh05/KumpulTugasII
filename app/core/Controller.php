<?php 

class Controller {
	protected function model($model){
		include_once ("../app/models/".$model.".php");
		return new $model;		
	}
	protected function view($href, $data = []){
		include_once "../app/views/".$href.".php";
	}

}