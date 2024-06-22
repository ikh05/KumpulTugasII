<?php  

class Model_gambar{
	protected $db;
	protected $tabel = 'gambar';
	protected $ekstensi_valid = ['jpg', 'png', 'jpeg', 'tiff', 'heif'];
	function __construct(){
		$this->db = new Database();
	}

	public function upload($data, $file, $key='g'){
		$res = [];
		$iterasi = 1;
		foreach ($file as $k => $v) {
			$i = 'nama-file-'.$iterasi;
			$name = $v['name'];
			$tamp = $v['tmp_name'];
			$eks = explode('.', $name);
			$eks = end($eks);
			if(in_array($eks, $this->ekstensi_valid) && $v['error'] == UPLOAD_ERR_OK){
				$namaBaru = $key.'_'.time().'-'.$iterasi.'.'.$eks;
				move_uploaded_file($tamp, 'assets/img/'.$namaBaru);
				$res = array_merge($res,  array($data[$i] => $namaBaru));
			}
			$iterasi += 1;
		}
		return $res;
	}
	public function upload_siswa ($files){
		$res = [];
		$iterasi = 1;
		foreach ($files as $key => $file) {
			$name = $file['name'];
			$tamp = $file['tmp_name'];
			$eks = explode('.', $name);
			$eks = end($eks);
			if (in_array($eks, $this->ekstensi_valid) && $file['error'] == UPLOAD_ERR_OK){
				$namaBaru = "s_".time()."-$iterasi.".$eks;
				move_uploaded_file($tamp, 'assets/img/'.$namaBaru);
				array_push($res, $namaBaru);
				$iterasi += 1;
			}
		}
		return $res;
	}
	public function getImg($nama_gambar){
		$image_path = "assets/img/$nama_gambar";
		$image_info = getimagesize($image_path);
		$image_mime = $image_info['mime'];

		header("Content-Type: $image_mime");
		readfile($image_path);
	}
	
}
