<?php 



class Model_kelas{
	protected $db;
	protected $tabel = 'guru';
	function __construct(){
		$this->db = new Database();
	}
	public function get($data){
		$tokenKelas = $data['tokenKelas'];
		foreach ($tokenKelas as $k => $v) {
			$this->db->query("SELECT * FROM $this->tabel WHERE tokenKelas=:v");
			$this->db->bind('v', $v);
			$tokenKelas[$k] = $this->db->single();
		}
		return $tokenKelas;
	}
}