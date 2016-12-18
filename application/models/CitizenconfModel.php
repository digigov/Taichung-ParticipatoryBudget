<?php
include_once(__DIR__."/BaseRecordModel.php");

class CitizenconfModel extends BaseRecordModel {

  var $_type = "citizenconf";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
}