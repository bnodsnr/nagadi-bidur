<?php
/**
  *created by php strom
  *Name:Binod Sunar
*/
class MonthlyReport extends MX_Controller
{	
	public function __construct()
	{
		parent:: __construct();
    $this->module_code = 'REPORT';
    $this->load->model('CommonModel');
    $this->load->model('MonthlyReportMDL');
    if(!$this->authlibrary->IsLoggedIn()){
      $this->session->set_userdata('return_url', current_url());
      redirect('Login');
    }
		$this->container = 'main';
    $this->today = convertdate(date('Y-m-d'));
    $this->current_month = get_current_month();
    $this->fy = current_fiscal_year();
	}
	public function Index()
	{
        if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
          $data['current_month']      = $this->current_month;
          $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
          $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC',"ward");
          $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
          $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
          $data['sampati_kar']        = $this->MonthlyReportMDL->SampatiKarMonthly();
          $data['bhumi_kar']          = $this->MonthlyReportMDL->BhumiKarMonthly();
          $data['page']               = 'index';
          $this->load->view('main',$data);
        }
	}

    public function printMonthlyReport() {
        if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
          $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
          $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC',"ward");
          $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
          $data['current_month']      = $this->current_month;
          $data['sampati_kar']        = $this->MonthlyReportMDL->SampatiKarMonthly();
          $data['bhumi_kar']          = $this->MonthlyReportMDL->BhumiKarMonthly();
          $this->load->view('print_monthly_details',$data);
        }
    }

    //bills view for monthly report
    public function viewOverAllDetails() {
        if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
          $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
          $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC',"ward");
          $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
          $data['current_month']      = $this->current_month;
          $data['nagadibilldetials']  = $this->MonthlyReportMDL->getNagadiBillDetails();
          $data['sampatikardetails']  = $this->MonthlyReportMDL->getSearchSampatiKarDetails();
          $this->load->view('view_billdetails',$data);
        }
    }

  public function viewMonthlyNagadiDetails($topic_id) {
    if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
      $data['main_topic']         = $this->CommonModel->getWhere('main_topic', array('id' => $topic_id));
      $data['nagadibilldetails']  = $this->MonthlyReportMDL->getNagadiBillDetailsByTopic($topic_id);
      $data['cancel_amount']      = $this->MonthlyReportMDL->getNagadiBillDetailsCancelByTopic($topic_id);
      $this->load->view('view_nagadibilldetailsbytopic',$data);
    }
  }
  
    public function viewMonthlyNagadiDetailsSearch($topic_id,$from_date,$to_date,$ward_no,$fiscal_year) {
        if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
            $data['main_topic']         = $this->CommonModel->getWhere('main_topic', array('id' => $topic_id));
            $fy                         = str_replace('-', '/', $fiscal_year);
            $data['nagadibilldetails']  = $this->MonthlyReportMDL->getNagadiBillDetailsBySearch($topic_id,$from_date,$to_date,$ward_no,$fy);
            $data['cancel_amount']      = $this->MonthlyReportMDL->getNagadiCancelBillDetailsBySearch($topic_id,$from_date,$to_date,$ward_no,$fy);
            $this->load->view('view_nagadibilldetailsbytopic',$data);
        }
    }
    
    //get sampati billing details by month
    public function MonthlySampatiBhumiKarDetailsbyMonth() {
        $data['current_month']      = $this->current_month;
        $data['sampati_bhumi_kar']  = $this->MonthlyReportMDL->getSearchSampatiKarDetailsByMonth();
        $data['cancelamount']       = $this->MonthlyReportMDL->getCancelSampatikarAmountDetails();
        $this->load->view('monthly_sampati_details', $data);
    }
    
    public function MonthlySampatiBhumiKarDetailSearch($from_date,$to_date,$ward_no,$fiscal_year) {
        $fy        = str_replace('-', '/', $fiscal_year);
        $data['sampati_bhumi_kar']  = $this->MonthlyReportMDL->getSearchSampatiKarDetailsBySearch($from_date,$to_date,$ward_no,$fy);
        $data['cancelamount']       = $this->MonthlyReportMDL->getCancelSampatikarAmountDetailsBySearch($from_date,$to_date,$ward_no,$fy);
        $this->load->view('monthly_sampati_details', $data);
    }
    //------------------------------------------------------------------------------------------------------------------------
    /**
        * This function on ajax call get all MONTHLY report.
        * @param varchar $date, int $ward
        * @return json.
    */
    //--------------------------------------
    public function AdminMonthlyReport() {
        if($this->input->is_ajax_request()) {
          $from_date                  = $this->input->post('from_date');
          $to_date                    = $this->input->post('to_date');
          $ward                       = $this->input->post('ward');
          $fiscal_year                = $this->input->post('fiscal_year');
          $data['ward_no']            = !empty($ward)?$ward:'-';
          $data['from_date']          = !empty($from_date)?$from_date:'-';
          $data['to_date']            = !empty($to_date)?$to_date:'-';
          $data['fiscal_year']        = str_replace('/', '-', $fiscal_year);
          $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fiscal_year));
          $data['sampati_kar']        = $this->MonthlyReportMDL->SearchSampatiKarMonthly($data['ward_no'],$data['from_date'],$data['to_date'],$fiscal_year);
          $data['bhumi_kar']          = $this->MonthlyReportMDL->SearchBhumikarKarMonthly($data['ward_no'],$data['from_date'],$data['to_date'], $fiscal_year);
          $data_view                  = $this->load->view('admin_monthly_report', $data, true);
          $response                   = array(
            'status'                  => 'success',
            'data'                    => $data_view
          );
          header("Content-type: application/json");
          echo json_encode($response);
          exit;
        }
    }
    //-------------------------------------------------------
        //print by search
    //--------------------------------------------------------
    public function printSearchMonthlyReport() {
    $from_date                  = $this->uri->segment(3);
    $to_date                    = $this->uri->segment(4);
    $ward                       = $this->uri->segment(5);
    $data['ward_no']            = !empty($ward)?$ward:'-';
    $data['from_date']          = !empty($from_date)?$from_date:'-';
    $data['to_date']            = !empty($to_date)?$to_date:'00';
    $data['fiscal_year']        = $this->uri->segment(6);
    $fiscal_year                = str_replace('-','/',$data['fiscal_year']);
    $data['main_topic']         = $this->CommonModel->getData('main_topic', 'ASC','topic_no');
    $data['sampati_kar']        = $this->MonthlyReportMDL->SearchSampatiKarMonthly($ward,$from_date,$to_date, $fiscal_year);
    $data['bhumi_kar']          = $this->MonthlyReportMDL->SearchBhumikarKarMonthly($ward,$from_date,$to_date, $fiscal_year);
    $this->load->view('print_search_report', $data);   
  }

    public function viewOverAllDetailsBySearch() {
    if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
      $from_date                  = $this->uri->segment(4);
      $to_date                    = $this->uri->segment(5);
      $ward                       = $this->uri->segment(3);
      $data['ward_no']            = !empty($ward)?$ward:'-';
      $data['from_date']          = !empty($from_date)?$from_date:'-';
      $data['to_date']            = !empty($to_date)?$to_date:'00';
      $data['fiscal_year']        = $this->uri->segment(6);
      $fiscal_year                = str_replace('-','/',$data['fiscal_year']);
      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
      $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC',"ward");
      $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
      $data['current_month']      = $this->current_month;
      $data['nagadibilldetials']  = $this->MonthlyReportMDL->getNagadiBillDetailsBySearch($from_date,$to_date,$ward,$fiscal_year);
      $data['sampatikardetails']  = $this->MonthlyReportMDL->getSearchSampatiKarDetailsBySearch($from_date,$to_date,$ward,$fiscal_year);
      $this->load->view('view_billdetails',$data);
    }
  }
  
}//end of class