<?php
include_once(__DIR__."/BaseRecordModel.php");

class StallModel extends BaseRecordModel {

  var $_type = "stall";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
}