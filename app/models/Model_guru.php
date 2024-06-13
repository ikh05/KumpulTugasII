<?php 

class Model_guru{
	protected $db;
	protected $tabel = 'guru';
	function __construct(){
		$this->db = new Database();
	}
	public function masuk($data){
		$data = $this->bersihkan($data);
		$username = $data['m-username'];
		$password = $data['m-password'];
		$this->db->query("SELECT * FROM $this->tabel WHERE username=:username");
		$this->db->bind('username', $username);
		$res = $this->db->single();
		if($res === FALSE){
			return -1;
		}elseif(password_verify($password, $res['password'])){
			$_SESSION[C_GURU] = $res['id'];			
			return 1;
		}else{
			return 0;
		}
	}
	public function daftar($data){
		$data = $this->bersihkan($data);
		$username = $data['d-username'];
		$nama = $data['d-nama'];
		$email = $data['d-email'];
		$wa = $data['d-wa'];
		$password = $data['d-password'];
		$konfpassword = $data['d-konf-password'];

		// cek username
		$this->db->query("SELECT * FROM $this->tabel WHERE username=:username");
		$this->db->bind('username', $username);
		$res = $this->db->single();
		if($res !== FALSE) return -1; // sudah ada
		
		// cak password
		if($password !== $konfpassword) return -2;

		$this->db->query("INSERT INTO $this->tabel (`nama`, `username`, `noWa`, `email`, `password`) VALUES (:nama, :username, :noWa, :email, :pass)");
		$this->db->bind('nama', $nama);
		$this->db->bind('noWa', $wa);
		$this->db->bind('email', $email);
		$this->db->bind('username', $username);
		$this->db->bind('pass', password_hash($password, PASSWORD_DEFAULT));
		$this->db->execute();

		$this->db->query("SELECT * FROM $this->tabel WHERE username=:username");
		$this->db->bind('username', $username);
		$res = $this->db->single();
		$_SESSION[C_GURU] = $res['id'];
		return 1;
	}

	public function bersihkan($data){
		foreach ($data as $key => $value) $data[$key] = htmlspecialchars($value);
		return $data;
	}

	public function getSession(){
		$this->db->query("SELECT * FROM $this->tabel WHERE id=:id");
		$this->db->bind('id', $_SESSION[C_GURU]);
		$res = $this->db->single();
		$json = json_decode($res['tokenKelas']);
		$res['tokenKelas'] = is_null($json) ? [] : $json;
		return $res;
	}
}