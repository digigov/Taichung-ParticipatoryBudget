<?php
include_once(__DIR__."/BaseRecordModel.php");

class LivingModel extends BaseRecordModel {

  var $_type = "livingroom";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
  
}