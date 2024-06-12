<?php 


class Guru extends Controller{
	public function index(){
		if(isset($_SESSION[C_GURU])) header("Location: ".BASE_URL.'Guru/dashboard');
		echo "tempat login";
	}

	public function dashboard(){
		if(!isset($_SESSION[C_GURU])) header("Location: ".BASE_URL.'Guru');
		echo "dashboard";
	}

	public function keluar(){
		unset($_SESSION[C_GURU]);
		header("Location: ".BASE_URL."Guru");
	}

}