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
        "area_now" => $area
    ] );
  }

  public function map(){

    $this->load->view('areas/map',[
        "pageTitle" => "各區推動概況 - 地圖檢視"
    ] );
  }

  public function location($un_area_name){
    $area_name = rawurldecode($un_area_name);

    $this->load->database();
    $this->load->model("areaModel");
    $this->load->model("caseModel");
    
    $gov_datas = json_decode(file_get_contents(__DIR__."/../../public/js/cleaned_data.json"));

    $gov_items = [];
    foreach($gov_datas as $data){
      if($data->區 == $area_name){
        $gov_items[] = (array) $data;
      }
    }    

    $area_cases = [
      "2016" => $this->caseModel->get_active_by_area(
        $area_name)
    ];
    $area_item = $this->areaModel->find_by_name($area_name);
    $this->load->view('areas/location',[
        "pageTitle" => "各區介紹 - ".$area_name,
        "gov_items" => $gov_items,
        "area_item" => $area_item,
        "area_name" => $area_name,
        "area_cases" => $area_cases
    ]);
  }

  public function detail($unname){
    $name = rawurldecode($unname);
    $datas = json_decode(file_get_contents(__DIR__."/../../public/js/cleaned_data.json"));

    $item = null;
    foreach($datas as $data){
      $field = "建設(服務)案";
      if($data->$field == $name){
        $item = (array) $data;
        break;
      }
    }

    if($item == null){
      return show_404();
    }

    $this->load->view('areas/detail',[
        "pageTitle" => "各區推動概況 - ".$data->$field,
        "area_now" => $data, 
        "data" => $item
    ] );
  }

  public function ren_all_types(){
    $types = _get_case_types();
    foreach($types as $t){
      $this->render_circle_image($t);
    }
  }

  public function render_circle_image($type = "社區營造"){
    $type = rawurldecode($type);
        //this creates a pink rectangle of the same size
    $img = imagecreatefrompng(__DIR__."/../../public/img/icons/".$type.".png");

    list($imgwidth, $imgheight) = getimagesize(__DIR__."/../../public/img/icons/".$type.".png");
    $mask = imagecreatetruecolor($imgwidth, $imgheight);
    $pink = imagecolorallocate($mask, 255, 0, 255);
    imagefill($mask, 0, 0, $pink);
    //this cuts a hole in the middle of the pink mask
    $black = imagecolorallocate($mask, 0, 0, 0);
    imagecolortransparent($mask, $black);
    // imagefilledellipse($mask,50,50, $imgwidth, $imgheight, $black);
    imagefilledellipse($mask, $imgwidth/2, $imgheight/2, $imgwidth *0.8, $imgheight*0.8, $black);

    //this merges the mask over the pic and makes the pink corners transparent
    imagecopymerge($img, $mask, 0, 0, 0, 0, $imgheight, $imgheight,100);

    imagecolortransparent($img, $pink);

    header ('Content-Type: image/png');
    imagepng($img,__DIR__."/../../public/img/icons/".$type."_circle.png");
    imagepng($img);
  }
}
