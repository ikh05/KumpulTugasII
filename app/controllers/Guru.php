<?php 


class Guru extends Controller{
	public function index(){
		if(isset($_SESSION[C_GURU])) header("Location: ".BASE_URL.'Guru/dashboard');
		$data = [];
		$data[C_MESSAGE] = $this->model('Model_message')->get();
		$data['title'] = 'Guru - Login';
		$data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS, 'flipCard'];
		$data ['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, 'm_flipCard', 'm_guru_index'];
		$this->view('tamplates/header', $data);
		$this->view('guru/login', $data);
		$this->view('tamplates/footer', $data);
	}

	public function dashboard(){
		if(!isset($_SESSION[C_GURU])) header("Location: ".BASE_URL.'Guru');
		$data = [];
		$data['guru'] = $this->model('Model_guru')->getSession();
		$this->view('tamplates/header', $data);
		var_dump($data['guru']);
		$this->view('tamplates/footer', $data);
	}
	public function masuk(){
		switch ($this->model('Model_guru')->masuk($_POST['m-username'], $_POST['m-password'])) {
			case  0: $this->model('Model_message')->set('Password salah!, warning, ERROR'); break; 
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

	public function keluar(){
		unset($_SESSION[C_GURU]);
		header("Location: ".BASE_URL."Guru");
	}

}