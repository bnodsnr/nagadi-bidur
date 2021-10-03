<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class NagadiTitleWiseReport extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("NagadiTitleWiseReportModel");
        $this->module_code = 'TITLE-REPORT';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /**
       ** This function list all the land minimun rate
       ** @param 
       ** @return array of all land_minimum rate

    */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
            $data['reports'] = $this->NagadiTitleWiseReportModel->getReport();
            $data['sampatikar'] = $this->NagadiTitleWiseReportModel->getSampatiKar();
            $data['bhumikar'] = $this->NagadiTitleWiseReportModel->getBhumiKar();
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function Search() {
    	if($this->input->is_ajax_request()) {
    		$ward = $this->input->post('search_added_ward');
    		$from_date = $this->input->post('from_date');
    		$to_date = $this->input->post('to_date');
    		$data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
            $data['reports'] = $this->NagadiTitleWiseReportModel->getReport($from_date,$to_date,$ward);
            $data['sampatikar'] = $this->NagadiTitleWiseReportModel->getSampatiKar($from_date,$to_date,$ward);
            $data['bhumikar'] = $this->NagadiTitleWiseReportModel->getBhumiKar($from_date,$to_date,$ward);
            $data_view                  = $this->load->view('ajax_search_view', $data, true);
        	$response                   = array(
          		'status'                  => 'success',
          		'data'                    => $data_view
        	);
        	header("Content-type: application/json");
        	echo json_encode($response);
        	exit;
    	} else {
    		exit('invalid!!!');
    	}
    }
}