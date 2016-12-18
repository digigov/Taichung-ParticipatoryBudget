<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_ADMIN_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->model("pageModel");

    $this->_model = $this->pageModel;
  }

  public function prepare_year(){
    $name = $this->input->get("name");
    $key = $this->input->get("key");

    $this->load->view("admin/page/prepare_year",
      ["name" => $name,
        "key" => $key]
      );
  }

  public function build(){
    $name = $this->input->get("name");
    $key = $this->input->get("key");
    $year = $this->input->get("year");
    $ok = $this->input->get("ok");

    $news = new stdclass();
    $news->name = $name;
    $news->key = $key;
    $news->year = $year;
    $news->content = "";

    $page = $this->pageModel->get($year,$key);

    if($page != null){
      $news->content = $page->content;
    }
    
    $this->load->view("admin/page/edit",
      [
        "pageTitle" => "編輯網頁內容:".$name,
        "action" => site_url("admin/page/building"),
        "news" => $news,
        "ok" => $ok
      ]
      );
  }

  public function building(){
    $name = $this->input->post("name");
    $key = $this->input->post("key");
    $year = $this->input->post("year");
    $content  = $this->input->post("content");

    $this->pageModel->insertOrUpdate($year,$key,$name,$content);
    redirect('admin/page/build?name='.h($name)."&key=".h($key)."&year=".h($year)."&ok=1");
  }
}
