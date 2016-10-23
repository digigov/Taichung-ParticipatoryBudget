<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->load->database();
		$this->load->model("sliderModel");

		$slides = $this->sliderModel->get_active_now();

		$this->load->view('welcome_message',
			[	
				"pb" => "",
				"slides" => $slides
			] );
		session_write_close();
	}

	public function QA(){
		session_write_close();
		$this->load->database();
    $this->load->model("qaModel");		

    $qas = $this->qaModel->get_latest_by_page(1,1000);
		$this->load->view('pages/qa',
			[
				"pageTitle" => "問與答",
				"qas" => $qas
			]);
			
	}
	public function process(){
		session_write_close();
		$this->load->view('pages/process',["pageTitle" => "臺中市參與式預算推動流程"]);
	}

}
