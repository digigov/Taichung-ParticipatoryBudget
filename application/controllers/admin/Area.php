<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends MY_ADMIN_Controller {
        
  var $_type = "area";
  var $_name = "地區";
  var $fields = ["name","city", "intro","opendata_link"];
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->model("areaModel");

    $this->_model = $this->areaModel;
    $this->load->vars([
      "_type" => $this->_type,
      "_name" => $this->_name,
    ]);
  }

  public function index()
  {
    session_write_close();

    $latest_news = $this->_model->get_all_by_page(1,1000);
    $this->_load_view($this->_type."/index",[
        "pageTitle" => "所有地區一覽",
        "all_items" => $latest_news
    ]);
  }

  public function add(){

    $news = new stdclass();

    $news->name ="";
    $news->city ="";
    $news->intro ="";
    $news->opendata_link ="";
    $news->id = -1;
    $news->pic = null;
    $news->years = null;
    

    $this->_load_view($this->_type."/edit",[
        "pageTitle" => "新增 ".$this->_name ,
        "news" => $news,
        "action" => admin_url($this->_type."/adding")
    ]);

  }


  public function adding(){

    $inserted_data = [];

    foreach($this->fields as $field){
      $inserted_data[$field] = $this->input->post($field);
    }


    $years = $this->input->post("years");
    
    $year_res = [];
    foreach($years as $year){
      $year_res[$year] = 1;
    }
    $inserted_data["years"] = json_encode($year_res);
    

    $id = $this->_model->insert($inserted_data);

    $upload = $this->_upload("area","pic","area/".$id."/");
    if($upload->isSuccess){
      $update_data = [];
      $update_data["pic"] = $upload->data->url;
      $this->_model->update($id,$update_data);
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

    $this->_load_view($this->_type."/edit",[
        "pageTitle" => "編輯".$this->_name ,
        "news" => $news,
        "action" => admin_url($this->_type."/editing")
    ]);
  }

  public function editing(){
    
    $update_data = [];
    foreach($this->fields as $field){
      $update_data[$field] = $this->input->post($field);
    }

    $id = $this->input->post("id");
    
    $upload = $this->_upload("area","pic","area/".$id."/");
    if($upload->isSuccess){
      $update_data["pic"] = $upload->data->url;
    }

    $years = $this->input->post("years");

    $year_res = [];
    foreach($years as $year){
      $year_res[$year] = 1;
    }
    $update_data["years"] = json_encode($year_res);

    $this->_model->update($id,$update_data);

    redirect(admin_url($this->_type."/"));
  }

}
