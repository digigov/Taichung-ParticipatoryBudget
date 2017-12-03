<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller {

  public function index($current_year = LAST_YEAR)
  {
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $latest_news = $this->newsModel->get_latest_event_list($current_year,$current_year,1,100);
    $this->load->view('events/index',[
        "current_year" => $current_year,
        "pageTitle" => "活動快訊",
        "all_news" => $latest_news
    ] );
    
  }

  public function view($id = null)
  {
    if($id == null){
      return show_404();
    }

    if(!is_numeric($id)){
      return show_404(); 
    }

    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $news = $this->newsModel->get_event($id);

    if($news == null){
      return show_404();
    }

    $this->newsModel->update_clicks($id);

    $this->load->view('events/view',[
        "pageTitle" => "活動快訊 [".$news->title." ]" ,
        "news" => $news
    ] );
  }

}
