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

       ** This function list all the land minimun rate

       ** @param 

       ** @return array of all land_minimum rate

    */

    public function Index()

    {

        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page']                       = 'list_report';
            $data['fiscal_year']                = $this->CommonModel->getData('fiscal_year','DESC');
            $data['main_topic']                 = $this->RajasowTitleWiseModel->getTitles();
            $data['aanumanit_sampatikar']       = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11313);
            $data['aanumanit_bhumikar']         = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11314);
            $data['wards']                      = $this->CommonModel->getData('wardwise_address','ASC','ward');
            $data['sampati_kar']            = $this->RajasowTitleWiseModel->getSampatiKarCurrentMonth();
            $data['sampati_kar_lastmonth']  = $this->RajasowTitleWiseModel->getSampatiKarCurrentUptoLastMonth();
            $data['bhumi_kar']              = $this->RajasowTitleWiseModel->getBhumiKarCurrentMonth();
            $data['bhumi_kar_lastmonth']    = $this->RajasowTitleWiseModel->getBhumiKaruptoLastMonth();
            $arr                            = array();
            foreach ($data['main_topic'] as $key => $item) {
                
                
                //get other topic id
                $current_month_otherdata         = $this->RajasowTitleWiseModel->getOtherTitleCurrentMonth($item['topic_id']);
                $upto_last_othermonth            = $this->RajasowTitleWiseModel->getSubByTopicNoUptoLastMonthOtherTopic($item['topic_id']);
                
                $current_month_data              = $this->RajasowTitleWiseModel->getSubByTopicNo($item['topic_id']);
                //pp($current_month_otherdata);
                $upto_last_month                 = $this->RajasowTitleWiseModel->getSubByTopicNoUptoLastMonth($item['topic_id']);
                $arr[]                           = array(
                    'topic_no'                   => $item['topic_id'],
                    'topic_name'                 => $item['topic_name'],
                    'ass_amount'                 => $item['annual_income'],
                    
                    'current_month_data'         => $current_month_data['total'] + $current_month_otherdata['total'],
                    'upto_last_month'            => $upto_last_month['total'] + $upto_last_othermonth['total']
                );
            }
            // $groups = array();
            // foreach ($data['main_topic'] as $item) {
            //     $key = $item['topic_no'];
            //     if (!array_key_exists($key, $groups)) {
            //         $groups[$key] = array(
            //             'id'    => $item['evaluation_category_id'],
            //             'score' => $item['score'],
            //             'itemMaxPoint' => $item['itemMaxPoint'],
            //         );
            //     } else {
            //         $groups[$key]['score'] = $groups[$key]['score'] + $item['score'];
            //         $groups[$key]['itemMaxPoint'] = $groups[$key]['itemMaxPoint'] + $item['itemMaxPoint'];
            //     }
            // }
            // return $groups;


            $data['report'] = $arr;
            //pp($data['report']);

            $this->load->view('main', $data);

        } else {

            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');

            redirect('Dashboard');

        }

    }



    public function printReport() {

        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){

            $data['page']                   = 'list_report';

            $data['fiscal_year']            = $this->CommonModel->getData('fiscal_year','DESC');

            $data['main_topic']             = $this->RajasowTitleWiseModel->getTitles();

            $data['aanumanit_sampatikar']   = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11313);

            $data['aanumanit_bhumikar']     = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11314);

            $data['wards']                  = $this->CommonModel->getData('wardwise_address','ASC','ward');

            $data['sampati_kar']            = $this->RajasowTitleWiseModel->getSampatiKarCurrentMonth();

            $data['sampati_kar_lastmonth']  = $this->RajasowTitleWiseModel->getSampatiKarCurrentUptoLastMonth();

            $data['bhumi_kar']              = $this->RajasowTitleWiseModel->getBhumiKarCurrentMonth();

            $data['bhumi_kar_lastmonth']    = $this->RajasowTitleWiseModel->getBhumiKaruptoLastMonth();

            $arr                            = array();

           foreach ($data['main_topic'] as $key => $item) {

                $current_month_otherdata         = $this->RajasowTitleWiseModel->getCurrentMonthOtherTopic($item['topic_id']);

                $upto_last_othermonth            = $this->RajasowTitleWiseModel->getSubByTopicNoUptoLastMonthOtherTopic($item['topic_id']);



                $current_month_data         = $this->RajasowTitleWiseModel->getSubByTopicNo($item['topic_id']);

                $upto_last_month            = $this->RajasowTitleWiseModel->getSubByTopicNoUptoLastMonth($item['topic_id']);

                $arr[]                      = array(

                    'topic_no'                      => $item['topic_id'],

                    'topic_name'                    => $item['topic_name'],

                    'ass_amount'                    => $item['annual_income'],

                    'current_month_data'            => $current_month_data['total'] + $current_month_otherdata['total'],

                    'upto_last_month'               => $upto_last_month['total'] + $upto_last_othermonth['total'],

                );

            }

            $data['report'] = $arr;



            $this->load->view('print_report', $data);

        } else {

            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');

            redirect('Dashboard');

        }

    }

    //search

    public function Search() {

        if($this->input->is_ajax_request()) {

            $ward                           = $this->input->post('ward');

            $month                          = $this->input->post('month');

            $data['month']                  = !empty($month)?$month:'-';

            $data['ward']                   = !empty($ward)?$ward:'-';
           // pp($data['month']);

            $data['fiscal_year']            = $this->CommonModel->getData('fiscal_year','DESC');

            $data['main_topic']             = $this->RajasowTitleWiseModel->getTitles();

            $data['aanumanit_sampatikar']   = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11313);

            $data['aanumanit_bhumikar']     = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11314);

            $data['wards']                  = $this->CommonModel->getData('wardwise_address','ASC','ward');

            $data['sampati_kar']            = $this->RajasowTitleWiseModel->getSearchSampatiKarCurrentMonth($data['ward'], $data['month']);

            $data['sampati_kar_lastmonth']  = $this->RajasowTitleWiseModel->getSearchSampatiKarCurrentUptoLastMonth($data['ward'], $data['month']);
           // pp($data['sampati_kar_lastmonth']);

            $data['bhumi_kar']              = $this->RajasowTitleWiseModel->getSearchBhumiKarCurrentMonth($data['ward'], $data['month']);

            $data['bhumi_kar_lastmonth']    = $this->RajasowTitleWiseModel->getSearchBhumiKaruptoLastMonth($data['ward'], $data['month']);
           // pp($data['bhumi_kar_lastmonth']);
            $arr                            = array();
           // $sum_current_month = 0;

            foreach ($data['main_topic'] as $key => $item) {



                $current_month_otherdata         = $this->RajasowTitleWiseModel->getCurrentMonthSearchOtherTopic($item['topic_id'] ,$data['ward'], $data['month']);

                $upto_last_othermonth            = $this->RajasowTitleWiseModel->getSubByTopicNoUptoLastMonthSearchOtherTopic($item['topic_id'] ,$data['ward'], $data['month']);
                // echo "<pre>";
                // print_r($current_month_otherdata);


                $current_month_data         = $this->RajasowTitleWiseModel->getSearchSubByTopicNo($item['topic_id'],$data['ward'], $data['month']);
                // echo "<pre>";
                // print_r($current_month_data);
                $upto_last_month            = $this->RajasowTitleWiseModel->getSearchSubByTopicNoUptoLastMonth($item['topic_id'],$data['ward'], $data['month']);
               // $sum_current_month += $current_month_data['total'];

               $arr[]                      = array(

                    'topic_no'                      => $item['topic_id'],

                    'topic_name'                    => $item['topic_name'],

                    'ass_amount'                    => $item['annual_income'],

                    'current_month_data'            => $current_month_data['total'] + $current_month_otherdata['total'],

                    'other_topic_total_current'     => $current_month_otherdata['total'],

                    'upto_last_othermonth'          => $upto_last_othermonth['total'],

                    'upto_last_month'               => $upto_last_month['total'] + $upto_last_othermonth['total'],
                    //'sum_current_month'             => $sum_current_month,

                );

            }
           // pp($sum_current_month);
            $data['report'] = $arr;
            //pp($data['report']);

            $data_view                  = $this->load->view('ajax_view', $data, true);

            $response = array(

                'status'          => 'success',

                'data'            => $data_view,

               

            );

            header("Content-type: application/json");

            echo json_encode($response);

            exit;

            

        } else {

            exit('no direct script allowed');

        }

    }



    public function printSearch() {

        $ward                           = $this->uri->segment(3);

        $month                          = $this->uri->segment(4);

        $data['month']                  = !empty($month)?$month:'-';

        $data['ward']                   = !empty($ward)?$ward:'-';

        $data['search_month']          = $month;

        $data['fiscal_year']            = $this->CommonModel->getData('fiscal_year','DESC');

        $data['main_topic']             = $this->RajasowTitleWiseModel->getTitles();

        $data['aanumanit_sampatikar']   = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11313);

        $data['aanumanit_bhumikar']     = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',11314);

        $data['wards']                  = $this->CommonModel->getData('wardwise_address','ASC','ward');

        $data['sampati_kar']            = $this->RajasowTitleWiseModel->getSearchSampatiKarCurrentMonth($data['ward'], $data['month']);

        $data['sampati_kar_lastmonth']  = $this->RajasowTitleWiseModel->getSearchSampatiKarCurrentUptoLastMonth($data['ward'], $data['month']);

        $data['bhumi_kar']              = $this->RajasowTitleWiseModel->getSearchBhumiKarCurrentMonth($data['ward'], $data['month']);

        $data['bhumi_kar_lastmonth']    = $this->RajasowTitleWiseModel->getSearchBhumiKaruptoLastMonth($data['ward'], $data['month']);

        $arr                            = array();

        foreach ($data['main_topic'] as $key => $item) {



            $current_month_otherdata         = $this->RajasowTitleWiseModel->getCurrentMonthSearchOtherTopic($item['topic_id'] ,$data['ward'], $data['month']);

            $upto_last_othermonth            = $this->RajasowTitleWiseModel->getSubByTopicNoUptoLastMonthSearchOtherTopic($item['topic_id'] ,$data['ward'], $data['month']);



            $current_month_data         = $this->RajasowTitleWiseModel->getSearchSubByTopicNo($item['topic_id'],$data['ward'], $data['month']);

            $upto_last_month            = $this->RajasowTitleWiseModel->getSearchSubByTopicNoUptoLastMonth($item['topic_id'],$data['ward'], $data['month']);

            $arr[]                      = array(

                    'topic_no'                      => $item['topic_id'],

                    'topic_name'                    => $item['topic_name'],

                    'ass_amount'                    => $item['annual_income'],

                    'current_month_data'            => $current_month_data['total'] + $current_month_otherdata['total'],

                    //'other_topic_total'             => $current_month_otherdata['total'],

                    //'upto_last_othermonth'          => $upto_last_othermonth['total'],

                    'upto_last_month'               => $upto_last_month['total'] + $upto_last_othermonth['total'],

                );

        }

        $data['report'] = $arr;

        $this->load->view('print_report', $data);

    }

}