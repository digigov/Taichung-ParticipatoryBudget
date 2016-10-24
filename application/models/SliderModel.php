<?php

class SliderModel extends CI_Model {

  var $_table = "sliders";

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function get_active_now(){
    $this->db->select("*");
    $this->db->where("status",1);
    $this->db->where("start_time <= timezone('utc'::text, now()) and end_time >= timezone('utc'::text, now()) ");
    $this->db->where("deleted",0);

    $q = $this->db->get($this->_table);
    return ($q->result());
  }


  public function get_all_by_page($page,$pageSize){
    $this->db->select("*");
    $this->db->where("start_time <= timezone('utc'::text, now()) and end_time >= timezone('utc'::text, now()) ");
    $this->db->where("deleted",0);

    $this->db->order_by("id","desc");
    $this->db->limit($pageSize);
    $this->db->offset($pageSize*($page-1));

    $q = $this->db->get($this->_table);
    return ($q->result());
  }

  public function get_latest_by_page($page,$pageSize){
    $this->db->select("*");
    $this->db->where("status",1);
    $this->db->where("start_time <= timezone('utc'::text, now()) and end_time >= timezone('utc'::text, now()) ");
    $this->db->where("deleted",0);

    $this->db->order_by("id","desc");
    $this->db->limit($pageSize);
    $this->db->offset($pageSize*($page-1));

    $q = $this->db->get($this->_table);
    return ($q->result());
  }


  public function get($id){
    $this->db->select("*");
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

  public function delete($post_id){
    $this->db->set("deleted",1);
    $this->db->where("id",$post_id);
    $this->db->update($this->_table);
  }
  
}