<?php 

class Home extends Controller{
	public function index (){
		if(!$this->model('Model_message')->cek()){
			$this->model('Model_message')->set('Silahkan lengkapi identitas anda!', 'primary', 'Selamat Datang' );
		}
		if(isset($_SESSION[C_SISWA])){
			$this->data['siswa'] = $this->model('Model_siswa')->getSession();
			$this->data ['kelas'] = $this->model('Model_kelas')->getByToken($this->data['siswa']['tokenKelas']);
			$this->data['tugas'] = $this->model('Model_tugas')->getByToken($this->data['siswa']['tokenKelas']);
			$this->model('Model_soal')->tempelSoal($this->data['tugas']);
			foreach ($this->data['tugas'] as $key => $tugas) {
				$soal = $tugas['soal'];
				$soal = $this->model('Model_soal')->tempelGambar($soal);
				$soal = $this->model('Model_soal')->tempelDocument($soal);
				$this->data['tugas'][$key]['soal'] = $soal;
			}

			// dikumpul
			$this->data['dikumpul'] = $this->model('Model_jawaban')->getAllBySiswa($this->data['siswa'], 'dikumpul');
			$this->model('Model_jawaban')->filterTugas($this->data['dikumpul'], $this->data['tugas']);

			// dinilai
			$this->data['dinilai'] = $this->model('Model_jawaban')->getAllBySiswa($this->data['siswa'], 'dinilai');
			$this->model('Model_jawaban')->filterTugas($this->data['dinilai'], $this->data['tugas']);

			// ditolak
			$this->data['ditolak'] = $this->model('Model_jawaban')->getAllBySiswa($this->data['siswa'], 'ditolak');
			$this->model('Model_jawaban')->filterTugas($this->data['ditolak'], $this->data['tugas']);

			// terlambat (cek waktu sekarang dan waktu batas)
			$this->data['terlambat'] = $this->model('Model_jawaban')->filterTugas_terlambat($this->data['tugas']);
		}
		$this->data[C_MESSAGE] = $this->model('Model_message')->get();
		$this->data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$this->data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, CDN_MATHJAX_JS, "m_home_index", 't_config_mathjax', 'm_home_tugas'];
		$this->view("tamplates/header", $this->data);
		$this->view("home/index", $this->data);
		if(isset($_SESSION[C_SISWA])) $this->view('home/tugas', $this->data);
		$this->view('tamplates/cekGambar', $this->data);
		$this->view("tamplates/footer", $this->data);
	}

	// mekanisme
	public function masuk(){
		unset($_SESSION[C_SISWA]);
		if($this->model('Model_kelas')->getByToken($_POST['tokenKelas']) === FALSE)
			$this->model('Model_message')->error('Kelas tidak dikenali!', '');
		switch ($this->model('Model_siswa')->cekSiswa($_POST)) {
			case 'passwordSalah':
				$this->model('Model_message')->error("Password salah!");
				break;
			case 'noSiswa':
				$this->model('Model_siswa')->simpan($_POST);
				$_SESSION[C_SISWA] = $this->model('Model_siswa')->getByNama_token($_POST['nama'], $_POST['tokenKelas'])['id'];
				$this->model('Model_message')->success("Berhasil menambahkan {$_POST['nama']} ke kelas {$_POST['tokenKelas']}!");
				break;
			default:
				$this->model('Model_message')->success("Selamat Datang Kembali {$_POST['nama']} di kelas {$_POST['tokenKelas']}!");
				break;
		}
		header("Location: ".BASE_URL);
	}
	public function simpanTugas($tokenKelas){
		if($_POST['status-tugas'] === 'terlambat'){
			$namaGambar = $this->model('Model_gambar')->upload_siswa($_FILES);
			$this->model('Model_jawaban')->kumpul($namaGambar, $_POST['idTugas'], $tokenKelas, $_POST['ket']);
		}else {
			$namaGambar = $this->model('Model_gambar')->upload_siswa($_FILES);
			$this->model('Model_jawaban')->kumpul($namaGambar, $_POST['idTugas'], $tokenKelas);
		}
		header("Location: ".BASE_URL);
	}
	public function clear(){
		unset($_SESSION[C_SISWA]);
		header("Location: ".BASE_URL);
	}
}