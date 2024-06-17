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


	// dashboard
	public function dashboard(){
		$this->data['guru'] = $this->model('Model_guru')->getSession();
		$this->data['kelas'] = $this->model('Model_kelas')->getByGuru($this->data['guru']);
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS];
		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('dashboard');
		$this->view('tamplates/footer', $this->data);
	}
	public function buatKelas(){
		$this->data['guru'] = $this->model('Model_guru')->getSession();
		$this->data['kelas'] = $this->model('Model_kelas')->getByGuru($this->data['guru']);
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, 'm_guru_buatKelas'];
		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('buatKelas');
		$this->view('tamplates/footer', $this->data);
	}
	public function soalKu(){
		$this->data ['soal'] = $this->model('Model_soal')->getByIdGuru();
		$this->data['guru'] = $this->model('Model_guru')->getSession();
		$this->data['kelas'] = $this->model('Model_kelas')->getByGuru($this->data['guru']);
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, 't_config_mathjax', 'm_guru_soalKu'];
		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('soalKu');
		$this->view('tamplates/cekGambar', $this->data);
		$this->view('tamplates/footer', $this->data);
	}
	public function daftarTugas($keyKelas){
		$this->data ['soal'] = $this->model('Model_soal')->getByIdGuru();
		$this->data['guru'] = $this->model('Model_guru')->getSession();
		$this->data['kelas'] = $this->model('Model_kelas')->getByGuru($this->data['guru']);
		$this->data['tugas'] = $this->model('Model_tugas')->getByToken($keyKelas);
		$this->data ['tokenKelas-active'] = $keyKelas;
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, 't_config_mathjax', 'm_guru_daftarTugas'];
		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('detailTugas', $keyKelas);
		$this->view('tamplates/cekGambar', $this->data);
		$this->view('tamplates/footer', $this->data);
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
		$this->dataClear['gambar'] = (empty($_FILES)) ? [] : $this->model('Model_gambar')->upload($this->dataClear, $_FILES, 'g');
		if(!empty($this->dataClear['gambar'])) $this->dataClear['soal'] = $this->Model('Model_soal')->tempelNamaGambar($this->dataClear);
		$this->model('Model_soal')->simpanSoal($this->dataClear);
		header("Location: ".BASE_URL."Guru/soalKu");
	}
	public function simpanTugas($tokenKelas){
		// cek apakah guru memiliki tokenKelas tersebut
		// cek cara input tugas,
		// kerjakan sesuai cara tersebut
		// jika sistem upload file maka dianggap membuat sebuah soal baru
		// simpan tugas
		if($this->model('Model_guru')->cekKelas($tokenKelas)){
			var_dump($this->dataClear);
			echo " <br> ";
			var_dump($_FILES);
			if(!isset($this->dataClear['cara'])){
				$namaFile = $this->model('Model_document')->upload($_FILES, $tokenKelas);
				$this->dataClear['soal'] = "__D_".$namaFile.'_';
				$this->dataClear['file'] = array($namaFile);
				$this->dataClear['soal'] = $this->model('Model_soal')->tempelNamaDocument($this->dataClear);
				$this->dataClear['idSoal'] = array($this->model('Model_soal')->simpanSoal($this->dataClear)['id']);
				var_dump($this->dataClear);
			}
			$this->model('Model_tugas')->simpanTugas($this->dataClear, $tokenKelas);
		}
	}
	public function keluar(){
		unset($_SESSION[C_GURU]);
		header("Location: ".BASE_URL."Guru");
	}


	// function
	protected function func_dashoard($content, $active = null){
		if(!isset($_SESSION[C_GURU])) header("Location: ".BASE_URL.'Guru');
		$this->data['offcanvas'] = is_null($active) ? $content : $active;
		$this->data['content_main'] = 'Guru/'.$content;
		$this->view('tamplates/dashboard', $this->data);
	}

}