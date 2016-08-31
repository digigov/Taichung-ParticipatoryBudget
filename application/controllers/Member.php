<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

    //if you need to write session,overwrite this.
  var $_enable_cookie_write_methods = ["signing","signup","logout","signuping",
    'openid', 'openid_signin_callback','openid_connect','openid_connect_callback', 
    'openid_cancel','signuping_openid'];

  var $_mem = null;

  public function index(){
    $this->load->view("member/index",["pageTitle" => "管理者首頁"]);
  }


  public function signin(){
    $this->load->view("member/signin",["pageTitle" => "管理者登入"]);
  }

  public function signing(){
    $this->load->database();
    $this->load->model("memberModel");
    $acc = $this->input->post("acc");
    $pwd = $this->input->post("pwd");

    $ret = $this->memberModel->getUser(
      $acc,
      $pwd
    );
    
    // if errorCode == ERROR_MEMBER_NOT_VERIFIED, go to reverify
    if($ret != null){
      $_SESSION["user"] = $ret;
    }
    session_write_close();

    if($ret == null){
      $this->load->view("member/signin",[
        "pageTitle" => "管理者登入",
        "acc" => $acc,
        "pwd" => $pwd 
      ]);
    }else{
      redirect(site_url("member/index"));
    }
  }

  public function is_login(){
    header('Content-Type: application/json');
    $this->return_success_json($this->_is_login());
  }


  public function logout(){
    unset($_SESSION["user"]) ;
    redirect(site_url("member/signin"));
  }

  public function changepwd(){
    $old_pwd = $this->input->post("oldpwd");
    $pwd1 = $this->input->post("pwd1");
    $pwd2 = $this->input->post("pwd2");

    if(!password_verify($old_pwd,$_SESSION["user"]->pwd)){
      $this->load->view("member/password",["pageTitle" => "修改密碼",
        "error" => "舊密碼錯誤"]);
      return true;
    }

    if($pwd1 != $pwd2){
      $this->load->view("member/password",["pageTitle" => "修改密碼",
        "error" => "新密碼與新密碼確認不一致"]);
      return true;
    }

    $this->load->database();
    $this->load->model("memberModel");
    $this->memberModel->update_pwd($_SESSION["user"]->account,$pwd1);
    redirect("member/index");

  }

  public function password(){
    $this->load->view("member/password",["pageTitle" => "修改密碼"]);
  }

  // NOTE: who want to overwrite the _remap 
  // have to rewrite the enable_cookie_write_methods also.
  public function _remap($method, $params = [])
  {

    if( $this->_enable_cookie_write_methods == null ||
       ! in_array($method,$this->_enable_cookie_write_methods)){
      $this->_sesison_close();
    }

    $mem = null;

    $allows = ["signin","signing","logout"];

    if(!in_array($method,$allows)){

      // $mem_sn = $this->_get_user_sn();
      if(!$this->_is_login()){
        redirect(site_url("member/signin"));
        return false;  
      }

      $mem_sn = $_SESSION["user"]->id;

      if($mem_sn == null){
        return $this->_return_404();
      }

      $this->load->vars([ "mem" => $_SESSION["user"],
        "is_login" => $this->_is_login() ]);
      $this->_mem = $_SESSION["user"];
    }else{
      $this->load->vars(["is_login" => false ]);
    }
    if (method_exists($this, $method))
    {
      return call_user_func_array([$this, $method], $params);
    }

    show_404();
    return false;
  }


}


  /* End of file welcome.php */
  /* Location: ./application/controllers/welcome.php */
