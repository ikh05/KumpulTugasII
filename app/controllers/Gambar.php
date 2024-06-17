<?php 


class Gambar extends Controller{
	protected $gambar;
	public function index(){}
	public function getGambarTugas($namaGambar){
		if(isset($_SESSION[C_SISWA]) || isset($_SESSION[C_GURU])){
			$this->model('Model_gambar')->getImg($namaGambar);
		}
	}
	public function getGambarKumpulSiswa($namaGambar, $idSiswa){
		if(isset($_SESSION[C_SISWA]) && $this->model('Model_siswa')->getSiswa() == $idSiswa){
			$this->model('Model_gambar')->getImg($namaGambar);
		}
	}
}