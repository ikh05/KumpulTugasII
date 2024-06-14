<?php 



class Model_kelas{
	protected $db;
	protected $tabel = 'kelas';
	function __construct(){
		$this->db = new Database();
	}
	public function getByGuru($data){
		$tokenKelas = $data['tokenKelas'];
		foreach ($tokenKelas as $k => $v) {
			$this->db->query("SELECT * FROM $this->tabel WHERE tokenKelas=:v");
			$this->db->bind('v', $v);
			$tokenKelas[$k] = $this->db->single();
		}
		return $tokenKelas;
	}
	public function getByToken($data){
		$data = $this->bersihkan($data);
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
	public function bersihkan($data){
		foreach ($data as $key => $value) $data[$key] = htmlspecialchars($value);
		return $data;
	}
}