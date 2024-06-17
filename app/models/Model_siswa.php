<?php 



class Model_siswa{
	protected $db;
	protected $tabel = 'siswa';
	function __construct(){
		$this->db = new Database();
	}

	public function getByNama_token($nama, $token){
		$this->db->query("SELECT * FROM $this->tabel WHERE nama=:nama AND tokenKelas=:tokenKelas");
		$this->db->bind('nama', $nama);
		$this->db->bind('tokenKelas', $tokenKelas);
		return $this->db->single();
	}
	public function simpan($data){
		$this->db->query("INSERT INTO $this->tabel (`nama`, `tokenKelas`, `noWa`, `email`, `password`) VALUES (:nama, :tokenKelas, :noWa, :email, :pass)");
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('noWa', $data['noWa']);
		$this->db->bind('email', $data['email']);
		$this->db->bind('tokenKelas', $data['tokenKelas']);
		$this->db->bind('pass', password_hash($data['password'], PASSWORD_DEFAULT));
		$this->db->execute();

		$_SESSION[C_SISWA] = $this->getByNama_token($data['nama'], $data['token'])['id'];
	}
	public function getById($id){
		$this->db->query("SELECT * FROM $this->tabel WHERE id=:id");
		$this->db->bind('id', $id);
		return $this->db->single();
	}
	public function getSession(){
		return $this->getById($_SESSION[C_SISWA]);
	}

	public function cekSiswa($data){
		$this->db->query("SELECT * FROM $this->tabel WHERE nama=:nama AND tokenKelas=:tokenKelas");
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('tokenKelas', $data['tokenKelas']);
		$siswa = $this->db->single();
		if($siswa === FALSE) return 'noSiswa';
		if(password_verify($data['password'], $siswa['password'])){
			$_SESSION[C_SISWA] = $siswa['id'];
		}else{
			return 'passwordSalah';
		}
	}
}