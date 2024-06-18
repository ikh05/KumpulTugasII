<?php 


class Model_message{
	protected $res = '';
	public function set($pesan, $warna = 'primary', $strong = ''){
		$_SESSION[C_MESSAGE] = array('pesan' => $pesan , 'warna' => $warna, 'strong'=>$strong);
	}
	public function get(){
		if(isset($_SESSION[C_MESSAGE])){
			$this->res = $_SESSION[C_MESSAGE];
			unset($_SESSION[C_MESSAGE]);
		}
		return $this->res;
	}
	public function error($mes, $location=null){
		$this->set($mes, 'danger', 'Error');
		if(!is_null($location)) {header("Location: ".BASE_URL.$location); exit();}
	}
	public function warning($mes,$location=null){
		$this->set($mes, 'warning', 'Warning');
		if(!is_null($location)) {header("Location: ".BASE_URL.$location); exit();}
	}
	public function success($mes, $location=null){
		$this->set($mes, 'success', 'Sukses');
		if(!is_null($location)) {header("Location: ".BASE_URL.$location); exit();}
	}
	public function cek(){
		return isset($_SESSION[C_MESSAGE]);
	}
}