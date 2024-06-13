<?php 


class Guru extends Controller{
	// tampilan
	protected $data = [];
	public function index(){
		if(isset($_SESSION[C_GURU])) header("Location: ".BASE_URL.'Guru/dashboard');
		$this->data[C_MESSAGE] = $this->model('Model_message')->get();
		$this->data['title'] = 'Guru - Login';
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS, 'flipCard'];
		$this->data ['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, 'm_flipCard', 'm_guru_index'];
		$this->view('tamplates/header', $this->data);
		$this->view('guru/login', $this->data);
		$this->view('tamplates/footer', $this->data);
	}
	public function dashboard(){
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS];
		$this->func_dashoard('dashboard');
	}
	public function buatKelas(){
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS];
		$this->func_dashoard('buatKelas');
	}

	// mekanisme
	public function masuk(){
		switch ($this->model('Model_guru')->masuk($_POST)) {
			case  0: $this->model('Model_message')->set('Password salah!', 'warning', 'ERROR'); break; 
			case -1: $this->model('Model_message')->set('Guru tidak dikenali!', 'danger', 'ERROR'); break;
			case  1: $this->model('Model_message')->set('Berhasil Login');
		}
		header("Location: ".BASE_URL.'Guru');
	}
	public function daftar(){
		switch ($this->model('Model_guru')->daftar($_POST)) {
			case -1: $this->model('Model_message')->set('Username sudah digunakan oleh guru lain!'); break; 
			case -2: $this->model('Model_message')->set('Password dan Konfirmasi Password berbeda!'); break;
			case  1: $this->model('Model_message')->set('Berhasil Login');
		}
		header("Location: ".BASE_URL.'Guru');
	}
	public function simpanKelas(){
		// simpan di kelas,
		// tambah token kelas pada guru
		// buat daftar nilai dengan nama tabel adalah token kelas,
		// cek tugas default,
		var_dump($_POST);
		die;
	}
	public function keluar(){
		unset($_SESSION[C_GURU]);
		header("Location: ".BASE_URL."Guru");
	}


	// function
	protected function func_dashoard($active, $content = null){
		if(!isset($_SESSION[C_GURU])) header("Location: ".BASE_URL.'Guru');
		$this->data['offcanvas'] = $active;
		$this->data['content_main'] = 'Guru/'.(is_null($content) ? $active : $content);
		$this->data['guru'] = $this->model('Model_guru')->getSession();
		$this->data['kelas'] = $this->model('Model_kelas')->get($this->data['guru']);
		$this->view('tamplates/header', $this->data);
		$this->view('tamplates/dashboard', $this->data);
		$this->view('tamplates/footer', $this->data);
	}

}