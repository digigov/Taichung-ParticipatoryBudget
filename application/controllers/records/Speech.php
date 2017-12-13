<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Speech extends MY_Record_Controller {

  var $_view_root = "speech";
  var $_name = "講座";
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
  
    $latest_items = $this->_model->get_all_by_year($year);

    $record = $this->_get_record($this->_view_root);

    $breadcrumb = [
      [ 
        "url" => site_url("/record/year/".$year),
        "name" => "工作成果與提案記錄 - ".$year
      ],
      ["name" => $this->_name,
        "url" => site_url("/records/".$this->_view_root."/index/".$year)
      ]
    ];

    $this->load->view("records/".$this->_view_root."/index",[
        "pageTitle" => $year." ".$this->_name."列表",
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
      ["name" => $item->title
      ]
    ];

    $images = $this->_model->get_images($view_id);

    $this->load->view("records/".$this->_view_root."/view",[
        "pageTitle" => _date_format_utc($item->record_date,"Y-m-d")." ".$item->title." | ".$year." ".$this->_name,
        "breadcrumb" => $breadcrumb,
        "record" => $record,
        "item" => $item,
        "images" => $images
    ]);    
  }

}
