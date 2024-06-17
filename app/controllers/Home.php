<?php 

class Home extends Controller{
	protected $data = [];
	protected $dataClear = [];
	function __construct(){
		if(isset($_POST)) $this->dataClear = $this->clearData($_POST);
	}
	public function index (){
		$this->data = [];
		if(!$this->model('Model_message')->cek()){
			$this->model('Model_message')->set('Silahkan lengkapi identitas anda!', 'primary', 'Selamat Datang' );
		}
		$this->data[C_MESSAGE] = $this->model('Model_message')->get();
		$this->data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, "m_home_index"];
		$this->view("tamplates/header", $this->data);
		$this->view("home/index", $this->data);
		$this->view("tamplates/footer", $this->data);
	}
	public function tugas(){
		$this->data = [];
		$kelas = $this->model('Model_kelas')->getByToken($this->dataClear);
		if($kelas === FALSE){
			$this->model('Model_message')->set('Kelas tidak dikenali!', 'danger', 'ERROR');
			header("Location: ".BASE_URL); exit();
		}
		if(!isset($this->dataClear['pass'])){
			$this->model('Model_message')->set('Silahkan masukkan identitas diri anda dengan benar!', 'danger', 'ERROR:');
			header("Location: ".BASE_URL); exit();
		}else{ 
			switch ($this->model('Model_siswa')->cekDataSiswa($this->dataClear)){
				case 0: $this->model('Model_message')->set('Password yang anda masukkan salah!', 'danger', 'ERROR');
					header("Location: ".BASE_URL);
				case -1: $this->model('Model_siswa')->tambahSiswa($this->dataClear);
				case 1: 
					$this->data['tugas'] = $this->model('Model_tugas')->getByToken($this->dataClear);
					$this->data['tugasDikerjakan'] = $this->model('Model_jawaban')->getBySiswa($this->dataClear);
					$this->data['tugas']= $this->model('Model_soal')->tempelSoal($this->data['tugas']);
					$this->data['tugasDikerjakan']= $this->model('Model_soal')->tempelSoal($this->data['tugasDikerjakan']);
					$this->data['tugasDikerjakan'] = $this->model('Model_tugas')->tempelTugas($this->data['tugasDikerjakan']);

					$this->data['status-tugas'] = $this->model('Model_tugas')->countTugasStatus($this->data['tugas'], $this->data['tugasDikerjakan']);

					$this->data['bkerja'] = $this->model('Model_jawaban')->filterBKerja_siswa($this->data['tugas'], $this->dataClear);
					$this->data['dikumpul'] = $this->model('Model_jawaban')->filterByStatus_siswa($this->data['tugasDikerjakan'], 'dikumpul');
					$this->data['dinilai'] = $this->model('Model_jawaban')->filterByStatus_siswa($this->data['tugasDikerjakan'], 'dinilai');
					$this->data['ditolak'] = $this->model('Model_jawaban')->filterByStatus_siswa($this->data['tugasDikerjakan'], 'ditolak');
					break;
			}
		}
		$this->data[C_MESSAGE] = $this->model('Model_message')->get();
		$this->data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, "m_home_index", "m_home_tugas"];
		$this->view("tamplates/header", $this->data);
		$this->view("home/index", $this->data);
		$this->view('home/tugas', $this->data);
		$this->view("tamplates/footer", $this->data);
	}
}