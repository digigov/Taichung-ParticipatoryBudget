<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends MY_ADMIN_Controller {

  var $case_fields = ["year","name","budget","author",
    "purpose","content","advice","step_source","step_expert",
    "step_ivoting_1","step_ivoting_2","step_advance","step_running"];

  public function index()
  {

    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $latest_sliders = $this->caseModel->get_latest_by_page(1,1000);

    $this->_load_view("cases/index",[
        "pageTitle" => "所有案件管理",
        "all_items" => $latest_sliders
    ]);
  }

  public function add(){

    $news = new stdclass();
    $news->area ="";
    $news->name ="";
    $news->purpose ="";
    $news->budget ="";
    $news->content ="";
    $news->author ="";
    $news->advice ="";
    $news->step_source = false;
    $news->step_expert = false;
    $news->step_ivoting_1 = false;
    $news->step_ivoting_2 = false;
    $news->step_advance = false;
    $news->step_running = false;

    $news->year = date("Y");
    $news->id = -1;

    $this->_load_view("cases/edit",[
        "pageTitle" => "新增提案 " ,
        "news" => $news,
        "action" => admin_url("cases/adding")
    ]);

  }


  public function adding(){

    $data = [];

    foreach($this->case_fields as $field){
      $data[$field] = $this->input->post($field);
    }

    $this->load->database();
    $this->load->model("caseModel");
    $this->caseModel->insert($data);

    redirect(admin_url("cases/"));
  }

  public function delete($id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $news = $this->caseModel->delete($id);
    redirect(admin_url("cases/"));
  }


  public function edit($id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $news = $this->caseModel->get($id);

    if($news == null){
      return show_404();
    }

    $this->_load_view("cases/edit",[
        "pageTitle" => "編輯提案 " ,
        "news" => $news,
        "action" => admin_url("cases/editing")
    ]);
  }

  public function editing(){
    $id = $this->input->post("id");

    $data = [];

    foreach($this->case_fields as $field){
      $data[$field] = $this->input->post($field);
    }

    $this->load->database();
    $this->load->model("caseModel");
    $this->caseModel->update($id,$data);

    redirect(admin_url("cases/"));

  }

}
