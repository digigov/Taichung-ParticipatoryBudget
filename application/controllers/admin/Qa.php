<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qa extends MY_ADMIN_Controller {

  public function index()
  {
    session_write_close();

    $this->load->database();
    $this->load->model("qaModel");

    $latest_news = $this->qaModel->get_latest_by_page(1,100);

    $this->_load_view("qa/index",[
        "pageTitle" => "所有 QA 一覽",
        "all_items" => $latest_news
    ]);
  }

  public function add(){

    $news = new stdclass();

    $news->question ="";
    $news->answer ="";
    $news->id = -1;

    $this->_load_view("qa/edit",[
        "pageTitle" => "新增 QA " ,
        "news" => $news,
        "action" => admin_url("qa/adding")
    ]);

  }


  public function adding(){
    $question = $this->input->post("question");
    $answer = $this->input->post("answer");

    $this->load->database();
    $this->load->model("qaModel");
    $this->qaModel->insert(["question" => $question,"answer" => $answer]);

    redirect(admin_url("qa/"));
  }

  public function delete($id){
    session_write_close();

    $this->load->database();
    $this->load->model("qaModel");

    $news = $this->qaModel->delete($id);
    redirect(admin_url("qa/"));
  }


  public function edit($id){
    session_write_close();

    $this->load->database();
    $this->load->model("qaModel");

    $news = $this->qaModel->get($id);

    if($news == null){
      return show_404();
    }

    $this->_load_view("qa/edit",[
        "pageTitle" => "編輯 QA " ,
        "news" => $news,
        "action" => admin_url("qa/editing")
    ]);
  }

  public function editing(){
    $id = $this->input->post("id");
    
    $question = $this->input->post("question");
    $answer = $this->input->post("answer");

    $this->load->database();
    $this->load->model("qaModel");
    $this->qaModel->update($id,["question" => $question,"answer" => $answer]);

    redirect(admin_url("qa/"));
  }

}
