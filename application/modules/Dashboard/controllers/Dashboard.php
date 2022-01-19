<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends MX_Controller

{	

	public function __construct()

	{

		parent:: __construct();

        $this->load->model('DashboardModel');
        $this->load->model('CommonModel');
        if(!$this->authlibrary->IsLoggedIn()){

            $this->session->set_userdata('return_url', current_url());

            //$this->session->set_flashdata("AUTH_ACCESS", "Your Are Not Logged in Please Login First !!");

            redirect('Login');

        }

		$this->container='main';

        //$this->load->model("DashboardMode");

	}



	public function Index()

	{
        if($this->session->userdata('PRJ_USER_ID') == 1){

            $data['page'] = 'dashboard';

        } elseif($this->session->userdata('PRJ_USER_WARD') == 0 ) {
            $data['page'] = 'dashboard';
        } else {

            $data['page'] = 'user_dashboard';

        }

        $data['title'] = '';

        $data['pagetitle'] = '';

        $ndata =[];

        $sbdata = [];

        $ldata = [];

        $sldata =[];
        $spdata = [];

        $current_date = convertDate(date('Y-m-d'));

        $month = (explode("-",$current_date));

        $current_month = $month[1];
        $data['totalProfile'] = $this->DashboardModel->getTotalProfile();
        $data['totalSampatiBhumiKar'] = $this->DashboardModel->getTotalSampatiBhumiKar();
        $data['totalNagadi'] = $this->DashboardModel->getNagadiTotal();
      
        $data['gTotalNagadi'] = $this->DashboardModel->getWardWiseNagadiCollection();
        $data['gTotalBhumiSampati'] = $this->DashboardModel->getSsamptiBhumiKarCollection();
        $data['sgTotalBhumiSampati'] = $this->DashboardModel->getSsamptiBhumiKarCollection();
        $data['dailyNagadiCollection'] = $this->DashboardModel->getDailyNagadiCollection();
        $data['dailySampatiKar'] = $this->DashboardModel->getDailySampatiBhumiKarCollection();
        $data['monthlyNagadi'] = $this->DashboardModel->getMonthlyNagadiWardCollection();
        $data['monthlySampatiKar'] = $this->DashboardModel->getMonthlySampatiBhumiKarWardCollection();
        $data['TotalPaidProfile'] = $this->DashboardModel->getTotalPaidProfile();
        $data['TotalUnPaidProfile'] = $this->DashboardModel->getTotalUnPaidProfile();
        $data['labels'] = $this->DashboardModel->getNagadiWard();

        $data['swards'] = $this->DashboardModel->getsampatiWard();
       // pp($data['swards']);
        if(!empty($data['labels'])) {

            foreach ($data['labels'] as $value) {

                if($value->added_ward == 0){

                    $ldata['ldata'][] = "नगरपालिक";

                }

                if($value->added_ward == 1){

                    $ldata['ldata'][] = "वडा १ ";

                }

                if($value->added_ward == 2){

                    $ldata['ldata'][] = "वडा २";

                }

                if($value->added_ward == 3){

                    $ldata['ldata'][] = "वडा ३";

                }

                if($value->added_ward == 4){

                    $ldata['ldata'][] = "वडा ४";

                }

                if($value->added_ward == 5){

                    $ldata['ldata'][] = "वडा ५";

                }

                if($value->added_ward == 6){

                    $ldata['ldata'][] = "वडा ६";

                }

                if($value->added_ward == 7){

                    $ldata['ldata'][] = "वडा ७";

                }

                if($value->added_ward == 8){

                    $ldata['ldata'][] = "वडा ८";

                }

                if($value->added_ward == 9){

                    $ldata['ldata'][] = "वडा ९";

                }

                if($value->added_ward == 10){

                    $ldata['ldata'][] = "वडा १०";

                }

                if($value->added_ward == 11){

                    $ldata['ldata'][] = "वडा ११";

                }

                if($value->added_ward == 12){

                    $ldata['ldata'][] = "वडा १२";

                }

                if($value->added_ward == 13){

                    $ldata['ldata'][] = "वडा १३";

                }

            }

        }

        // pp($ldata);

        if(!empty($data['swards'])) {

            foreach ($data['swards'] as $svalue) {

                if($svalue->added_ward == 0){

                    $sldata['sldata'][] = "नगरपालिक";

                }

                if($svalue->added_ward == 1){

                    $sldata['sldata'][] = "वडा १ ";

                }

                if($svalue->added_ward == 2){

                    $sldata['sldata'][] = "वडा २";

                }

                if($svalue->added_ward == 3){

                    $sldata['sldata'][] = "वडा ३";

                }

                if($svalue->added_ward == 4){

                    $sldata['sldata'][] = "वडा ४";

                }

                if($svalue->added_ward == 5){

                    $sldata['sldata'][] = "वडा ५";

                }

                if($svalue->added_ward == 6){

                    $sldata['sldata'][] = "वडा ६";

                }

                if($svalue->added_ward == 7){

                    $sldata['sldata'][] = "वडा ७";

                }

                if($svalue->added_ward == 8){

                    $sldata['sldata'][] = "वडा ८";

                }

                if($svalue->added_ward == 9){

                    $sldata['sldata'][] = "वडा ९";

                }

                if($svalue->added_ward == 10){

                    $sldata['sldata'][] = "वडा १०";

                }

                if($svalue->added_ward == 11){

                    $sldata['sldata'][] = "वडा ११";

                }

                if($svalue->added_ward == 12){

                    $sldata['sldata'][] = "वडा १२";

                }

                if($svalue->added_ward == 13){

                    $sldata['sldata'][] = "वडा १३";

                }

            }

        }

        $data['ladata'] = json_encode($ldata);

        $data['slabel'] = json_encode($sldata);

        foreach($data['gTotalNagadi'] as $row) {

            $ndata['data'][] = (int) !empty($row->total_nagadi)?round($row->total_nagadi):0;

        }
        // pp($ndata);
          // array_unshift($data['gTotalBhumiSampati'],"0");
        $data['chart_data'] = json_encode($ndata);

       
        $z = [
            'total' => '0',
        ];
        array_unshift($data['gTotalBhumiSampati'],$z);
        foreach($data['gTotalBhumiSampati'] as $srow) {
            $sbdata['sbdata'][] = (int) !empty($srow->total)?$srow->total:0;

        }
        array_unshift($sbdata,"0");
        $data['nchart_data'] = json_encode($sbdata);

        foreach($data['sgTotalBhumiSampati'] as $sgrow) {
            $spdata['spdata'][] = (int) !empty($sgrow->total)?$sgrow->total:0;
        }
       
        $data['snpchart_data'] = json_encode($spdata);
        $data['today_sampati_bhumi_collection'] = $this->DashboardModel->getTodaysSsamptiBhumiKarCollection();
        $data['today_nagadi_collection'] = $this->DashboardModel->getTodayNagadiCollection();
        $data['monthly_sampati_bhumi_collection'] = $this->DashboardModel->getMonthlySamptiBhumiKarCollection($current_month);
        $data['monthly_nagadi_collection'] = $this->DashboardModel->getMonthlyNagadiCollection($current_month);
        $data['total_kar_paid_proile'] = 0;
        $data['wards']                  = $this->DashboardModel->getWards();
        $bank_dakhila = array();
        if(!empty($data['wards'])) {
            foreach ($data['wards'] as $key => $ward) {
                $total_deposit          = $this->DashboardModel->getTotalDeposit($ward['ward']);
                $total_collection       = $this->DashboardModel->getTotalNagadiCollection($ward['ward']);
                $total_sampati_kar      = $this->DashboardModel->getTotalSampatiCollection($ward['ward']);
                $grand_total            = $total_sampati_kar['total_sampati'] + $total_collection['total_collection'];
                $due_amount             = $grand_total - $total_deposit['total_deposit'];

                $bank_dakhila[]         = array(
                    'ward'              => $ward['ward'],
                    'deposit_amount'    => $total_deposit['total_deposit'],
                    'total_collection'  => $grand_total,
                    'due_amount'        => !empty($due_amount)?$due_amount:$grand_total,
                    'total_nagadi'      => $total_collection['total_collection'],
                    'total_sampati_kar' => $total_sampati_kar['total_sampati'],
                );
            }
        }
        //pp($bank_dakhila);
        $data['bankDetails'] = $bank_dakhila;
        $this->load->view('main', $data);

	}



    /*

     * this function create database backup

     * @ param NULL

     * @ copy db

    */

    public function dbbackup(){

        $this->load->dbutil();

        $config = array(     

            'format'      => 'zip',             

            'filename'    => 'db_nagadi.sql'

        );

        $backup =  $this->dbutil->backup($config);

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';

        $save = FCPATH.'assets/dbbackup/'.$db_name;

        $this->load->helper('file');

        write_file($save, $backup); 

        // $this->load->helper('download');

        // force_download($db_name, $backup);

    }
    
    public function updateTopicnumber() {
        
        $updata = $this->CommonModel->getAllDataByField('topic', 'fiscal_year', '2077/078');
       // pp($updata);
        $data = array();
        if(!empty($updata)) {
            foreach ($updata as $key => $value) {
                $data = array(
                    'topic_no' => $value['topic_no']
                );
                $this->CommonModel->updateDataByField('topic', 'sub_topic',$value['sub_topic'], $data);
            }
            //pp($data);
            // $result = $this->db->insert_batch('sub_topic', $data);
            // if($result) {
            //     $this->session->set_flashdata('MSG_SUCCESS', 'Successfully update');
            //     redirect('Dashboard/updateSetting');
            // }
        }
    }

}