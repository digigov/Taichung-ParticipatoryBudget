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

  public function view($undeName){

    $datas = json_decode(file_get_contents(__DIR__."/../../public/js/cleaned_data.json"));
    $name = rawurldecode($undeName);


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

    $this->load->view('areas/view',[
        "pageTitle" => "各區推動概況 - ".$data->$field,
        "data" => $item
    ] );
  }

}
