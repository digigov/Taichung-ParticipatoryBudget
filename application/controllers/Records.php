<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Records extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function year($year = null)
	{

		if(!_check_year($year)){
			return show_404();
		}

		if($year == "2015"){
			return redirect('http://2015taichungivoting.weebly.com/');
		}
		$this->load->view('records/index',
			[	
				"pb" => "",
				"year" => $year
			] );
		session_write_close();
	}

}
