<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

  public function index($current_year = LAST_YEAR)
  {
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $latest_news = $this->newsModel->get_latest_news_list($current_year,1,100);
    $this->load->view('news/index',[
        "current_year" => $current_year,
        "pageTitle" => "最新消息",
        "all_news" => $latest_news
    ] );
    
  }


  public function view($id = null)
  {
    if($id == null){
      return show_404();
    }
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $news = $this->newsModel->get($id);

    if($news == null){
      return show_404();
    }

    $this->newsModel->update_clicks($id);

    $this->load->view('news/view',[
        "pageTitle" => "最新消息 [".$news->title." ]" ,
        "news" => $news
    ] );
  }

}
