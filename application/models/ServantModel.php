<?php
include_once(__DIR__."/BaseRecordModel.php");

class ServantModel extends BaseRecordModel {

  var $_type = "servant";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
}