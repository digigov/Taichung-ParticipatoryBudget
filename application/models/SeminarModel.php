<?php
include_once(__DIR__."/BaseRecordModel.php");

class SeminarModel extends BaseRecordModel {

  var $_type = "seminar";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
}