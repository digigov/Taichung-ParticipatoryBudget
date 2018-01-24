<?php
include_once(__DIR__."/BaseRecordModel.php");

class GovProjModel extends CI_Model {

  var $_table = "gov_projects";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
  
  public function find(){
    $this->db->select("*,(select name from areas where areas.id = gov_projects.area_id) as area");
    $this->db->where("deleted",false);
    $q = $this->db->get($this->_table);
    return (($q->result()));
  }

  public function find_by_area($id){
    $this->db->select("*,(select name from areas where areas.id = gov_projects.area_id) as area");
    $this->db->where("area_id",$id);
    $this->db->where("deleted",false);
    $q = $this->db->get($this->_table);
    return (($q->result()));
  }

  public function get($id){
    $this->db->select("*,(select name from areas where areas.id = gov_projects.area_id) as area");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("deleted",false);
    $q = $this->db->get($this->_table);
    return array_first_item(($q->result()));
  }


  public function insert($options){
    if($options ==null){
      $options = [];
    }

    $fields = ["start_year","end_year","central_budget","budget","central_budget"];

    foreach($fields as $field){
      if(isset($options[$field]) && $options[$field] == ""){
        $options[$field] = null;
      }
    }


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