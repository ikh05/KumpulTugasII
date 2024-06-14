<?php 

class Home extends Controller{
	public function index (){
		$data = [];
		if(!$this->model('Model_message')->cek()){
			$this->model('Model_message')->set('Silahkan lengkapi identitas anda!', 'primary', 'Selamat Datang' );
		}
		$data[C_MESSAGE] = $this->model('Model_message')->get();
		$data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, "m_home_index"];
		$this->view("tamplates/header", $data);
		$this->view("home/index", $data);
		$this->view("tamplates/footer", $data);
	}
	public function tugas(){
		$data = [];
		$kelas = $this->model('Model_kelas')->getByToken($_POST);
		if($kelas === FALSE){
			$this->model('Model_message')->set('Kelas tidak dikenali!', 'danger', 'ERROR');
			header("Location: ".BASE_URL); exit();
		}
		if(!isset($_POST['pass'])){
			$this->model('Model_message')->set('Silahkan masukkan identitas diri anda dengan benar!', 'danger', 'ERROR:');
			header("Location: ".BASE_URL); exit();
		}else{ 
			switch ($this->model('Model_siswa')->cekDataSiswa($_POST)){
				case 0: $this->model('Model_message')->set('Password yang anda masukkan salah!', 'danger', 'ERROR');
					header("Location: ".BASE_URL);
				case -1: $this->model('Model_siswa')->tambahSiswa($_POST);
				case 1: 
					$data['tugas'] = $this->model('Model_tugas')->getByToken($_POST);
					$data['tugasDikerjakan'] = $this->model('Model_kumpul')->getBySiswa();

					$data['tugas']= $this->model('Model_soal')->tempelSoal($data['tugas']);
					$data['tugasDikerjakan']= $this->model('Model_soal')->tempelSoal($data['tugasDikerjakan']);
					$data['tugasDikerjakan'] = $this->model('Model_tugas')->tempelTugas($data['tugasDikerjakan']);

					$data['status-tugas'] = $this->model('Model_tugas')->countTugasStatus($data['tugas'], $data['tugasDikerjakan']);

					$data['bkerja'] = $this->model('Model_kumpul')->filterBKerja_siswa($data['tugas']);
					$data['dikumpul'] = $this->model('Model_kumpul')->filterByStatus_siswa($data['tugasDikerjakan'], 'dikumpul');
					$data['dinilai'] = $this->model('Model_kumpul')->filterByStatus_siswa($data['tugasDikerjakan'], 'dinilai');
					$data['ditolak'] = $this->model('Model_kumpul')->filterByStatus_siswa($data['tugasDikerjakan'], 'ditolak');
					break;
			}
		}
		$data[C_MESSAGE] = $this->model('Model_message')->get();
		$data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, "m_home_index", "m_home_tugas"];
		$this->view("tamplates/header", $data);
		$this->view("home/index", $data);
		$this->view('home/tugas', $data);
		$this->view("tamplates/footer", $data);
	}
}