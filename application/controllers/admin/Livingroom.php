<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livingroom extends MY_ADMIN_Controller {

  var $_view_root = "livingroom";
  var $fields = ["area", "type", "record_date", "location", 
      "interviewer", "worker", "status", "content"];

  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->model("livingModel");

  }

  public function index()
  {

    session_write_close();

    $latest_items = $this->livingModel->get_all_by_page(1,1000);

    $this->_load_view($this->_view_root."/index",[
        "pageTitle" => "客廳會成果管理",
        "all_items" => $latest_items
    ]);
  }

  public function add(){

    $news = new stdclass();

    $news->area ="";
    $news->type ="";
    $news->record_date = gmdate("Y-m-d\TH:i:s");
    $news->location = "";
    $news->interviewer = "";
    $news->worker = "";
    $news->status = 1;
    $news->content = "";
    $news->id = -1;

    $this->_load_view($this->_view_root."/edit",[
        "pageTitle" => "新增客廳會記錄 " ,
        "news" => $news,
        "news_images" => [],
        "action" => admin_url("livingroom/adding")
    ]);

  }


  public function adding(){

    $inserted_data = [];

    foreach($this->fields as $field){
      $inserted_data[$field] = $this->input->post($field);
    }

    $living_id = $this->livingModel->insert($inserted_data);
    $file_ids = $this->input->post("fileids");
    $this->_handle_file_ids($living_id,$file_ids);
    redirect(admin_url($this->_view_root."/"));
  }

  public function _handle_file_ids($living_id,$file_ids){
    $this->livingModel->handle_file_ids($living_id,$file_ids);
  }

  public function delete($id){
    session_write_close();

    $news = $this->livingModel->delete($id);
    redirect(admin_url($this->_view_root."/"));
  }


  public function edit($id){
    session_write_close();


    $news = $this->livingModel->get($id);

    if($news == null){
      return show_404();
    }

    $living = $this->livingModel->get_images($id);

    $this->_load_view($this->_view_root."/edit",[
        "pageTitle" => "編輯活動 " ,
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

    $this->livingModel->update($id,$update_data);

    $file_ids = $this->input->post("fileids");
    $this->_handle_file_ids($id,$file_ids);
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

      $file_id = $this->livingModel->insert_image([
          "filename" => $data->original_name,
          "filetype" => "",
          "filesize" => $data->file_size,
          "filepath" => $data->folder.$data->name,
          "url" => $data->url,
          "type" => 1
        ]
      );
      $info->delete_url = site_url("admin/livingroom/delete_image/".$file_id);
      $info->url = $data->url;
      $info->file_id = $file_id;

      $files[] = $info;
      echo json_encode(array("files" => $files));
  }


}
