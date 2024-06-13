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
}