<?php 


class Gambar extends Controller{
	protected $gambar;
	public function index(){}
	public function getGambarTugas($namaGambar){
		if(isset($_SESSION[C_SISWA]) || isset($_SESSION[C_GURU])){
			$this->model('Model_gambar')->getImg($namaGambar);
		}
	}
	public function getGambarJawaban_Siswa($namaGambar){
		if(!isset($_SESSION[C_SISWA])){
			header("Location: ".BASE_URL.'Error/noIjin/Gambar/noSiswa');
		}
		$siswa = $this->model('Model_siswa')->getSission();
		$this->model('Model_gambar')->getImg($namaGambar);
	}
	public function getGambarJawaban_Guru($namaGambar){
		// code...
	}
}