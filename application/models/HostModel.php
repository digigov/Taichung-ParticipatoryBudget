<?php
include_once(__DIR__."/BaseRecordModel.php");

class HostModel extends BaseRecordModel {

  var $_type = "hosttrain";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
}