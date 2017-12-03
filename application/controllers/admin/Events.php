<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_ADMIN_Controller {

  public function index()
  {
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $latest_news = $this->newsModel->get_latest_event_list(LAST_YEAR,1,100);

    $this->_load_view("events/index",[
        "pageTitle" => "所有活動一覽",
        "all_news" => $latest_news
    ]);
  }

  public function edit($id){
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $news = $this->newsModel->get_event($id);

    if($news == null){
      return show_404();
    }

    $this->_load_view("events/edit",[
        "pageTitle" => "編輯活動 " ,
        "news" => $news,
        "action" => admin_url("events/editing")
    ]);
  }

  public function editing(){
    $title = $this->input->post("title");
    $content = $this->input->post("content");
    $postid = $this->input->post("postid");

    $match = [];
    $img_match = preg_match("/<[^>]+src=['\"](.*?)['\"][^>]+/", $content,$match);

    $img = null;

    if(count($match) > 1 ){
      $img = $match[1];
    }

    $this->load->database();
    $this->load->model("newsModel");
    $this->newsModel->update_event($postid,$title,$content,$img);

    redirect(admin_url("events/"));
  }




  public function add(){

    $news = new stdclass();

    $news->title ="新增活動";
    $news->content ="";
    $news->status = 1;
    $news->category = "";
    $news->id = -1;

    $this->_load_view("events/edit",[
        "pageTitle" => "編輯活動 " ,
        "news" => $news,
        "action" => admin_url("events/adding")
    ]);

  }


  public function adding(){
    $title = $this->input->post("title");
    $content = $this->input->post("content");
    $postid = $this->input->post("postid");

    $match = [];
    $img_match = preg_match("/<[^>]+src=['\"](.*?)['\"][^>]+/", $content,$match);

    $img = null;

    if(count($match) > 1 ){
      $img = $match[1];
    }

    $this->load->database();
    $this->load->model("newsModel");
    $this->newsModel->insert_event($title,$content,$img);

    redirect(admin_url("events/"));
  }


  public function delete($id){
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $news = $this->newsModel->delete($id);
    redirect(admin_url("events/"));
  }



}
