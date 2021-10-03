<?php

/**
 * This class export data.
 */
require_once FCPATH.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ImportData extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
        $this->load->model("CommonModel");
        $this->load->model("Importdatamodel");
        $this->module_code = 'IMPORT-DATA';
        $this->file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }
 
    /**
     * Index view.
     * @return void.
     */
    public function Index()
    {
        $data['page'] = 'list_all';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', "ASC");
        $this->load->view('main', $data);
    }

    /**
     * pop up nagadi rasid import form.
     * @return void.
     */
    public function NagadiDetails() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_nagadi_details');
    }
    
    //save nagadi details
    public function saveNagadiDetails() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
        if($file[0] != 'नगदी' && $file[1] != 'रशिद' && $file[2] !='विवरण' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        $last_y = explode('.',$file[5]);
        $fiscal_year = $file[4].'/'.$last_y[0];
        //$data_2 = $this->Importdatamodel->getNagadiDetails($fiscal_year, $month);
        // if(!empty($data_e)) {
        //      //$data_2 = array();
        //     foreach ($data_2 as $key => $value) {
        //         $data_2[] =array(
        //             'fiscal_year'       => $value['fiscal_year'],
        //             'date'              => $value['date'],
        //             'customer_name'     => $value['customer_name'],
        //             'pan_no'            => $value['pan_no'],
        //             'bill_no'           => $value['bill_no'],
        //             'provience'         => $value['provience'],
        //             'district'          => $value['district'],
        //             'gapa_napa'         => $value['gapa_napa'],
        //             'ward'              => $value['ward'],
        //             't_total'           => $value['t_total'],
        //             'recieved_amount'   => $value['recieved_amount'],
        //             'return_amount'     => $value['return_amount'],
        //             'guid'              => $value['guid'],
        //             'added_by'          => $value['added_by'],
        //             'added_on'          => $value['added_on'],
        //             'status'            => $value['status'],
        //             'modified_by'       => $value['modified_by'],
        //             'modified_on'       => $value['modified_on'],
        //             'print_count'       => $value['print_count'],
        //             'initital_flag'     => '1'
        //         );
        //     }
        // }
        
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'fiscal_year'       => $value[0],
                    'date'              => $value[1],
                    'customer_name'     => $value[2],
                    'pan_no'            => $value[3],
                    'bill_no'           => $value[4],
                    'provience'         => $value[5],
                    'district'          => $value[6],
                    'gapa_napa'         => $value[7],
                    'ward'              => $value[8],
                    't_total'           => $value[9],
                    'recieved_amount'   => $value[10],
                    'return_amount'     => $value[11],
                    'guid'              => $value[12],
                    'added_by'          => $value[13],
                    'added_on'          => $value[14],
                    'status'            => $value[15],
                    'modified_by'       => $value[16],
                    'modified_on'       => $value[17],
                    'print_count'       => $value[18],
                    'initial_flag'     => '2'
                );
            }

            // $itemsIncart = array_reduce(array_uintersect($data, $data_2, function ($a, $b) {
            // $a = (array) $a;
            // $b = (array) $b;
            // return $a['bill_no'] === $b['bill_no'] ? 0 : 1;
            // }), function ($a, $b) {
            // $a[$b->id] = true;
            // return $a;
            // });


            //array_intersect($arr1, $arr2);
            // $new_arr = array_intersect($data, $data_2);
            // pp($itemsIncart);
            // $new_data = array_diff($data_2, $data);
            // pp($data);
            $this->db->trans_start();
            $this->db->insert_batch('nagadi_rasid', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }

   /**
     * pop up nagadi rasid import form.
     * @return void.
     */
    public function NagadiAmountDetails() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_nagadi_amount_details');
    }

    //SaveNagadiAmountDetails
    public function SaveNagadiAmountDetails() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        //नगदी-रशिद-रकम-विवरण
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
        if( $file[0] != 'नगदी' && $file[1] != 'रशिद' && $file[2] !='रकम' &&  $file[3] !='विवरण' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        $last_y = explode('.',$file[5]);
        $fiscal_year = $file[4].'/'.$last_y[0];
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            //pp($sheetData);
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'guid'          => $value[0],
                    'main_topic'    => $value[1],
                    'sub_topic'     => $value[2],
                    'topic'         => $value[3],
                    'topic_qty'     => $value[4],
                    'rate'          => $value[5],
                    't_rates'       => $value[6],
                    'others_topic'  => $value[7],
                    'ward'          => $value[8],
                    'added'         => $value[9],
                    'fiscal_year'   => $value[10],
                    'bill_no'       => $value[11],
                    'added_by'      => $value[12],
                    'initial_flag'  => '2'
                );
            }
            $this->db->trans_start();
            $this->db->insert_batch('nagadi_amount_details', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }

    /**
     * pop up nagadi rasid import form.
     * @return void.
     */
    public function NagadiCancelBills() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_nagadi_cancel_details');
    }

    //SaveNagadiAmountDetails
    public function SaveNagadiCancelBills() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        //नगदी-रशिद-रद्द-विवरण
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
        if( $file[0] != 'नगदी' && $file[1] != 'रशिद' && $file[2] !='रद्द' &&  $file[3] !='विवरण' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        $last_y = explode('.',$file[5]);
        $fiscal_year = $file[4].'/'.$last_y[0];
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            //pp($sheetData);
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'trans_id'      => $value[0],
                    'bill_no'       => $value[1],
                    'date'          => $value[2],
                    'reason'        => $value[3],
                    'added_by'      => $value[4],
                    'initial_flag'  => '2'
                );
            }
            $this->db->trans_start();
            $this->db->insert_batch('nagadi_cancle_reason', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }

    /**
     * pop up nagadi rasid import form.
     * @return void.
     */
    public function ProfileDetails() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_profile_details');
    }

    //SaveNagadiAmountDetails
    public function SaveProfileDetails() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        //जग्गाधनी-प्रोफाइल
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
        if( $file[0] != 'जग्गाधनी' && $file[1] != 'प्रोफाइल' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        $last_y = explode('.',$file[5]);
        $fiscal_year = $file[4].'/'.$last_y[0];
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            //pp($sheetData);
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'fiscal_year'                   => $value[0],
                    'land_own_type'                 => $value[1],
                    'land_owner_name_np'            => $value[2],
                    'land_owner_name_en'            => $value[3],
                    'land_owner_father_name'        => $value[4],
                    'land_owner_grandpa_name'       => $value[5],
                    'land_owner_occupation'         => $value[6],
                    'land_owner_gender'             => $value[7],
                    'nationality'                   => $value[8],
                    'land_owner_email'              => $value[9],
                    'land_owner_contact_no'         => $value[10],
                    'file_no'                       => $value[11],
                    'remarks'                       => $value[12],
                    'lo_state'                      => $value[13],
                    'lo_district'                   => $value[14],
                    'lo_gapa_napa'                  => $value[15],
                    'lo_ward'                       => $value[16],
                    'lo_land_lac_ward'              => $value[17],
                    'lo_temp_address'               => $value[18],
                    'lo_house_no'                   => $value[19],
                    'lo_tol'                        => $value[20],
                    'lo_temp_state'                 => $value[21],
                    'lo_temp_dis'                   => $value[22],
                    'lo_temp_gapanapa'              => $value[23],
                    'lo_czn_no'                     => $value[24],
                    'lo_pan_no'                     => $value[25],
                    'lo_temp_ward'                  => $value[26],
                    'lo_temp_tol'                   => $value[27],
                    'lo_temp_house_no'              => $value[28],
                    'lo_fi_state'                   => $value[29],
                    'lo_fi_district'                => $value[30],
                    'lo_fi_gapa_napa'               => $value[31],
                    'lo_fi_ward'                    => $value[32],
                    'lo_fi_relation'                => $value[33],
                    'lo_fi_name'                    => $value[34],
                    'lo_fi_date'                    => $value[35],
                    'added_by'                      => $value[36],
                    'added_on'                      => $value[37],
                    'modified_on'                   => $value[38],
                    'modified_by'                   => $value[39],
                    'initial_flag'                  => '2'
                );
            }
            $this->db->trans_start();
            $this->db->insert_batch('land_owner_profile_basic', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }

     /**
     * pop up nagadi rasid import form.
     * @return void.
     */
    public function FamailyDetails() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_famaily_details');
    }

    //SaveNagadiAmountDetails
    public function SaveFamailyDetails() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        //जग्गाधनी-पारिबार
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
        if( $file[0] != 'जग्गाधनी' && $file[1] != 'पारिबार' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        $last_y = explode('.',$file[5]);
        $fiscal_year = $file[4].'/'.$last_y[0];
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            //pp($sheetData);
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'member_name'       => $value[0],
                    'member_age'        => $value[1],
                    'member_relation'   => $value[2],
                    'profile_file_no'   => $value[3],
                    'added_on'          => $value[4],
                    'added_by'          => $value[5],
                    'initial_flag'      => '2'
                );
            }
            $this->db->trans_start();
            $this->db->insert_batch('land_owner_family_details', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }

    /**
     * pop up nagadi rasid import form.
     * @return void.
     */
    public function LandDetails() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_land_details');
    }

    //SaveNagadiAmountDetails
    public function SaveLandDetails() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        //जग्गाको विवरण
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
        if( $file[0] != 'जग्गाको' && $file[1] !='विवरण' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        // $last_y = explode('.',$file[5]);
        // $fiscal_year = $file[4].'/'.$last_y[0];
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
          // pp($sheetData);
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'old_gapa_napa'         => $value[0],
                    'old_ward'              => $value[1],
                    'present_gapa_napa'     => $value[2],
                    'present_ward'          => $value[3],
                    'road_name'             => $value[4],
                    'land_area_type'        => $value[5],
                    'nn_number'             => $value[6],
                    'k_number'              => $value[7],
                    'a_ropani'              => $value[8],
                    'a_ana'                 => $value[9],
                    'a_paisa'               => $value[10],
                    'a_dam'                 => $value[11],
                    'a_unit'                => $value[12],
                    'total_square_feet'     => $value[13],
                    'min_land_rate'         => $value[14],
                    'max_land_rate'         => $value[15],
                    'k_land_rate'           => $value[16],
                    't_rate'                => $value[17],
                    'fiscal_year'           => $value[18],
                    'ld_file_no'            => $value[19],
                    'added_by'              => $value[20],
                    'added_on'              => $value[21],
                    'modified_by'           => $value[22],
                    'modified_on    '       => $value[23],
                    'initial_flag'          => '2'
                );
            }
            
            $this->db->trans_start();
            $this->db->insert_batch('land_description_details', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }

    public function SanrachanaDetails() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_sanrachan_details');
    }

    public function SaveSanrachanaDetails() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        //भोतिक-संरचनाको-विवरण
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
        if( $file[0] != 'भोतिक' && $file[1] !='संरचनाको' &&  $file[2] !='विवरण' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        // $last_y = explode('.',$file[5]);
        // $fiscal_year = $file[4].'/'.$last_y[0];
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
          // pp($sheetData);
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'k_no'                                  => $value[0],
                    'toal_land_area'                        => $value[1],
                    'total_land_area_sqft'                  => $value[2],
                    'total_land_min_amount'                 => $value[3],
                    'total_land_tax_amount'                 => $value[4],
                    'sanrachana_n_no'                       => $value[5],
                    'sanrachana_prakar'                     => $value[6],
                    'sanrachana_banot_kisim'                => $value[7],
                    'sanrachana_usages'                     => $value[8],
                    'sanrachana_floor'                      => $value[9],
                    'sanrachana_ground_lenth'               => !empty($value[10])?$value[10]:'',
                    'sanrachana_ground_width'               => !empty($value[11])?$value[11]:'',
                    'sanrachana_ground_area_sqft'           => $value[12],
                    'sanrachana_ground_housing_area_sqft'   => $value[13],
                    'contructed_year'                       => $value[14],
                    'sanrachana_dep_rate'                   => $value[15],
                    'sanrachana_min_amount'                 => $value[16],
                    'sanrachana_kubul_amount'               => $value[17],
                    'sanrachana_khud_amount'                => $value[18],
                    'sanrachana_ground_area_ropani'         => $value[19],
                    'sanrachana_land_tax_amount'            => $value[20],
                    'net_tax_amount'                        => $value[21],
                    'ls_file_no'                            => $value[22],
                    'added_on'                              => $value[23],
                    'added_by'                              => !empty($value[24])?$value[24]:'',
                    'modified_on'                           => !empty($value[25])?$value[25]:'',
                    'modified_by'                           => !empty($value[26])?$value[26]:'',
                    'r_bhumi_area'                          => $value[27],
                    'r_bhumi_kar'                           => $value[28],
                    'fiscal_year'                           => $value[29],
                    'initial_flag'                          => '2'
                );
            }
            $this->db->trans_start();
            $this->db->insert_batch('sanrachana_details', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }

    public function BDetails() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_b_details');
    }

    public function SaveBDetails() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        //भोतिक-संरचनाको-विवरण
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
        if( $file[0] != 'बक्यौता' &&  $file[1] !='विवरण' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        // $last_y = explode('.',$file[5]);
        // $fiscal_year = $file[4].'/'.$last_y[0];
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
          // pp($sheetData);
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'fiscal_year'    => $value[0],
                    'total_t_amount' => $value[1],
                    'bhumi_kar'      => $value[2],
                    'lb_file_no'     => $value[3],
                    'added_on'       => $value[4],
                    'added_by'       => $value[5],
                    'modified_on'    => $value[6],
                    'modified_by'    => $value[7],
                    'initial_flag'   => '2'
                );
            }
            $this->db->trans_start();
            $this->db->insert_batch('ba_details', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }

    public function SampatiKarDetails() {
        $data['pageTitle'] = 'नगदी रशिद विवरण';
        $this->load->view('import_sam_bhu_kar_details');
    }

    public function SaveSampatiKarDetails() {
       
        if(empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('MSG_EMP','Invalid Format! Please select xls file');
            redirect('ImportData');
        }
        //सम्पतिकर-भूमिकर-रसिद
        $file_name = $_FILES['userfile']['name'];
        $file = explode('-', $file_name);
      
        if( $file[0] != 'सम्पतिकर' && $file[1] != 'भूमिकर' && $file[2] !='रसिद' ) {
            $this->session->set_flashdata('MSG_EMP','Invalid File Name!');
            redirect('ImportData');
        }
        $month = $file[3];
        // $last_y = explode('.',$file[5]);
        // $fiscal_year = $file[4].'/'.$last_y[0];
        if(isset($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'], $this->file_mimes)) {
            $arr_file = explode('.', $_FILES['userfile']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if('Xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['userfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
          // pp($sheetData);
            foreach ($sheetData as $key => $value) {
                $data[] =array(
                    'nb_file_no'                            => $value[0],
                    'bill_no'                               => $value[1],
                    'saranchana_ko_kar_amount'              => $value[2],
                    'saranchana_ko_sampti_kar'              => $value[3],
                    'saranchana_ko_charckeko_kar_amount'    => $value[4],
                    'saranchana_ko_charcheko_bhumi_kar'     => $value[5],
                    'total_land_area_kar_amount'            => $value[6],
                    'other_amount'                          => $value[7],
                    'discount_amount'                       => $value[8],
                    'khud_amount'                           => $value[9],
                    'bakeyuta_amount'                       => $value[10],
                    'fine_amount'                           => $value[11],
                    'recieved_amount'                       => $value[12],
                    'retruned_amount'                       => $value[13],
                    'net_total_amount'                      => $value[14],
                    'added_by'                              => $value[15],
                    'added_ward'                            => !empty($value[16])?$value[16]:'0',
                    'added_on'                              => $value[17],
                    'billing_date'                          => $value[18],
                    'print_count'                           => $value[19],
                    'modified_on'                           => !empty($value[20])?$value[20]:'0',
                    'modified_by'                           => !empty($value[21])?$value[21]:'0',
                    'fiscal_year'                           => $value[22],
                    'status'                                => $value[23],
                    'initial_flag'                          => '2'
                );
            }
            $this->db->trans_start();
            $this->db->insert_batch('sampati_kar_bhumi_kar_bill_details', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
               $this->session->set_flashdata('MSG_EMP','OOPS ! cannot import data');
               redirect('ImportData');
            } else {
               $this->session->set_flashdata('MSG_EMP','Success');
               redirect('ImportData');
            }
        }
    }
}