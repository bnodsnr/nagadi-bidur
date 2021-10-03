<?php

/**
 * This class export data.
 */
require_once FCPATH.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ExportData extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("ExportDataModel");
        $this->module_code = 'EXPORT-DATA';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }
 
    /**
        * This function list all the land minimun rate
        return void
     */
    public function Index()
    {
        $data['page'] = 'list_all';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', "ASC");
        $this->load->view('main', $data);
    }

    //export nagadi rasid wirawan
    public function NagadiDetails() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getNagadiDetails($fiscal_year, $month);
            //updata flag

           
            //pp($data);
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }

            if(!empty($data)) {
                $id =array();
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdateNagadiRasid($id);
                if($result) {
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $rowCount = 1;
                    foreach ($data as $element) {
                        $sheet->setCellValue('A' . $rowCount, $element['fiscal_year']);
                        $sheet->setCellValue('B' . $rowCount, $element['date']);
                        $sheet->setCellValue('C' . $rowCount, $element['customer_name']);
                        $sheet->setCellValue('D' . $rowCount, $element['pan_no']);
                        $sheet->setCellValue('E' . $rowCount, $element['bill_no']);
                        $sheet->setCellValue('F' . $rowCount, $element['provience']);
                        $sheet->setCellValue('G' . $rowCount, $element['district']);
                        $sheet->setCellValue('H' . $rowCount, $element['gapa_napa']);
                        $sheet->setCellValue('I' . $rowCount, $element['ward']);
                        $sheet->setCellValue('J' . $rowCount, $element['t_total']);
                        $sheet->setCellValue('K' . $rowCount, $element['recieved_amount']);
                        $sheet->setCellValue('L' . $rowCount, $element['return_amount']);
                        $sheet->setCellValue('M' . $rowCount, $element['guid']);
                        $sheet->setCellValue('N' . $rowCount, $element['added_by']);
                        $sheet->setCellValue('O' . $rowCount, $element['added_on']);
                        $sheet->setCellValue('P' . $rowCount, $element['status']);
                        $sheet->setCellValue('Q' . $rowCount, $element['modified_by']);
                        $sheet->setCellValue('R' . $rowCount, $element['modified_by']);
                        $sheet->setCellValue('S' . $rowCount, $element['print_count']);
                        $rowCount++;
                    }
                    $writer = new Xlsx($spreadsheet);
                    $fy = explode('/', $fiscal_year);
                    $filename = 'नगदी-रशिद-विवरण-'.$month.'-'.$fy[0].'-'.$fy[1];
                    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output'); // download file
                } else {
                    $this->session->set_flashdata('MSG_EMP','Cannot Export data');
                    redirect('ExportData');
                }
            }
        }
    }
    
    public function ExportNagadiAmountDetails() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getNagadiAmountDetails($fiscal_year, $month);
            //pp($data);
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdateNagadiAmountDetails($id);
                if($result) {
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $rowCount = 1;
                    foreach ($data as $element) {
                        $sheet->setCellValue('A' . $rowCount, $element['guid']);
                        $sheet->setCellValue('B' . $rowCount, $element['main_topic']);
                        $sheet->setCellValue('C' . $rowCount, $element['sub_topic']);
                        $sheet->setCellValue('D' . $rowCount, $element['topic']);
                        $sheet->setCellValue('E' . $rowCount, $element['topic_qty']);
                        $sheet->setCellValue('F' . $rowCount, $element['rate']);
                        $sheet->setCellValue('G' . $rowCount, $element['t_rates']);
                        $sheet->setCellValue('H' . $rowCount, $element['others_topic']);
                        $sheet->setCellValue('I' . $rowCount, $element['ward']);
                        $sheet->setCellValue('J' . $rowCount, $element['added']);
                        $sheet->setCellValue('K' . $rowCount, $element['fiscal_year']);
                        $sheet->setCellValue('L' . $rowCount, $element['bill_no']);
                        $sheet->setCellValue('M' . $rowCount, $element['added_by']);
                        $rowCount++;
                    }
                    $writer = new Xlsx($spreadsheet);
                    $filename = 'नगदी-रशिद-रकम-विवरण-'.convertDate(date('Y-m-d'));
                    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output'); // download file
                } else {
                    $this->session->set_flashdata('MSG_EMP','Cannot Export Data');
                    redirect('ExportData');
                }
                
        }
    }

    public function ExportnagadiCancelBills() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getNagadiCancelBills($fiscal_year, $month);
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }
            if(!empty($data)) {
                $id =array();
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdateNagadiCancelBills($id);
                if($result) {
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $rowCount = 1;
                    foreach ($data as $element) {
                        $sheet->setCellValue('A' . $rowCount, $element['trans_id']);
                        $sheet->setCellValue('B' . $rowCount, $element['bill_no']);
                        $sheet->setCellValue('C' . $rowCount, $element['date']);
                        $sheet->setCellValue('D' . $rowCount, $element['reason']);
                        $sheet->setCellValue('E' . $rowCount, $element['added_by']);
                        $rowCount++;
                    }
                    $writer = new Xlsx($spreadsheet);
                    $filename = 'नगदी-रशिद-रद्द-विवरण'.convertDate(date('Y-m-d'));
                    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output'); // download file
                } else {
                    $this->session->set_flashdata('MSG_EMP','Cannot Export Data');
                    redirect('ExportData');
                }
            }
        }
    }

    public function ExportProfileDetails() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getProfileDetails($fiscal_year, $month);
            //pp($data);
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }

            if(!empty($data)) {
                $id =array();
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdateProfileDetails($id);
                if($result) {
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $rowCount = 1;
                    foreach ($data as $element) {
                        $sheet->setCellValue('A' . $rowCount, $element['fiscal_year']);
                        $sheet->setCellValue('B' . $rowCount, $element['land_own_type']);
                        $sheet->setCellValue('C' . $rowCount, $element['land_owner_name_np']);
                        $sheet->setCellValue('D' . $rowCount, $element['land_owner_name_en']);
                        $sheet->setCellValue('E' . $rowCount, $element['land_owner_father_name']);
                        $sheet->setCellValue('F' . $rowCount, $element['land_owner_grandpa_name']);
                        $sheet->setCellValue('G' . $rowCount, $element['land_owner_occupation']);
                        $sheet->setCellValue('H' . $rowCount, $element['land_owner_gender']);
                        $sheet->setCellValue('I' . $rowCount, $element['nationality']);
                        $sheet->setCellValue('J' . $rowCount, $element['land_owner_email']);
                        $sheet->setCellValue('K' . $rowCount, $element['land_owner_contact_no']);
                        $sheet->setCellValue('L' . $rowCount, $element['file_no']);
                        $sheet->setCellValue('M' . $rowCount, $element['status']);
                        $sheet->setCellValue('N' . $rowCount, $element['lo_state']);
                        $sheet->setCellValue('O' . $rowCount, $element['lo_district']);
                        $sheet->setCellValue('P' . $rowCount, $element['lo_gapa_napa']);
                        $sheet->setCellValue('Q' . $rowCount, $element['lo_ward']);
                        $sheet->setCellValue('R' . $rowCount, $element['lo_land_lac_ward']);
                        $sheet->setCellValue('S' . $rowCount, $element['lo_temp_address']);
                        $sheet->setCellValue('T' . $rowCount, $element['lo_house_no']);
                        $sheet->setCellValue('U' . $rowCount, $element['lo_tol']);
                        $sheet->setCellValue('V' . $rowCount, $element['lo_temp_state']);
                        $sheet->setCellValue('W' . $rowCount, $element['lo_temp_dis']);
                        $sheet->setCellValue('X' . $rowCount, $element['lo_temp_gapanapa']);
                        $sheet->setCellValue('Y' . $rowCount, $element['lo_czn_no']);
                        $sheet->setCellValue('Z' . $rowCount, $element['lo_pan_no']);
                        $sheet->setCellValue('AA' . $rowCount, $element['lo_temp_ward']);
                        $sheet->setCellValue('AB' . $rowCount, $element['lo_temp_tol']);
                        $sheet->setCellValue('AC' . $rowCount, $element['lo_temp_house_no']);
                        $sheet->setCellValue('AD' . $rowCount, $element['lo_fi_state']);
                        $sheet->setCellValue('AE' . $rowCount, $element['lo_fi_district']);
                        $sheet->setCellValue('AF' . $rowCount, $element['lo_fi_gapa_napa']);
                        $sheet->setCellValue('AG' . $rowCount, $element['lo_fi_ward']);
                        $sheet->setCellValue('AH' . $rowCount, $element['lo_fi_relation']);
                        $sheet->setCellValue('AI' . $rowCount, $element['lo_fi_name']);
                        $sheet->setCellValue('AJ' . $rowCount, $element['lo_fi_date']);
                        $sheet->setCellValue('AK' . $rowCount, $element['added_by']);
                        $sheet->setCellValue('AL' . $rowCount, $element['added_on']);
                        $sheet->setCellValue('AM' . $rowCount, $element['modified_on']);
                        $sheet->setCellValue('AO' . $rowCount, $element['modified_by']);
                        $rowCount++;
                    }
                    $writer = new Xlsx($spreadsheet);
                    $filename = 'जग्गाधनी-प्रोफाइल-'.convertDate(date('Y-m-d'));
                    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output'); // download file
                } else {
                    $this->session->set_flashdata('MSG_EMP','Cannot Export Data');
                    redirect('ExportData');
                }
            }
        }
    }

    public function ExportFamilyDetails() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getFamailyDetails($fiscal_year, $month);
            
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }

            if(!empty($data)) {
                $id =array();
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdateFamailyDetails($id);
                if($result) {
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $rowCount = 1;
                foreach ($data as $element) {
                    $sheet->setCellValue('A' . $rowCount, $element['member_name']);
                    $sheet->setCellValue('B' . $rowCount, $element['member_age']);
                    $sheet->setCellValue('C' . $rowCount, $element['member_relation']);
                    $sheet->setCellValue('D' . $rowCount, $element['profile_file_no']);
                    $sheet->setCellValue('E' . $rowCount, $element['added_on']);
                    $sheet->setCellValue('F' . $rowCount, $element['added_by']);
                    $rowCount++;
                }
                $writer = new Xlsx($spreadsheet);
                $filename = 'जग्गाधनी-पारिबार-'.convertDate(date('Y-m-d'));
                $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');
                $writer->save('php://output'); // download file
            } else {
                $this->session->set_flashdata('MSG_EMP','Cannot Export Data');
                redirect('ExportData');
            }
        }
        }
    }

    public function ExportLandDetails() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getLandDetails($fiscal_year, $month);
            //pp($data);
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }

            if(!empty($data)) {
                $id =array();
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdateLandDetails($id);
                if($result) {

                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $rowCount = 1;
                    foreach ($data as $element) {
                        $sheet->setCellValue('A' . $rowCount, $element['old_gapa_napa']);
                        $sheet->setCellValue('B' . $rowCount, $element['old_ward']);
                        $sheet->setCellValue('C' . $rowCount, $element['present_gapa_napa']);
                        $sheet->setCellValue('D' . $rowCount, $element['present_ward']);
                        $sheet->setCellValue('E' . $rowCount, $element['road_name']);
                        $sheet->setCellValue('F' . $rowCount, $element['land_area_type']);
                        $sheet->setCellValue('G' . $rowCount, $element['nn_number']);
                        $sheet->setCellValue('H' . $rowCount, $element['k_number']);
                        $sheet->setCellValue('I' . $rowCount, $element['a_ropani']);
                        $sheet->setCellValue('J' . $rowCount, $element['a_ana']);
                        $sheet->setCellValue('K' . $rowCount, $element['a_paisa']);
                        $sheet->setCellValue('L' . $rowCount, $element['a_dam']);
                        $sheet->setCellValue('M' . $rowCount, $element['a_unit']);
                        $sheet->setCellValue('N' . $rowCount, $element['total_square_feet']);
                        $sheet->setCellValue('O' . $rowCount, $element['min_land_rate']);
                        $sheet->setCellValue('P' . $rowCount, $element['max_land_rate']);
                        $sheet->setCellValue('Q' . $rowCount, $element['k_land_rate']);
                        $sheet->setCellValue('R' . $rowCount, $element['t_rate']);
                        $sheet->setCellValue('S' . $rowCount, $element['fiscal_year']);
                        $sheet->setCellValue('T' . $rowCount, $element['ld_file_no']);
                        $sheet->setCellValue('U' . $rowCount, $element['added_by']);
                        $sheet->setCellValue('V' . $rowCount, $element['added_on']);
                        $sheet->setCellValue('W' . $rowCount, $element['modified_by']);
                        $sheet->setCellValue('X' . $rowCount, $element['modified_on']);
                        $rowCount++;
                    }
                    //जग्गाको विवरण
                    $writer = new Xlsx($spreadsheet);
                    $filename = 'जग्गाको-विवरण-'.convertDate(date('Y-m-d'));
                    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output'); // download file
                } else {
                    $this->session->set_flashdata('MSG_EMP','Cannot Export Data');
                    redirect('ExportData');
                }
            }
        }
    }

    public function ExportSanrachanaDetails() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getSanrachanaDetails($fiscal_year, $month);
            //pp($data);
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }

            if(!empty($data)) {
                $id =array();
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdateSanrachanaDetails($id);
                if($result) {
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $rowCount = 1;
                    foreach ($data as $element) {
                        $sheet->setCellValue('A' . $rowCount, $element['k_no']);
                        $sheet->setCellValue('B' . $rowCount, $element['toal_land_area']);
                        $sheet->setCellValue('C' . $rowCount, $element['total_land_area_sqft']);
                        $sheet->setCellValue('D' . $rowCount, $element['total_land_min_amount']);
                        $sheet->setCellValue('E' . $rowCount, $element['total_land_tax_amount']);
                        $sheet->setCellValue('F' . $rowCount, $element['sanrachana_n_no']);
                        $sheet->setCellValue('G' . $rowCount, $element['sanrachana_prakar']);
                        $sheet->setCellValue('H' . $rowCount, $element['sanrachana_banot_kisim']);
                        $sheet->setCellValue('I' . $rowCount, $element['sanrachana_usages']);
                        $sheet->setCellValue('J' . $rowCount, $element['sanrachana_floor']);
                        $sheet->setCellValue('K' . $rowCount, $element['sanrachana_ground_lenth']);
                        $sheet->setCellValue('L' . $rowCount, $element['sanrachana_ground_width']);
                        $sheet->setCellValue('M' . $rowCount, $element['sanrachana_ground_area_sqft']);
                        $sheet->setCellValue('N' . $rowCount, $element['sanrachana_ground_housing_area_sqft']);
                        $sheet->setCellValue('O' . $rowCount, $element['contructed_year']);
                        $sheet->setCellValue('P' . $rowCount, $element['sanrachana_dep_rate']);
                        $sheet->setCellValue('Q' . $rowCount, $element['sanrachana_min_amount']);
                        $sheet->setCellValue('R' . $rowCount, $element['sanrachana_kubul_amount']);
                        $sheet->setCellValue('S' . $rowCount, $element['sanrachana_khud_amount']);
                        $sheet->setCellValue('T' . $rowCount, $element['sanrachana_ground_area_ropani']);
                        $sheet->setCellValue('U' . $rowCount, $element['sanrachana_land_tax_amount']);
                        $sheet->setCellValue('V' . $rowCount, $element['net_tax_amount']);
                        $sheet->setCellValue('W' . $rowCount, $element['ls_file_no']);
                        $sheet->setCellValue('X' . $rowCount, $element['added_on']);
                        $sheet->setCellValue('Y' . $rowCount, $element['added_by']);
                        $sheet->setCellValue('Z' . $rowCount, $element['modified_on']);
                        $sheet->setCellValue('AA' . $rowCount, $element['modified_by']);
                        $sheet->setCellValue('AB' . $rowCount, $element['r_bhumi_area']);
                        $sheet->setCellValue('AC' . $rowCount, $element['r_bhumi_kar']);
                        $sheet->setCellValue('AD' . $rowCount, $element['fiscal_year']);
                        $rowCount++;
                    }
                    $writer = new Xlsx($spreadsheet);
                    $filename = 'भोतिक-संरचनाको-विवरण-'.convertDate(date('Y-m-d'));
                    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output'); // download file
                } else {
                    $this->session->set_flashdata('MSG_EMP','Cannot Export Data');
                    redirect('ExportData');
                }
            }
        }
    }

    public function ExportBDetails() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getBDetails($fiscal_year, $month);
            //pp($data);
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }

            if(!empty($data)) {
                $id =array();
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdateBDetails($id);
                if($result) {
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $rowCount = 1;
                    foreach ($data as $element) {
                        $sheet->setCellValue('A' . $rowCount, $element['fiscal_year']);
                        $sheet->setCellValue('B' . $rowCount, $element['total_t_amount']);
                        $sheet->setCellValue('C' . $rowCount, $element['bhumi_kar']);
                        $sheet->setCellValue('D' . $rowCount, $element['lb_file_no']);
                        $sheet->setCellValue('E' . $rowCount, $element['added_on']);
                        $sheet->setCellValue('F' . $rowCount, $element['added_by']);
                        $sheet->setCellValue('G' . $rowCount, $element['modified_on']);
                        $sheet->setCellValue('H' . $rowCount, $element['modified_by']);
                        $rowCount++;
                    }
                    $writer = new Xlsx($spreadsheet);
                    $filename = 'बक्यौता-विवरण-'.convertDate(date('Y-m-d'));
                    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output'); // download file
                } else {
                    $this->session->set_flashdata('MSG_EMP','Cannot Export Data');
                    redirect('ExportData');
                }
            }
        }
    }

    public function ExportSampatiKarDetails() {
        if($this->input->post('Submit')) {
            $fiscal_year = $this->input->post('n_fiscal_year');
            $month = $this->input->post('n_month');
            if(empty($fiscal_year) && empty($month)) {
                $this->session->set_flashdata('MSG_EMP','invalid data format ');
                redirect('ExportData');
            }
            $data = $this->ExportDataModel->getsampatiKarDetails($fiscal_year, $month);
            //pp($data);
            if(empty($data)) {
                $this->session->set_flashdata('MSG_EMP','पहिले नै निर्यात गरिएको छ');
                redirect('ExportData');
            }

            if(!empty($data)) {
                $id =array();
                foreach ($data as $key => $value) {
                   $id[] = $value['id'];
                }
                $result = $this->ExportDataModel->UpdatesampatiKarDetails($id);
                if($result) {
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $rowCount = 1;
                    foreach ($data as $element) {
                        $sheet->setCellValue('A' . $rowCount, $element['nb_file_no']);
                        $sheet->setCellValue('B' . $rowCount, $element['bill_no']);
                        $sheet->setCellValue('C' . $rowCount, $element['saranchana_ko_kar_amount']);
                        $sheet->setCellValue('D' . $rowCount, $element['saranchana_ko_sampti_kar']);
                        $sheet->setCellValue('E' . $rowCount, $element['saranchana_ko_charckeko_kar_amount']);
                        $sheet->setCellValue('F' . $rowCount, $element['saranchana_ko_charcheko_bhumi_kar']);
                        $sheet->setCellValue('G' . $rowCount, $element['total_land_area_kar_amount']);
                        $sheet->setCellValue('H' . $rowCount, $element['other_amount']);
                        $sheet->setCellValue('I' . $rowCount, $element['discount_amount']);
                        $sheet->setCellValue('J' . $rowCount, $element['khud_amount']);
                        $sheet->setCellValue('k' . $rowCount, $element['bakeyuta_amount']);
                        $sheet->setCellValue('L' . $rowCount, $element['fine_amount']);
                        $sheet->setCellValue('M' . $rowCount, $element['recieved_amount']);
                        $sheet->setCellValue('N' . $rowCount, $element['retruned_amount']);
                        $sheet->setCellValue('O' . $rowCount, $element['net_total_amount']);
                        $sheet->setCellValue('P' . $rowCount, $element['added_by']);
                        $sheet->setCellValue('Q' . $rowCount, $element['added_ward']);
                        $sheet->setCellValue('R' . $rowCount, $element['added_on']);
                        $sheet->setCellValue('S' . $rowCount, $element['billing_date']);
                        $sheet->setCellValue('T' . $rowCount, $element['print_count']);
                        $sheet->setCellValue('U' . $rowCount, $element['modified_on']);
                        $sheet->setCellValue('V' . $rowCount, $element['modified_by']);
                        $sheet->setCellValue('W' . $rowCount, $element['fiscal_year']);
                        $sheet->setCellValue('X' . $rowCount, $element['status']);
                        $rowCount++;
                    }
                    $writer = new Xlsx($spreadsheet);
                    $filename = 'सम्पतिकर-भूमिकर-रसिद-'.convertDate(date('Y-m-d'));
                    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output'); // download file
                } else {
                    $this->session->set_flashdata('MSG_EMP','Cannot Export Data');
                    redirect('ExportData');
                }
            }
        }
    }
}