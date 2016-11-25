<?php
include_once(__DIR__."/BaseRecordModel.php");

class WorkshopModel extends BaseRecordModel {

  var $_type = "workshop";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
}