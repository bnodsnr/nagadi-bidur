<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{	

	function __construct() 
	{
		parent::__construct();
		$this->_hmvc_fixes();
		$this->load->model('CommonModel');
	}
	
	function _hmvc_fixes()
	{		
		//fix callback form_validation		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

	// public function GetLandValuationRate($conditions) {
	// 	$road_detials = $this->CommonModel->GetRoadDetailsByID($conditions);
	// 	return $road_detials;
 //    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */