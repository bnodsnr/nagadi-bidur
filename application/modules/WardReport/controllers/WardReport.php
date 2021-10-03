<?php
/**
* created by php strom
  Name:Binod Sunar
  Date:2018/02/01:11:14 AM.
*/
require_once FCPATH.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class WardReport extends MX_Controller
{	
	public function __construct()
	{
		parent:: __construct();
        $this->module_code = 'REPORT';
        $this->load->model('CommonModel');
        $this->load->model('WardReportModel');
        if(!$this->authlibrary->IsLoggedIn()){
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
        $this->today = convertdate(date('Y-m-d'));
        $this->current_month = get_current_month();
		$this->container='main';
	}

  	public function Index()
  	{
      if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {
        $data['main_topic']         = $this->CommonModel->getData('main_topic', 'ASC');
        $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC');
        $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
        $data['date']               = $this->today;
        $data['current_month']      = $this->current_month;
        //echo $this->current_month;exit;
        $data['sampati_kar_bhumi']  = $this->WardReportModel->DailySampatiKarCollection();
        $data['page']               = 'new/index';
        $this->load->view('main', $data);
      }
  	}

    //search daily report
    public function searchDailyReport() {
      if($this->input->is_ajax_request()) {
        $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');
        $data['total'] = $this->WardReportModel->getNagadiTotal();
        $data['sampati_kar_bhumi'] = $this->WardReportModel->SearchDailySampatiKar();
        $data_view = $this->load->view('new/ajax_search_daily_report', $data, true);
        $response = array(
          'status'            => 'success',
          'data'              => $data_view
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
      }
    }

    //admin  //DAILY REPORT-------------------------------
    public function AdminDailyReport() {
       if($this->input->is_ajax_request()) {
        $date = $this->input->post('date');
        $ward = $this->input->post('ward');
        $data['session_ward'] = $ward;
        $data['date'] = $date;
        $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');
        $data['sampati_kar_bhumi'] = $this->WardReportModel->SearchDailySampatiKar();
        $data_view = $this->load->view('new/admin_daily_report', $data, true);
        $response = array(
          'status'            => 'success',
          'data'              => $data_view
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
      }
    }
    public function printDailyCollection($ward =NULL,$date =NULL) {
        // $data['ward'] = $ward;
        // $data['date'] = $date;
        $detail_date = empty( $date) ? $this->today : $date;
        $detail_ward = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;
        $data['ward_no'] = $detail_ward;
        $data['date'] = $detail_date;
        //echo $detail_ward;exit;
        $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');
        $data['sampati_kar_bhumi'] = $this->WardReportModel->SearchDailySampatiKar();
        $this->load->view('new/print_daily_collection_report', $data);
    }

    public function viewDailyCollectionDetails($ward =NULL, $date=NULL) {
        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {
            $detail_date = empty( $date) ? $this->today : $date;
            $detail_ward = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;
            $data['ward'] = $detail_ward;
            $data['date'] = $detail_date;
            $data['details'] = $this->WardReportModel->getDailyReportDetails($detail_date, $detail_ward);
            //pp($data['details']);
            $data['sampati_bhumi_kar'] = $this->WardReportModel->getDailySampatiKarDetails($detail_date, $detail_ward);
            $data['cancel_amount'] = $this->WardReportModel->getCancelAmountDetailsByDate($detail_date, $detail_ward);
            $data['sampati_cancel_amount'] = $this->WardReportModel->getCancelSampatikarAmountDetailsByDate($detail_date, $detail_ward);
            $data['page'] = 'new/daily_details';
            $this->load->view('main', $data);
        }
    }

    //view nagadi topic wise details by date
    public function viewByTopic($topic_id = NULL, $date = NULL , $ward = NULL) {
        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {
            $detail_date = empty( $date) ? $this->today : $date;
            $detail_ward = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;
            $data['ward'] = $detail_ward;
            $data['date'] = $detail_date;
            $data['title']  = $this->CommonModel->getDataById('main_topic', $topic_id);
            $data['details'] = $this->WardReportModel->getDailyReportDetails($detail_date, $detail_ward, $topic_id);
            $data['cancel_amount'] = $this->WardReportModel->getCancelAmountDetailsByDate($detail_date, $detail_ward, $topic_id);
            $data['page'] = 'new/v_mt_detail';
            $this->load->view('main', $data);
        }
    }
    public function viewSampatiKarDetails( $date=NULL, $ward = NULL) {
        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {
            $detail_date = empty( $date) ? $this->today : $date;
            $detail_ward = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;
            $data['session_ward'] = $detail_ward;
            $data['date'] = $detail_date;
            $data['sampati_bhumi_kar'] = $this->WardReportModel->getDailySampatiKarDetails($detail_date, $detail_ward);
            //pp($data['sampati_bhumi_kar']);
            $data['sampati_cancel_amount'] = $this->WardReportModel->getCancelSampatikarAmountDetailsByDate($detail_date, $detail_ward);
            $data['page'] = 'new/v_sb_detail';
            $this->load->view('main', $data);
        }
    }

    public function printDailyNagadiReport() {

    }

    public function searchMontlhyReport() {
        if($this->input->is_ajax_request()) {
            $month                      = $this->input->post('date');
            $ward_no                    = $this->input->post('ward');
            $data['month']              = $month;
            $data['ward_no']            = $ward_no;

            $data['main_topic']         = $this->CommonModel->getData('main_topic', 'ASC');
            $data['sampati_kar_bhumi']  = $this->WardReportModel->SearchDailySampatiKar();
            $data_view = $this->load->view('new/ajax_search_monthly_report', $data, true);
            $response = array(
              'status'            => 'success',
              'data'              => $data_view
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
    }

    public function viewMonthlyDetailsByTopic($topic_id =NULL, $month = NULL, $ward_no = NULL) {
        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {
            $detail_date = empty( $month) ? $current_month : $month;
            $detail_ward = empty($ward_no) ? $this->session->userdata('PRJ_USER_WARD') : $ward_no;
            $data['ward'] = $detail_ward;
            $data['month'] = $detail_date;
            $data['title']  = $this->CommonModel->getDataById('main_topic', $topic_id);
            $data['details'] = $this->WardReportModel->getMonthlyReportDetails($detail_date, $detail_ward, $topic_id);
            $data['cancel_amount'] = $this->WardReportModel->getCancelAmountDetailsByDate($detail_date, $detail_ward, $topic_id);
            $data['page'] = 'new/v_mt_monthly_detail';
            $this->load->view('main', $data);
        }
    }
    //print monthly report
    public function printMonthlyCollection($ward_no =NULL,$month = NULL)
    {
        $detail_date = empty( $month) ? $this->current_month : $month;
        $detail_ward = empty($ward_no) ? $this->session->userdata('PRJ_USER_WARD') : $ward_no;
        $data['ward_no'] = $detail_ward;
        $data['date'] = $detail_date;
       
        $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');
        $data['sampati_kar_bhumi'] = $this->WardReportModel->SearchDailySampatiKar();
        $this->load->view('new/print_monthly_collection_report', $data); 
    }

    /*-----------------------------------------------------------------------------------------
    ------------------------------------------------------------------------------------------*/
    public function searchAllReport() {
        if($this->input->is_ajax_request()) {
            $month_search = $this->input->post('month_search');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $search_ward_no = $this->input->post('search_ward_no');
            $ward_no = !empty($search_ward_no)? $search_ward_no:$this->session->userdata('PRJ_USER_ID');
            $data['ward_no'] = $ward_no;
            $data['month'] = $month_search;
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            $data['main_topic']         = $this->CommonModel->getData('main_topic', 'ASC');
            $data['sampati_kar_bhumi']  = $this->WardReportModel->SearchDailySampatiKar();
            $data_view = $this->load->view('new/ajax_search_all_report', $data, true);
            $response = array(
              'status'            => 'success',
              'data'              => $data_view
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
    }

}//end of class