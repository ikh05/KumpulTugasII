<?php 

class Model_soal{
	protected $db;
	protected $tabel = 'soal';
	function __construct(){
		$this->db = new Database();
	}

	public function tempelSoal($tugas){
		foreach ($tugas as $i => $v) {
			$soal = [];
			foreach ($v['idSoal'] as $idSoal) {
				$this->db->query("SELECT soal FROM $this->tabel WHERE id=:idSoal");
				$this->db->bind('idSoal', $idSoal);
				$soal = array_merge($soal, $this->db->single());
			}
			$tugas[$i] = array_merge($tugas[$i], $soal);
		}
		return $tugas;
	}
	public function getByIdGuru(){
		$idGuru = $_SESSION[C_GURU];
		$this->db->query("SELECT * FROM $this->tabel WHERE idGuru=:idGuru");
		$this->db->bind('idGuru', $idGuru);
		return $this->db->resultSet();
	}

	public function simpanSoal($data){
		$tanggal = date("Y-m-d");
		$this->db->query("INSERT INTO $this->tabel (`nama`, `soal`, `tanggal`, `idGuru`) VALUES (:nama, :soal, :tanggal, :idGuru)");
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('soal', $data['soal']);
		$this->db->bind('idGuru', $_SESSION[C_GURU]);
		$this->db->bind('tanggal', $tanggal);
		$this->db->execute();

		$this->db = new Database;
		$this->db->query("SELECT * FROM $this->tabel WHERE tanggal=:tanggal");
		$this->db->bind('tanggal', $tanggal);
		return $this->db->single();
	}
	public function tempelNamaGambar($data){
		$namaGambar = $data['gambar'];
		$soal = $data ['soal'];
		foreach ($namaGambar as $key => $value) {
			$tamp = "<img src='".BASE_URL."Gambar/getGambarTugas/$value' class='img-thumbnail' style='max-width:100px;'>";
			$soal = str_replace("__G_".$key."__", $tamp, $soal);
		}
		return $soal;
	}
	public function tempelNamaDocument($data){
		$namaFile = $data['file'];
		$soal = $data['soal'];
		foreach ($namaFile as $key => $value) {
			$tamp = "<a href='".BASE_URL."assets/document/".$value."' class='btn btn-primary'>Download Soal</a>";
			$soal = str_replace('__D_'.$value.'_', $tamp, $soal);
		}
		return $soal;
	}
}