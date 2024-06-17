<?php 

class Model_jawaban{
	protected $db;
	protected $tabel = 'jawaban';
	function __construct(){
		$this->db = new Database();
	}
	public function filterTugas_terlambat(&$tugas){
		$sekarang = new DateTime();
		// var_dump($sekarang);;
		$terlambat = [];
		foreach ($tugas as $key => $value) {
			$batas = new DateTime($value['batas']);
			// var_dump($batas); die;
			if($batas < $sekarang){
				array_push($terlambat, $value);
				unset($tugas[$key]);
			}
		}
		return $terlambat;
	}
	public function filterTugas(&$jawab, &$tugas){
		// yang sama tugas >> id || jawab >> idTugas
		foreach ($jawab as $kj => $j) {
			foreach ($tugas as $kt => $t) {
				if($j['idTugas'] === $t['id']){
					$buff_tugas = $tugas[$kt];
					unset($buff_tugas['id']);
					$jawab[$kj] = array_merge($jawab[$kj], $buff_tugas);
					unset($tugas[$kj]);
				}
			}
		}
	}
	public function createTabel($tokenKelas){
		$this->tabel .= $tokenKelas;
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
	public function getAllBySiswa($siswa, $status=null){
		$this->tabel .= strtolower($siswa['tokenKelas']);
		if(is_null($status)){
			$this->db->query("SELECT * FROM $this->tabel WHERE idSiswa=:id");
		}else{
			$this->db->query("SELECT * FROM $this->tabel WHERE idSiswa=:id AND status=:status");
			$this->db->bind('status', $status);
		}
		$this->db->bind('id', $siswa['id']);
		return $this->db->resultSet();
	}
}