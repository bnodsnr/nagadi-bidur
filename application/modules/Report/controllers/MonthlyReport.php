<?php
/**
    * created by php strom
      Name:Binod Sunar
      Date:2018/02/01:11:14 AM.
*/

class MonthlyReport extends MX_Controller
{	
	public function __construct()
	{

		parent:: __construct();
        $this->module_code = 'REPORT';
        $this->load->model('CommonModel');
        $this->load->model('MonthlyReportmodel');
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

    if ($this->authlibrary->HasModulePermission('DAILY-REPORT', "VIEW")) {
      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year'=>$this->fy));
      $data['fiscal_year']         = $this->CommonModel->getData('fiscal_year', 'ASC');
      $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC',"ward");
      $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
      $data['current_month']      = $this->current_month;
      $data['sampati_kar_bhumi']  = $this->MonthlyReportmodel->MonthlySampatiKarCollection($this->current_month, $this->session->userdata('PRJ_USER_WARD'));
      $data['page']               = 'monthly/index';
      $this->load->view('main',

       $data);

    }

	}



  /**

     * This function on ajax call get all daily report.

     * @param varchar $date, int $ward

     * @return json.

    */

    public function AdminMonthlyReport() {

        if($this->input->is_ajax_request()) {

            $date                       = $this->input->post('date');
            $ward                       = $this->input->post('ward');
            $fiscal_year                = $this->input->post('fiscal_year');
            
            $detail_date                = empty( $date) ? $this->current_month : $date;
            $detail_ward                = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;
            $data['ward_no']            = $detail_ward;
            $data['current_month']      = $detail_date;
            $data['fiscal_year']        = str_replace('/', '-', $fiscal_year);
            $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year'=>$fiscal_year));
            $data['sampati_bhumi_kar']  = $this->MonthlyReportmodel->MonthlySampatiKarCollection($date, $ward,$fiscal_year);
            $data_view                  = $this->load->view('monthly/admin_daily_report', $data, true);
            $response                   = array(

              'status'                  => 'success',

              'data'                    => $data_view

            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
    }
    /**
        * This function show overall daily collection report
        * @param varchar $date, int $ward
        * @return void.
    **/

    public function viewMonthlyCollectionDetails($date =NULL, $ward=NULL) {
        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {
            $detail_date                    = empty( $date) ? $this->current_month : $date;
            $detail_ward                    = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;
            $data['ward_no']                = $detail_ward;
            $data['date']                   = $detail_date;
            $data['details']                = $this->MonthlyReportmodel->getMonthlyReportDetails($detail_date, $detail_ward);
            $data['sampati_bhumi_kar']      = $this->MonthlyReportmodel->getMonthlySampatiKarDetails($detail_date, $detail_ward);
            $data['cancel_amount']          = $this->MonthlyReportmodel->getCancelAmountDetailsByMonth($detail_date, $detail_ward);
            $data['sampati_cancel_amount']  = $this->MonthlyReportmodel->getCancelSampatikarAmountDetailsByMonth($detail_date, $detail_ward);
            $data['page']                   = 'monthly/monthly_collection_report';
            $this->load->view('main', $data);
        }

    }
     /**
        * This function show overall daily collection report
        * @param varchar $date, int $ward
        * @return void.
    **/

    public function viewMonthlyNagadiCollectionByTopic($topic_id, $date =NULL, $ward=NULL) {

        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {

            // $detail_date                    = empty( $date) ? $this->today : $date;

            // $detail_ward                    = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

            // $data['ward_no']                = $detail_ward;

            // $data['date']                   = $detail_date;

            // $data['details']                = $this->MonthlyReportmodel->getDailyReportDetails($detail_date, $detail_ward);

            // $data['sampati_bhumi_kar']      = $this->MonthlyReportmodel->getDailySampatiKarDetails($detail_date, $detail_ward);

            // $data['cancel_amount']          = $this->MonthlyReportmodel->getCancelAmountDetailsByDate($detail_date, $detail_ward);

            // $data['sampati_cancel_amount']  = $this->MonthlyReportmodel->getCancelSampatikarAmountDetailsByDate($detail_date, $detail_ward);

            // $data['page']                   = 'daily/daily_collection_report';

            // $this->load->view('main', $data);

        }

    }



    /**

        * This function show views of nagadi billing details by main topic

        * @param int $topic_id, varchar $date, int $ward

        * @return void;

    */

    public function viewByTopic( $topic_id = NUll, $date = NULL , $ward = NULL, $fiscal_year=NULL) {

        if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
            $detail_date            = empty( $date) ? $this->current_month : $date;

            $detail_ward            = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

          $data['ward_no']           = $detail_ward;

          $data['date']           = $detail_date;

           $data['topic_id']       = $topic_id;
            $data['fiscal_year']        = str_replace('-', '/', $fiscal_year);
          $data['nagadi_details'] = $this->MonthlyReportmodel->getMonthlyReportDetails($detail_date, $detail_ward, $topic_id, $fiscal_year);

          $data['title']          = $this->CommonModel->getDataById('main_topic', $topic_id);

          $data['cancel_amount']  = $this->MonthlyReportmodel->getCancelAmountDetailsByMonth($detail_date, $detail_ward, $topic_id);

          $data['page']           = 'monthly/view_by_topic';

          $this->load->view('main', $data);

        } else {
            exit('no permission set');
        }

    }



    /**

      * This function show daily sampati kar details view

      * @param int $topic_id, varchar $date, int $ward

      * @return void;

    */

    public function viewSampatiKarDetails( $date=NULL, $ward = NULL,$fiscal_year) {

        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {

            $detail_date                    = empty( $date) ? $this->current_month : $date;

            $detail_ward                    = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

            $data['ward_no']                = $detail_ward;

            $data['date']                   = $detail_date;
            $data['fiscal_year']            = str_replace('/', '-', $fiscal_year);
            $data['sampati_bhumi_kar']      = $this->MonthlyReportmodel->MonthlySampatiKarCollection($detail_date, $detail_ward);

            $data['sampati_cancel_amount']  = $this->MonthlyReportmodel->getCancelSampatikarAmountDetailsByMonth($detail_date, $detail_ward);

            $data['page'] = 'monthly/monthly_sampati_details';

            $this->load->view('main', $data);

        }

    }





    /**

     * This function show daily collection print details

     * @param varchar $date, int $ward

     * @return void.

    */

    public function printMonthlyCollection($date =NULL,$ward =NULL) {

      $detail_date                = empty( $date) ? $this->current_month : $date;

      $detail_ward                = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

      // pp($detail_ward );

      $data['ward_no']            = $detail_ward;

      $data['date']               = $detail_date;

      $data['main_topic']         = $this->CommonModel->getData('main_topic', 'ASC');

     $data['sampati_bhumi_kar']   = $this->MonthlyReportmodel->MonthlySampatiKarCollection($detail_date, $detail_ward);

        $this->load->view('monthly/print_monthly_collection', $data);

    }



    public function printNagadiDetailsByTopic($topic_id = NUll,$date = NULL , $ward = NULL) {

       if ($this->authlibrary->HasModulePermission('DAILY-REPORT', "VIEW")) {

          $detail_date            = empty( $date) ? $this->current_month : $date;

          $detail_ward            = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

          $data['topic_id']       = $topic_id;

          $data['ward_no']           = $detail_ward;

          $data['date']           = $detail_date;

          $data['nagadi_details'] = $this->MonthlyReportmodel->getMonthlyReportDetails($detail_date,$detail_ward, $topic_id);
         // pp($data['nagadi_details']);
          $data['main_topic']          = $this->CommonModel->getDataById('main_topic', $topic_id);

         // $data['cancel_amount']  = $this->MonthlyReportmodel->getCancelAmountDetailsByDate($detail_date, $detail_ward, $topic_id);

          

          $this->load->view('monthly/print_monthly_details_by_topic', $data);

        }

    }



  public function printCollectionReport($date =NULL, $ward_no =NULL){

    if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {

      $detail_date                    = empty( $date) ? $this->current_month : $date;

      $detail_ward                    = empty($ward_no) ? $this->session->userdata('PRJ_USER_WARD') : $ward_no;

      $data['ward_no']                = $detail_ward;

      $data['date']                   = $detail_date;

      $data['details']                = $this->MonthlyReportmodel->getMonthlyReportDetails($detail_date, $detail_ward);

      $data['sampati_bhumi_kar']      = $this->MonthlyReportmodel->getMonthlySampatiKarDetails($detail_date, $detail_ward);

      $data['cancel_amount']          = $this->MonthlyReportmodel->getCancelAmountDetailsByMonth($detail_date, $detail_ward);

      $data['sampati_cancel_amount']  = $this->MonthlyReportmodel->getCancelSampatikarAmountDetailsByMonth($detail_date, $detail_ward);

      $data['page']                   = '';

      $this->load->view('monthly/print_collection_report', $data);

    }

  }



  /*---------------------------------------------------------------------------

  ----------------------------------------------------------------------------*/

 

}//end of class