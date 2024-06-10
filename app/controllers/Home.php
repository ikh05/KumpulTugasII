<?php 

class Home extends Controller{
	public function index (){
		$data = [];
		$data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, "m_home_index"];
		$this->view("tamplates/header", $data);
		$this->view("home/index", $data);
		$this->view("tamplates/footer", $data);
	}
	public function tugas(){
		$data = [];
		$data['css'] = [CDN_BOOTSTRAP_CSS, CDN_FONTAWESOME_CSS];
		$data['js'] = [CDN_BOOTSTRAP_JS, CDN_FONTAWESOME_JS, "m_home_index"];
		$this->view("tamplates/header", $data);
		$this->view("home/index", $data);
		// $this->view('home/tugas', $data);
		$this->view("tamplates/footer", $data);
	}
}