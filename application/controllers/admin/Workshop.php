<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends MY_ADMIN_Controller {

  var $_view_root = "workshop";
  var $fields = ["year","area","title", "record_date","record_date_end", "location", 
       "status", "content"];

  var $_name = "工作坊";

  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->model("workshopModel");

    $this->_model = $this->workshopModel;
    $this->load->vars([
      "_name" => $this->_name,
      "_type" => $this->_model->_type
    ]);
  }

  public function index()
  {

    session_write_close();

    $area= $this->input->get("area");

    if($area == "全部" || $area == ""){
      $latest_items = $this->_model->get_all_by_page(1,1000);
    }else{
      $latest_items = $this->_model->get_all_by_area_page($area,1,1000);
    }

    

    $this->_load_view($this->_view_root."/index",[
        "pageTitle" => $this->_name." 成果管理",
        "all_items" => $latest_items,
        "now_area" => $area == "" ?"全部":$area
    ]);
  }

  public function add(){

    $news = new stdclass();

    $news->area ="";
    $news->type ="";
    $news->record_date = gmdate("Y-m-d\TH:i:s");
    $news->record_date_end = gmdate("Y-m-d\TH:i:s");
    $news->location = "";
    $news->interviewer = "";
    $news->worker = "";
    $news->status = 1;
    $news->content = "";
    $news->id = -1;
    $news->year = "";
    $news->title = "";

    $this->_load_view($this->_view_root."/edit",[
        "pageTitle" => "新增". $this->_name."記錄 " ,
        "news" => $news,
        "news_images" => [],
        "action" => admin_url($this->_view_root."/adding")
    ]);

  }


  public function adding(){

    $inserted_data = [];

    foreach($this->fields as $field){
      $inserted_data[$field] = $this->input->post($field);
    }

    $living_id = $this->_model->insert($inserted_data);
    $file_ids = $this->input->post("fileids");

    $file_major = $this->input->post("file_major");
    if($file_major == null && count($file_ids) >0 ){
      $file_major= $file_ids[0];
    }

    $this->_handle_file_ids($living_id,$file_ids,$file_major);
    redirect(admin_url($this->_view_root."/"));
  }

  public function _handle_file_ids($living_id,$file_ids,$file_major){
    $this->_model->handle_file_ids($living_id,$file_ids,$file_major);
  }

  public function delete($id){
    session_write_close();

    $news = $this->_model->delete($id);
    redirect(admin_url($this->_view_root."/"));
  }


  public function edit($id){
    session_write_close();


    $news = $this->_model->get($id);

    if($news == null){
      return show_404();
    }

    $living = $this->_model->get_images($id);

    $this->_load_view($this->_view_root."/edit",[
        "pageTitle" => "編輯 ". $this->_name ,
        "news" => $news,
        "news_images" => $living,
        "action" => admin_url($this->_view_root."/editing")
    ]);
  }

  public function editing(){
    
    $update_data = [];
    foreach($this->fields as $field){
      $update_data[$field] = $this->input->post($field);
    }

    $id = $this->input->post("id");

    $this->_model->update($id,$update_data);

    $file_ids = $this->input->post("fileids");

    $file_major = $this->input->post("file_major");
    if($file_major == null && count($file_ids) >0 ){
      $file_major= $file_ids[0];
    }

    $this->_handle_file_ids($id,$file_ids,$file_major);
    redirect(admin_url($this->_view_root."/"));

  }


  public function upload_image() {
      
      $ret = $this->_upload("files","files","livingroom/".date("Ymd")."/");

      if (!$ret->isSuccess) {
        return [];
      } 

      
      $data = $ret->data;

      $file_name = iconv('UTF-8', 'UTF-8//IGNORE', ($data->original_name));

      $info = new StdClass;
      $info->name = $file_name;
      $info->size = $data->file_size * 1024;
      $info->url = $data->url;
      $info->delete_type = 'DELETE';
      $info->error = null;

      $file_id = $this->_model->insert_image([
          "filename" => $data->original_name,
          "filetype" => "",
          "filesize" => $data->file_size,
          "filepath" => $data->folder.$data->name,
          "url" => $data->url,
          "type" => 1
        ]
      );
      $info->delete_url = site_url("admin/".$this->_view_root."/delete_image/".$file_id);
      $info->url = $data->url;
      $info->file_id = $file_id;

      $files[] = $info;
      echo json_encode(array("files" => $files));
  }


}
