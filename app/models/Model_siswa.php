<?php 



class Model_siswa{
	protected $db;
	protected $tabel = 'siswa';
	protected $enc;
	function __construct(){
		$this->db = new Database();
		$this->enc = new Encrypt (['noWa', 'email']);
	}
	protected function bersihkan(&$data){
		if(is_array($data)){
			foreach ($data as $key => $value) $data[$key] = $this->bersihkan($value);
		}
		elseif (is_string($data)) $data = htmlspecialchars($data);
		return $data; 
	}

	public function getAllByTokenKelas($tokenKelas, $urut=''){
		if($urut !== '') $urut = " ORDER BY ".$urut; 
		$this->db->query("SELECT * FROM $this->tabel WHERE tokenKelas=:tokenKelas$urut");
		$this->db->bind('tokenKelas', $tokenKelas);
		return $this->db->resultSet();
	}
	public function getByNama_token($nama, $token){
		$this->db->query("SELECT * FROM $this->tabel WHERE nama=:nama AND tokenKelas=:tokenKelas");
		$this->db->bind('nama', $nama);
		$this->db->bind('tokenKelas', $tokenKelas);
		return $this->db->single();
	}
	public function simpan($data){
		$this->bersihkan($data);
		$this->enc->array($data, 'enc');
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
		$siswa = $this->db->single();
		$this->enc->array($siswa, 'dec');
		return $siswa;
	}
	public function getSession(){
		if(isset($_SESSION[C_SISWA]))
			return $this->getById($_SESSION[C_SISWA]);
			return FALSE;
	}

	public function cekSiswa($data){
		$this->db->query("SELECT * FROM $this->tabel WHERE nama=:nama AND tokenKelas=:tokenKelas");
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('tokenKelas', $data['tokenKelas']);
		$siswa = $this->db->single();
		if($siswa === FALSE) return 'noSiswa';
		if(password_verify($data['password'], $siswa['password'])){
			$_SESSION[C_SISWA] = $siswa['id'];
			return 'ada';
		}else{
			return 'passwordSalah';
		}
	}
	public function tempelSiswa(&$data){
		$set = FALSE;
		if(isset($data['idSiswa'])){
			$set = TRUE;
			$data = [$data];
		}
		foreach ($data as $key => $value) {
			$this->db->query("SELECT * FROM $this->tabel WHERE id=:idSiswa");
			$this->db->bind('idSiswa', $value['idSiswa']);
			$siswa = $this->db->single();
			unset($siswa['password']);
			$data[$key]['siswa'] = $siswa;
		}

		if($set) $data = $data[0];
	}
}