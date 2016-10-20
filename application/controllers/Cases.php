<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends MY_Controller {

  public function index()
  {
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $latest_news = $this->newsModel->get_latest_list_by_type(
      NewsModel::TYPE_THIS_YEAR,1,100);
    $this->load->view('cases/index',[
        "pageTitle" => "今年提案",
        "all_news" => $latest_news
    ] );
  }


  public function view($id)
  {
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $news = $this->newsModel->get($id);

    if($news == null){
      return show_404();
    }

    $this->newsModel->update_clicks($id);

    $this->load->view('cases/view',[
        "pageTitle" => "今年提案 [".$news->title." ]" ,
        "news" => $news
    ] );
  }

}
