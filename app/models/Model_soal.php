<?php 

class Model_soal{
	protected $db;
	protected $tabel = 'soal';
	function __construct(){
		$this->db = new Database();
	}

	public function tempelSoal($tugas){
		foreach ($tugas as $i => $v) {
			$this->db->query("SELECT soal FROM $this->tabel WHERE id=:idSoal");
			$this->db->bind('idSoal', $v['idSoal']);
			$tugas[$i] = array_merge($tugas[$i], $this->db->single());
		}
		return $tugas;
	}
}