<?php 

class Ajax extends Controller{
	protected $res = [];
	function __construct(){
		// Cek apakah request datang dari AJAX
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == C_AJAX) {
		    $this->res ['status'] = 'success';
		} else {
		    $this->res ['status'] = 'error';
			$this->res ['message'] = 'Tidak bisa melakukan ajax';
			$this->__destruct(); exit();
		}
	}
	function __destruct(){
		// Mengubah array menjadi format JSON
	    header('Content-Type: application/json');
	    $this->res['BASE_URL'] = BASE_URL;
	    echo json_encode($this->res);
	}
	public function index(){
		// function ajax tidak dikenali
		$this->res ['message'] = 'ajax tidak dikenali';
	}
	protected function cekAjax($const){
		switch ($const) {
			case C_GURU:
				if(isset($_SESSION[C_GURU])) return true;
				break;
			case C_SISWA:
				if(isset($_SESSION[C_SISWA])) return true;
				break;
		}
		$this->res ['status'] = 'error';
		$this->res ['message'] = 'anda tidak memiliki ijin untuk melakukan ini';
		return false;
	}

	// ajax guru
	public function editSoal($idSoal){
		if($this->cekAjax(C_GURU)){
			$soal = $this->model('Model_soal')->getById($idSoal);
			if($soal['idGuru'] !== $_SESSION[C_GURU]){
				$this->res ['message'] = 'anda tidak bisa mengedit soal orang lain!';
				return 0;
			}
			$this ->res ['result'] = $soal;
		}
	}

	public function getTugas ($idTugas){
		if($this->cekAjax(C_SISWA)){
			$tugas = $this->model('Model_tugas')->getById($idTugas);
			$siswa = $this->model('Model_siswa')->getSession();
			if($tugas['tokenKelas'] !== $siswa['tokenKelas']){
				$this->res ['message'] = 'anda tidak terdaftar dikelas ini';
				return 0;
			}
			$this->model('Model_soal')->tempelSoal($tugas);

			$tugas[0]['soal'] = $this->model('Model_soal')->tempelGambar($tugas[0]['soal']);
			$this->res['tugas'] = $tugas[0];
			$jawaban = $this->model('Model_jawaban')->getBySiswa_Tugas($siswa,$idTugas);
			if($jawaban !== FALSE) $jawaban['gambar'] = json_decode($jawaban['gambar']);
			$this->res ['jawaban'] = $jawaban;
		}else if($this->cekAjax(C_GURU)){

		}
	}
	public function getJawaban($id){
		if($this->cekAjax(C_GURU)){
			$this->res['jawaban'] = $this->model('Model_jawaban')->getById($id);
			$this->res['siswa'] = $this->model('Model_siswa')->getById($this->res['jawaban']['idSiswa']);
		}
	}

	
}   