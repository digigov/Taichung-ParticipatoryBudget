<?php

class NewsModel extends CI_Model {

  var $_table = "news";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function get_latest_news_list($pageIndex,$pageSize = 100){
    $this->db->select("id,category,publish_date,title,clicks");
    $this->db->limit($pageSize);
    $this->db->offset(($pageIndex-1) * $pageSize);
    $this->db->order_by("ctime","desc");
    $this->db->where("type",1);
    $q = $this->db->get($this->_table);

    return $q->result();
  }


  public function get_latest_event_list($pageIndex,$pageSize = 100){
    $this->db->select("id,category,publish_date,title,clicks,image,content");
    $this->db->limit($pageSize);
    $this->db->offset(($pageIndex-1) * $pageSize);
    $this->db->order_by("ctime","desc");
    $this->db->where("type",2);
    $q = $this->db->get($this->_table);

    return $q->result();
  }

  public function get_event($id){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("type",2);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result()); 
  }

  public function get($id){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("type",1);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result());
  }

  public function update_clicks($id){
    $this->db->set("clicks","clicks + 1",false);
    $this->db->where("id",$id);
    $this->db->where("type",1);
    $this->db->update($this->_table);
  }
  
}