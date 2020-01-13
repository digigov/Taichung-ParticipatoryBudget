<?php

class CaseModel extends CI_Model {

  var $_table = "cases";
  var $_table_advice = "case_advice";

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function get_active_now(){
    $this->db->select("*");

    $this->db->where("publish_date <= timezone('utc'::text, now()) ");
    $this->db->where("deleted",0);

    $q = $this->db->get($this->_table);
    return ($q->result());
  }


  public function get_active_by_area($year,$area_id){

    if($year == null){
      $this->db->select("max(year) as year");
      $q = $this->db->get($this->_table);
      $res = array_first_item($q->result());

      if($res != null){
        $year = $res->year;
      }
    }

    $this->db->select("*");
    $this->db->where("area_id",$area_id);
    $this->db->where("year","".$year);
    $this->db->where("publish_date <= timezone('utc'::text, now()) ");
    $this->db->where("deleted",0);
    $this->db->order_by("caseno","asc");

    $q = $this->db->get($this->_table);
    return ($q->result());
  }

  public function get_latest_by_page_and_depart($depart,$page,$pageSize){
    $this->db->select("*,(select count(*) from case_advice ca where ca.case_id = cases.id and deleted = 0) as case_cnt,
      (select name from departs dp where dp.id = cases.depart_id ) as departname");
    $this->db->where("deleted",0);
    $this->db->where("depart_id",$depart);
    $this->db->order_by("id","desc");
    $this->db->limit($pageSize);
    $this->db->offset($pageSize*($page-1));

    $q = $this->db->get($this->_table);
    return ($q->result());
  }

  public function get_latest_by_page($page,$pageSize){
    $this->db->select("*,(select count(*) from case_advice ca where ca.case_id = cases.id and deleted = 0) as case_cnt,
      (select name from departs dp where dp.id = cases.depart_id ) as departname");
    $this->db->where("deleted",0);

    $this->db->order_by("id","desc");
    $this->db->limit($pageSize);
    $this->db->offset($pageSize*($page-1));

    $q = $this->db->get($this->_table);
    return ($q->result());
  }

  public function get_latest_by_area_and_page($areaID,$page,$pageSize){
    $this->db->select("*,(select count(*) from case_advice ca where ca.case_id = cases.id and deleted = 0) as case_cnt");

    $this->db->where("area_id",$areaID);
    $this->db->where("deleted",0);

    $this->db->order_by("id","desc");
    $this->db->limit($pageSize);
    $this->db->offset($pageSize*($page-1));

    $q = $this->db->get($this->_table);
    return ($q->result());
  }


  public function get_public($id){
    $this->db->select("*,(select a.name from areas as a where cases.area_id = a.id) as area");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("publish_date <= timezone('utc'::text, now()) ");
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result());
  }

  public function get($id){
    $this->db->select("*,(select a.name from areas as a where cases.area_id = a.id) as area");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result());
  }

  public function insert($options){
    //text,start_time,end_time,status,img_url,url
    $this->db->insert($this->_table,$options);
    return $this->db->insert_id();
  }
  
  public function update($id,$options){
    $this->db->set($options);
    $this->db->where("id",$id);
    $this->db->update($this->_table);
  }

  public function update_clicks($id){
    $this->db->set("clicks","clicks + 1",false);
    $this->db->where("id",$id);
    $this->db->update($this->_table);
  }
  
  public function delete($id){
    $this->db->set("deleted",1);
    $this->db->where("id",$id);
    $this->db->update($this->_table);
  }




  public function insert_advice($options){
    //text,start_time,end_time,status,img_url,url
    $this->db->insert($this->_table_advice,$options);
    return $this->db->insert_id();
  }
  
  public function update_advice($id,$options){
    $this->db->set($options);
    $this->db->where("id",$id);
    $this->db->update($this->_table_advice);
  }

  public function delete_advice($id){
    $this->db->set("deleted",1);
    $this->db->where("id",$id);
    $this->db->update($this->_table_advice);
  }


  public function get_advice($id){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table_advice);
    return array_first_item($q->result());
  }

  
  public function list_advices($case_id){
    $this->db->where("case_id",$case_id);
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table_advice);
    return $q->result();
  }


}