<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Image extends MY_ADMIN_Controller {

	public function recent($last = null,$limit = 30){

		$this->load->database();
		$this->load->model("imageModel");
		$images = $this->imageModel->recent_admin_images();
		$this->return_success_json($images);
		//$this->load->library("imagemanager");
		//$images = $this->imagemanager->recent();
		//$this->return_success_json($images,true);
	}

	public function upload(){

		$upload = $this->_upload("pb","image","pb_".date("Ymd")."/");
		if($upload->isSuccess){
			$this->load->database();
			$this->load->model("imageModel");
			$this->imageModel->insert_image($upload->data->url);
		}
		$this->return_json($upload,true);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */