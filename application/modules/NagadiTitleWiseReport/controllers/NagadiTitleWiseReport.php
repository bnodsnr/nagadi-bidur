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
            $data['page']               = 'list_report';
            $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
            $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
            $data['titles']             = $this->NagadiTitleWiseReportModel->setCategoryTree();
            // pp($data['titles']);
            $data['sampati_kar']        = $this->NagadiTitleWiseReportModel->SampatiKarMonthly();
            $data['bhumi_kar']          = $this->NagadiTitleWiseReportModel->BhumiKarMonthly();
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }
    public function printDetails() {
        $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
        $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
        $data['titles']             = $this->NagadiTitleWiseReportModel->setCategoryTree();
        $data['sampati_kar']        = $this->NagadiTitleWiseReportModel->SampatiKarMonthly();
        $data['bhumi_kar']          = $this->NagadiTitleWiseReportModel->BhumiKarMonthly();
        $this->load->view('print_report', $data);
    }

    //serach report by titlewise
    public function getSearchResult() {
        $data['page']               = 'search_list';
        $from_date                  = $this->uri->segment(3);
        $to_date                    = $this->uri->segment(4);
        $ward                       = $this->uri->segment(5);
        $data['ward_no']            = !empty($ward)?$ward:'00';
        $data['from_date']          = !empty($from_date)?$from_date:'00';
        $data['to_date']            = !empty($to_date)?$to_date:'00';
        $data['titles']             = $this->NagadiTitleWiseReportModel->setCategoryTree();
        $data['sampati_kar']        = $this->NagadiTitleWiseReportModel->SearchSampatiKarMonthly($from_date,$to_date,$ward);
        $data['bhumi_kar']          = $this->NagadiTitleWiseReportModel->SearchBhumikarKarMonthly($from_date,$to_date,$ward);
        $this->load->view('main', $data);
    }
    public function printSearchDetails() {
        $from_date                  = $this->uri->segment(3);
        $to_date                    = $this->uri->segment(4);
        $ward                       = $this->uri->segment(5);
        $data['ward_no']            = !empty($ward)?$ward:'00';
        $data['from_date']          = !empty($from_date)?$from_date:'00';
        $data['to_date']            = !empty($to_date)?$to_date:'00';
        $data['titles']             = $this->NagadiTitleWiseReportModel->setCategoryTree();
        $data['sampati_kar']        = $this->NagadiTitleWiseReportModel->SearchSampatiKarMonthly($from_date,$to_date,$ward);
        $data['bhumi_kar']          = $this->NagadiTitleWiseReportModel->SearchBhumikarKarMonthly($from_date,$to_date,$ward);
        $this->load->view('print_searchdetails', $data);
    }
    
    /*----------------------------------------------
      Topic wise details
      -------------------------------------------------*/
    public function getViewByTopic() {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $id                         = $this->uri->segment(3);
            $data['page']               = 'viewby_topic';
            $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
            $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
            $data['titles']             = $this->NagadiTitleWiseReportModel->setCategoryTree($id);
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    //print by nagadi main title
    public function printDetailsByTopicId() {
        $id                         = $this->uri->segment(3);
        $data['page']               = 'viewby_topic';
        $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
        $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
        $data['titles']             = $this->NagadiTitleWiseReportModel->setCategoryTree($id);
        $this->load->view('print_by_topic', $data);
    }

    //get nagadi by topic and search
    public function getBySearchNagadi() {
        $id                         = $this->uri->segment(3);
        $from_date                  = $this->uri->segment(4);
        $to_date                    = $this->uri->segment(5);
        $ward                       = $this->uri->segment(6);
        $data['ward_no']            = !empty($ward)?$ward:'00';
        $data['from_date']          = !empty($from_date)?$from_date:'00';
        $data['to_date']            = !empty($to_date)?$to_date:'00';
        $data['page']               = 'viewby_topic_search';
        $data['titles']             = $this->NagadiTitleWiseReportModel->setCategoryTree($id);
        $this->load->view('main', $data);
    }
    public function printDetailsByTopicIdSearch() {
        $id                         = $this->uri->segment(3);
        $from_date                  = $this->uri->segment(4);
        $to_date                    = $this->uri->segment(5);
        $ward                       = $this->uri->segment(6);
        $data['ward_no']            = !empty($ward)?$ward:'00';
        $data['from_date']          = !empty($from_date)?$from_date:'00';
        $data['to_date']            = !empty($to_date)?$to_date:'00';
       // $data['page']               = 'viewby_topicbysearch';
        $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
        $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
        $data['titles']             = $this->NagadiTitleWiseReportModel->setCategoryTree($id);
        $this->load->view('print_topicbysearch', $data);
    }

    /*----------------------------------------------------------------------------------------------
        Nagadi Bill details by main topic
    -----------------------------------------------------------------------------------------------*/
    public function MonthlyBillDetailsByMainTopic($topic_id) {
        $data['page']               = 'list_monthly_details_by_topic';
        $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
        $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
        $data['billDetails']        = $this->NagadiTitleWiseReportModel->getMontlhyNagadiBillDetails($topic_id);
        $data['cancel_amount']      = $this->NagadiTitleWiseReportModel->getCancelAmountDetailsByMonth($topic_id);
        $this->load->view('main', $data);
    }

    public function MonthlyBillDetailsByMainTopicBySearch() {
        $topic_id                   = $this->uri->segment(3);
        $from_date                  = $this->uri->segment(4);
        $to_date                    = $this->uri->segment(5);
        $ward                       = $this->uri->segment(6);
        // echo $topic_id.$from_date.$to_date.$ward;
        // exit;
        $data['ward_no']            = !empty($ward)?$ward:'00';
        $data['from_date']          = !empty($from_date)?$from_date:'00';
        $data['to_date']            = !empty($to_date)?$to_date:'00';
        $data['page']               = 'list_bill_details_by_search';
        $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
        $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
        $data['billDetails']        = $this->NagadiTitleWiseReportModel->getMontlhyNagadiBillDetailsBySearch($topic_id, $from_date,$to_date,$ward);
       // pp($data['billDetails']);
        $data['cancel_amount']      = $this->NagadiTitleWiseReportModel->getCancelAmountDetailsByMonthBySearch($topic_id, $from_date,$to_date,$ward);
        $this->load->view('main', $data);
    }

    /*------------------------------------------------------------------
        //view sampati/bhumi kar monthly bil details details
    -------------------------------------------------------------------*/
  public function MonthlySampatiBhumiKarDetailsView() {
    $from_date                      = $this->uri->segment(3);
    $to_date                        = $this->uri->segment(4);
    $ward                           = $this->uri->segment(5);
    $data['ward_no']                = !empty($ward)?$ward:'00';
    $data['from_date']              = !empty($from_date)?$from_date:'00';
    $data['to_date']                = !empty($to_date)?$to_date:'00';
    $data['sampati_bhumi_kar']      = $this->NagadiTitleWiseReportModel->MonthlySampatiBhumiKarSearch($from_date,$to_date,$ward);
    $data['sampati_cancel_amount']  = $this->NagadiTitleWiseReportModel->getCancelSampatikarAmountDetailsByMonthSearch($from_date,$to_date,$ward);
    $data['page'] = 'list_sampati_bhumikar_bill_details';
      $this->load->view('main', $data);
  }
}