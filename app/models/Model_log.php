<?php 

class Model_log{
	public function getUpdate(){
		$update = file_get_contents("assets/log/update.json");
		$update = json_decode($update);
		var_dump($update);
	}
}