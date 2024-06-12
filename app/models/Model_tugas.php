<?php 


class Model_tugas {
	protected $db;
	protected $tabel = 'tugas';
	function __construct(){
		$this->db = new Database();
	}

	public function getByToken($data){
		$token = htmlspecialchars($data['token']);
		$this->db->query("SELECT * FROM $this->tabel WHERE tokenKelas=:token");
		$this->db->bind('token', $token);
		return $this->db->resultSet();
	}

	public function countTugasStatus($tugas, $dikerjakan){
		$status = array('warning'=>'dikumpul', 'success'=>'dinilai', 'danger'=>'ditolak');
		$res = array('belum dikerjakan' => array(
			'warna' => 'secondary', 
			'banyak'=>count($tugas)-count($dikerjakan),
			'id'=>'bkerja'
		));
		foreach ($status as $w => $s) {
			$c = 0;
			foreach ($dikerjakan as $v) {
				if($v['status'] === $s) $c++;
			}
			$res = array_merge($res, array($s=>array(
				'warna' => $w,
				'banyak' => $c,
				'id' => $s
			)));
		}
		return $res;
	}

	public function tempelTugas($kumpul){
		foreach ($kumpul as $k => $v) {
			$this->db->query("SELECT nama, tanggal, batas FROM $this->tabel WHERE id=:idTugas");
			$this->db->bind('idTugas', $v['idTugas']);
			$kumpul[$k] = array_merge($kumpul[$k], $this->db->single());
		}
		return $kumpul;
	}
}