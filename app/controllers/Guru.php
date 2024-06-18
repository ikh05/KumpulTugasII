<?php 


class Guru extends Controller{
	// tampilan
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
	public function delete($delete, $id){
		$this->data ['id'] = $id;
		$this->data ['delete'] = $delete;
		if($delete === 'soal') $this->data['asal'] = BASE_URL.'Guru/soalKu';
		// else if($delete === 'tugas') $this->data['asal'] = BASE_URL.'Guru/';
		// else if($delete === 'soal') $this->data['asal'] = BASE_URL.'Guru/soalKu';
		// else if($delete === 'soal') $this->data['asal'] = BASE_URL.'Guru/soalKu';


		$this->model('Model_message')->warning("Apakah anda yakin ingin menghapus $delete ini?");
		$this->data [C_MESSAGE] = $this->model('Model_message')->get();
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS, 'flipCard'];
		$this->data ['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, 'm_flipCard'];
		$this->view('tamplates/header', $this->data);
		$this->view('guru/delete', $this->data);
		$this->view('tamplates/footer', $this->data);
	}


	// dashboard
	protected function func_dashoard($content, $active = null){
		if(!isset($_SESSION[C_GURU])) header("Location: ".BASE_URL.'Guru');
		$this->data['guru'] = $this->model('Model_guru')->getSession();
		$this->data['kelas'] = $this->model('Model_kelas')->getByGuru($this->data['guru']['tokenKelas']);
		$this->data['offcanvas'] = is_null($active) ? $content : $active;
		$this->data['content_main'] = 'Guru/'.$content;
		$this->view('tamplates/dashboard', $this->data);
	}
	public function dashboard(){
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS];

		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('dashboard');
		$this->view('tamplates/footer', $this->data);
	}
	public function buatKelas(){
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, 'm_guru_buatKelas'];

		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('buatKelas');
		$this->view('tamplates/footer', $this->data);
	}
	public function soalKu(){
		$this->data ['soal'] = $this->model('Model_soal')->getByIdGuru();

		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, 't_config_mathjax', 'm_guru_soalKu'];

		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('soalKu');
		$this->view('tamplates/cekGambar', $this->data);
		$this->view('tamplates/footer', $this->data);
	}
	public function daftarTugas($keyKelas){
		$this->data ['soal'] = $this->model('Model_soal')->getByIdGuru();
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
			$this->model('Model_guru')->tambahKelas($this->dataClear['tokenKelas']);
			$this->model('Model_jawaban')->createTabel($this->dataClear['tokenKelas']);
			$this->model('Model_message')->set('Kelas Berhasil dibuat', 'success');
			header("Location: ".BASE_URL.'Guru/detailKelas/'.$this->dataClear['tokenKelas']);
		}else{
			$this->model('Model_message')->set('Token Kelas sudah digunakan oleh guru lain', 'danger');
			header("Location: ".BASE_URL.'Guru/buatKelas');
		}
		exit();
	}
	public function simpanSoal(){
		/* 
			$_FILES = { 'file-1'=>{},'file-2'=>{}}
			['gambar'] = { 'nama-file-1' => 'g_213422323_1.png'};
		*/
			var_dump($this->dataClear);
			echo "<br> <br>";
			var_dump($_FILES);
		$namaGambar = (empty($_FILES)) ? [] : $this->model('Model_gambar')->upload($this->dataClear, $_FILES, 'g');
		if(!empty($namaGambar)) $this->dataClear['soal'] = $this->Model('Model_soal')->tempelNamaGambar($namaGambar, $this->dataClear['soal']);

		$this->model('Model_soal')->simpanSoal($this->dataClear['namaSoal'], $this->dataClear['soal']);
		header("Location: ".BASE_URL."Guru/soalKu");
	}
	public function simpanTugas($tokenKelas){
		if($this->model('Model_guru')->cekKelas($tokenKelas)){
			if(!isset($this->dataClear['cara'])){
				// file yang di upload harus dalam pdf dan cuman 1
				$namaFile = $this->model('Model_document')->upload($_FILES, $tokenKelas);
				$namaFile = array($namaFile);
				$soal = "__D_".$namaFile[0].'__';
				$soal = $this->model('Model_soal')->tempelNamaDocument($namaFile, $soal);
				$this->dataClear['soal-pilih'] = $this->model('Model_soal')->simpanSoal($namaFile[0], $soal)['id'];
			}
			$this->model('Model_tugas')->simpanTugas($this->dataClear, $tokenKelas);
		}
	}
	public function fiksDelete($delete, $id){
		// belum ada untuk mencek apakah yang akan didelete merupakan milik dari si punya dan harus dari Guru/delete/$delete/$id
		switch ($delete) {
			case 'siswa': $this->model('Model_siswa')->deleteById($id);
				break;
			case 'soal': $this->model('Model_soal')->deleteById($id);
				$asal = 'soalKu'; break;
			case 'kelas':$this->model('Model_kelas')->deleteById($id);
				break;
			case 'tugas': $this->model('Model_tugas')->deleteById($id);
				break;
		}
		header('Location: '.BASE_URL.'Guru/'.$asal);
	}
	public function keluar(){
		unset($_SESSION[C_GURU]);
		header("Location: ".BASE_URL."Guru");
	}




}