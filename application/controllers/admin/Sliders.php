<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sliders extends MY_ADMIN_Controller {

  public function index()
  {

    session_write_close();

    $this->load->database();
    $this->load->model("sliderModel");

    $latest_sliders = $this->sliderModel->get_latest_by_page(1,1000);

    $this->_load_view("sliders/index",[
        "pageTitle" => "輪播管理",
        "all_items" => $latest_sliders
    ]);
  }

  public function add(){

    $news = new stdclass();

    $news->text ="";
    $news->url ="";
    $news->img_url ="";
    $news->start_time = gmdate("Y-m-d\TH:i:s");
    $news->end_time = gmdate("Y-m-d\TH:i:s",time() + 86400*365*20 );
    $news->status = 1;
    $news->category = "";
    $news->id = -1;

    $this->_load_view("sliders/edit",[
        "pageTitle" => "新增輪播 " ,
        "news" => $news,
        "action" => admin_url("sliders/adding")
    ]);

  }


  public function adding(){
    $text = $this->input->post("text");
    $url = $this->input->post("url");
    $status = $this->input->post("status");
    $start_time = _utc_date_from_zone_date($this->input->post("start_time"));
    $end_time = _utc_date_from_zone_date($this->input->post("end_time"));


    $upload = $this->_upload("pb","image","slider_".date("Ymd")."/");
    if(!$upload->isSuccess){
      die("上傳失敗");
    }

    $img_url = $upload->data->url;
    $this->load->database();
    $this->load->model("sliderModel");
    $this->sliderModel->insert([
      "text" => $text,
      "start_time" => $start_time ,
      "end_time" => $end_time ,
      "status" => $status,
      "img_url" => $img_url,
      "url" => $url
    ]);

    redirect(admin_url("sliders/"));
  }

  public function delete($id){
    session_write_close();

    $this->load->database();
    $this->load->model("sliderModel");

    $news = $this->sliderModel->delete($id);
    redirect(admin_url("sliders/"));
  }


  public function edit($id){
    session_write_close();

    $this->load->database();
    $this->load->model("sliderModel");

    $news = $this->sliderModel->get($id);

    if($news == null){
      return show_404();
    }

    $this->_load_view("sliders/edit",[
        "pageTitle" => "編輯活動 " ,
        "news" => $news,
        "action" => admin_url("sliders/editing")
    ]);
  }

  public function editing(){
    $id = $this->input->post("id");
    $text = $this->input->post("text");
    $url = $this->input->post("url");
    $status = $this->input->post("status");
    $start_time = _utc_date_from_zone_date($this->input->post("start_time"));
    $end_time = _utc_date_from_zone_date($this->input->post("end_time"));


    $options = [
      "text" => $text,
      "start_time" => $start_time ,
      "end_time" => $end_time ,
      "status" => $status,
      "url" => $url
    ];

    $upload = $this->_upload("pb","image","slider_".date("Ymd")."/");
    if($upload->isSuccess){
      $img_url = $upload->data->url;
      $options[ "img_url" ] = $img_url;
    }

    $this->load->database();
    $this->load->model("sliderModel");
    $this->sliderModel->update($id,$options);

    redirect(admin_url("sliders/"));

  }

}
