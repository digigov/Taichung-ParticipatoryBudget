<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller {

  public function index()
  {
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $latest_news = $this->newsModel->get_latest_event_list(1,100);
    $this->load->view('events/index',[
        "pageTitle" => "活動快訊",
        "all_news" => $latest_news
    ] );
  }


  public function view($id)
  {
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
