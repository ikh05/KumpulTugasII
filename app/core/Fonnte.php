<?php 
class Fonte{
	protected $token = "PGpsHj!o9NB@RN3nfqNy";
	protected $target = '';
	function __construct(){
		$this->curl = curl_init();
	}
	public function kirimPesan($noTujuan, $pesan){
		
	}
	public function toSiswa_dinilai($data){
		$this->target = $data['noWa'];
		$this->clearTarget();
		if($this->target !== ''){
			$nilai = $data['nilai'];
			$nama = $data['nama'];

			curl_setopt_array($this->curl, array(
			  CURLOPT_URL => 'https://api.fonnte.com/send',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array(
			'target' => $this->target,
			'message' => "$nama, Selamat tugasmu sudah dinilai, kamu mendapatkan nilia $nilai.",
			),
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: '.$this->token
			  ),
			));
		}
	}
	public function toSiswa_ditolak($data){
		$this->target = $data['noWa'];
		$this->clearTarget();
		if($this->target !== ''){
			$ket = $data['ket'];
			$nama = $data['nama'];

			curl_setopt_array($this->curl, array(
			  CURLOPT_URL => 'https://api.fonnte.com/send',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array(
			'target' => $this->target,
			'message' => "$nama, Sayang sekali tugasmu sudah ditolak dikarenakan '$ket'. Tolong perbaiki dan kumpul kembali!",
			),
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: '.$this->token
			  ),
			));
		}
	}
	public function toGuru($namaSiswa, $kelas, $namaTugas){
		$this->target = "085157341446";
		$this->clearTarget();
		curl_setopt_array($this->curl, array(
		  CURLOPT_URL => 'https://api.fonnte.com/send',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array(
		'target' => $this->target,
		'message' => "$namaSiswa dari $kelas telah mengumpul tugas $namaTugas, silahkan periksa!",
		),
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: '.$this->token
		  ),
		));
	}
	function __destruct(){
		$response = curl_exec($this->curl);
		if (curl_errno($this->curl)) {
		  $error_msg = curl_error($this->curl);
		}
		curl_close($this->curl);
		if (isset($error_msg)) {
		 echo $error_msg;
		 echo "<script>alert('Error mengirim pemberitahuan')</script>";
		}
		echo $response;
		echo "<script>alert('Berhasil mengirim pemberitahuan')</script>";
	}
	protected function clearTarget (){
		$this->target = preg_replace('/[^0-9]/', '', $this->target);
	}
}


 ?>