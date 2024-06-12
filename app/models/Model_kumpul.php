<?php 

class Model_kumpul {
	protected $db;
	protected $tabel = 'kumpul';
	function __construct(){
		$this->db = new Database();
	}

	public function getBySiswa(){
		$id = $_SESSION[C_SISWA]['id'];
		$this->db->query("SELECT * FROM $this->tabel WHERE idSiswa=:id");
		$this->db->bind('id', $id);
		return $this->db->resultSet();
	}
	public function filterBKerja_siswa($tugas){
		$kumpul = $this->getBySiswa();
		foreach ($kumpul as $k){
			foreach ($tugas as $i => $t) {
				if($k['idTugas'] === $t['id']) unset($tugas[$i]);
			}	
		}
		return $tugas;
	}
	public function filterByStatus_siswa($kumpul, $status){
		foreach ($kumpul as $key => $value) if($value['status'] !== $status) unset($kumpul[$key]);
		return $kumpul;
	}
}