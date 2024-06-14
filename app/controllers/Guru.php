<?php 


class Guru extends Controller{
	// tampilan
	protected $data = [];
	protected $dataClear = [];
	function __construct(){
		if(isset($_POST)) $this->dataClear = $this->clearData($_POST);
	}
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
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, 'm_guru_buatKelas'];
		$this->func_dashoard('buatKelas');
	}
	public function soalKu(){
		$this->data ['soal'] = $this->model('Model_soal')->getByIdGuru();
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, 't_config_mathjax', 'm_guru_soalKu'];
		$this->func_dashoard('soalKu');
	}



	// mekanisme
	public function masuk(){
		switch ($this->model('Model_guru')->masuk($this->dataClear)) {
			case  0: $this->model('Model_message')->set('Password salah!', 'warning', 'ERROR'); break; 
			case -1: $this->model('Model_message')->set('Guru tidak dikenali!', 'danger', 'ERROR'); break;
			case  1: $this->model('Model_message')->set('Berhasil Login');
		}
		header("Location: ".BASE_URL.'Guru');
	}
	public function daftar(){
		switch ($this->model('Model_guru')->daftar($this->dataClear)) {
			case -1: $this->model('Model_message')->set('Username sudah digunakan oleh guru lain!'); break; 
			case -2: $this->model('Model_message')->set('Password dan Konfirmasi Password berbeda!'); break;
			case  1: $this->model('Model_message')->set('Berhasil Login');
		}
		header("Location: ".BASE_URL.'Guru');
	}
	public function simpanKelas(){
		if($this->model('Model_kelas')->getByToken($this->dataClear) === FALSE){
			$this->model('Model_kelas')->simpanKelas($this->dataClear);
			$this->model('Model_guru')->tambahKelas($this->dataClear);
			$this->model('Model_jawaban')->createTabel($this->dataClear);
			$this->model('Model_message')->set('Kelas Berhasil dibuat', 'success');
			header("Location: ".BASE_URL.'Guru/detailKelas/'.$this->dataClear['tokenKelas']);
		}else{
			$this->model('Model_message')->set('Token Kelas sudah digunakan oleh guru lain', 'danger');
			header("Location: ".BASE_URL.'Guru/buatKelas');
		}
		exit();
	}
	public function simpanSoal(){
		$this->model('Model_soal')->simpanSoal($this->dataClear);
		header("Location: ".BASE_URL."Guru/soalKu");
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
		$this->data['kelas'] = $this->model('Model_kelas')->getByGuru($this->data['guru']);
		$this->view('tamplates/header', $this->data);
		$this->view('tamplates/dashboard', $this->data);
		$this->view('tamplates/footer', $this->data);
	}

}