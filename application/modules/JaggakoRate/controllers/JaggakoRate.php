<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */

require_once FCPATH.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class JaggakoRate extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("LandModel");
        $this->module_code = 'LAND-RATE';
        $this->fy = current_fiscal_year();
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /*
        *This function list all the land minimun rate
        @param 
        return array of all land_minimum rate

     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['jaagaKoRate'] = $this->LandModel->getJaagaKoRate();
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /* *
        *this function add or modify the list if id is set to null it will update detais
        @param int id incase of edit
        return true on success  
     */
    public function addJaagakoMinRate($id =NULL) {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){

           $data['page'] = 'add_jaagako_min_rate';
           $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
           $data['ward'] = $this->CommonModel->getData('wardwise_address','DESC');
           $data['settingsLandAreaType'] = $this->CommonModel->getWhereAll('settings_land_area_type' ,array('fiscal_year' => $this->fy));
          // pp($data['settingsLandAreaType']);
           $data['road'] = $this->CommonModel->getWhereAll('settings_road', array('fiscal_year' => $this->fy));
           //$data['settings_land_area_type'] = $this->CommonModel->getWhereAll('settings_land_area_type', array('fiscal_year' => $this->fy));
           if(!empty($id)) {
                $data['row'] = $this->CommonModel->getDataByID('settings_area_minimal_cost',$id);
                $data['roads'] = $this->LandModel->getRoadDetails($data['row']['ward']);
           }
            $id = $this->uri->segment(3);
            //$data['page'] = 'add_jaagako_min_rate';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            //$data['settingsLandAreaType'] = $this->CommonModel->getWhereAll('settings_land_area_type',array('fiscal_year' => $this->fy));
            //$data['road'] = $this->CommonModel->getWhereAll('settings_road', array('fiscal_year' => $this->fy));
            //$data['settings_land_area_type'] = $this->CommonModel->getWhereAll('settings_land_area_type', array('fiscal_year' => $this->fy));
            //$data['row'] = $this->CommonModel->getDataByID('settings_area_minimal_cost',$id);
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }

    }
   

   //save detaails
    /** 
        * this function save form details
        @param post data
        return true on success
    */
        //save 
    public function SaveJaagakoMinRate() {
        if($this->input->post('Submit')) {
            $id = $this->input->post('id');
            $ward = $this->input->post('ward_no');
            $road = $this->input->post('road');
            $land_type  = $this->input->post('land_type');
            $min_amount = $this->input->post('min_amount');
            $max_amount = $this->input->post('max_amount');
            $fiscal_year = $this->input->post('fiscal_year');
            $post_data = array(
                'ward' => $ward,
                'road_name' => $road,
                'land_area_type' => $land_type,
                'minimal_cost' =>$min_amount,
                'maximum_cost' => $max_amount,
                'fiscal_year' => $fiscal_year
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('settings_area_minimal_cost',$post_data);
            } else{
                $result = $this->CommonModel->UpdateData('settings_area_minimal_cost',$id, $post_data);
            }
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', "सफलतापूर्वक अपडेट गरियो");
                redirect('JaggakoRate');
            }
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
            $result = $this->CommonModel->remove($id,'settings_area_minimal_cost');
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


/**
        * on ajax request get new address on request old address.
        * check proper id is in format of not.
        * @param $ward int pk
        * @return boolean.
    */
    public function getRoads() {
        if($this->input->is_ajax_request()){
            $ward = $this->input->post('ward');
            $road_option = "";
            $road_option .= "<option value=''>छान्नुहोस्</option>";
            $road['details'] = $this->LandModel->getRoadDetails($ward);
            if(!empty($road['details'])) {
              foreach ($road['details'] as $key => $value) {
                $road_option .= "<option value = '".$value['id']."''>".$value['road_name']."</option>";
              }
            } else {
              $road_option .= "<option> Empty Road</option>";
            }
            $response = array(
              'status'      => 'success',
              'data'         => $road_option,
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
        
    } 

    /* -------------------------------------------------------------------------------------------------------------
    ---------------------------------------------------------------------------------------------------------------*/
    //import jaaga ko min rate
    public function importView() {
        $this->load->view('import_view');
    }

    public function importData() {
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            foreach ($sheetData as $key => $value) {
                $data[] =           array(
                    'ward'              => $value[0],
                    'road_name'         => $value[1],
                    'land_area_type'    => $value[2],
                    'minimal_cost'      => $value[3],
                    'maximum_cost'      => $value[4],
                    'fiscal_year'       => $value[5],
                );
            }
          $this->db->insert_batch('settings_area_minimal_cost', $data);
        }
    }
}