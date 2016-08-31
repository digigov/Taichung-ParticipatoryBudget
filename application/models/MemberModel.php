<?php

class MemberModel extends CI_Model {

  var $_table = "member";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
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