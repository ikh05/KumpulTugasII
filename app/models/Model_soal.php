<?php 

class Model_soal{
	protected $db;
	protected $tabel = 'soal';
	function __construct(){
		$this->db = new Database();
	}

	public function tempelSoal(&$tugas, $tempelGambar = false){
		$tugas = (isset($tugas['id'])) ? [$tugas] : $tugas;
		foreach ($tugas as $k => $t) {
			$soal = '';
			$iter = 0;
			foreach ($t['idSoal'] as $key => $value) {
				$this->db->query("SELECT * FROM $this->tabel WHERE id=:id");
				$this->db->bind('id', $value);
				$res = $this->db->single();
				if($res !== FALSE) {
					$iter += 1;
					$soal .= ($iter.". ".$res['soal']."<br>");

				}
			}
			if($tempelGambar) $soal = $this->tempelGambar($soal);
			$tugas[$k]['soal'] = $soal;
		}
	}
	public function getByIdGuru(){
		$this->db->query("SELECT * FROM $this->tabel WHERE idGuru=:idGuru");
		$this->db->bind('idGuru', $_SESSION[C_GURU]);
		return $this->db->resultSet();
	}
	public function getById($id){
		$this->db->query("SELECT * FROM $this->tabel WHERE id=:id");
		$this->db->bind('id', $id);
		return $this->db->single();
	}

	public function simpanSoal($namaSoal, $soal){
		$tanggal = date("Y-m-d");
		$this->db->query("INSERT INTO $this->tabel (`nama`, `soal`, `tanggal`, `idGuru`) VALUES (:nama, :soal, :tanggal, :idGuru)");
		$this->db->bind('nama', $namaSoal);
		$this->db->bind('soal', $soal);
		$this->db->bind('idGuru', $_SESSION[C_GURU]);
		$this->db->bind('tanggal', $tanggal);
		$this->db->execute();

		$this->db = new Database;
		$this->db->query("SELECT * FROM $this->tabel WHERE tanggal=:tanggal");
		$this->db->bind('tanggal', $tanggal);
		return $this->db->single();
	}
	public function tempelNamaGambar($namaGambar, $soal){
		foreach ($namaGambar as $key => $value) {
			$soal = str_replace("__G_".$key."__", "__G_".$value."__", $soal);
		}
		return $soal;
	}
	public function tempelNamaDocument($namaFile, $soal){
		$namaFile = is_array($namaFile) ? $namaFile: [$namaFile];
		foreach ($namaFile as $key => $value) {
			$soal = str_replace('__D_'.$value.'__', '__D_'.$value.'__', $soal);
		}
		return $soal;
	}
	public function deleteById($id){
		$this->db->query("DELETE FROM $this->tabel WHERE id=:id AND idGuru=:idGuru");
		$this->db->bind('id',$id);
		$this->db->bind('idGuru', $_SESSION[C_GURU]);
		$this->db->execute();
	}
	public function tempelGambar($soal){
		$tamps = file_get_contents(BASE_URL.'../app/views/tamplates/element_html.html');
		$tamps = explode('<!-- end -->', $tamps);
		foreach ($tamps as $key => $tamp) {
			if(strpos($tamp, '<!-- gambar soal -->') !== -1){
				$soalNew = explode('__G_', $soal);
				foreach ($soalNew as $k => $v) {
					if(strpos($v, 'g_') === 0){
						$g = explode('__', $v);
						$n = $g[0];
						$g[0] = str_replace('${BASE_URL}', BASE_URL, $tamp);
						$g[0] = str_replace('${namaGambar}', $n, $g[0]);
						$v = implode('', $g);
					}
					$soalNew[$k] = $v;
				}
				$soal = implode('', $soalNew);
				break;
			}
		}
		// var_dump($soal);
		// die;
		return $soal;
	}
	public function tempelDocument($soal){
		$tamps = file_get_contents(BASE_URL.'../app/views/tamplates/element_html.html');
		var_dump(BASE_URL); die;
		$tamps = explode('<!-- end -->', $tamps);
		foreach ($tamps as $key => $tamp) {
			if(strpos($tamp, '<!-- document soal -->') !== -1){
				$soalNew = explode('__D_', $soal);
				foreach ($soalNew as $k => $v) {
					if(strpos($v, 'g_') === 0){
						$g = explode('__', $v);
						$n = $g[0];
						$g[0] = str_replace('${BASE_URL}', BASE_URL, $tamp);
						$g[0] = str_replace('${namaDocument}', $n, $g[0]);
						$v = implode('', $g);
					}
					$soalNew[$k] = $v;
				}
				$soal = implode('', $soalNew);
				break;
			}
		}
		// var_dump($soal);
		// die;
		return $soal;
	}
}