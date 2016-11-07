<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pb extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("sliderModel");

		$slides = $this->sliderModel->get_active_now();

    $this->load->vars(["slides" => $slides]);

	}

	public function what()
	{
		session_write_close();
		$this->load->view('pb/what',[
				"pb" => "what",
				"pageTitle" => "參與式預算是什麼？"
			] );
		
	}

	public function how()
	{
		session_write_close();
		$this->load->view('pb/how',[
				"pb" => "how",
				"pageTitle" => "參與式預算怎麼執行？"
		]);
	}

	public function who()
	{
		session_write_close();
		$this->load->view('pb/who',[
				"pb" => "who",
				"pageTitle" => "參與式預算誰該參加"
		]);
	}


	public function go()
	{
		session_write_close();
		$this->load->view('pb/go',[
				"pb" => "go",
				"pageTitle" => "參與式預算怎麼提案"
		]);
	}
}
