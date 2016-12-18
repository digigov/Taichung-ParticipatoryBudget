<?php

class PageModel extends CI_Model {

  var $_table = "pages";

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function get($year,$key){

    $this->db->where("year",$year);
    $this->db->where("key",$key);
    $q = $this->db->get($this->_table);

    $res = $q->result();
    return array_first_item($res);
    
  }

  public function insertOrUpdate($year,$key,$name,$content){

    $this->db->where("year",$year);
    $this->db->where("key",$key);
    $this->db->select("id");
    $q = $this->db->get($this->_table);

    $res = $q->result();

    if(count($res) > 0 ){
      $this->db->where("year",$year);
      $this->db->where("key",$key);

      $this->db->set("content",$content);
      $this->db->set("name",$name);
      $this->db->update($this->_table);
    }else{
      $this->db->insert($this->_table,
        [
          "year" => $year,
          "key" => $key,
          "name" => $name,
          "content" => $content,
        ]
      );
    }
  }
}