<?php 

class Controller {
	protected function model($modal){
		include_once "../app/modals/".$modal.".php";
		return new $modal;		
	}
	protected function view($href, $data = []){
		include_once "../app/views/".$href.".php";
	}

}