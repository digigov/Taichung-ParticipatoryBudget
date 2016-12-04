<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livingroom extends MY_Record_Controller {

  var $_view_root = "livingroom";
  var $_name = "客廳說明會";
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->model("livingModel");
  }

  public function index($year)
  { 
    if(!$this->_check_year_and_handle($year)){die();}

    session_write_close();

    $record = $this->_get_record($this->_view_root);

    $this->load->database();
    $this->load->model("areaModel");

    $areas = $this->areaModel->get_area_simple_list();

    $area_counts = $this->livingModel->get_area_counts_by_year($year);

    foreach($areas as $a){
      $a->link = site_url("/records/livingroom/area/".$a->id."?year=".$year);
      $a->cnt = 0;
      foreach($area_counts as $a2){
        if($a->id == $a2->area_id){
          $a->cnt = $a2->cnt;
        }
      }
    }


    $this->_render_area_list([
      [ "url" => site_url("/record/year/".$year),
          "name" => "工作成果與提案記錄 - 2016"
      ],
      ["name" => "客廳說明會"]
    ]
      ,$year."年客廳說明會",$record,$areas);
  }

  public function area($area_id){
    $year = $this->input->get("year");
    if(!$this->_check_year_and_handle($year)){die();}

    session_write_close();


    $this->load->database();
    $this->load->model("areaModel");

    $area = $this->areaModel->get($area_id);
    if($area == null){
      return show_404();
    }
  
    $latest_items = $this->livingModel->get_all_by_area_id_and_year($area_id,$year);


    $record = $this->_get_record($this->_view_root);

    $breadcrumb = [
      [ 
        "url" => site_url("/record/year/".$year),
        "name" => "工作成果與提案記錄 - 2016"
      ],
      ["name" => "客廳說明會",
        "url" => site_url("/records/livingroom/index/".$year)
      ],
      ["name" => $area->name]
    ];

    $this->load->view("records/livingroom/area",[
        "pageTitle" => $year." ".$area->name." 客廳說明會列表",
        "breadcrumb" => $breadcrumb,
        "record" => $record,
        "items" => $latest_items
    ]);    
  }


  public function view($view_id){

    session_write_close();


    $this->load->database();
    $this->load->model("areaModel");

    $item = $this->livingModel->get($view_id,"1");

    $area = $this->areaModel->get($item->area_id);
    if($area == null){
      return show_404();
    }

    $record = $this->_get_record($this->_view_root);

    $year = $item->year;

    $breadcrumb = [
      [ 
        "url" => site_url("/record/year/".$year),
        "name" => "工作成果與提案記錄 - ".$year
      ],
      ["name" => "客廳說明會",
        "url" => site_url("/records/livingroom/index/".$year)
      ],
      ["name" => $area->name,
        "url" => site_url("/records/livingroom/area/".$area->id."?year=".$year)
      ],
      ["name" => _date_format_utc($item->record_date,"Y-m-d")." 訪談 ".$item->interviewer
      ]
    ];

    $images = $this->livingModel->get_images($view_id);

    $this->load->view("records/livingroom/view",[
        "pageTitle" => _date_format_utc($item->record_date,"Y-m-d")." 訪談 ".$item->interviewer." | ".$year." ".$area->name." 客廳說明會",
        "breadcrumb" => $breadcrumb,
        "record" => $record,
        "item" => $item,
        "images" => $images
    ]);    
  }

}
