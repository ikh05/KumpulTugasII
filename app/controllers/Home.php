<?php 

class Home extends Controller{
	public function index (){
		$data = [];
		$data[C_MESSAGE] = array('pesan' => ' Silahkan lengkapi identitas anda!' , 'warna'=>'primary', 'strong' => 'Selamat Datang');
		$data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, "m_home_index"];
		$this->view("tamplates/header", $data);
		$this->view("home/index", $data);
		$this->view("tamplates/footer", $data);
	}
	public function tugas(){
		$data = [];
		$data ['tugas']= array();
		if(!isset($_POST['pass'])){
			$data[C_MESSAGE] = array('pesan' => 'Silahkan masukkan identitas diri anda!' , 'warna'=>'danger', 'strong' => 'ERROR:');
		}else{ 
			switch ($this->model('Model_siswa')->cekPassword($_POST)) {
				case 0: $data[C_MESSAGE] = array('pesan' => 'Password yang anda masukkan salah!' , 'warna'=>'danger', 'strong' => 'ERROR:');
					break;
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

		$data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, "m_home_index", "m_home_tugas"];
		$this->view("tamplates/header", $data);
		$this->view("home/index", $data);
		$this->view('home/tugas', $data);
		$this->view("tamplates/footer", $data);
	}
}