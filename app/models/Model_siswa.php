<?php 



class Model_siswa{
	protected $db;
	protected $tabel = 'siswa';
	function __construct(){
		$this->db = new Database();
	}

	public function cekPassword($data){
		$nama = htmlspecialchars($data['nama']);
		$token = htmlspecialchars($data['token']);
		$pass = htmlspecialchars($data['pass']);
		$this->db->query("SELECT * FROM $this->tabel WHERE nama=:nama AND tokenKelas=:token");
		$this->db->bind('nama', $nama);
		$this->db->bind('token', $token);
		$res = $this->db->single();
		return $res === FALSE ? -1 : (password_verify($pass, $res['password']) ? $this->setDataSiswa($data) : $this->removeDataSiswa());
	}

	public function tambahSiswa($data){
		$nama = htmlspecialchars($data['nama']);
		$noWa = htmlspecialchars($data['noWa']);
		$email = htmlspecialchars($data['email']);
		$pass = htmlspecialchars($data['pass']);
		$tokenKelas = htmlspecialchars($data['token']);
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
		$this->db->query("SELECT * FROM $this->tabel WHERE nama=:nama AND tokenKelas=:token");
		$this->db->bind('nama', htmlspecialchars($data['nama']));
		$this->db->bind('token', htmlspecialchars($data['token']));
		$_SESSION[C_SISWA] = $this->db->single();
		return 1;
	}
	protected function removeDataSiswa(){
		$_SESSION[C_SISWA]['nama'] = '? Tidak dikenali ?';
		$_SESSION[C_SISWA]['id'] = -1;
		return 0;
	}
}