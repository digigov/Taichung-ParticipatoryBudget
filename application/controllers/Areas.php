<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends MY_Controller {

  public function index()
  {
    session_write_close();

    $this->load->view('areas/index_old',[
        "pageTitle" => "各區推動概況"
    ] );
  }

  public function view($unArea = null){
    
    if($unArea == null){
      return show_404();
    }
    $area = rawurldecode($unArea);

    $all_areas = ["中區", "東區", "南區", "西區", "北區", "西屯區", "南屯區", "北屯區", "豐原區", "東勢區", "大甲區", "清水區", "沙鹿區", "梧棲區", "后里區", "神岡區", "潭子區", "大雅區", "新社區", "石岡區", "外埔區", "大安區", "烏日區", "大肚區", "龍井區", "霧峰區", "太平區", "大里區", "和平區"];

    $find = false;
    foreach($all_areas as $a){
      if($a == $area){
        $find = true;
      }
    }
    if(!$find){
      return show_404();
    }
    $this->load->database();
    $this->load->model("caseModel");

    $cases = $this->caseModel->get_active_by_area($area);

    $this->load->view('areas/view',[
        "pageTitle" => "各區推動概況 - ".$area,
        "items" => $cases,
        "area" => $area
    ] );

  }

  // public function view($undeName){

  //   $datas = json_decode(file_get_contents(__DIR__."/../../public/js/cleaned_data.json"));
  //   $name = rawurldecode($undeName);


  //   $item = null;
  //   foreach($datas as $data){
  //     $field = "建設(服務)案";
  //     if($data->$field == $name){
  //       $item = (array) $data;
  //       break;
  //     }
  //   }

  //   if($item == null){
  //     return show_404();
  //   }

  //   $this->load->view('areas/view',[
  //       "pageTitle" => "各區推動概況 - ".$data->$field,
  //       "data" => $item
  //   ] );
  // }

}
