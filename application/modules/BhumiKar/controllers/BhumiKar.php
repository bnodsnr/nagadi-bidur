<?php

class BhumiKar extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("BhumiModel");
        $this->module_code = 'BHUMI-KAR';
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
            $data['page'] = 'list_all';
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
            $data['page'] = 'add';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['land_category'] = $this->CommonModel->getData('land_category', 'DESC');
            $data['roads'] = $this->CommonModel->getData('settings_road', 'DESC');
            $data['land_area_type'] = $this->CommonModel->getData('settings_land_area_type','DESC');
            if(!empty($id)) {
                $data['row'] = $this->CommonModel->getDataByID('bhumikar',$id);
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
            $road_type          = $this->input->post('road_type');
            $land_area_type     = $this->input->post('land_area_type');
            $land_category      = $this->input->post('land_category');
            $ward               = $this->input->post('ward_no');
            $rate               = $this->input->post('rate');
            $fiscal_year        = $this->input->post('fiscal_year'); 
            $this->form_validation->set_rules('fiscal_year', 'आर्थिक वर्ष', 'required');
            $this->form_validation->set_rules('land_area_type', 'जग्गाको क्षेत्रगत किसिम', 'required');
            $this->form_validation->set_rules('land_category', 'जग्गाको वर्गिकरण', 'required');
            if(MODULE != 3 ) {
                $this->form_validation->set_rules('ward_no',   'वार्ड', 'required');
            }
            $this->form_validation->set_rules('rate', 'अधिक्कतम मुल्य', array('trim','required','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));
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
                'land_area_type'    => $land_area_type,
                'land_category'     => $land_category,
                'ward'              => !empty($ward)?$ward:0,
                'rate'              => $rate,
                'fiscal_year'       => $fiscal_year,
                'added_by'          => $this->session->userdata('PRJ_USER_ID'),
                'added_on'          => convertDate(date('Y-m-d'))
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('bhumikar',$post_data);
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
                 $result = $this->CommonModel->UpdateData('bhumikar',$id, $post_data);
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
                            1   => 'land_area_type',
                            2   => 'category',
                            3   => 'ward    ',
                            4   => 'fiscal_year',
                            5   => 'rate'
                        );

            $limit                  = $this->input->post('length');
            $start                  = $this->input->post('start');
            $fiscal_year            = $this->input->post('fiscal_year');
            $land_area_type         = $this->input->post('land_area_type');
            $land_category          = $this->input->post('land_category');
            $order                  = $columns[$this->input->post('order')[0]['column']];
            $dir                    = $this->input->post('order')[0]['dir'];
            $totalData              = $this->BhumiModel->allposts_count($fiscal_year,$land_area_type,$land_category);
            $totalFiltered          = $totalData;
            $posts                  = $this->BhumiModel->allposts($limit,$start,$order,$dir, $fiscal_year,$land_area_type,$land_category);
            // pp($posts);
            $data           = array();
            if(!empty($posts))
            {
                $i = 1;
                foreach ($posts as $post)
                {
                    $nestedData['sn']               = $this->mylibrary->convertedcit($i++);
                    $nestedData['id']               = $post->ids;
                    $nestedData['land_area_type']   = $post->lat;
                    $nestedData['land_category']    = $post->road_name;
                    $nestedData['ward']             = $this->mylibrary->convertedcit($post->ward);
                    $nestedData['rate']             = $this->mylibrary->convertedcit($post->rate);
                    $nestedData['fiscal_year']      = $this->mylibrary->convertedcit($post->fy);
                    $data[] = $nestedData;
                }
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