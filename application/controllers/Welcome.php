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
    	$latest_news = $this->newsModel->get_latest_news_list(LAST_YEAR,1,3);


		$this->load->view('welcome_message',
			[	
				"pb" => "",
				"slides" => $slides,
				"latest_news" => $latest_news
			] );
		session_write_close();
	}


	/*
	public function QA(){
		session_write_close();
		$this->load->database();
    $this->load->model("qaModel");		

		$qas = $this->qaModel->get_latest_by_page(1,1000);
		$this->load->view('pages/qa',
			[
				"pageTitle" => "問與答",
				"qas" => $qas,
        "og_image" => base_url("img/qa_og.png")
			]);
			
	}
	*/

	/*
	public function process(){
		session_write_close();
		$this->load->view('pages/process',["pageTitle" => "臺中市參與式預算推動流程"]);
	}
	*/

	public function introduce(){
		session_write_close();
		$this->load->view('pages/introduce',["pageTitle" => "認識參與式預算"]);
	}

	public function links(){
		session_write_close();
		$this->load->database();
		$this->load->model("pageModel");
    $page = $this->pageModel->get(-1,"reference_link");
		$this->load->view('pages/links',["pageTitle" => "友站連結",
			"page" => $page]);
	}

	public function import_points(){

		$this->load->model("govProjModel");
		$json = json_decode(file_get_contents(__DIR__."/../data/data.json"),true);


		foreach($json as $data){

			if($data["area_id"] == "東勢區"){
				$data["area_id"] = 6;
			}else{
				$data["area_id"] = 1;
			}

			$data["map_infos"] = json_encode(["text"=>$data["map_infos"]]);
			$this->govProjModel->insert($data);

		}
		
	}

	public function refresh_geos(){

		$this->load->model("govProjModel");

		$all = $this->govProjModel->find();

		foreach($all as $item){
			
			$info = json_decode($item->map_infos);

			if(isset($info->markers)){
				continue;
			}
			
			$markers = _parse_fiddle_text($info->text);
			$info->markers = $markers;
			
			$this->govProjModel->update($item->id,["map_infos"=>json_encode($info)]);
			
		}

		
	}
}
