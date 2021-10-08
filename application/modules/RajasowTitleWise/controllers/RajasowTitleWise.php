<?php
/**
 * Created by PhpStorm.
 * User: root
 */
class RajasowTitleWise extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("RajasowTitleWiseModel");
        $this->module_code = 'RAJASOW-TITLEWISE';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }
    /**
       * This function list all the land minimun rate
       * @param 
       * @return void
    */
    public function Index() {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page']                       = 'search_page';
            $data['fiscal_year']                = $this->CommonModel->getData('fiscal_year','DESC');
            $data['main_topic']                 = $this->RajasowTitleWiseModel->getTitles();
            $data['aanumanit_sampatikar']       = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11313);
            $data['aanumanit_bhumikar']         = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11314);
            $data['wards']                      = $this->CommonModel->getData('wardwise_address','ASC','ward');
            $data['sampati_kar']                = $this->RajasowTitleWiseModel->getSampatiKarCurrentMonth();
            $data['sampati_kar_lastmonth']      = $this->RajasowTitleWiseModel->getSampatiKarCurrentUptoLastMonth();
            $data['bhumi_kar']                  = $this->RajasowTitleWiseModel->getBhumiKarCurrentMonth();
            $data['bhumi_kar_lastmonth']        = $this->RajasowTitleWiseModel->getBhumiKaruptoLastMonth();
            $arr                                = array();
            foreach ($data['main_topic'] as $key => $item) {
                $upto_last_month               = $this->RajasowTitleWiseModel->getTotalSumUpToLastMonth($item['topic_id']);
                $current_month                      = $this->RajasowTitleWiseModel->getTotalSumCurrentMonth($item['topic_id']);
                $arr[]                              = array(
                    'topic_no'                      => $item['topic_id'],
                    'topic_name'                    => $item['topic_name'],
                    'uptolast_month'                => $upto_last_month['total'],
                    'current_month'                 => $current_month['mtotal'],
                    'income_amount'                 => $item['annual_income'],
                );
            }
            $data['report'] = $arr;
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    // public function printReport() {
    //     if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
    //         //$data['page']                       = 'print_report';
    //         $data['fiscal_year']                = $this->CommonModel->getData('fiscal_year','DESC');
    //         $data['main_topic']                 = $this->RajasowTitleWiseModel->getTitles();
    //         $data['aanumanit_sampatikar']       = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11313);
    //         $data['aanumanit_bhumikar']         = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11314);
    //         $data['wards']                      = $this->CommonModel->getData('wardwise_address','ASC','ward');
    //         $data['sampati_kar']                = $this->RajasowTitleWiseModel->getSampatiKarCurrentMonth();
    //         $data['sampati_kar_lastmonth']      = $this->RajasowTitleWiseModel->getSampatiKarCurrentUptoLastMonth();
    //         $data['bhumi_kar']                  = $this->RajasowTitleWiseModel->getBhumiKarCurrentMonth();
    //         $data['bhumi_kar_lastmonth']        = $this->RajasowTitleWiseModel->getBhumiKaruptoLastMonth();
    //         $arr                                = array();
    //         foreach ($data['main_topic'] as $key => $item) {
    //             $upto_last_month               = $this->RajasowTitleWiseModel->getTotalSumUpToLastMonth($item['topic_id']);
    //             $current_month                      = $this->RajasowTitleWiseModel->getTotalSumCurrentMonth($item['topic_id']);
    //             $arr[]                              = array(
    //                 'topic_no'                      => $item['topic_id'],
    //                 'topic_name'                    => $item['topic_name'],
    //                 'uptolast_month'                => $upto_last_month['total'],
    //                 'current_month'                 => $current_month['mtotal'],
    //                 'income_amount'                 => $item['annual_income'],
    //             );
    //         }
    //         $data['report'] = $arr;
    //         $this->load->view('print_report', $data);
    //     } else {
    //         $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
    //         redirect('Dashboard');
    //     }
    // }
    //search
    public function Search() {
        if($this->input->is_ajax_request()) {
            $fiscal_year                            = $this->input->post('fiscal_year');
            $ward                                   = $this->input->post('ward');
            $month                                  = $this->input->post('month');
            $this->form_validation->set_rules("fiscal_year","देखि","trim|required",               
            array('required' => 'कृपया देखि रकम भर्नु होस्')
            );
            $this->form_validation->set_rules("month","देखि", "trim|required",
                array('required'=>'कृपया सम्म रकम भर्नु होस्','uni')
            );
            if ($this->form_validation->run() === false) { 
                $response = array(
                    'status'          => 'validation_error',
                    'message'            => 'कृपाय आर्थिक वर्ष र महिना छान्नुहोस',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            

            $data['sfy']                            = $fiscal_year;
            $data['month']                          = $month;
            $data['ward']                           = $ward;

            $data['fiscal_year']                    = $this->CommonModel->getData('fiscal_year','DESC');
            $data['main_topic']                     = $this->RajasowTitleWiseModel->getTitles();

            $data['aanumanit_sampatikar']           = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11313);
            $data['aanumanit_bhumikar']             = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11314);
            $data['wards']                          = $this->CommonModel->getData('wardwise_address','ASC','ward');

            $data['sampati_kar']                    = $this->RajasowTitleWiseModel->getSampatiKarMonthlySearch($fiscal_year,$ward,$month);
            $data['sampati_kar_lastmonth']          = $this->RajasowTitleWiseModel->getSampatiKarSearchUptoLastMonth($fiscal_year,$ward,$month);

            $data['bhumi_kar']                      = $this->RajasowTitleWiseModel->getBhumiMonthlySearch($fiscal_year,$ward,$month);
            $data['bhumi_kar_lastmonth']            = $this->RajasowTitleWiseModel->getBhumiKarSearchUptoLastMonth($fiscal_year,$ward,$month);
            $arr                                    = array();
            foreach ($data['main_topic'] as $key => $item) {
                $upto_last_month                    = $this->RajasowTitleWiseModel->getTotalSumSearchUpToLastMonth($item['topic_id'], $fiscal_year,$ward,$month);
                $current_month                      = $this->RajasowTitleWiseModel->getNagadiSearchCurrentMonth($item['topic_id'],$fiscal_year,$ward,$month);
                $arr[]                              = array (
                    'topic_no'                      => $item['topic_id'],
                    'topic_name'                    => $item['topic_name'],
                    'uptolast_month'                => $upto_last_month['total'],
                    'current_month'                 => $current_month['mtotal'],
                    'income_amount'                 => $item['annual_income'],
                );
            }
            $data['report'] = $arr;
            $data_view                  = $this->load->view('ajax_view', $data, true);
            $response = array(
                'status'          => 'success',
                'data'            => $data_view,
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        } else {
            exit('no direct script allowed!!!');
        }
    }

    public function printReport($fiscal_year,$month,$ward = NULL ) {
            $fy = str_replace('-','/',$fiscal_year);
            // $fiscal_year                            = $this->input->post('fiscal_year');
            // $ward                                   = $this->input->post('ward');
            //$month                                  = $this->input->post('month');
            $data['fiscal_year']                    = $this->CommonModel->getData('fiscal_year','DESC');
            $data['main_topic']                     = $this->RajasowTitleWiseModel->getTitles();

            $data['aanumanit_sampatikar']           = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11313);
            $data['aanumanit_bhumikar']             = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11314);
            $data['wards']                          = $this->CommonModel->getData('wardwise_address','ASC','ward');

            $data['sampati_kar']                    = $this->RajasowTitleWiseModel->getSampatiKarMonthlySearch($fy,$ward,$month);
            $data['sampati_kar_lastmonth']          = $this->RajasowTitleWiseModel->getSampatiKarSearchUptoLastMonth($fy,$ward,$month);

            $data['bhumi_kar']                      = $this->RajasowTitleWiseModel->getBhumiMonthlySearch($fy,$ward,$month);
            $data['bhumi_kar_lastmonth']            = $this->RajasowTitleWiseModel->getBhumiKarSearchUptoLastMonth($fy,$ward,$month);
            $arr                                    = array();
            foreach ($data['main_topic'] as $key => $item) {
                $upto_last_month                    = $this->RajasowTitleWiseModel->getTotalSumSearchUpToLastMonth($item['topic_id'], $fy,$ward,$month);
                $current_month                      = $this->RajasowTitleWiseModel->getNagadiSearchCurrentMonth($item['topic_id'],$fy,$ward,$month);
                $arr[]                              = array (
                    'topic_no'                      => $item['topic_id'],
                    'topic_name'                    => $item['topic_name'],
                    'uptolast_month'                => $upto_last_month['total'],
                    'current_month'                 => $current_month['mtotal'],
                    'income_amount'                 => $item['annual_income'],
                );
            }
            $data['report'] = $arr;
            $this->load->view('print_report', $data);
    }
}