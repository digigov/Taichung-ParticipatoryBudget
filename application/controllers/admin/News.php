<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_ADMIN_Controller {

  public function index()
  {
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $latest_news = $this->newsModel->get_latest_news_list(LAST_YEAR,1,100);

    $this->_load_view("news/index",[
        "pageTitle" => "所有新聞一覽",
        "all_news" => $latest_news
    ]);
  }

  public function add(){

    $news = new stdclass();

    $news->title ="新增新聞";
    $news->content ="";
    $news->status = 1;
    $news->category = "";
    $news->id = -1;

    $this->_load_view("news/edit",[
        "pageTitle" => "新增新聞 " ,
        "news" => $news,
        "action" => admin_url("news/adding")
    ]);

  }


  public function adding(){
    $title = $this->input->post("title");
    $content = $this->input->post("content");
    $postid = $this->input->post("postid");
    $cagegory = $this->input->post("category");
    $year = $this->input->post("year");
    $is_video = $this->input->post("is_video");

    $match = [];
    $img_match = preg_match("/<[^>]+src=['\"](.*?)['\"][^>]+/", $content,$match);

    $img = null;

    if(count($match) > 1 ){
      $img = $match[1];
    }

    $this->load->database();
    $this->load->model("newsModel");
    $this->newsModel->insert_news($title,$content,$img,$cagegory,$year,$is_video);

    redirect(admin_url("news/"));
  }

  public function delete($id){
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $news = $this->newsModel->delete($id);
    redirect(admin_url("news/"));
  }


  public function edit($id){
    session_write_close();

    $this->load->database();
    $this->load->model("newsModel");

    $news = $this->newsModel->get($id);

    if($news == null){
      return show_404();
    }

    $this->_load_view("news/edit",[
        "pageTitle" => "編輯活動 " ,
        "news" => $news,
        "action" => admin_url("news/editing")
    ]);
  }

  public function editing(){
    $title = $this->input->post("title");
    $content = $this->input->post("content");
    $postid = $this->input->post("postid");
    $cagegory= $this->input->post("category");
    $year = $this->input->post("year");
    $is_video = $this->input->post("is_video");

    $match = [];
    $img_match = preg_match("/<[^>]+src=['\"](.*?)['\"][^>]+/", $content,$match);

    $img = null;

    if(count($match) > 1 ){
      $img = $match[1];
    }

    $this->load->database();
    $this->load->model("newsModel");
    $this->newsModel->update_news($postid,$title,$content,$img,$cagegory,$year,$is_video);

    redirect(admin_url("news/"));
  }

}
