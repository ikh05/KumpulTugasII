<?php 

class Model_log{
	public function getUpdate(){
		$update = file_get_contents("assets/log/update.json");
		return json_decode($update, true);
	}
}