<?php
include_once(__DIR__."/BaseRecordModel.php");

class SpeechModel extends BaseRecordModel {

  var $_type = "speech";
  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }
}