<?php 



class Model_siswa{
	protected $db;
	protected $tabel = 'siswa';
	function __construct(){
		$this->db = new Database();
	}

	public function cekDataSiswa($data){
		$data = $this->bersihkan($data);
		$nama = $data['nama'];
		$tokenKelas = $data['tokenKelas'];
		$pass = $data['pass'];
		$this->db->query("SELECT * FROM $this->tabel WHERE nama=:nama AND tokenKelas=:tokenKelas");
		$this->db->bind('nama', $nama);
		$this->db->bind('tokenKelas', $tokenKelas);
		$res = $this->db->single();
		return $res === FALSE ? -1 : (password_verify($pass, $res['password']) ? $this->setDataSiswa($data) : $this->removeDataSiswa());
	}

	public function tambahSiswa($data){
		$data = $this->bersihkan($data);
		$nama = $data['nama'];
		$noWa = $data['noWa'];
		$email = $data['email'];
		$pass = $data['pass'];
		$tokenKelas = $data['tokenKelas'];
		$this->db->query("INSERT INTO $this->tabel (`nama`, `tokenKelas`, `noWa`, `email`, `password`) VALUES (:nama, :tokenKelas, :noWa, :email, :pass)");
		$this->db->bind('nama', $nama);
		$this->db->bind('noWa', $noWa);
		$this->db->bind('email', $email);
		$this->db->bind('tokenKelas', $tokenKelas);
		$this->db->bind('pass', password_hash($pass, PASSWORD_DEFAULT));
		$this->db->execute();
		$this->setDataSiswa($data);
	}

	protected function setDataSiswa($data){
		unset($data['pass']);
		$this->db->query("SELECT * FROM $this->tabel WHERE nama=:nama AND tokenKelas=:tokenKelas");
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('tokenKelas', $data['tokenKelas']);
		$_SESSION[C_SISWA] = $this->db->single();
		return 1;
	}
	protected function removeDataSiswa(){
		$_SESSION[C_SISWA]['nama'] = '? Tidak dikenali ?';
		$_SESSION[C_SISWA]['id'] = -1;
		return 0;
	}

	public function bersihkan($data){
		foreach ($data as $key => $value) $data[$key] = htmlspecialchars($value);
		return $data;
	}
}