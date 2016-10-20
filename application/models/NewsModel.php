<?php

class NewsModel extends CI_Model {

  var $_table = "news";

  var $TYPE_NEWS = 1;
  var $TYPE_EVENT = 2;
  var $TYPE_THIS_YEAR = 3;
  var $TYPE_NEXT_YEAR = 4;

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function get_latest_list_by_type($type,$pageIndex,$pageSize = 100){
    $this->db->select("id,category,publish_date,title,clicks");
    $this->db->limit($pageSize);
    $this->db->offset(($pageIndex-1) * $pageSize);
    $this->db->order_by("publish_date","desc");
    $this->db->where("type", $type);
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table);

    return $q->result();
  }

  public function get_latest_news_list($pageIndex,$pageSize = 100){
    $this->db->select("id,category,publish_date,title,clicks");
    $this->db->limit($pageSize);
    $this->db->offset(($pageIndex-1) * $pageSize);
    $this->db->order_by("publish_date","desc");
    $this->db->where("type",$this->TYPE_NEWS);
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table);

    return $q->result();
  }


  public function get_latest_event_list($pageIndex,$pageSize = 100){
    $this->db->select("id,category,publish_date,title,clicks,image,content");
    $this->db->limit($pageSize);
    $this->db->offset(($pageIndex-1) * $pageSize);
    $this->db->order_by("publish_date","desc");
    $this->db->where("type",$this->TYPE_EVENT);
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table);

    return $q->result();
  }

  public function get_event($id){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("type",$this->TYPE_EVENT);
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result()); 
  }

  public function get($id){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $this->db->where("type",$this->TYPE_NEWS);
    $this->db->where("deleted",0);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result());
  }

  public function update_clicks($id){
    $this->db->set("clicks","clicks + 1",false);
    $this->db->where("id",$id);
    $this->db->update($this->_table);
  }

  public function update_event($post_id,$title,$content,$img){
    $this->db->set("title",$title);
    $this->db->set("content",$content);
    $this->db->set("image",$img);
    $this->db->set("mtime", db_current_gmt_date() );
    $this->db->where("id",$post_id);
    $this->db->where("deleted",0);
    $this->db->where("type",$this->TYPE_EVENT);
    $this->db->update($this->_table);
  }

  public function update_news($post_id,$title,$content,$img,$category){

    $this->db->set("title",$title);
    $this->db->set("content",$content);
    $this->db->set("image",$img);
    $this->db->set("mtime", db_current_gmt_date() );
    $this->db->set("category" , $category);

    $this->db->where("id",$post_id);
    $this->db->where("deleted",0);


    $this->db->where("type",$this->TYPE_NEWS);
    $this->db->update($this->_table);
  }


  public function insert_news($title,$content,$img,$category){
    $this->db->insert($this->_table,[
      "title" => $title,
      "content" => $content,
      "image" => $img,
      "category" => $category,
      "type" => $this->TYPE_NEWS
    ]);
    return $this->db->insert_id();
  }

  public function insert_event($title,$content,$img){
    $this->db->insert($this->_table,[
      "title" => $title,
      "content" => $content,
      "image" => $img,
      "type" => $this->TYPE_EVENT,
      "category" => "活動快訊"
    ]);
    return $this->db->insert_id();
  }
  
  public function delete($post_id){
    $this->db->set("deleted",1);
    $this->db->where("id",$post_id);
    $this->db->update($this->_table);
  }
  
}