<?php

class MemberModel extends CI_Model {

  var $_table = "member";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }




  public function get_depart_list(){

    $this->db->select("member.*,(select name from departs where departs.id = member.depart::int ) departName");
    $this->db->where("member.depart is not null");
    $q = $this->db->get($this->_table);

    return ($q->result());
  }

  public function insert($options){
    //text,start_time,end_time,status,img_url,url
    $this->db->insert($this->_table,$options);
    return $this->db->insert_id();
  }
  


  public function get($id){
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->where("id",$id);
    $q = $this->db->get($this->_table);
    return array_first_item($q->result());
  }

  public function getByAccount($acc){
    $this->db->where("account",$acc);
    $this->db->limit(1);
    $q = $this->db->get($this->_table);

    $user = array_first_item($q->result());
    if($user == null){
      return null;
    }

    return $user;

  }


  public function update($id,$options){
    $this->db->set($options);
    $this->db->set("mtime","now() at time zone 'utc'",false);
    $this->db->where("id",$id);
    $this->db->update($this->_table);
  }


  public function getUser($acc,$pwd){

    $this->db->where("account",$acc);
    $this->db->limit(1);
    $q = $this->db->get($this->_table);

    $user = array_first_item($q->result());
    if($user == null){
      return null;
    }

    if(!password_verify($pwd,$user->pwd)){
      return null;
    }

    return $user;

  }

  public function update_pwd($acc,$pwd){
    $hash = password_hash($pwd, PASSWORD_DEFAULT,["cost"=> 12]);
    $this->db->set("pwd",$hash);
    $this->db->where("account",$acc);
    $this->db->update($this->_table);
  }
}