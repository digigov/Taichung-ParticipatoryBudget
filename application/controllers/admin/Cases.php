<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends MY_ADMIN_Controller {

  var $case_fields = [
    "year","name","budget","author",
    "purpose","content","budget_desc","advice",
    "step_source","step_expert",
    "step_ivoting_1","step_ivoting_2",
    "step_advance","step_running","area_id",
    "caseno","type","process","gov_type"
    ];

  var $advice_fields = [
    "possible","law","reasonable","unit","job","phone","name","type"
  ];

  public function index()
  {

    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $latest_sliders = $this->caseModel->get_latest_by_page(1,1000);

    $this->_load_view("cases/index",[
        "pageTitle" => "所有案件管理",
        "all_items" => $latest_sliders
    ]);
  }


  public function area($areaID){
    $area = $this->areaModel->get($areaID);
    if($area == null){
      return show_404();
    }

    $this->load->model("caseModel");    
    $latest_news = $this->caseModel->get_latest_by_area_and_page($area->id,1,1000);

    $this->_load_view('cases/index',[
        "pageTitle" => $area->name." 提案",
        "all_items" => $latest_news
    ] );
  }


  public function add(){

    $news = new stdclass();
    $news->gov_type ="";
    $news->caseno ="";
    $news->type ="";
    $news->dm_file="";
    $news->area ="";
    $news->process ="";
    $news->name ="";
    $news->purpose ="";
    $news->budget ="";
    $news->budget_desc = "";
    $news->content ="";
    $news->author ="";
    $news->advice ="";
    $news->publish_date = gmdate("Y-m-d H:i:s");
    $news->step_source = false;
    $news->step_expert = false;
    $news->step_ivoting_1 = false;
    $news->step_ivoting_2 = false;
    $news->step_advance = false;
    $news->step_running = false;

    $news->step_source_files = null;
    $news->step_expert_files = null;
    $news->step_ivoting_1_files = null;
    $news->step_ivoting_2_files = null;
    $news->step_advance_files = null;
    $news->step_running_files = null;
    $news->location_urls = null;

    $news->year = date("Y");
    $news->id = -1;

    $this->_load_view("cases/edit",[
        "pageTitle" => "新增提案 " ,
        "news" => $news,
        "action" => admin_url("cases/adding")
    ]);

  }


  public function adding(){

    $data = [];

    foreach($this->case_fields as $field){
      $data[$field] = $this->input->post($field);
    }

    $files = ["step_source_files", "step_expert_files", "step_ivoting_1_files", "step_ivoting_2_files", "step_advance_files", "step_running_files","dm_file"];

    foreach($files as $file){
      $upload = $this->_upload("pb",$file,$file."/".date("Ymd")."/");
      if($upload->isSuccess){
        $data[$file] = $upload->data->url;
      }
    }

    $data['publish_date']= _utc_date_from_zone_date($this->input->post("publish_date"));

    $this->load->database();
    $this->load->model("caseModel");
    $this->caseModel->insert($data);

    redirect(admin_url("cases/"));
  }

  public function delete($id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $news = $this->caseModel->delete($id);
    redirect(admin_url("cases/"));
  }


  public function edit($id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $news = $this->caseModel->get($id);

    if($news == null){
      return show_404();
    }

    $this->_load_view("cases/edit",[
        "pageTitle" => "編輯提案 " ,
        "news" => $news,
        "action" => admin_url("cases/editing")
    ]);
  }

  public function editing(){
    $id = $this->input->post("id");

    $data = [];

    foreach($this->case_fields as $field){
      $data[$field] = $this->input->post($field);
    }

    $files = ["step_source_files", "step_expert_files", "step_ivoting_1_files", "step_ivoting_2_files", "step_advance_files", "step_running_files","dm_file"];

    foreach($files as $file){
      $upload = $this->_upload("pb",$file,$file."/".date("Ymd")."/");
      if($upload->isSuccess){
        $data[$file] = $upload->data->url;
      }
    }

    $data['publish_date']= _utc_date_from_zone_date($this->input->post("publish_date"));

    $this->load->database();
    $this->load->model("caseModel");
    $this->caseModel->update($id,$data);

    redirect(admin_url("cases/"));

  }



  public function preview($id)
  {
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $news = $this->caseModel->get($id);

    $area = $this->areaModel->get($news->area_id);
    if($news == null){
      return show_404();
    }

    $advices = $this->caseModel->list_advices($id);

    $this->caseModel->update_clicks($id);

    $this->load->view('cases/view',[
        "pageTitle" => $news->year." 年提案 [".$news->name." ]" ,
        "area"=> $area,
        "news" => $news,
        "advices" => $advices
    ] );
  }


  public function advices($id = null){
    session_write_close();

    if($id == null){
      return show_404();
    }

    $this->load->database();
    $this->load->model("caseModel");

    $case = $this->caseModel->get($id);

    if($case == null){
      return show_404();
    }

    $advices = $this->caseModel->list_advices($id);

    $this->_load_view("cases/advice_index",[
        "pageTitle" => $case->name." 建議管理",
        "case" => $case,
        "all_items" => $advices
    ]);

  }

  public function advice_add($case_id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $case = $this->caseModel->get($case_id);

    if($case == null){
      return show_404();
    }

    $advice = new stdclass();
    $advice->possible ="";
    $advice->law ="";
    $advice->reasonable ="";
    $advice->unit ="";
    $advice->job = "";
    $advice->name ="";
    $advice->phone ="";
    $advice->type ="";
    $advice->id = -1;
    $advice->case_id = $case_id;

    $this->_load_view("cases/advice_edit",[
        "pageTitle" => "新增建議 " ,
        "case" => $case,
        "advice" => $advice,
        "action" => admin_url("cases/advice_adding/".$case_id)
    ]);

  }


  public function advice_adding($case_id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $case = $this->caseModel->get($case_id);

    if($case == null){
      return show_404();
    }

    $data = [];
    $data["case_id"] = $case->id;

    foreach($this->advice_fields as $field){
      $data[$field] = $this->input->post($field);
    }

    $this->load->database();
    $this->load->model("caseModel");
    $this->caseModel->insert_advice($data);

    redirect(admin_url("cases/advices/".$case->id));
  }

  public function advice_edit($adv_id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $advice = $this->caseModel->get_advice($adv_id);

    if($advice == null){
      return show_404();
    }

    $case = $this->caseModel->get($advice->case_id);
    if($case == null){
      return show_404();
    }


    $this->_load_view("cases/advice_edit",[
        "pageTitle" => "編輯建議 " ,
        "case" => $case,
        "advice" => $advice,
        "action" => admin_url("cases/advice_editing/".$adv_id)
    ]);
  }



  public function advice_editing($adv_id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $advice = $this->caseModel->get_advice($adv_id);

    $data = [];
    foreach($this->advice_fields as $field){
      $data[$field] = $this->input->post($field);
    }

    $this->load->database();
    $this->load->model("caseModel");
    $this->caseModel->update_advice($adv_id,$data);

    redirect(admin_url("cases/advices/".$advice->case_id));
  }

  public function advice_delete($adv_id){
    session_write_close();

    $this->load->database();
    $this->load->model("caseModel");

    $advice = $this->caseModel->get_advice($adv_id);
    $this->caseModel->delete_advice($adv_id);
    redirect(admin_url("cases/advices/".$advice->case_id));
  }

}
