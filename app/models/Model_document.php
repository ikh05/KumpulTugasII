<?php 


class Model_document{
	public function upload($file, $token, $key = 'g'){
		// g_tokenKelas_time
		
		$name = $file['file-tugas']['name'];
		$tamp = $file['file-tugas']['tmp_name'];
		$eks = explode('.', $name);
		$eks = end($eks);
		if(strtolower($eks) === 'pdf' && $file['file-tugas']['error'] == UPLOAD_ERR_OK){
			$namaBaru = $key.'_'.$token.'_'.time().'.'.$eks;
			if(move_uploaded_file($tamp, 'assets/document/'.$namaBaru)){
				return $namaBaru;
			}
		}
		return false;
	}
}