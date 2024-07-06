<?php 


class Model_document{
	public function upload($files, $token, $key = 'g'){
		// g_tokenKelas_time
		$namaBaru = [];
		foreach ($files as $key => $file) {
			$name = $file['name'];
			$tamp = $file['tmp_name'];
			$eks = explode('.', $name);
			$eks = end($eks);
			var_dump($eks);
			echo "<br>";
			if(strtolower($eks) === 'pdf'){
				$n = $key.'_'.$token.'_'.time().'.'.$eks;
				if(move_uploaded_file($tamp, 'assets/document/'.$n)){
					array_push($namaBaru, $n);
				}
			}
		}
		return empty($namaBaru) ? FALSE : $namaBaru;
	}
}