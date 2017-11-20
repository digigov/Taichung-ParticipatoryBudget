<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
  var $_enable_cookie_write_methods = null;

  public function __construct()
  {
    parent::__construct();
    $this->load->library("session");
    $this->_initvars();
    
  }

  public function _initvars(){
  }

  
  public function _upload($category,$name,$folder_path = ''){
    $path = $_FILES[$name]['tmp_name'];
    $name = $_FILES[$name]['name'];
    $file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    $file_name = uniqid($category."_");

    $whitelist = ["jpg","jpeg","gif","png","swf","zip","rar"]; 
    if (!(in_array($file_ext, $whitelist))) {
      return new ReturnMessage(false,100,"file type [".$file_ext."] not allowed.");
    }

    // die(var_dump($folder_path));
    $allname = $folder_path.$file_name.".".$file_ext;
    // $all_org_name = $folder_path.$file_name."_org.".$file_ext;
    $this->load->library("s3");
    // $result = $this->s3->uploadGZ($this->_toGzip($path),$all_org_name);
    
    $result = $this->s3->uploadGZ($this->_toGzip($path),$allname);


    if(!isset($result['ObjectURL'])){
      throw new ReturnMessage(false,100,'Failed to move uploaded file.');
    }

    return new ReturnMessage(true,null,null,(object)Array(
      "name" => $file_name.".".$file_ext ,
      "original_name" => $name,
      "ext" => $file_ext,
      "folder" => $folder_path,
      "file_size" => filesize($path),         
      "url" => S3_HOST.$allname
    ));

  }

  public function _sesison_close(){
    session_write_close();
  }


  function _is_login(){
    return isset($_SESSION["user"]);
  }


  public function _toGzip($path){

    // Name of compressed gz file 
    $gzfile = $path.".gz";

    // Open the gz file (w9 is the highest compression)
    $fp = gzopen($gzfile, 'w9');

    // Compress the file
    gzwrite ($fp, file_get_contents($path));

    //close the file after compression is done
    gzclose($fp);

    return $gzfile;
  }



  protected function return_success_json ($obj,$header = false){
    if($header){
      header('Content-Type: application/json');
    }
    return $this->return_json(new ReturnMessage(true,0, null, $obj));
  }

  protected function return_error($code,$msg,$header = false){
    if($header){
      header('Content-Type: application/json');
    }       
    return $this->return_json(new ReturnMessage(false,$code,$msg, null));
  }

  protected function return_json ($obj,$header = false){
    if($header){
      header('Content-Type: application/json');
    }       
    echo json_encode($obj);
    return true;
  }

  
}



class MY_ADMIN_Controller extends MY_Controller {

  public function _load_view($path,$args,$ret = false){
    return $this->load->view('admin/'.$path,$args,$ret = false);
  }
  // NOTE: who want to overwrite the _remap 
  // have to rewrite the enable_cookie_write_methods also.
  public function _remap($method, $params = [])
  {
/*
    if( $this->_enable_cookie_write_methods == null ||
       ! in_array($method,$this->_enable_cookie_write_methods)){
      session_write_close();
    }
*/
    $mem = null;

    $this->load->database();
    $this->load->model("areaModel");

    $areas = $this->areaModel->get_area_simple_list();
    $this->_areas = $areas;

    $this->load->vars([ "_areas" => $areas ]);
    if(true){

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
    }
    if (method_exists($this, $method))
    {
      return call_user_func_array([$this, $method], $params);
    }

    show_404();
    return false;
  }


}


class ReturnMessage{
  var $isSuccess;
  var $errorCode;
  var $data;
  public function __construct($isSuccess,$errorCode,$errorMessage,$data = null){
    $this->isSuccess = $isSuccess;
    $this->errorCode = $errorCode;
    $this->errorMessage = $errorMessage;
    $this->data = $data;
  }
}

include("MY_Record_Controller.php");
