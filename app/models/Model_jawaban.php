<?php 

class Model_jawaban{
	protected $db;
	protected $tabel = 'jawaban';
	function __construct(){
		$this->db = new Database();
	}
	public function createTabel($data){
		$this->tabel .= $data['tokenKelas'];
		$this->db->query("CREATE TABLE $this->tabel(
    		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    		idSiswa INT(6) NOT NULL,
    		idTugas INT(6) NOT NULL,
    		nilai INT(3) NOT NULL,
    		gambar TEXT NOT NULL,
    		tanggalKumpul DATE NOT NULL,
    		status VARCHAR(10) NOT NULL DEFAULT 'dikumpul',
    		ket VARCHAR(100) NOT NULL
		)");
		$this->db->execute();
	}
	public function getBySiswa($data){
		$this->tabel .= strtolower($data['tokenKelas']);
		$id = $_SESSION[C_SISWA]['id'];
		$this->db->query("SELECT * FROM $this->tabel WHERE idSiswa=:id");
		$this->db->bind('id', $id);
		return $this->db->resultSet();
	}
	public function filterBKerja_siswa($tugas, $data){
		$kumpul = $this->getBySiswa($data);
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