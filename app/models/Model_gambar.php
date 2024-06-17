<?php  

class Model_gambar{
	protected $db;
	function __construct(){
		$this->db = new Database();
	}

	public function upload($data, $file,$key='S'){
		$res = [];
		var_dump($file);
		$iterasi = 0;
		$ekstensi_valid = ['jpg', 'png', 'jpeg'];
		foreach ($file as $k => $v) {
			$namaLama = $data['nama-'.$k];
			var_dump($namaLama);
			echo "<br>";
			$name = $v['name'];
			$tamp = $v['tmp_name'];
			$eks = explode('.', $name);
			$eks = end($eks);
			if(in_array($eks, $ekstensi_valid) && $v['error'] == UPLOAD_ERR_OK){
				$iterasi += 1;
				$namaBaru = $key.'_'.time().'-'.$iterasi.'.'.$eks;
				if(move_uploaded_file($tamp, 'assets/img/'.$namaBaru)){
					$res = array_merge($res,  array($namaLama => $namaBaru));
				}
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
