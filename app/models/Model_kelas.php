<?php 



class Model_kelas{
	protected $db;
	protected $tabel = 'kelas';
	function __construct(){
		$this->db = new Database();
	}
	public function getByGuru($data){
		$tokenKelas = $data['tokenKelas'];
		$res = [];
		// var_dump($data['tokenKelas']); die;
		foreach ($tokenKelas as $k => $v) {
			$this->db->query("SELECT * FROM $this->tabel WHERE tokenKelas=:v");
			$this->db->bind('v', $v);
			$res[$v] = $this->db->single();
		}
		return $res;
	}
	public function getByToken($data){
		$tokenKelas = $data['tokenKelas'];
		$this->db->query("SELECT * FROM $this->tabel WHERE tokenKelas=:tokenKelas");
		$this->db->bind('tokenKelas', $tokenKelas);
		return $this->db->single();
	}
	public function getAllSekolah(){
		$this->db->query("SELECT sekolah FROM $this->tabel ORDER BY sekolah");
		$res = $this->db->resultSet();
		if(!empty($res)){
			foreach ($res as $key => $value) {
				$res[$key] = $value['sekolah'];
			}
			$res = array_unique($res);
		}
		return $res;
	}


	public function simpanKelas($data){
		$this->db->query("INSERT INTO $this->tabel (`nama`, `tokenKelas`, `sekolah`, `tahun`) VALUES (:nama, :tokenKelas, :sekolah, :tahun)");
		$this->db->bind("nama", $data['nama']);
		$this->db->bind("sekolah", $data['sekolah']);
		$this->db->bind("tahun", $data['tahun']);
		$this->db->bind("tokenKelas", $data['tokenKelas']);
		$this->db->execute();
	}
}