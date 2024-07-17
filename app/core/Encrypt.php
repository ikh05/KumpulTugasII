<?php 


class Encrypt{
	protected $keyEncripsi = "ICH-KumpulTugas_2.0";
	protected $keyArray;
	function __construct($data){
		$this->keyArray = $data;
		$this->keyArray []= 'id';
	}
	public function enc_string(&$data){
		$cipher= "AES-256-CBC";
		$ivlen = openssl_cipher_iv_length($cipher);
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext = openssl_encrypt($data, $cipher, $this->keyEncripsi, OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext, $this->keyEncripsi, TRUE);
		$data = base64_encode($iv.$hmac.$ciphertext);
		return TRUE;
	}
	public function dec_string(&$data){
		$cipher= "AES-256-CBC";
		$c = base64_decode($data);
		$ivlen = openssl_cipher_iv_length($cipher);
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len = 32);
		$ciphertext = substr($c, $ivlen + $sha2len);
		$original_plaintext = openssl_decrypt($ciphertext, $cipher, $this->keyEncripsi, OPENSSL_RAW_DATA, $iv);
		$calcmac = hash_hmac('sha256', $ciphertext, $this->keyEncripsi, TRUE);
		if(hash_equals($hmac, $calcmac)){
			$data = $original_plaintext;
			return TRUE;
		}
		return FALSE;
	}
	public function array(&$data, $methode){
		$this->loopArray($data, $methode.'_string');
	}
	protected function loopArray(&$data, $methode){
		foreach ($data as $key => $value) {
			if(in_array($key, $this->keyArray)){
				$this->$methode($value);
				$data[$key] = $value;
			}
		}
	}
}