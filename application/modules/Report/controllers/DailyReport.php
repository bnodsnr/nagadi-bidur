<?php

/**

* created by php strom

  Name:Binod Sunar

  Date:2018/02/01:11:14 AM.

*/

class DailyReport extends MX_Controller

{	

	public function __construct()

	{

		parent:: __construct();

      $this->module_code = 'REPORT';

      $this->load->model('CommonModel');

      $this->load->model('DailyReportModel');

      if(!$this->authlibrary->IsLoggedIn()){

        $this->session->set_userdata('return_url', current_url());

        redirect('Login');

      }

		  $this->container = 'main';

      $this->today = convertdate(date('Y-m-d'));

      $this->current_month = get_current_month();

	}



	public function Index()

	{

    if ($this->authlibrary->HasModulePermission('DAILY-REPORT', "VIEW")) {

      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));

      $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');

      $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');

      $data['date']               = $this->today;

      $data['sampati_kar_bhumi']  = $this->DailyReportModel->DailySampatiKarCollection($this->today, $this->session->userdata('PRJ_USER_WARD'));

      $data['page']               = 'daily/index';

      $this->load->view('main', $data);

    }

	}



  /**

     * This function on ajax call get all daily report.

     * @param varchar $date, int $ward

     * @return json.

    */

    public function AdminDailyReport() {

       if($this->input->is_ajax_request()) {
        $date                       = $this->input->post('date');
        $ward                       = $this->input->post('ward');
        $detail_date                = empty( $date) ? $this->today : $date;

        $detail_ward                = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

        $data['ward_no']            = $detail_ward;

        $data['date']               = $detail_date;
       
        $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));

        $data['sampati_bhumi_kar']  = $this->DailyReportModel->DailySampatiKarCollection($detail_date, $detail_ward);

        $data_view                  = $this->load->view('daily/admin_daily_report', $data, true);

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

    */

    public function viewDailyCollectionDetails($date =NULL, $ward=NULL) {

        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {

            $detail_date                    = empty( $date) ? $this->today : $date;

            $detail_ward                    = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

            $data['ward_no']                = $detail_ward;

            $data['date']                   = $detail_date;

            $data['details']                = $this->DailyReportModel->getDailyDetailsByTopic($detail_date, $detail_ward);

            $data['sampati_bhumi_kar']      = $this->DailyReportModel->getDailySampatiKarDetails($detail_date, $detail_ward);

            $data['cancel_amount']          = $this->DailyReportModel->getCancelAmountDetailsByDate($detail_date, $detail_ward);

            $data['sampati_cancel_amount']  = $this->DailyReportModel->getCancelSampatikarAmountDetailsByDate($detail_date, $detail_ward);

            $data['page']                   = 'daily/daily_collection_report';

            $this->load->view('main', $data);

        }

    }





    /**

     * This function show overall daily collection report

     * @param varchar $date, int $ward

     * @return void.

    */

    public function viewDailyNagadiCollectionByTopic($topic_id, $date =NULL, $ward=NULL) {

        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {

            $detail_date                    = empty( $date) ? $this->today : $date;

            $detail_ward                    = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

            $data['ward_no']                = $detail_ward;

            $data['date']                   = $detail_date;

            $data['details']                = $this->DailyReportModel->getDailyReportDetails($detail_date, $detail_ward);

            $data['sampati_bhumi_kar']      = $this->DailyReportModel->getDailySampatiKarDetails($detail_date, $detail_ward);

            $data['cancel_amount']          = $this->DailyReportModel->getCancelAmountDetailsByDate($detail_date, $detail_ward);

            $data['sampati_cancel_amount']  = $this->DailyReportModel->getCancelSampatikarAmountDetailsByDate($detail_date, $detail_ward);

            $data['page']                   = 'daily/daily_collection_report';

            $this->load->view('main', $data);

        }

    }



    /**

        * This function show views of nagadi billing details by main topic

        * @param int $topic_id, varchar $date, int $ward

        * @return void;

    */

    public function viewByTopic( $topic_id = NUll,$date = NULL , $ward = NULL) {

        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {

          $detail_date            = empty( $date) ? $this->today : $date;

          $detail_ward            = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

          $data['ward_no']           = $detail_ward;

          $data['date']           = $detail_date;

           $data['topic_id']       = $topic_id;

          $data['nagadi_details'] = $this->DailyReportModel->getDailyDetailsByTopic($detail_date,$detail_ward, $topic_id);

          $data['title']          = $this->CommonModel->getDataById('main_topic', $topic_id);

          $data['cancel_amount']  = $this->DailyReportModel->getCancelAmountDetailsByDate($detail_date, $detail_ward, $topic_id);

          $data['page']           = 'daily/view_by_topic';

          $this->load->view('main', $data);

        }

    }



    /**

      * This function show daily sampati kar details view

      * @param int $topic_id, varchar $date, int $ward

      * @return void;

    */

    public function viewSampatiKarDetails( $date=NULL, $ward = NULL) {

        if ($this->authlibrary->HasModulePermission('REPORT', "VIEW")) {

            $detail_date                    = empty( $date) ? $this->today : $date;

            $detail_ward                    = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

            $data['ward_no']                = $detail_ward;

            $data['date']                   = $detail_date;



            $data['sampati_bhumi_kar']      = $this->DailyReportModel->getDailySampatiKarDetails($detail_date, $detail_ward);

            $data['sampati_cancel_amount']  = $this->DailyReportModel->getCancelSampatikarAmountDetailsByDate($detail_date, $detail_ward);

            $data['page'] = 'daily/daily_sampati_details';

            $this->load->view('main', $data);

        }

    }





    /**

     * This function show daily collection print details

     * @param varchar $date, int $ward

     * @return void.

    */

    public function printDailyCollection($date =NULL,$ward =NULL) {

      $detail_date                = empty( $date) ? $this->today : $date;

      $detail_ward                = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;
      $data['ward_no']            = $detail_ward;

      $data['date']               = $detail_date;

      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));

     $data['sampati_bhumi_kar']  = $this->DailyReportModel->DailySampatiKarCollection($detail_date, $detail_ward);

        $this->load->view('daily/print_daily_details', $data);

    }



    public function printNagadiDetailsByTopic($topic_id = NUll,$date = NULL , $ward = NULL) {

       if ($this->authlibrary->HasModulePermission('DAILY-REPORT', "VIEW")) {

        $date                       = $this->input->post('date');

        $ward                       = $this->input->post('ward');

        $detail_date                = empty( $date) ? $this->today : $date;

        $detail_ward                = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

        $data['ward_no']            = $detail_ward;

        $data['date']               = $detail_date;

        $data['main_topic']         = $this->CommonModel->getData('main_topic', 'ASC');

        $data['sampati_bhumi_kar']  = $this->DailyReportModel->DailySampatiKarCollection($detail_date, $detail_ward);

          // $detail_date            = empty( $date) ? $this->today : $date;

          // $detail_ward            = empty($ward) ? $this->session->userdata('PRJ_USER_WARD') : $ward;

          // $data['topic_id']       = $topic_id;

          // $data['ward_no']           = $detail_ward;

          // $data['date']           = $detail_date;

          // $data['nagadi_details'] = $this->DailyReportModel->getDailyDetailsByTopic($detail_date,$detail_ward, $topic_id);

          // $data['title']          = $this->CommonModel->getDataById('main_topic', $topic_id);

          // $data['cancel_amount']  = $this->DailyReportModel->getCancelAmountDetailsByDate($detail_date, $detail_ward, $topic_id);

          

          $this->load->view('daily/print_daily_details', $data);

        }

    }

 

}//end of class