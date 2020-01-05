<?php
include_once(__DIR__."/BaseRecordModel.php");

class AllBaseRecordModel extends BaseRecordModel {

  var $_type = null;
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
  
}
