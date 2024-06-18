<?php 

class Model_soal{
	protected $db;
	protected $tabel = 'soal';
	function __construct(){
		$this->db = new Database();
	}

	public function tempelSoal(&$tugas){
		foreach ($tugas as $k => $t) {
			$soal = '';
			foreach ($t['idSoal'] as $key => $value) {
				$this->db->query("SELECT * FROM $this->tabel WHERE id=:id");
				$this->db->bind('id', $value);
				$soal .= $this->db->single()['soal']."<br>";
			}
			$tugas[$k]['soal'] = $soal;
		}
	}
	public function getByIdGuru(){
		$this->db->query("SELECT * FROM $this->tabel WHERE idGuru=:idGuru");
		$this->db->bind('idGuru', $_SESSION[C_GURU]);
		return $this->db->resultSet();
	}
	public function getById($id){
		$this->db->query("SELECT * FROM $this->tabel WHERE id=:id");
		$this->db->bind('id', $id);
		return $this->db->single();
	}

	public function simpanSoal($namaSoal, $soal){
		$tanggal = date("Y-m-d");
		$this->db->query("INSERT INTO $this->tabel (`nama`, `soal`, `tanggal`, `idGuru`) VALUES (:nama, :soal, :tanggal, :idGuru)");
		$this->db->bind('nama', $namaSoal);
		$this->db->bind('soal', $soal);
		$this->db->bind('idGuru', $_SESSION[C_GURU]);
		$this->db->bind('tanggal', $tanggal);
		$this->db->execute();

		$this->db = new Database;
		$this->db->query("SELECT * FROM $this->tabel WHERE tanggal=:tanggal");
		$this->db->bind('tanggal', $tanggal);
		return $this->db->single();
	}
	public function tempelNamaGambar($namaGambar, $soal){
		foreach ($namaGambar as $key => $value) {
			$tamp = "<img data-bs-toggle='modal' data-bs-target='#modal-cek' src='".BASE_URL."Gambar/getGambarTugas/$value' class='img-thumbnail' style='max-width:100px;'>";
			$soal = str_replace("__G_".$key."__", $tamp, $soal);
		}
		return $soal;
	}
	public function tempelNamaDocument($namaFile, $soal){
		$namaFile = is_array($namaFile) ? $namaFile: [$namaFile];
		foreach ($namaFile as $key => $value) {
			$tamp = "<a href='".BASE_URL."assets/document/".$value."' class='btn btn-primary'>Download Soal</a>";
			$soal = str_replace('__D_'.$value.'__', $tamp, $soal);
		}
		return $soal;
	}
	public function deleteById($id){
		$this->db->query("DELETE FROM $this->tabel WHERE id=:id AND idGuru=:idGuru");
		$this->db->bind('id',$id);
		$this->db->bind('idGuru', $_SESSION[C_GURU]);
		$this->db->execute();
	}
}