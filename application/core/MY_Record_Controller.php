<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Record_Controller extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function _check_year_and_handle($year){

    if(!_check_year($year)){
      show_404();
      return false;
    }

    if($year == "2015"){
      redirect('http://2015taichungivoting.weebly.com/');
      return false;
    }

    return true;
  }

  public function _get_record($type){
    $types = _get_record_types();
    foreach($types as $t ){
      if($t->key == $type){
        return $t;
      }
    }
    return null;
  }

  public function _render_area_list($breadcrumb,
    $pageTitle,$record,$areas){

    $this->load->view("records/area_list",[
        "pageTitle" => $pageTitle,
        "breadcrumb" => $breadcrumb,
        "record" => $record,
        "areas" => $areas
        // "all_items" => $latest_items,
        // "now_area" => $area == "" ?"全部":$area
    ]);    
  }

}
