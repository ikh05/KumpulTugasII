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
		$this->db->query("INSERT INTO $this->tabel (`nama`, `soal`, `tanggal`, `idGuru`) VALUES (:nama, :soal, :tanggal, :idGuru)");
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('soal', $data['soal']);
		$this->db->bind('idGuru', $_SESSION[C_GURU]);
		$this->db->bind('tanggal', date("Y-m-d H:i:s"));
		$this->db->execute();
	}
}