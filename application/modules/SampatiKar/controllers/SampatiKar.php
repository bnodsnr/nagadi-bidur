<?php

class SampatiKar extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("SampatiModel");
        $this->module_code = 'SAMPATI-KAR';
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
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'tripura/list_all';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['land_area_type'] = $this->CommonModel->getData('settings_land_area_type','DESC');
             $data['land_category'] = $this->CommonModel->getData('land_category', 'DESC');
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function Add() {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $id = $this->uri->segment(3);
            $data['page'] = 'tripura/add';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['sanrachana_ko_kisim'] = $this->CommonModel->getData('settings_architect_structure','DESC');
            if(!empty($id)) {
                $data['row'] = $this->CommonModel->getDataByID('sampati_kar_rate',$id);
            }
             $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function Save() {

        if($this->input->is_ajax_request()) {

            $id                 = $this->input->post('id');
            $sampati_type       = $this->input->post('sampati_type');
            $from               = $this->input->post('from');
            $to                 = $this->input->post('to');
            $unit               = $this->input->post('unit');
            $amount             = $this->input->post('amount');
            $is_percent         = $this->input->post('is_percent');
            $fiscal_year        = $this->input->post('fiscal_year'); 
            $this->form_validation->set_rules('fiscal_year', 'आर्थिक वर्ष', 'required');
            //if(MODULE ! = 2 )
            //$this->form_validation->set_rules('sampati_type', 'जग्गाको क्षेत्रगत किसिम', 'required');
            //$this->form_validation->set_rules('from', 'अधिक्कतम मुल्य', array('trim','required','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));
            //$this->form_validation->set_rules('to', 'अधिक्कतम मुल्य', array('trim','required','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));
            //$this->form_validation->set_rules('unit',   'वार्ड', 'required');
            $this->form_validation->set_rules('amount', 'अधिक्कतम मुल्य', array('trim','required','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));
           
            if($this->form_validation->run() == false) {
                $response = array(
                    'status'      => 'validation_error',
                    'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            $post_data = array(
                'type'    => $sampati_type,
                'from_rate'     => !empty($from)?$from:0,
                'to_rate'              => !empty($to)?$to:0,
                'unit'              => !empty($unit)?$unit:0,
                'fiscal_year'       => !empty($fiscal_year)?$fiscal_year:0,
                'amount'            => !empty($amount)?$amount:0,
                'is_percent'        => !empty($is_percent)?$is_percent:0,
                'added_by'          => $this->session->userdata('PRJ_USER_ID'),
                'added_on'          => convertDate(date('Y-m-d'))
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('sampati_kar_rate',$post_data);
                if($result) {
                    $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                        // 'message'     => 'redirect',
                        // 'redirect_url'       => base_url().'Road',
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                }   
            } else {
                 $result = $this->CommonModel->UpdateData('sampati_kar_rate',$id, $post_data);
                if($result) {
                    $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                        'message'     => 'success'
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                }   
            }
           
        } else {
            exit('no direct script allowed');
        }
    }

    /**
        * This function delete data the id.
        * check proper id is in format of not.
        * @param $id int pk
        * @return json.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $result = $this->CommonModel->remove($id,'bhumikar');
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक हटाइयो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } else {
                $response = array(
                    'status'      => 'error',
                    'data'         => "Oops something goes worng!!! Please try again",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
        } else {
            exit('no direct script allowed!!!');
        }
    }
    // public function importRoadName() {
    //     $this->load->view('import');
    // }
    // public function importData() {
    //      $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //   if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $file_mimes)) {
    //       $arr_file = explode('.', $_FILES['userfile']['name']);
    //       $extension = end($arr_file);
    //       if('csv' == $extension) {
    //           $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    //       } else {
    //           $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //       }
    //       $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
    //       $sheetData = $spreadsheet->getActiveSheet()->toArray();
    //       foreach ($sheetData as $key => $value) {
    //         $data[] =array(
    //             'road_name'  => $value[1],
    //             'road_type'  => $value[2],
    //             'tole'       => '',
    //             'ward'       => $value[3],
    //             'fiscal_year' => $value[4],
    //         );
    //       }
    //       $this->db->insert_batch('settings_road', $data);
    //     }
    // }

    /**
        * This function on ajaxcall load server side data into datatable
        * @param  NULL
        * @return json response
     */
    public function get_list() 
    {
        if($this->input->is_ajax_request()) {
            $columns =  array( 
                            0   => 'id', 
                            1   => 'from_rate',
                            2   => 'to_rate',
                            3   => 'amount ',
                            4   => 'fiscal_year',
                        );

            $limit                  = $this->input->post('length');
            $start                  = $this->input->post('start');
            $fiscal_year            = $this->input->post('fiscal_year');
            $from_rate              = $this->input->post('from_rate');
            $to_rate                = $this->input->post('to_rate');
            $type                   = $this->input->post('type');
            $order                  = $columns[$this->input->post('order')[0]['column']];
            $dir                    = $this->input->post('order')[0]['dir'];
            $totalData              = $this->SampatiModel->allposts_count($fiscal_year,$from_rate,$to_rate, $type);
            $totalFiltered          = $totalData;
            $posts                  = $this->SampatiModel->allposts($limit,$start,$order,$dir, $fiscal_year,$from_rate,$to_rate, $type);
            $data           = array();
            if(!empty($posts))
            {
               
                $i = 1;
                foreach ($posts as $post)
                {
                    $nestedData['sn']               = $this->mylibrary->convertedcit($i++);
                    $nestedData['id']               = $post->id;
                    if($post->type == 1){
                        $nestedData['type'] = 'पक्की प्रति घरधुरी ';
                    } else {
                        $nestedData['type'] = 'कच्ची प्रतिघर घरधुरी ';
                    }
                    if($post->type == 1){
                        $nestedData['unit'] = 'पहिलो तला   ';
                    } else if($post->unit == 2){
                        $nestedData['unit'] = 'दोस्रो तला ';
                    }
                    else if($post->unit == 3){
                        $nestedData['unit'] = 'तेस्रो तला ';
                    }
                    else{
                        $nestedData['unit'] = 'तेस्रो तला भन्दा माथि  ';
                    }
                    // $nestedData['from_rate']        = $this->convertlib->convert_number($post->from_rate);
                    // $nestedData['to_rate']          = $this->convertlib->convert_number($post->to_rate);
                    // if($post->is_percent == 1) {
                    //     $rate = $post->amount.'(%)';
                    // } else if($post->from_rate > 50000000) {
                    //     $rate = '0.40%';
                    // } else {
                    //     $rate = $post->amount;
                    // }
                    $nestedData['amount'] =  $this->mylibrary->convertedcit($post->amount);
                    //if($post->type == 1){
                       //if($post->unit == 1) {
                            //$nestedData['amount'] = 'एक मुष्ठ रु '.$this->mylibrary->convertedcit($post->amount);
                        //} else {
                            //$nestedData['amount'] = 'प्रति लाख रु '.$this->mylibrary->convertedcit($post->amount);
                        //}
                    //} else if($post->type == 2) {
                        //if($post->is_percent == 1) {
                           // $nestedData['amount'] = $this->mylibrary->convertedcit($post->amount).'(प्रतिशत )';
                        //}
                    //}
                    $nestedData['fiscal_year']      = $this->mylibrary->convertedcit($post->fiscal_year);
                    $data[] = $nestedData;
                }
               // pp($data);
            }
            $json_data = array(
                        "draw"            => intval($this->input->post('draw')),  
                        "recordsTotal"    => intval($totalData),                   
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                        );
                
            echo json_encode($json_data);
        } else {
            exit('HTTPS!!');
        }
    }
}