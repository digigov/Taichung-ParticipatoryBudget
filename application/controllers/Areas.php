<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends MY_Controller {

  public function index()
  {
    session_write_close();


    $this->load->view('areas/index',[
        "pageTitle" => "各區推動概況"
    ] );
  }

}
