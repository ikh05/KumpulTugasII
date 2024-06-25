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
					unset($tugas[$kt]);
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
    		tanggalKumpul DATETIME NOT NULL,
    		status VARCHAR(10) NOT NULL DEFAULT 'dikumpul',
    		ket VARCHAR(100) NOT NULL
		)");
		$this->db->execute();
	}
	public function getAllByIdTugas($idTugas){
		$this->tabel .= $_SESSION[C_KELAS];
		$this->db->query("SELECT * FROM $this->tabel WHERE idTugas=:idTugas");
		$this->db->bind('idTugas', $idTugas);
		$tugas = $this->db->resultSet();
		foreach ($tugas as $key => $value) $tugas[$key]['gambar'] = json_decode($value['gambar']);
		return $tugas;
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
		// return $this->db->resultSet();
		return [];
	}
	public function getById($id){
		$this->tabel .= strtolower($_SESSION[C_KELAS]);
		$this->db->query("SELECT * FROM $this->tabel WHERE id=:id");
		$this->db->bind('id', $id);
		return $this->db->single();
	}
	public function getBySiswa_Tugas($siswa, $idTugas){
		$this->tabel .= strtolower($siswa['tokenKelas']);
		$this->db->query("SELECT * FROM $this->tabel WHERE idSiswa=:idSiswa AND idTugas=:idTugas");
		$this->db->bind('idSiswa', $siswa['id']);
		$this->db->bind('idTugas', $idTugas);
		return $this->db->single();
	}
	public function getAll($tokenKelas, $order=''){
		$this->tabel .= strtolower($_SESSION[C_KELAS]);
		if($order !== '') $order=" ORDER BY ".$order;
		$this->db->query("SELECT * FROM $this->tabel$order");
		return $this->db->resultSet();
	}
	public function updateNilai($data){
		$this->tabel .= strtolower($_SESSION[C_KELAS]);
		if($data['nilai'] === ''){
			$this->db->query("UPDATE $this->tabel SET status=:status, ket=:ket WHERE id=:id");
			$this->db->bind('ket', $data['ket']);
		}else if($data['ket'] === ''){
			$this->db->query("UPDATE $this->tabel SET status=:status, nilai=:nilai WHERE id=:id");
			$this->db->bind('nilai', $data['nilai']);
		}else{
			$this->db->query("UPDATE $this->tabel SET status=:status, nilai=:nilai, ket=:ket WHERE id=:id");
			$this->db->bind('ket', $data['ket']);
			$this->db->bind('nilai', $data['nilai']);
		}
		$this->db->bind('status', $data['status']);
		$this->db->bind('id', $data['id']);
		$this->db->execute();
	}
	public function kumpul($namaGambar, $idTugas, $tokenKelas, $ket=null){
		$this->tabel .= strtolower($tokenKelas);
		$this->db->query("SELECT * FROM $this->tabel WHERE idSiswa=:idSiswa AND idTugas=:idTugas");
		$this->db->bind('idSiswa', $_SESSION[C_SISWA]);
		$this->db->bind('idTugas', $idTugas);
		$kumpul = $this->db->single();
		if($kumpul !== FALSE){ /*kirim ulang*/
			$fileSebelumnya = json_decode($kumpul['gambar']);
			foreach ($fileSebelumnya as $key => $value) {
				if(file_exists(BASE_URL.'assets/img/'.$value)) unlink(BASE_URL.'assets/img/'.$value);
			}
			$this->db->query("UPDATE $this->tabel SET gambar=:gambar, tanggalKumpul=:tanggalKumpul, status=:status WHERE idTugas=:idTugas AND idSiswa=:idSiswa");
			$this->db->bind('status', 'dikumpul');
		}else if(is_null($ket)){
			$this->db->query("INSERT INTO $this->tabel (`idSiswa`, `idTugas`, `gambar`, `tanggalKumpul`) VALUES (:idSiswa, :idTugas, :gambar, :tanggalKumpul)");
		}else{
			$this->db->query("INSERT INTO $this->tabel (`idSiswa`, `idTugas`, `gambar`, `tanggalKumpul`, `ket`) VALUES (:idSiswa, :idTugas, :gambar, :tanggalKumpul, :ket)");
			$this->db->bind('ket', $ket);
		}
		$this->db->bind('idSiswa', $_SESSION[C_SISWA]);
		$this->db->bind('idTugas', $idTugas);
		$this->db->bind('tanggalKumpul', date("Y-m-d H:i:s"));
		$this->db->bind('gambar', json_encode($namaGambar));
		$this->db->execute();
	}
	public function delete($k, $v){
		$this->tabel .= strtolower($_SESSION[C_KELAS]);
		$this->db->query("DELETE FROM $this->tabel WHERE $k=:v");
		$this->db->bind('v', $v);
		$this->db->execute();
	}
}