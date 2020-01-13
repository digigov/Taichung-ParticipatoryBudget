<?php
include_once(__DIR__."/BaseRecordModel.php");

class DepartModel extends CI_Model {

  var $_table = "departs";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function get_list(){
    $this->db->select("*");
    $this->db->where("deleted",false);

    $this->db->order_by("id","desc");

    $q = $this->db->get($this->_table);
    $res= $q->result();

    return $res;

  }

  public function get($id){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("deleted",false);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result());
  }

  public function find_by_name($name){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("name",$name);
    $this->db->where("deleted",false);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result());
  }

  public function insert($options){
    if($options ==null){
      $options = [];
    }
    //text,start_time,end_time,status,img_url,url
    $this->db->insert($this->_table,$options);
    return $this->db->insert_id();
  }

  public function update($id,$options){
    $this->db->set($options);
    $this->db->set("mtime","now() at time zone 'utc'",false);
    $this->db->where("id",$id);
    $this->db->update($this->_table);
  }

  public function delete($post_id){
    $this->db->set("deleted",true);
    $this->db->where("id",$post_id);
    $this->db->update($this->_table);
  }
  
}