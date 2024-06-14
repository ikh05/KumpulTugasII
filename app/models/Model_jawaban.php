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

}