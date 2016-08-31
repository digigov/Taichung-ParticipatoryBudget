<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function admin_url($url){
  return site_url("admin/".$url);
}