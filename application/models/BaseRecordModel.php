<?php

class BaseRecordModel extends CI_Model {

  var $_table = "livingroom";
  var $_table_livingroom_images = "livingroom_images";
  var $_type = "hosttrain";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function get_all_by_page($page,$pageSize){
    $this->db->select("*,(select name from areas where areas.id = livingroom.area_id) as area");
    $this->db->where("deleted",false);
    $this->db->where("record_type",$this->_type);

    $this->db->order_by("id","desc");
    $this->db->limit($pageSize);
    $this->db->offset($pageSize*($page-1));

    $q = $this->db->get($this->_table);
    return ($q->result());
  }

  public function get_all_by_area_id_and_year($area_id,$year){

    $this->db->select("n.*,(select im.url from livingroom_images im where im.id = n.major_file) as img_url");
    $this->db->where("n.deleted",false);
    $this->db->where("n.area_id",$area_id);
    $this->db->where("n.year",$year);

    $this->db->where("n.record_type",$this->_type);
    $this->db->order_by("n.record_date","desc");

    $q = $this->db->get($this->_table." n");
    return ($q->result());
  }

  public function get_all_by_year($year){

    $this->db->select("n.*,(select im.url from livingroom_images im where im.id = n.major_file) as img_url");
    $this->db->where("n.deleted",false);
    $this->db->where("n.year",$year);

    $this->db->where("n.record_type",$this->_type);
    $this->db->order_by("n.record_date","desc");

    $q = $this->db->get($this->_table." n");
    return ($q->result());
  }

  public function get_area_counts_by_year($year){

    $this->db->select("n.area_id,count(*) as cnt");
    $this->db->where("n.deleted",false);
    $this->db->where("n.year",$year);
    $this->db->where("n.record_type",$this->_type);
    $this->db->group_by("n.area_id");

    $q = $this->db->get($this->_table." n");
    return ($q->result());
  }

  public function get_all_by_area_page($area,$page,$pageSize){
    $this->db->select("n.*,a.name as area");
    $this->db->where("n.deleted",false);


    $this->db->where("a.name",$area);
    $this->db->where("n.record_type",$this->_type);

    $this->db->join("areas a","a.id = n.area_id");
    $this->db->order_by("n.id","desc");
    $this->db->limit($pageSize);
    $this->db->offset($pageSize*($page-1));

    $q = $this->db->get($this->_table." n");
    return ($q->result());

  }

  public function get($id,$public = null){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("record_type",$this->_type);

    if($public != null){
      $this->db->where("status",$public);
    }
    $this->db->where("deleted",false);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result());
  }

  public function insert($options){
    if($options ==null){
      $options = [];
    }
    $options["record_type"]= $this->_type;
    //text,start_time,end_time,status,img_url,url
    $this->db->insert($this->_table,$options);
    return $this->db->insert_id();
  }

  public function insert_image($options){
    $this->db->insert($this->_table_livingroom_images,$options);
    return $this->db->insert_id(); 
  }
  
  public function update($id,$options){
    $this->db->set($options);
    $this->db->where("id",$id);
    $this->db->update($this->_table);
  }

  public function delete($post_id){
    $this->db->set("deleted",true);
    $this->db->where("id",$post_id);
    $this->db->update($this->_table);
  }
  
  public function handle_file_ids($living_id,$file_ids,$file_major)
  {

    $this->db->set("livingroom_id",'null',false);
    $this->db->where("livingroom_id",$living_id);
    $this->db->update($this->_table_livingroom_images);

    if(count($file_ids)>0){
      $this->db->set("livingroom_id",$living_id);
      $this->db->where_in("id",$file_ids);
      $this->db->update($this->_table_livingroom_images);
    }

    $this->db->set("major_file",$file_major);
    $this->db->where("id",$living_id);
    $this->db->update($this->_table);

  }

  public function get_images($living_id){
    $this->db->select("*,(select 1 from livingroom where major_file = livingroom_images.id) as is_major");
    $this->db->where("livingroom_id",$living_id);
    $q = $this->db->get($this->_table_livingroom_images);
    return $q->result();

  }
}