<?php

require_once FCPATH.'/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**

 * Created by PhpStorm.

 * User: root

 * Date: 12/2/16

 * Time: 9:57 PM

 */

class Road extends MX_Controller

{

    public function __construct()

    {

        parent::__construct();

        $this->load->model("CommonModel");

        $this->load->model("RoadModel");

        $this->module_code = 'ROAD';

        $this->fy = current_fiscal_year();

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

            $data['land_area_type'] = $this->CommonModel->getWhereAll('settings_land_area_type',array('fiscal_year' => $this->fy));

            $data['road_type'] = $this->CommonModel->getWhereAll('settings_road_type',array('fiscal_year' => $this->fy));
            $data['wards'] = $this->CommonModel->getData('wardwise_address',"ASC");
            $this->load->view('main', $data);

        }else{

            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');

            redirect('Dashboard');

        }

    }



    public function Add() {

        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){

            $id = $this->uri->segment(3);

            $data['page'] = 'add_road';

            //$data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');



            $data['ward'] = $this->CommonModel->getData('settings_ward','ASC');

            $data['road_type'] = $this->CommonModel->getWhereAll('settings_road_type', array('fiscal_year'=>$this->fy));



            // $data['land_area_type'] = $this->CommonModel->getData('settings_land_area_type','DESC');

            // $data['land_category'] = $this->CommonModel->getData('land_category','DESC');

            if(!empty($id)) {

                $data['row'] = $this->CommonModel->getDataByID('settings_road',$id);

            }

             $this->load->view('main', $data);

        }else{

            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');

            redirect('Dashboard');

        }

    }



    public function Save() {



        if($this->input->is_ajax_request()) {



            $id = $this->input->post('id');

            $road_type = $this->input->post('road_type');

            $land_area_type = $this->input->post('land_area_type');

            $tol = $this->input->post('tol');

            $ward = $this->input->post('ward_no');

            $road_name = $this->input->post('road_name');

            $min_rate = $this->input->post('min_rate');

            $max_rate = $this->input->post('max_rate');

            $fiscal_year = $this->input->post('fiscal_year'); 

            $this->form_validation->set_rules('fiscal_year', 'आर्थिक वर्ष', 'required');

            if(MODULE == 2) {

                $this->form_validation->set_rules('land_area_type', 'जग्गाको क्षेत्रगत किसिम', 'required');

                $this->form_validation->set_rules('min_rate', 'अधिक्कतम मुल्य', array('trim','required','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));

                $this->form_validation->set_rules('max_rate', 'अधिक्कतम मुल्य', array('trim','required','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));

            }

           

            $this->form_validation->set_rules('road_type', 'सडकको किसिम', 'required');

            $this->form_validation->set_rules('ward_no',   'वार्ड', 'required');

            $this->form_validation->set_rules('road_name', 'रोडको नाम', 'required');

           

            // $this->form_validation->set_rules('max_rate', 'अधिक्कतम मुल्य', 'required');

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

                'road_type'         => $road_type,

                'road_name'         => $road_name,

                'tole'              => $tol,

                'ward'              => $ward,

                'fiscal_year'       => $fiscal_year

            );

            if(empty($id)) {

                $result = $this->CommonModel->insertData('settings_road',$post_data);

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

                 $result = $this->CommonModel->UpdateData('settings_road',$id, $post_data);

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

            $result = $this->CommonModel->remove($id,'settings_road');

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



    //get land category

    public function getLandCategory() {

        if($this->input->is_ajax_request()) {

            $land_area_type = $this->input->post('land_area_type');

            $result = $this->RoadModel->getLandCategory($land_area_type);



            if($result) {

                $response = array(

                    'status'      => 'success',

                    'data'         => $result,

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

    public function importRoadName() {

        $this->load->view('import');

    }

    public function importData() {

        header('Content-Type: text/html; charset=UTF-8');

         $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $file_mimes)) {

          $arr_file = explode('.', $_FILES['userfile']['name']);

          $extension = end($arr_file);

          if('csv' == $extension) {

              $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

          } else {

              $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

          }

          $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);

          $sheetData = $spreadsheet->getActiveSheet()->toArray();

          foreach ($sheetData as $key => $value) {

            $data[] =array(

                'fiscal_year'  => '2077/078',

                'parent_id'  => $value[0],

                'sub_topic' => $value[1],

                'topic_title' =>$value[2],

                'rate' =>   $value[3],

                'is_per' =>$value[4],

                'status' =>'1',

                'added_by' =>'1',

                'added_by' =>'1',

                'added_on' =>'1',

            );

          }

          //pp($data);

          $this->db->insert_batch('sub_topic', $data);

        }

    }



    /**

        * This function on ajaxcall load server side data into datatable

        * @param  NULL

        * @return json response

     */

    public function get_road_list() 

    {

        if($this->input->is_ajax_request()) {

            $columns =  array( 

                                0   => 'id', 

                                1   => 'road_name',

                                2   => 'road_type',

                                3   => 'land_area_type',

                                4   => 'fiscal_year'

                            );
            $limit          = $this->input->post('length');
            $start          = $this->input->post('start');
            $fiscal_year    = $this->input->post('fiscal_year');
            $land_area_type = $this->input->post('land_area_type');
            $road_type      = $this->input->post('road_type');
            $road_name      = $this->input->post('road_name');
            $ward_no        = $this->input->post('ward_no');
            $order          = $columns[$this->input->post('order')[0]['column']];
            $dir            = $this->input->post('order')[0]['dir'];
            $totalData      = $this->RoadModel->allposts_count($fiscal_year,$road_type,$road_name,$ward_no);
            $totalFiltered  = $totalData;

            $posts          = $this->RoadModel->allposts($limit,$start,$order,$dir, $fiscal_year,$road_type,$road_name,$ward_no);

            $data           = array();

            if(!empty($posts))

            {

                $i = 1;

                foreach ($posts as $post)

                {

                    $nestedData['sn']               = $this->mylibrary->convertedcit($i++);

                    $nestedData['id']               = $post->road_id;

                    $nestedData['road_type']        = $post->rot;

                    $nestedData['road_name']        = $post->road_name;
                    $nestedData['ward']             = $this->mylibrary->convertedcit($post->ward);
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