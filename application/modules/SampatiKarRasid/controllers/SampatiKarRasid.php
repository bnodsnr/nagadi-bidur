<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class SampatiKarRasid extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_code = 'SAMPATI-RASID';
        $this->load->model("CommonModel");
        $this->load->model("SampatiKarRasidModel");
        $this->fy = current_fiscal_year();
        $this->recently_closed_fy = recently_closed_fy();
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
    {}
    public function getBRateByFiscalYear() {
        $fiscal_year = $this->input->post('fiscal_year');
        $total_t_tax = $this->input->post('total_t_tax');
        $data = $this->SampatiKarRasidModel->getSampatiKarAmount($total_t_tax,$fiscal_year);
        echo $data['sampati_kar'];
    }

    public function saveBaAmount() {
        $fiscal_year = $this->input->post('fiscal_year');
        $lo_file_no = $this->input->post('file_no');
        $total_t_tax = $this->input->post('total_t_tax');
        $bhumi_kar = $this->input->post('bhumi_kar');
        $details = array();
        foreach ($fiscal_year as $key => $indexv) {
          $details[] = array(
              'fiscal_year'               => $fiscal_year[$key],
              'total_t_amount'                => $total_t_tax[$key],
              'bhumi_kar'           => $bhumi_kar[$key],
              'lb_file_no'           => $lo_file_no,
          );
        }
        $this->SampatiKarRasidModel->saveBADetails($details);
        $this->session->set_flashdata('MSG_SUCCESS','');
        redirect('SampatiKarRasid/addNewRasid/'.$lo_file_no);
    }
    /*
    |--------------------------------------------------------------------------
    | Bakayuta
    |--------------------------------------------------------------------------
    |
    | This add details of bakayuta and claculate the tax value for previous.
    */
    public function BakauytaDetails($fileNo = NULL) {
         if(empty($fileNo)) {
            show_404();
        }
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $data['fileNo'] = $fileNo;
            $data['fiscal_year'] = $this->CommonModel->getBFiscalYear();
            $data['land_owner_details'] = $this->SampatiKarRasidModel->getLandOwnerDetails($fileNo);
            $data['landdetails'] = $this->SampatiKarRasidModel->getBakayutaLandDetails($fileNo);
            $data['page'] = 'list_b_details';
            $this->load->view('main',$data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }


    public function BakayutaLandDetails($fileNo) {
        if(empty($fileNo)) {
            show_404();
        }
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")) {
            $data['oldwardaddress'] = $this->SampatiKarRasidModel->addressOld();
            $data['wardadrress']    = $this->SampatiKarRasidModel->oldWard();
            $data['roadtype']       = $this->CommonModel->getData('settings_road','DESC');
            $data['roadkisim']      = $this->CommonModel->getData('settings_road_type', 'DESC');
            $data['jaggaunit']      = $this->CommonModel->getData('settings_unit', 'DESC');
            $data['areatype']       = $this->CommonModel->getData('settings_land_area_type', 'DESC');
            $data['lo_details']     = $this->SampatiKarRasidModel->getLandOwnerDetails($fileNo);
            $data['fiscal_year']    = $this->CommonModel->getDepFiscalYear();
            $data['page'] = 'add_new_bakauyta';
            $this->load->view('main',$data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function addBakayutalSanrachanaDetails($fileNo) {
        $fileNo = $this->uri->segment(3);
        if(empty($fileNo)) {
          show_404();
        }
        $data['page'] = 'add_b_sanrachana_details';
        $data['landDescription']      = $this->SampatiKarRasidModel->getBakayutaLandDetails($fileNo);
        $data['year']                 = $this->CommonModel->getData('settings_year');
        $data['lo_details']           = $this->SampatiKarRasidModel->getLandOwnerDetailsByFileNo($fileNo);
        $data['architectstructure']   = $this->CommonModel->getData('settings_architect_structure', 'DESC');
        $data['architecttype'] = $this->CommonModel->getData('settings_architect_type', 'DESC');
        $this->load->view('main', $data);
    }

    //on ajax request get new address on request old address
    public function getNewAddress() {
        if($this->input->is_ajax_request()) {
            $gapana = $this->input->post('gapana');
            $ward = $this->input->post('ward');
            $fiscal_year = $this->input->post('fiscal_year');
            $data = $this->SampatiKarRasidModel->getNewAddressDetails($gapana,$ward);
            $road_option = "";
            $road_option .= "<option value=''>छान्नुहोस्</option>";
            $road['details'] = $this->SampatiKarRasidModel->getRoadDetails($ward, $fiscal_year);
            if(!empty($road['details'])) {
              foreach ($road['details'] as $key => $value) {
                $road_option .= "<option value = '".$value['id']."''>".$value['road_name']."</option>";
              }
            } else {
              $road_option .= "<option> Empty Road</option>";
            }
            $new_gapana = $data['present_name'];
            $new_ward = $data['present_ward'];
            $response = array(
              'status'      => 'success',
              'data'         => $data,
              'road_option' => $road_option,
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        } else {
            exit('no direct script allowed');
        }
       
    } 


    //get minimal cost
    public function getLandAreaCost() {
        if($this->input->is_ajax_request()) {
          $road_name = $this->input->post('road_name');
          $land_area_type = $this->input->post('land_area_type');
          $fiscal_year = $this->input->post('fiscal_year');
          $data = $this->SampatiKarRasidModel->getLandCost($road_name, $land_area_type, $fiscal_year);
          $response = array(
            'status'      => 'success',
            'data'         => $data,
          );
          header("Content-type: application/json");
          echo json_encode($response);
          exit;
        }
    }

    //save bakayta data
    public function saveBLandDetails() {
      $fiscal_year              = $this->input->post('fiscal_year');
      $old_gapa_napa            = $this->input->post('old_gapa_napa');
      $old_ward                 = $this->input->post('old_ward');
      $present_gapa_napa        = $this->input->post('present_gapa_napa');
      $present_ward             = $this->input->post('present_ward');
      $road_name                = $this->input->post('road_name');
      $land_area_type           = $this->input->post('land_area_type');
      $n_number                 = $this->input->post('nn_number');
      $k_number                 = $this->input->post('k_number');
      $a_ropani                 = $this->input->post('a_ropani');
      $a_paisa                  = $this->input->post('a_paisa');
      $a_ana                    = $this->input->post('a_ana');
      $a_dam                    = $this->input->post('a_dam');
      $a_unit                   = $this->input->post('a_unit');
      $total_square_feet        = $this->input->post('total_square_feet');
      $min_land_rate            = $this->input->post('min_land_rate');
      $max_land_rate            = $this->input->post('max_land_rate');
      $k_land_rate              = $this->input->post('k_land_rate');
      $t_rate                   = $this->input->post('t_rate');
      $ld_file_no               = $this->input->post('ld_file_no');
      $data['lo_details']       = $this->SampatiKarRasidModel->getLandOwnerDetailsByFileNo($ld_file_no);
      if($ld_file_no != $data['lo_details']['file_no']){
        exit('invalid file no');
      }
      $post_array = array(
        'old_gapa_napa'     =>$old_gapa_napa,
        'old_ward'          => $old_ward,
        'present_gapa_napa' =>$present_gapa_napa,
        'present_ward'      => $present_ward,
        'road_name'         => $road_name,
        'land_area_type'    => $land_area_type,
        'nn_number'         => $n_number,
        'k_number'          => $k_number,
        'a_ropani'          => $a_ropani,
        'a_paisa'           => $a_paisa,
        'a_ana'             => $a_ana,
        'a_dam'             => $a_dam,
        'a_unit'            => $a_unit,
        'total_square_feet' => $total_square_feet,
        'min_land_rate'     => $min_land_rate,
        'max_land_rate'     => $max_land_rate,
        'k_land_rate'       => $k_land_rate,
        't_rate'            => $t_rate,
        'ld_file_no'        => $ld_file_no,
        'fiscal_year'       => $fiscal_year,
        'added_by'          => $this->session->userdata('PRJ_USER_ID'),
        'added_on'          => convertDate(date('Y-m-d')),
        'added_ip'      => $this->input->ip_address(),
      );
      //pp($post_array);
      $result = $this->SampatiKarRasidModel->saveLandDescription($post_array);
      if($result) {
        $this->session->set_flashdata('MSG_SUCCESS','प्रोफाइल सफलतापूर्वक सिर्जना गरियो
        ');
        redirect('SampatiKarRasid/BakauytaDetails/'.$ld_file_no);
      }
    }

    /**

    */
    public function GetCurrentLandDetails() {
        $current_value = $this->input->post('current_value');
        $file_no = $this->input->post('file_no');
        $land_details = $this->SampatiKarRasidModel->getLandDetails($file_no);
        pp($land_details);
    }

    /*
    on ajax call this function return sanrachana view
    @param NULL
    return view
    */
    public function addBakyauta() {
        $fileNo = $this->uri->segment(3);
        if(empty($fileNo)) {
          show_404();
        }
        $data['page'] = 'add_b';
        $data['fiscal_year'] = $this->CommonModel->getBFiscalYear();
        $this->load->view('main', $data);
    }

    /*
    On ajax call this function return kar details by fiscal year
    @param varchar fiscal year
    @param varchar file number
    return array 
    */
    public function getBakayutaDescription(){
        if($this->input->is_ajax_request()) {
            $fiscal_year                = $this->input->post('fiscal_year');
            $fileNo                     = $this->input->post('file_no');
            $total_area = 0;
            $total_kar_amount = 0;
            $sampati_kar = 0;
            $house_rate = 0;
            $r_area = 0;
            $data['landDescription']    = $this->SampatiKarRasidModel->getBillBakayutaLandDetails($fileNo,$fiscal_year);
            if(!empty($data['landDescription'])) {
                foreach ($data['landDescription'] as $key => $value) {

                    $sanrachana_details = $this->SampatiKarRasidModel->getBSanrachanaDetailsByKNo($value['k_number'],$value['fiscal_year']);
                    if(!empty($sanrachana_details)) {
                        foreach ($sanrachana_details as $key => $s) {
                           $house_rate = $s['net_tax_amount'];
                           $r_area = $s['r_bhumi_kar'];
                           
                        }
                    } else {
                        $total_kar_amount = $value['t_rate'];
                    } 
                }
            }
            $total_sampati_kar = $house_rate+$r_area+$total_kar_amount;
            $sampati_kar_rate = $this->SampatiKarRasidModel->getSampatiKarAmount($total_sampati_kar, $fiscal_year);
            $response = array(
                'status'            => 'success',
                'data'              => $total_sampati_kar,
                'kar_amount'        => $sampati_kar_rate,
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
    }

    //view details by kitta no
    public function viewLandDetailsByKNo($kno)
    {
        if(empty($kno)) {
            show_404();
        }
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")) {
            $data['landdetails'] = $this->SampatiKarRasidModel->getLandDetailsByKNo($kno);
         
            $data['page'] = 'land_details_k';
            $this->load->view('main',$data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    //invoice
    public function invoice() {
        $data['page'] = 'invoice';
        $this->load->view('main',$data);
    }


    /**
        * This function create bills
        * @param string $fileno
        * @return void
    */
    public function CreateBills($file_no) {
        if(empty($file_no)) {
            redirect('PresonalProfile');
        }
        $data['page']               = 'new/create_bill';
        if(current_fiscal_year() == $this->recently_closed_fy) {
            $data['Billsdetails']   = $this->SampatiKarRasidModel->GetProfileDetailsForBills($file_no);
        } else {
            $data['Billsdetails']   = $this->SampatiKarRasidModel->GetProfileDetailsForCurrentBills($file_no);
        }
        //pp($data['Billsdetails']);
        $data['buysell']            = $this->CommonModel->getWhereAll('buy_sell', array('seller_file_no' => $file_no));
        
        $data['bills']              = $this->CommonModel->getAllDataBySelectedFields('land_description_details','ld_file_no', $file_no);
        $data['set_bill']           = $this->SampatiKarRasidModel->checkBill();
        $data['bill_no']            = $this->SampatiKarRasidModel->getBillNo();
        $data['inactive_bill']       = $this->SampatiKarRasidModel->getInactiveBills();
        
        if(!empty($data[inactive_bill])) {
            if(!empty($data['set_bill']['bill_no'])) {
            if($data['set_bill']['bill_no'] == $data['inactive_bill']['bill_to']) {
                //$this->session->set_flashdata('MSG_WARNING','दिएको सबै रसिद प्रोयोग भएको हुनाले रसिद काट्न मिल्दैन [कृपया रसिद माग गर्नुहोस]');
                $data['bill'] = $data['bill_no']['bill_from'];
            } else {
                $data['bill'] = $data['set_bill']['bill_no'] + 1;
            }
        } else {
            $data['bill'] = $data['bill_no']['bill_from'];
        }
        } else {
           if(!empty($data['set_bill']['bill_no'])) {
            if($data['set_bill']['bill_no'] == $data['bill_no']['bill_to']) {
                //$this->session->set_flashdata('MSG_WARNING','दिएको सबै रसिद प्रोयोग भएको हुनाले रसिद काट्न मिल्दैन [कृपया रसिद माग गर्नुहोस]');
                $data['bill'] = '';
            } else {
                $data['bill'] = $data['set_bill']['bill_no'] + 1;
            }
        } else {
            $data['bill'] = $data['bill_no']['bill_from'];
        } 
        }
        
        // if($this->session->userdata('PRJ_USER_WARD') == 9 ) {
        //   pp($data['bill']);
        // }
        //pp($data['bill_no']);

        // $data['bill_range']         = $this->SampatiKarRasidModel->getBillRange();
        // $data['bill_range_1']       = $this->SampatiKarRasidModel->getBillRangeLast();

        // if($data['set_bill']['bill_no'] == $data['bill_range']['bill_to']) {
        //     if(empty($data['set_bill']['bill_no'])) {
        //         $data['bill']       = $data['bill_range_1']['bill_from'];
        //     } else {
        //         if($data['set_bill']['bill_no'] == $data['bill_range']['bill_to']) {
        //             $data['bill']   = $data['bill_range_1']['bill_from'];
        //         } else {
        //             $data['bill']   = $data['set_bill']['bill_no']+1;
        //         }
        //     }
        // } else {
        //     if(empty($data['set_bill']['bill_no'])) {
        //         $data['bill']  = $data['bill_range']['bill_from'];
        //     } else {
        //         $data['bill'] = $data['set_bill']['bill_no']+1;
        //     }
        // }
        $data['land_owner'] = $this->CommonModel->GetLandOwnerRowByFileNo($file_no);
        $this->load->view('main', $data);
    }

    /**
        * This function create bills
        * @param string $fileno
        * @return void
    */
    public function SaveBillDetails() {
        if($this->input->is_ajax_request()) {
            $bill_no                = $this->input->post('bill_no');
            $total_kar_amount       = $this->input->post('total_kar_amount');
            $other_amount           = $this->input->post('other_amount');
            $discount_amount        = $this->input->post('discount_amount');
            $fine_amount            = $this->input->post('fine_amount');
            $total_sum              = $this->input->post('total_sum');
            $net_total_amount       = $this->input->post('net_total_amount');
            $bakeyuta_amount        = $this->input->post('bakeyuta_amount');;
            $nb_file_no             = $this->input->post('nb_file_no');
            $customer_id            = $this->input->post('customer_id');
            $recieved_amount        = $this->input->post('recieved_amount');
            $return_amount          = $this->input->post('return_amount');
            $due_amount             = $this->input->post('due_amount');
            $sampati_bakeyuta_date  = $this->input->post('sampati_bakeyuta_date');
            $bhumi_bakeyuta_amount  = $this->input->post('bhumi_bakeyuta_amount');
            $bhumi_bakeyuta_date    = $this->input->post('bhumi_bakeyuta_date');
            $sampati_kar            = $this->input->post('sampati_kar');
            $nb_file_no             = $this->input->post('nb_file_no');
            $bhumi_kar              = $this->input->post('bhumi_kar');
            $this->form_validation->set_rules('bill_no', 'Bill No','required');
            $this->form_validation->set_rules('net_total_amount','Toatal', 'required');
            $this->form_validation->set_rules('recieved_amount', 'Receive amount ', 'required');
            $checkBill = $this->SampatiKarRasidModel->checkBillNoExits($bill_no);
            if($checkBill == 1) {
                $response = array(
                    'status'      => 'error',
                    'message'     => 'बिल नं दोहोरिएको हुनाले सफल हुन सकेन!!',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }

            if($this->form_validation->run() == false) {
                $response = array(
                    'status'      => 'validation_error',
                    'message'     => '* चिन्न लागेको फारम खाली भएको हुनाले सभे गर्न असफल',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            if($recieved_amount < $net_total_amount) {
                $response = array(
                    'status'      => 'error',
                    'message'     => 'प्राप्त रकम फिर्ता रकम भन्दा कम हुन सक्दैन',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }

            // if($recieved_amount != $net_total_amount) {
            //     $response = array(
            //         'status'      => 'error',
            //         'message'     => 'प्राप्त रकम कुल रकम भन्दा कम हुन सक्दैन',
            //     );
            //     header("Content-type: application/json");
            //     echo json_encode($response);
            //     exit;
            // }
            
            $post_array = array(
                'nb_file_no'                            => $this->input->post('nb_file_no'),
                'bill_no'                               => $this->input->post('bill_no'),
                'saranchana_ko_kar_amount'              => '',
                'saranchana_ko_sampti_kar'              => '',
                'saranchana_ko_charckeko_kar_amount'    => '',
                'saranchana_ko_charcheko_bhumi_kar'     =>'',
                'total_land_area_kar_amount'            => '', 
                'bakeyuta_amount'                       => $bakeyuta_amount,
                'other_amount'                          => !empty($other_amount) ? $other_amount:0,
                'discount_amount'                       => !empty($discount_amount) ? $discount_amount:0,
                'khud_amount'                           => !empty($khud_amount) ? $khud_amount:0,
                'fine_amount'                           => $fine_amount, 
                'recieved_amount'                       => $recieved_amount, 
                'retruned_amount'                       => $return_amount,
                'sampati_kar'                           => $sampati_kar,
                'bhumi_kar'                             => $bhumi_kar,
                'net_total_amount'                      => $net_total_amount,
                'due_amount'                            => $due_amount,
                 'sampati_baykeuta_date'                => $sampati_bakeyuta_date,
                'bhumi_baykeuta_amount'                 => $bhumi_bakeyuta_amount,
                'bhumi_bakeuta_date'                    => $bhumi_bakeyuta_date,
                'added_by'                              => $this->session->userdata('PRJ_USER_ID'),
                'added_ward'                            => $this->session->userdata('PRJ_USER_WARD'), 
                'added_on'                              => convertDate(date('Y-m-d')),
                'billing_date'                          => convertDate(date('Y-m-d')),
                'print_count'                           => 1, 
                'modified_on'                           => '', 
                'modified_by'                           => '', 
                'fiscal_year'                           => $this->fy, 
                'status'                                => 1,
            );
            $result = $this->SampatiKarRasidModel->insertBillDetails($post_array);
            if($result) {
                $flag       = array('current_flag'  => 1);
                $land_flag = array('current_flag'   => 1, 'current_voucher_id' => $this->input->post('bill_no') );

                $this->CommonModel->updateDataByField('land_owner_profile_basic','file_no',$nb_file_no,$flag);//update profile flag

                $this->SampatiKarRasidModel->updateCurrentLandDetails($nb_file_no, $land_flag); //update land flag
                $has_sanrachana = $this->SampatiKarRasidModel->checkHasSanrachana($nb_file_no);
                if($has_sanrachana == 1) {
                    $this->CommonModel->updateData->updateDataByField('sanrachana_details','ls_file_no',$nb_file_no,$flag);
                }
                $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                        'message'     => 'redirect',
                        'redirect_url'    => base_url().'SampatiKarRasid/printPreview/'.$bill_no
                );
              header("Content-type: application/json");
              echo json_encode($response);
              exit;
            } else {
               $response = array(
                        'status'      => 'fail',
                        'data'         => "oops you got an error",
                );
              header("Content-type: application/json");
              echo json_encode($response);
              exit;
            }
        }
    }

    public function printPreview($bill_no) {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            if($this->fy == recently_closed_fy()) {
                $fiscal_year = recently_closed_fy();
            } else {
                $fiscal_year = $this->fy;
            }
            $profile                        = $this->CommonModel->getWhere('sampati_kar_bhumi_kar_bill_details', array('bill_no' => $bill_no, 'fiscal_year' => $fiscal_year));
            $fileNo                         = $profile['nb_file_no'];
            $data['land_owner_details']     = $this->SampatiKarRasidModel->getLandOwnerDetails($fileNo);
            $data['state']                  = $this->CommonModel->getDataByID('provinces', $data['land_owner_details']['lo_state']);
            $data['district']               = $this->CommonModel->getDataByID('settings_district', $data['land_owner_details']['lo_district']);
            $data['gapa']                   = $this->CommonModel->getDataByID('settings_vdc_municipality', $data['land_owner_details']['lo_gapa_napa']);
            $data['land_details']           = $this->SampatiKarRasidModel->getLandDetails($fileNo);
            $data['bill_details']           = $this->SampatiKarRasidModel->getTotalBillAmount($fileNo);
            $data['user']                   = $this->CommonModel->getCurrentUser($this->session->userdata('PRJ_USER_ID'));
            $data['billcount']              = $this->SampatiKarRasidModel->totalSamptiKarBillDetails();
            if(current_fiscal_year() == $this->recently_closed_fy) {
                $data['Billsdetails']           = $this->SampatiKarRasidModel->getPrintPreview($bill_no, $fileNo);
            } else {
                $data['Billsdetails']           = $this->SampatiKarRasidModel->getCurrentPrintPreview($bill_no, $fileNo);
            }
            
            //pp($data['BillsDetails']);
            $data['lastFyBillNo']           = $this->CommonModel->getWhere('sampati_kar_bhumi_kar_bill_details',array('fiscal_year' => $this->recently_closed_fy,'nb_file_no' => $fileNo ));

            $data['kar_details']            = $this->SampatiKarRasidModel->getTotalBillPreview($bill_no);


            if($data['kar_details']['status'] == 2){
            $data['cancel_reason'] = $this->CommonModel->getDataBySelectedFields('sampati_rasid_cancel_reason','bill_no', $data['kar_details']['bill_no']);
            }
            
            $data['buysell']            = $this->CommonModel->getWhereAll('buy_sell', array('seller_file_no' => $file_no));
            
            $this->load->view('new/new_bills', $data);
        } else {
            redirect('dashboard');
        }
    }


    /**
       *  @this function show bills
    */
    public function viewRasid($file_no){
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $bill_no                        = $this->CommonModel->getDataBySelectedFields('sampati_kar_bhumi_kar_bill_details', 'nb_file_no', $file_no);
            $billNo                         = $bill_no['bill_no'];
            $data['land_owner_details']     = $this->SampatiKarRasidModel->getLandOwnerDetails($file_no);
            $data['state']                  = $this->CommonModel->getDataByID('provinces', $data['land_owner_details']['lo_state']);
            $data['district']               = $this->CommonModel->getDataByID('settings_district', $data['land_owner_details']['lo_district']);
            $data['gapa']                   = $this->CommonModel->getDataByID('settings_vdc_municipality', $data['land_owner_details']['lo_gapa_napa']);
            $data['land_details']           = $this->SampatiKarRasidModel->getLandDetails($file_no);
            $data['bill_details']           = $this->SampatiKarRasidModel->getTotalBillAmount($file_no);//bill details by file number
            //pp($data['bill_details']);
            $data['user']                   = $this->CommonModel->getCurrentUser($this->session->userdata('PRJ_USER_ID'));
            $data['billcount']              = $this->SampatiKarRasidModel->totalSamptiKarBillDetails();
            
            $data['lastFyBillNo']           = $this->CommonModel->getWhere('sampati_kar_bhumi_kar_bill_details',array('fiscal_year' => $this->recently_closed_fy,'nb_file_no' => $file_no ));

            $data['kar_details']            = $this->SampatiKarRasidModel->getTotalBillPreview($billNo);
            //pp($data['kar_details']);
            $data['page']                   = 'new/view_rasid';
            $this->load->view('main', $data);
        } else {
            redirect('dashboard');
        }
    }

    //view rasid
    public function viewBills() {
        $data['page'] = 'new/list_bills';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $this->load->view('main', $data);
    }

   /**
        * This function on ajaxcall load server side data into datatable
        * @param  NULL
        * @return json 
   */
    public function GetBills() 
    {
      if($this->input->is_ajax_request()) {
        $columns = array( 
            0   => 'id', 
            1   => 'nb_file_no',
            2   => 'bill_no',
        );

          $limit                  = $this->input->post('length');
          $start                  = $this->input->post('start');
          $org_file_no            = $this->input->post('file_no');
          $bill_no                = $this->input->post('bill_no');
          $from_date              = $this->input->post('from_date');
          $to_date                = $this->input->post('to_date');
          $status                 = $this->input->post('status');
          $fiscal_year            = $this->input->post('fiscal_year');
          
          $order                  = $columns[$this->input->post('order')[0]['column']];
          $dir                    = $this->input->post('order')[0]['dir'];
          $totalData              = $this->SampatiKarRasidModel->CountBills($org_file_no,$bill_no,$from_date,$to_date, $status,$fiscal_year);
          $totalFiltered          = $totalData;
          $posts                  = $this->SampatiKarRasidModel->GetAllBills($limit,$start,$order,$dir, $org_file_no,$bill_no,$from_date,$to_date, $status,$fiscal_year);
         
          $data           = array();
          if(!empty($posts))
          {
              $i = 1;
              foreach ($posts as $post)
              {
                    $nestedData['sn']                   = $this->mylibrary->convertedcit($i++);
                    $nestedData['id']                   = $post->id;
                    $nestedData['nb_file_no']           = $this->mylibrary->convertedcit($post->nb_file_no);
                    $nestedData['nb_file_no_en']        = $post->nb_file_no;
                    $nestedData['nb_fiscal_year']       = str_replace("/", '-', $post->fiscal_year);
                    $nestedData['bill_no']              = $this->mylibrary->convertedcit($post->bill_no);
                    $nestedData['bill_no_en']           = $post->bill_no;
                    $nestedData['sampati_kar']          = $this->mylibrary->convertedcit($post->sampati_kar);
                    $nestedData['bhumi_kar']            = $this->mylibrary->convertedcit($post->bhumi_kar);
                    $nestedData['net_total_amount']     = $this->mylibrary->convertedcit($post->net_total_amount);
                    $nestedData['other_amount']         = $this->mylibrary->convertedcit($post->other_amount);
                    $nestedData['discount_amount']      = $this->mylibrary->convertedcit($post->discount_amount);
                    $nestedData['bakeyuta_amount']      = $this->mylibrary->convertedcit($post->bakeyuta_amount);
                    $nestedData['fine_amount']          = $this->mylibrary->convertedcit($post->fine_amount);
                    $nestedData['billing_date']         = $this->mylibrary->convertedcit($post->billing_date);
                    $nestedData['fiscal_year']          = $this->mylibrary->convertedcit($post->fiscal_year);
                    $nestedData['land_owner_name_np']   = $this->mylibrary->convertedcit($post->land_owner_name_np);
                    if($post->status == 1 ) {
                        $nestedData['status'] ="सदर";
                    } else {
                        $nestedData['status'] ="बदर";
                    }
                    $nestedData['user_name']            = $post->name;
                    $check_if_bill_exits = check_tax_pax_for_current_fiscal_year($post->nb_file_no, get_current_fiscal_year());
                 
                  if($check_if_bill_exits == TRUE) {
                    $nestedData['is_paid'] = 'Paid';
                  } else {
                    $nestedData['is_paid'] = 'Not Paid';
                  }
                  $data[] = $nestedData;
              }
          }
          $json_data = array(
                      "draw"            => intval($this->input->post('draw')),  
                      "recordsTotal"    => intval($totalData),                    "recordsFiltered" => intval($totalFiltered), 
                      "data"            => $data   
                      );
          echo json_encode($json_data);
      } else {
          exit('HTTPS!!');
      }
    }
    public function GetSearchList($org_file_no= NULL, $bill_no = NULL, $from_date=NULL,$to_date=NULL, $status =NULL, $fiscal_year = NULL, $land_owner =NULL) {
        if($this->input->is_ajax_request()) {
            $org_file_no            = $this->input->post('file_no');
            $bill_no                = $this->input->post('bill_no');
            $from_date              = $this->input->post('from_date');
            $to_date                = $this->input->post('to_date');
            $status                 = $this->input->post('status');
            $fiscal_year            = $this->input->post('fiscal_year');
            $land_owner             = $this->input->post('land_owner');
            $data                   = $this->SampatiKarRasidModel->GetSearchList($org_file_no, $bill_no , $from_date,$to_date, $status , $fiscal_year , $land_owner);
            pp($data);
        }
     }

    /**
        * This function load cancel forms
        * @param NULL
        * @return void
    */
    public function CancelBill() {
        $bill_id = $this->input->post('id');
        $data['billdetails'] = $this->CommonModel->getDataByID('sampati_kar_bhumi_kar_bill_details', $bill_id);
        $this->load->view('new/cancel_bill',$data);
    }

    /**
        * Call on ajax request cancel
        * @param form fields
        * @return NULL
     */
    public function save() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $file_no = $this->input->post('file_no');
            $this->form_validation->set_rules('id', 'रद्द गर्न कारण', 'required');
            $this->form_validation->set_rules('bill_no', 'रद्द गर्न कारण', 'required');
            $this->form_validation->set_rules('reason', 'रद्द गर्न कारण', 'required');
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
                'bill_no'       => $this->input->post('bill_no'),
                'reason'        => $this->input->post('reason'),
                'date'          => convertDate(date('Y-m-d')),
                'canceled_by'   => $this->session->userdata('PRJ_USER_ID'),
                'ip_address'    => $this->input->ip_address(),
            );
            $result = $this->CommonModel->insertData('sampati_rasid_cancel_reason',$post_data);
            if($result) {
                $update_data    = array('status' => 2);
                $profile_data   = array('current_flag' => 0);
                $land_data      = array('current_flag' => 0, 'current_voucher_id'=> 0);
                $this->SampatiKarRasidModel->updateBillStatus($id, $update_data);
                $this->SampatiKarRasidModel->updateProfileDetailsOnBillCancle($file_no, $profile_data);
                $this->SampatiKarRasidModel->updateLandDetailsOnBillCancle($file_no, $land_data);
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } 
        } else {
            exit('no direct script allowed');
        }
    }
   
    /**
        * Call on ajax request
        * save fiscal year
        * @return NULL
     */
    public function saveMalpot() {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('from_year', 'from year', 'required');
            $this->form_validation->set_rules('to_year', 'to year', 'required');
            $this->form_validation->set_rules('rate', 'rate', 'required');
            $this->form_validation->set_rules('file_no', 'file_no', 'required');
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
                'fiscal_year'       => get_current_fiscal_year(),
                'from_year'         => $this->input->post('from_year'),
                'to_year'           => $this->input->post('to_year'),
                'rate'              => $this->input->post('rate'),
                'file_no'              => $this->input->post('file_no'),
                'added_by'          => $this->session->userdata('PRJ_USER_ID'),
                'added_on'          => convertDate(date('Y-m-d'))
            );
            $result = $this->CommonModel->insertData('malpot_kar',$post_data);
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
        } else {
            exit('no direct script allowed');
        }
    }

    //view cancel reason
    public function viewReason() {
        if($this->input->is_ajax_request()) {
            $data['pageTitle'] = "रद्ध गर्नुको कारण";
            $bill_no = $this->input->post('id');
            $data['reason'] = $this->CommonModel->getDataBySelectedFields('sampati_rasid_cancel_reason', 'bill_no', $bill_no);
            $this->load->view('new/view_reason', $data);

        } else {
            exit('no direct script allowed!!!');
        }
    }

    public function viewCancelBills() {
        $data['lists'] = $this->SampatiKarRasidModel->getCancelBills();
        $data['page']  = 'new/view_cancel_bills';
        $this->load->view('main', $data);
    }

    public function previewCancelBill($bill_no) {
         if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $profile                        = $this->CommonModel->getDataBySelectedFields('sampati_kar_bhumi_kar_bill_details', 'bill_no', $bill_no);
            $fileNo                         = $profile['nb_file_no'];
            $data['land_owner_details']     = $this->SampatiKarRasidModel->getLandOwnerDetails($fileNo);
            $data['state']                  = $this->CommonModel->getDataByID('provinces', $data['land_owner_details']['lo_state']);
            $data['district']               = $this->CommonModel->getDataByID('settings_district', $data['land_owner_details']['lo_district']);
            $data['gapa']                   = $this->CommonModel->getDataByID('settings_vdc_municipality', $data['land_owner_details']['lo_gapa_napa']);
            $data['land_details']           = $this->SampatiKarRasidModel->getLandDetails($fileNo);
            $data['bill_details']           = $this->SampatiKarRasidModel->getTotalBillAmount($fileNo);
            $data['user']                   = $this->CommonModel->getCurrentUser($this->session->userdata('PRJ_USER_ID'));
            $data['billcount']              = $this->SampatiKarRasidModel->totalSamptiKarBillDetails();
            $data['Billsdetails']           = $this->SampatiKarRasidModel->GetCancelBillDetails($bill_no);
            $data['kar_details']            = $this->SampatiKarRasidModel->getTotalBillPreview($bill_no);
            if($data['kar_details']['status'] == 2){
            $data['cancel_reason'] = $this->CommonModel->getDataBySelectedFields('sampati_rasid_cancel_reason','bill_no', $data['kar_details']['bill_no']);
            }
            $this->load->view('new/new_bills', $data);
        } else {
            redirect('dashboard');
        }
    }
    
    public function billPreview($bill_no, $file_no, $fiscal_year) {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $fy = str_replace("-", '/', $fiscal_year);
           // $profile                        = $this->CommonModel->getWhere('sampati_kar_bhumi_kar_bill_details', array('bill_no' => $bill_no, 'fiscal_year' => $fy));
            //$fileNo                         = $profile['nb_file_no'];
            $data['land_owner_details']     = $this->SampatiKarRasidModel->getLandOwnerDetails($file_no);
            $data['state']                  = $this->CommonModel->getDataByID('provinces', $data['land_owner_details']['lo_state']);
            $data['district']               = $this->CommonModel->getDataByID('settings_district', $data['land_owner_details']['lo_district']);
            $data['gapa']                   = $this->CommonModel->getDataByID('settings_vdc_municipality', $data['land_owner_details']['lo_gapa_napa']);
            $data['land_details']           = $this->SampatiKarRasidModel->getLandDetails($file_no);
            $data['bill_details']           = $this->CommonModel->getWhere('sampati_kar_bhumi_kar_bill_details',array('fiscal_year' => $fy,'bill_no' => $bill_no,'nb_file_no' => $file_no));
            $data['user']                   = $this->CommonModel->getCurrentUser($this->session->userdata('PRJ_USER_ID'));
            $data['billcount']              = $this->SampatiKarRasidModel->totalSamptiKarBillDetails();
            $data['landdetails']            = $this->SampatiKarRasidModel->getbillPreview($bill_no, $file_no, $fy);
            $data['kar_details']            = $this->CommonModel->getWhere('sampati_kar_bhumi_kar_bill_details',array('fiscal_year' => $fy,'bill_no' => $bill_no,'nb_file_no' => $file_no));
            $this->load->view('bills_preview', $data);
        } else {
            redirect('dashboard');
        }
    }

    //get new bills
    public function newPreviewBills($bill_no,$file_no,$fiscal_year) {
        $fy = str_replace("-", '/', $fiscal_year);
        $data['land_owner_details']     = $this->SampatiKarRasidModel->getLandOwnerDetails($file_no);
        $data['landdetails']            = $this->SampatiKarRasidModel->searchBills($bill_no,$file_no,$fy);
        $data['state']                  = $this->CommonModel->getDataByID('provinces', $data['land_owner_details']['lo_state']);
        $data['district']               = $this->CommonModel->getDataByID('settings_district', $data['land_owner_details']['lo_district']);
        $data['gapa']                   = $this->CommonModel->getDataByID('settings_vdc_municipality', $data['land_owner_details']['lo_gapa_napa']);
        $data['bill_details']           = $this->CommonModel->getWhere('sampati_kar_bhumi_kar_bill_details', array('fiscal_year' => $fy, 'bill_no' => $bill_no, 'nb_file_no' => $file_no));
        $data['user']                   = $this->CommonModel->getCurrentUser($this->session->userdata('PRJ_USER_ID'));
        $data['billcount']              = $this->SampatiKarRasidModel->totalSamptiKarBillDetails();
        $data['kar_details']            = $this->CommonModel->getWhere('sampati_kar_bhumi_kar_bill_details', array('fiscal_year' => $fy, 'bill_no' => $bill_no, 'nb_file_no' => $file_no));
        $this->load->view('bills_preview', $data);
    }
}//end of class
