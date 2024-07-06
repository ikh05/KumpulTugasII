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
		$_SESSION[C_DELETE] = $delete;
		$this->data ['id'] = $id;
		$this->data ['delete'] = $delete;
		if($delete === 'soal') $this->data['asal'] = BASE_URL.'Guru/soalKu';
		else if($delete === 'tugas') $this->data['asal'] = BASE_URL.'Guru/daftarTugas/'.$_SESSION[C_KELAS];
		// else if($delete === 'kelas') $this->data['asal'] = BASE_URL.'Guru/kelas';
		// else if($delete === 'siswa') $this->data['asal'] = BASE_URL.'Guru/daftarSiswa/'.$_SESSION[C_KELAS];


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
		$this->data['allkelas'] = $this->model('Model_kelas')->getByGuru($this->data['guru']['tokenKelas']);
		$this->data['offcanvas'] = is_null($active) ? $content : $active;
		$this->data['content_main'] = 'guru/'.$content;
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
		foreach ($this->data['soal'] as $k => $v) $this->data['soal'][$k]['soal'] = $this->model('Model_soal')->tempelGambar($v['soal']);

		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, 't_config_mathjax', 'm_guru_soalKu'];

		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('soalKu');
		$this->view('tamplates/cekGambar', $this->data);
		$this->view('tamplates/footer', $this->data);
	}
	public function daftarTugas($tokenKelas){
		$_SESSION[C_KELAS] = $tokenKelas;
		$this->data ['soal'] = $this->model('Model_soal')->getByIdGuru();
		foreach ($this->data['soal'] as $k => $v) $this->data['soal'][$k]['soal'] = $this->model('Model_soal')->tempelGambar($v['soal']);
		$this->data['tugas'] = $this->model('Model_tugas')->getByToken($tokenKelas);
		$this->data['kelas'] = $this->model('Model_kelas')->getByToken($tokenKelas);
		$this->data ['tokenKelas-active'] = $tokenKelas;
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, 't_config_mathjax', 'm_guru_daftarTugas'];
		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('daftarTugas', $_SESSION[C_KELAS]);
		$this->view('tamplates/cekGambar', $this->data);
		$this->view('tamplates/footer', $this->data);
	}
	public function detailTugas($idTugas){
		define('DITOLAK', 'warning');
		define('DIKUMPUL', 'primary');
		define('DINILAI', 'success');
		define('TERLAMBAT', 'danger');
		$this->data ['tugas'] = $this->model('Model_tugas')->getById($idTugas);
		$this->data ['kelas'] = $this->model('Model_kelas')->getByToken($this->data['tugas']['tokenKelas']);
		$this->model('Model_soal')->tempelSoal($this->data['tugas'], true);
		$this->data ['tugas'] = $this->data['tugas'][0];
		$this->data ['jawaban'] = $this->model('Model_jawaban')->getAllByIdTugas($idTugas);
		$this->model('Model_siswa')->tempelSiswa($this->data['jawaban']);
		$_SESSION[C_KELAS] = $this->data['tugas']['tokenKelas'];

		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, 't_config_mathjax', 'm_guru_detailTugas'];
		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('detailTugas', $_SESSION[C_KELAS]);
		$this->view('tamplates/cekGambar', $this->data);
		$this->view('tamplates/footer', $this->data);
	}
	public function daftarNilai($tokenKelas){
		// kelas
		$this->data ['kelas'] = $this->model('Model_kelas')->getByToken($tokenKelas);
		// tugas, soal, dan gambar
		$this->data['tugas'] = $this->model('Model_tugas')->getByToken($tokenKelas);
		$this->model('Model_soal')->tempelSoal($this->data['tugas'], true);
		// guru
		$this->data ['guru'] = $this->model('Model_guru')->getSession();
		// siswa
		$this->data ['siswa'] = $this->model('Model_siswa')->getAllByTokenKelas($tokenKelas, 'nama ASC');
		// nilai
		$this->data['nilai'] = $this->model('Model_jawaban')->getAll($tokenKelas);

		$_SESSION[C_KELAS] = $tokenKelas;
		$this->data ['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data ['js'] = [CDN_POPPER_JS, CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, CDN_SHEET_JS, 'sheet'];
		$this->view('tamplates/header', $this->data);
		$this->func_dashoard('daftarNilai', $_SESSION[C_KELAS]);
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
				var_dump($_FILES);die;
				$soal = "__D_".$namaFile[0].'__';
				$soal = $this->model('Model_soal')->tempelNamaDocument($namaFile, $soal);
				$this->dataClear['soal-pilih'] = $this->model('Model_soal')->simpanSoal($namaFile[0], $soal)['id'];
			}
			$this->model('Model_tugas')->simpanTugas($this->dataClear, $tokenKelas);
			$this->model('Model_message')->success('Tugas berhail ditambahkan!');
		}else $this->model('Model_message')->error('Tugas gagal ditambahkan!');
		header('Location: '.BASE_URL.'Guru/daftarTugas/'.$tokenKelas);
	}
	public function simpanNilai($idTugas){
		$this->model('Model_jawaban')->updateNilai($this->dataClear);
		header("Location: ".BASE_URL."Guru/detailTugas/".$idTugas);
	}
	public function fiksDelete($delete, $id){
		// belum ada untuk mencek apakah yang akan didelete merupakan milik dari si punya dan harus dari Guru/delete/$delete/$id

		// jika tugas di dalete, cek di dalam jawab, apakah ada yang mengumpultugas itu, jika ada delete juga,

		$asal = '';
		if(isset($_SESSION[C_DELETE])){
			unset($_SESSION[C_DELETE]);
			$this->model('Model_'.$delete)->deleteById($id);
			switch ($delete) {
				case 'siswa': break;
				case 'soal': 
					$asal = 'soalKu'; break;
				case 'kelas': break;
				case 'tugas': 
					$this->model('Model_jawaban')->delete('idTugas', $id);
					$asal = 'daftarTugas/'.$_SESSION[C_KELAS]; break;
			}
		}
		header('Location: '.BASE_URL.'Guru/'.$asal);
	}
	public function keluar(){
		unset($_SESSION[C_GURU]);
		header("Location: ".BASE_URL."Guru");
	}




}