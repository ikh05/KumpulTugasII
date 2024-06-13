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
}