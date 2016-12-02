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
		
		$this->load->database();
		$this->load->model("newsModel");
    $latest_news = $this->newsModel->get_latest_news_list(1,3);


		$this->load->view('welcome_message',
			[	
				"pb" => "",
				"slides" => $slides,
				"latest_news" => $latest_news
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

	public function introduce(){
		session_write_close();
		$this->load->view('pages/introduce',["pageTitle" => "認識參與式預算"]);
	}

	public function links(){
		session_write_close();
		$this->load->view('pages/links',["pageTitle" => "友站連結"]);
	}
}
