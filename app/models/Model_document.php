<?php 


class Model_document{
	public function upload($files, $token, $key = 'g'){
		// g_tokenKelas_time
		$namaBaru = [];
		foreach ($files as $i => $file) {
			$name = $file['name'];
			$tamp = $file['tmp_name'];
			$eks = explode('.', $name);
			$eks = end($eks);
			if(strtolower($eks) == 'pdf'){
				$n = $key.'_'.$token.'_'.time().'_'.$i.'.'.$eks;
				var_dump($eks);
				echo "<br>";
				var_dump(move_uploaded_file($tamp, 'assets/document/'.$n));
				if(false){
					array_push($namaBaru, $n);
				}
			}
		}
		return empty($namaBaru) ? FALSE : $namaBaru;
	}
}