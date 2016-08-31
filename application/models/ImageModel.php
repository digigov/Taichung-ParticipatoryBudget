<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ImageModel extends CI_Model {

    var $_table = "images"; 

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_image($url,$type = 0){
        $data = Array(
            "url" => $url,
            "type" => $type,
            "ctime" => db_current_gmt_date()
        );
        $this->db->insert($this->_table,$data);
    }

    public function recent_admin_images($last = null,$limit = 30){

        $this->db->select("id,url,ctime");
        $this->db->where("type",0);
        $this->db->limit($limit);

        $query = $this->db->get($this->_table);
        $result = $query->result();
        foreach($result as &$r){
            $r->createDate = _date_format_utc($r->ctime);
        }
        return $result;
    }


}