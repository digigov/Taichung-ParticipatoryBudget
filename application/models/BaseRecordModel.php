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
    $this->db->select("*");
    $this->db->where("deleted",false);
    $this->db->where("record_type",$this->_type);

    $this->db->order_by("id","desc");
    $this->db->limit($pageSize);
    $this->db->offset($pageSize*($page-1));

    $q = $this->db->get($this->_table);
    return ($q->result());
  }

  public function get_all_by_area_page($area,$page,$pageSize){
    $this->db->select("*");
    $this->db->where("deleted",false);
    $this->db->where("area",$area);
    $this->db->where("record_type",$this->_type);

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
    $this->db->where("record_type",$this->_type);
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
    // die(var_dump([$living_id,$file_ids]));

  }

  public function get_images($living_id){
    $this->db->where("livingroom_id",$living_id);
    $q = $this->db->get($this->_table_livingroom_images);
    return $q->result();

  }
}