<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartAccount extends MY_ADMIN_Controller {
        
  var $_type = "departaccount";
  var $_name = "局處帳號管理";
  var $fields = ["name","account","depart"];
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->model("memberModel");
    $this->load->model("departModel");

    $this->_model = $this->memberModel;
    $this->load->vars([
      "_type" => $this->_type,
      "_name" => $this->_name,
    ]);
  }

  public function index()
  {
    session_write_close();

    $latest_news = $this->_model->get_depart_list();
    $this->_load_view($this->_type."/index",[
        "pageTitle" => "所有局處帳號一覽",
        "all_items" => $latest_news
    ]);
  }

  public function add(){

    $news = new stdclass();
    $news->name ="";  
    $news->depart ="";  
    $news->account ="";  

    $departs = $this->departModel->get_list();

    $this->_load_view($this->_type."/edit",[
        "pageTitle" => "新增 ".$this->_name ,
        "item" => $item,
        "departs" => $depars,
        "action" => admin_url($this->_type."/adding")
    ]);

  }


  public function adding(){

    $inserted_data = [];

    foreach($this->fields as $field){
      $inserted_data[$field] = $this->input->post($field);
    }

    $id = $this->_model->insert($inserted_data);

    if(isset($_POST["pwd"]) && trim($_POST["pwd"]) != ""){
      $this->_model->update_pwd($_POST["account"],$_POST["pwd"]);
    }


    redirect(admin_url($this->_type."/"));
  }

  public function delete($id){
    session_write_close();

    $news = $this->_model->delete($id);
    redirect(admin_url($this->_type."/"));
  }


  public function edit($id){
    session_write_close();

    $news = $this->_model->get($id);

    if($news == null){
      return show_404();
    }

    $departs = $this->departModel->get_list();

    $this->_load_view($this->_type."/edit",[
        "pageTitle" => "編輯".$this->_name ,
        "item" => $news,
        "departs" => $depars,
        "action" => admin_url($this->_type."/editing")
    ]);
  }

  public function editing(){
    
    $update_data = [];
    foreach($this->fields as $field){
      $update_data[$field] = $this->input->post($field);
    }

    $id = $this->input->post("id");   
    $this->_model->update($id,$update_data);

    if(isset($_POST["pwd"]) && trim($_POST["pwd"]) != ""){
      $this->_model->update_pwd($_POST["account"],$_POST["pwd"]);
    }

    redirect(admin_url($this->_type."/"));
  }

}
