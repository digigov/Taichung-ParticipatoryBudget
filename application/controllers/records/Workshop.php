<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends MY_Record_Controller {

  var $_view_root = "workshop";
  var $_name = "工作坊";
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $modelName = $this->_view_root."Model";
    $this->load->model($modelName);
    $this->_model = $this->$modelName;


    $this->load->vars([ "_type" => $this->_view_root,
        "_name" => $this->_name ]);
  }

  public function index($year)
  { 
    if(!$this->_check_year_and_handle($year)){die();}

    session_write_close();

    $record = $this->_get_record($this->_view_root);

    $this->load->database();
    $this->load->model("areaModel");

    $areas = $this->areaModel->get_area_simple_list();

    
    $area_counts = $this->_model->get_area_counts_by_year($year);

    foreach($areas as $a){
      $a->link = site_url("/records/".$this->_view_root."/area/".$a->id."?year=".$year);
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
      ["name" => $this->_name]
    ]
      ,$year."年".$this->_name,$record,$areas);
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
  
    $latest_items = $this->_model->get_all_by_area_id_and_year($area_id,$year);


    $record = $this->_get_record($this->_view_root);

    $breadcrumb = [
      [ 
        "url" => site_url("/record/year/".$year),
        "name" => "工作成果與提案記錄 - 2016"
      ],
      ["name" => $this->_name,
        "url" => site_url("/records/".$this->_view_root."/index/".$year)
      ],
      ["name" => $area->name]
    ];

    $this->load->view("records/".$this->_view_root."/area",[
        "pageTitle" => $year." ".$area->name." ".$this->_name."列表",
        "breadcrumb" => $breadcrumb,
        "record" => $record,
        "items" => $latest_items
    ]);    
  }


  public function view($view_id){

    session_write_close();


    $this->load->database();
    $this->load->model("areaModel");

    $item = $this->_model->get($view_id,"1");

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
      ["name" => $this->_name,
        "url" => site_url("/records/".$this->_view_root."/index/".$year)
      ],
      ["name" => $area->name,
        "url" => site_url("/records/".$this->_view_root."/area/".$area->id."?year=".$year)
      ],
      ["name" => _date_format_utc($item->record_date,"Y-m-d")." 訪談 ".$item->interviewer
      ]
    ];

    $images = $this->_model->get_images($view_id);

    $this->load->view("records/".$this->_view_root."/view",[
        "pageTitle" => _date_format_utc($item->record_date,"Y-m-d")." 訪談 ".$item->interviewer." | ".$year." ".$area->name." ".$this->_name,
        "breadcrumb" => $breadcrumb,
        "record" => $record,
        "item" => $item,
        "images" => $images
    ]);    
  }

}
