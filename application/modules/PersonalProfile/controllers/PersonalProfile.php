<?php
/**
* created by php strom
 * Name: Binod Sunar
 * Date:2020/02/06 05:02 PM.
*/
class PersonalProfile extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->module_code = 'PROFILE';
    $this->load->model("CommonModel");
    $this->load->model("ProfileModel");
    if(!$this->authlibrary->IsLoggedIn()) {
      $this->session->set_userdata('return_url', current_url());
      redirect('Login','location');
    }
  }

/*
| -------------------------------------------------------------------
|  Land Owner Profile Details
| -------------------------------------------------------------------
*/
  public function Index() {
    if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
      $data['page'] = 'list_personal_profile';
      $this->load->view('main', $data);
    } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }

  //view land owner details
  public function CreateProfile() {
    if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
      $data['page']         = 'add_basic_profile';
      $data['fiscal_year']  = $this->CommonModel->getData('fiscal_year','DESC');
      $data['occupation']   = $this->CommonModel->getData('settings_job', 'DESC');
      $data['provinces']    = $this->CommonModel->getData('provinces', 'DESC');
      $data['districts']    = getDistricts();
      $data['ward']         = $this->CommonModel->getData('settings_ward', 'DESC');
      $data['nationality']  = $this->CommonModel->getData('settings_nationality', 'DESC');
      $data['rel']          = $this->CommonModel->getData('settings_relation', 'DESC');
      $data['gapana']       = get_gapanapa();
      $user                 = $this->session->userdata("PRJ_USER_ID");
      $data['users']        = $this->CommonModel->getCurrentUser($user);
      $this->load->view('main', $data);
    } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }

  public function saveLandBasicInfo() {
    if($this->input->is_ajax_request()) {
      /*------- land owner basic details--------------------------------*/
      $form_type                        = $this->input->post('form_type');
      $fiscal_year                      = $this->input->post('fiscal_year');
      $land_own_type                    = $this->input->post('land_own_type');
      $land_owner_name_np               = $this->input->post('land_owner_name_np');
      $land_owner_name_en               = $this->input->post('land_owner_name_en');
      $land_owner_father_name           = $this->input->post('land_owner_father_name');
      $land_owner_grandpa_name          = $this->input->post('land_owner_grandpa_name');
      $land_owner_occupation            = $this->input->post('land_owner_occupation');
      $land_owner_gender                = $this->input->post('land_owner_gender');
      $nationality                      = $this->input->post('nationality');
      $land_owner_email                 = $this->input->post('land_owner_email');
      $land_owner_contact_no            = $this->input->post('land_owner_contact_no');
      $land_owner_remarks               = $this->input->post('land_owner_remarks');
      /*-------------land on details------------------------------------------*/
      $lo_province                      = $this->input->post('lo_province');
      $lo_district_id                   = $this->input->post('lo_district_id');
      $lo_gapanapa                      = $this->input->post('lo_gapanapa');
      $lo_address_ward                  = $this->input->post('lo_address_ward');
      // $lo_land_ward                     = $this->input->post('lo_land_ward');
      $lo_temp_add                      = $this->input->post('lo_temp_add');
      $lo_house_no                      = $this->input->post('lo_house_no');
      $lo_tol                           = $this->input->post('lo_tol');
      $lo_file_no                       = $this->input->post('lo_file_no');
      $lo_land_lac_ward                 = $this->input->post('lo_land_ward');
      $lo_czn_no                        = $this->input->post('lo_czn_no');
      $lo_pan_no                        = $this->input->post('lo_pan_no');
      /*----------form filler details-------------------------------*/
      $form_filler_state                = $this->input->post('form_filler_state');
      $form_filler_district             = $this->input->post('form_filler_district');
      $form_filler_vdc_municipality_id  = $this->input->post('form_filler_vdc_municipality_id');
      $form_filler_ward_no_id           = $this->input->post('form_filler_ward_no_id');
      $form_filler_relation             = $this->input->post('form_filler_relation');
      $form_filler_name                 = $this->input->post('form_filler_name');
      $form_filler_date                 = $this->input->post('form_filler_date');
      /*-----------------------family details-------------------------------*/
      $family_member_name               = $this->input->post('family_member_name');
      $family_member_dob                = $this->input->post('family_member_dob');
      $family_member_relation           = $this->input->post('family_member_relation');

      /*-------------------------land owner temp address--------------------------*/
      $lo_temp_state = $this->input->post('lo_temp_state');
      $lo_temp_dis = $this->input->post('lo_temp_district');
      $lo_temp_gapanapa = $this->input->post('lo_temp_gapanapa');
      $lo_temp_ward = $this->input->post('lo_temp_ward');
      $lo_temp_tol = $this->input->post('lo_temp_tol');
      $lo_temp_house_no = $this->input->post('lo_temp_house_no');

      $this->form_validation->set_rules('land_owner_name_np',     'संस्थाको नाम', 'required');
      $this->form_validation->set_rules('land_owner_name_en',     'संस्थाको नाम (अंग्रेजी)', 'required');
      $this->form_validation->set_rules('land_owner_grandpa_name', 'दर्ता मिती', 'required');
      $this->form_validation->set_rules('lo_czn_no', 'संस्थाको दर्ता न', 'required');
      $this->form_validation->set_rules('lo_pan_no', 'पान न', 'required');
      $this->form_validation->set_rules('land_owner_grandpa_name', 'दर्ता मिती', array('trim','required'));
      $this->form_validation->set_rules('land_owner_occupation', 'संस्थाको किसिम', array('trim','required'));
      $this->form_validation->set_rules('land_owner_contact_no', 'सम्पर्क फोन नं', array('trim','required'));

      $this->form_validation->set_rules('lo_province', 'स्थायी ठेगाना प्रदेश', array('trim','required'));
      $this->form_validation->set_rules('lo_district_id', 'स्थायी जिल्ला', array('trim','required'));
      $this->form_validation->set_rules('lo_gapanapa', 'गा पा / न पा', array('trim','required'));
      $this->form_validation->set_rules('lo_address_ward', 'स्थायी वडा नं', array('trim','required'));
      $this->form_validation->set_rules('lo_land_ward', 'जग्गा रहेको वडा नं', array('trim','required'));
      $this->form_validation->set_rules('lo_tol', 'स्थायी ठेगाना', array('trim','required'));
      $this->form_validation->set_rules('lo_file_no', 'करदाताको क्र.स नम्बर', array('trim','required'));

      $this->form_validation->set_rules('lo_temp_state', 'अस्थायी प्रदेश', array('trim','required'));
      $this->form_validation->set_rules('lo_temp_district', 'अस्थायी जिल्ला', array('trim','required'));
      $this->form_validation->set_rules('lo_temp_gapanapa', 'अस्थायी गा पा / न पा ', array('trim','required'));
      $this->form_validation->set_rules('lo_temp_ward', 'अस्थायी वडा नं', array('trim','required'));
      $this->form_validation->set_rules('lo_temp_tol', 'अस्थायी टोल/ठाउँ', array('trim','required'));

      if($this->form_validation->run() == false) {
          $response = array(
              'status'      => 'validation_error',
              'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
          );
          header("Content-type: application/json");
          echo json_encode($response);
          exit;
      }
      $is_unique_file_no = is_unique_file_no($lo_file_no);
      if($is_unique_file_no == 1) {
        $response = array(
              'status'      => 'validation_error',
              'message'     => '<div class="alert alert-danger">File number is already taken</div>',
          );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
      }
      $basic_info = array(
        'fiscal_year'                 => $fiscal_year,
        'land_own_type'               => $land_own_type,
        'land_owner_name_np'          => $land_owner_name_np,
        'land_owner_name_en'          => $land_owner_name_en,
        'land_owner_father_name'      => $land_owner_father_name,
        'land_owner_grandpa_name'     => $land_owner_grandpa_name,
        'land_owner_occupation'       => $land_owner_occupation,
        'land_owner_gender'           => $land_owner_gender,
        'nationality'                 => $nationality,
        'land_owner_email'            => $land_owner_email,
        'land_owner_contact_no'       => $land_owner_contact_no,
        'file_no'                     => $lo_file_no,
        /*------ land owner details---------------------*/
        'lo_state'                    => $lo_province,
        'lo_district'                 => $lo_district_id,
        'lo_gapa_napa'                => $lo_gapanapa,
        'lo_ward'                     => $lo_address_ward,
        'lo_land_lac_ward'            => $lo_land_lac_ward,
        'lo_house_no'                 => $lo_house_no,
        'lo_tol'                      => $lo_tol,
        'lo_czn_no'                   => $lo_czn_no,
        'lo_pan_no'                   => $lo_pan_no,

        /*--------temporary adderess----------------------*/
        'lo_temp_state'               => $lo_temp_state,
        'lo_temp_dis'                 => $lo_temp_dis,
        'lo_temp_gapanapa'            => $lo_temp_gapanapa,
        'lo_temp_ward'                => $lo_temp_ward,
        'lo_temp_tol'                 => $lo_temp_tol,
        'lo_temp_house_no'            => $lo_temp_house_no,
        /*-----------form filler details-------------------*/
        'lo_fi_state'                 => $form_filler_state,
        'lo_fi_district'              => $form_filler_district,
        'lo_fi_gapa_napa'             => $form_filler_vdc_municipality_id,
        'lo_fi_relation'              => $form_filler_relation ,
        'lo_fi_ward'                  => $form_filler_ward_no_id,
        // 'lo_fi_name'                  => $form_filler_relation,
        'lo_fi_name'                  => $form_filler_name,
        'lo_fi_date'                  => $form_filler_date,
        'remarks'                     => $land_owner_remarks,
        'status'                      => 1,
        'added_by'                    => $this->session->userdata('PRJ_USER_ID'),
        'added_ward'                  => $this->session->userdata('PRJ_USER_WARD'),
        'added_on'                    =>  convertDate(date('Y-m-d')),
        'modified_on'                 => '',
        'modified_by'                 => '',
        'form_type'                   => $form_type,
      );
      //pp($basic_info);
      $this->ProfileModel->saveProfileDetails($basic_info);
      $details = array();
      foreach ($family_member_name as $key => $indexv) {
          $details[] = array(
              'member_name'               => $family_member_name[$key],
              'member_age'                => $family_member_dob[$key],
              'member_relation'           => $family_member_relation[$key],
              'profile_file_no'           => $lo_file_no,
              'added_by'                    => $this->session->userdata('PRJ_USER_ID'),
              'added_on'                    =>  convertDate(date('Y-m-d')),
          );
      }
      $result = $this->ProfileModel->saveFamilyDetails($details);
      if($result) {
          $response = array(
              'status'      => 'success',
              'data'         => "सफलतापूर्वक सम्मिलित गरियो",
              'message'     => 'redirect',
              'redirect_url'       => base_url().'LandDetails/AddLandDetails/'.$lo_file_no,
          );
          header("Content-type: application/json");
          echo json_encode($response);
          exit;
      }
      // $this->session->set_flashdata('MSG_SUCCESS','प्रोफाइल सफलतापूर्वक सिर्जना गरियो !
      // कृपया जग्गाको विवरण थप्नुहोस्
      // ');
      // redirect('PersonalProfile/');
    }
  }
  //edit profile details
  public function editProfile($id = NULL) {
    if($this->authlibrary->HasModulePermission($this->module_code, "EDIT")){
      $id = $this->uri->segment(3);
      if(empty($id)) {
        show_404();
      }
      $fiscal_year                = get_current_fiscal_year();
      $data['page']               = 'edit_profile_details';
      $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','DESC');
      $data['occupation']         = $this->CommonModel->getData('settings_job', 'DESC');
      $data['provinces']          = $this->CommonModel->getData('provinces', 'DESC');
      $data['districts']          = $this->CommonModel->getData('settings_district', 'DESC');
      $data['ward']               = $this->CommonModel->getData('settings_ward', 'DESC');
      $data['nationality']        = $this->CommonModel->getData('settings_nationality', 'DESC');
      $data['rel']                = $this->CommonModel->getData('settings_relation', 'DESC');
     // $data['gapana']           = $this->CommonModel->getGapaNapa();
     // pp($data['gapana']);
      $data['profile_details'] = $this->CommonModel->getDataByID('land_owner_profile_basic', $id);
      $check_if_bill_exits = check_tax_pax_for_current_fiscal_year($data['profile_details']['file_no'],$fiscal_year);
      //pp($check_if_bill_exits);exit;
      if($check_if_bill_exits == 1) {
        $this->session->set_flashdata('MSG_SUCCESS', $data['profile_details']['file_no'].'-'.$fiscal_year.'-बिल भुक्तान गरिएको छ त्यसैले सम्पादन गर्न सक्दैन');
        redirect('PersonalProfile');
        }
      $data['lo_family_details'] = $this->CommonModel->getAllDataBySelectedFields('land_owner_family_details','profile_file_no', $data['profile_details']['file_no']);
      $user = $this->session->userdata("PRJ_USER_ID");
      $data['users'] = $this->CommonModel->getCurrentUser($user);;
      $this->load->view('main', $data);
      } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }

  public function updateProfileDetails() {
    if($this->input->post('Submit')) {
      /*------- land owner basic details--------------------------------*/
      $id                               = $this->input->post('id');
      $old_file_no                      = $this->input->post('old_file_no');
      $fiscal_year                      = $this->input->post('fiscal_year');
      $land_own_type                    = $this->input->post('land_own_type');
      $land_owner_name_np               = $this->input->post('land_owner_name_np');
      $land_owner_name_en               = $this->input->post('land_owner_name_en');
      $land_owner_father_name           = $this->input->post('land_owner_father_name');
      $land_owner_grandpa_name          = $this->input->post('land_owner_grandpa_name');
      $land_owner_occupation            = $this->input->post('land_owner_occupation');
      $land_owner_gender                = $this->input->post('land_owner_gender');
      $nationality                      = $this->input->post('nationality');
      $land_owner_email                 = $this->input->post('land_owner_email');
      $land_owner_contact_no            = $this->input->post('land_owner_contact_no');
      $land_owner_remarks               = $this->input->post('land_owner_remarks');
      /*-------------land on details------------------------------------------*/
      $lo_province                      = $this->input->post('lo_province');
      $lo_district_id                   = $this->input->post('lo_district_id');
      $lo_gapanapa                      = $this->input->post('lo_gapanapa');
      $lo_address_ward                  = $this->input->post('lo_address_ward');
      $lo_land_ward                     = $this->input->post('lo_land_ward');
      $lo_temp_add                      = $this->input->post('lo_temp_add');
      $lo_house_no                      = $this->input->post('lo_house_no');
      $lo_tol                           = $this->input->post('lo_tol');
      $lo_file_no                       = $this->input->post('lo_file_no');
      $lo_land_lac_ward                 = $this->input->post('lo_land_ward');
      $lo_czn_no                        = $this->input->post('lo_czn_no');
      $lo_pan_no                        = $this->input->post('lo_pan_no');
      /*----------form filler details-------------------------------*/
      $form_filler_state                = $this->input->post('form_filler_state');
      $form_filler_district             = $this->input->post('form_filler_district');
      $form_filler_vdc_municipality_id  = $this->input->post('form_filler_vdc_municipality_id');
      $form_filler_ward_no_id           = $this->input->post('form_filler_ward_no_id');
      $form_filler_relation             = $this->input->post('form_filler_relation');
      $form_filler_name                 = $this->input->post('form_filler_name');
      $form_filler_date                 = $this->input->post('form_filler_date');
      /*-----------------------family details-------------------------------*/
      $member_id                        = $this->input->post('member_id');
      $family_member_name               = $this->input->post('family_member_name');
      $family_member_dob                = $this->input->post('family_member_dob');
      $family_member_relation           = $this->input->post('family_member_relation');

      /*-------------------------land owner temp address--------------------------*/
      $lo_temp_state                      = $this->input->post('lo_temp_state');
      $lo_temp_dis                        = $this->input->post('lo_temp_district');
      $lo_temp_gapanapa                   = $this->input->post('lo_temp_gapanapa');
      $lo_temp_ward                       = $this->input->post('lo_temp_ward');
      $lo_temp_tol                        = $this->input->post('lo_temp_tol');
      $lo_temp_house_no                   = $this->input->post('lo_temp_house_no');
      $family_member_name_new             = $this->input->post('family_member_name_new');
      $family_member_dob_new              = $this->input->post('family_member_dob_new');
      $family_member_relation_new         = $this->input->post('family_member_relation_new');
      $basic_info = array(
        'fiscal_year'                 => $fiscal_year,
        'land_own_type'               => $land_own_type,
        'land_owner_name_np'          => $land_owner_name_np,
        // 'land_owner_name_en'          => $land_owner_name_en,
        'land_owner_father_name'      => $land_owner_father_name,
        'land_owner_grandpa_name'     => $land_owner_grandpa_name,
        'land_owner_occupation'       => $land_owner_occupation,
        'land_owner_gender'           => $land_owner_gender,
        'nationality'                 => $nationality,
        'land_owner_email'            => $land_owner_email,
        'land_owner_contact_no'       => $land_owner_contact_no,
        // 'file_no'                     => $lo_file_no,
        /*------ land owner details---------------------*/
        'lo_state'                    => $lo_province,
        'lo_district'                 => $lo_district_id,
        'lo_gapa_napa'                => $lo_gapanapa,
        'lo_ward'                     => $lo_address_ward,
        'lo_land_lac_ward'            => $lo_land_lac_ward,
        'lo_house_no'                 => $lo_house_no,
        'lo_tol'                      => $lo_tol,
        'lo_czn_no'                   => $lo_czn_no,
        'lo_pan_no'                   => $lo_pan_no,

        /*--------temporary adderess----------------------*/
        'lo_temp_state'               => $lo_temp_state,
        'lo_temp_dis'                 => $lo_temp_dis,
        'lo_temp_gapanapa'            => $lo_temp_gapanapa,
        'lo_temp_ward'                => $lo_temp_ward,
        'lo_temp_tol'                 => $lo_temp_tol,
        'lo_temp_house_no'            => $lo_temp_house_no,
        /*-----------form filler details-------------------*/
        'lo_fi_state'                 => $form_filler_state,
        'lo_fi_district'              => $form_filler_district,
        'lo_fi_gapa_napa'             => $form_filler_vdc_municipality_id,
        'lo_fi_relation'              => $form_filler_ward_no_id,
        'lo_fi_name'                  => $form_filler_relation,
        'lo_fi_name'                  => $form_filler_name,
        'lo_fi_date'                  => $form_filler_date,
        'remarks'                     => $land_owner_remarks,
        'modified_on'                 => $this->session->userdata('PRJ_USER_ID'),
        'modified_by'                 => convertDate(date('Y-m-d')),
      );
     // pp($basic_info);
      $result = $this->ProfileModel->updateProfileDetails($basic_info, $id);
      $update_familyDetails = array();
      if(!empty($family_member_name)) {
        foreach ($family_member_name as $key => $indexv) {
            $update_familyDetails[] = array(
                'id'                        => $member_id[$key],
                'member_name'               => $family_member_name[$key],
                'member_age'                => $family_member_dob[$key],
                'member_relation'           => $family_member_relation[$key],
                'profile_file_no'           => $lo_file_no,
            );
        }
      }
      if(!empty($update_familyDetails)){
        $this->ProfileModel->updateFamilyDetails($member_id,$update_familyDetails);
      }
      if(!empty($family_member_name_new)) {
        $new_family_details = array();
        foreach ($family_member_name_new as $key => $new_family){
          $new_family_details[] = array(
              'member_name'               => $family_member_name_new[$key],
              'member_age'                => $family_member_dob_new[$key],
              'member_relation'           => $family_member_relation_new[$key],
              'profile_file_no'           => $lo_file_no,
          );
        }
        $this->ProfileModel->saveFamilyDetails($new_family_details);
      }
      $has_land = has_land($old_file_no);
      if($has_land == 1) {
        $data = array('ld_file_no' =>$lo_file_no );
        $this->CommonModel->updateDataByField('land_description_details','ld_file_no', $old_file_no);
      }

      $has_sanrachana = has_sanrachana($old_file_no);
      if($has_sanrachana == 1) {
        $data = array('ls_file_no' =>$lo_file_no );
        $this->CommonModel->updateDataByField('sanrachana_details','ls_file_no', $old_file_no);
      }
      $this->session->set_flashdata('MSG_SUCCESS','प्रोफाइल सफलतापूर्वक सिर्जना गरियो !
      कृपया जग्गाको विवरण थप्नुहोस्
      ');
      redirect('PersonalProfile');
    }
  }
  
  //generate code
//   public function generateCode() {
//     if($this->input->is_ajax_request()) {
//       $n = $this->input->post('name');
//       $w = $this->input->post('address_ward');
//       $ganapa = $this->input->post('ganapa');
//       $file_no = generate_file_no($n, $w, $ganapa);
//       echo $file_no;exit;
//     } else {
//       exit('no direct script allowed');
//     }
//   }
    
    public function generateCode() {
        if($this->input->is_ajax_request()) {
            $n = $this->input->post('name');
            $w = $this->input->post('address_ward');
            $ganapa = $this->input->post('ganapa');
            $name_array = array( 
                'A' => '01',
                'B' => '02',
                'C' => '03',
                'D' => '04',
                'E' => '05',
                'F' => '06',
                'G' => '07',
                'H' => '08',
                'I' => '09',
                'J' => '10',
                'K' => '11',
                'L' => '12',
                'M' => '13',
                'N' => '14',
                'O' => '15',
                'P' => '16',
                'Q' => '17',
                'R' => '18',
                'S' => '19',
                'T' => '20',
                'U' => '21',
                'V' => '22',
                'W' => '23',
                'X' => '24',
                'Y' => '25',
                'Z' => '26',
            );
            $second_alphabet    = substr($n,0,1);
             if (array_key_exists(strtoupper($second_alphabet),$name_array)) {
                $file_no = generate_file_no($n, $w, $ganapa);
                $response = array(
                      'status'      => 'success',
                      'data'        => $file_no,
                  );
                  header("Content-type: application/json");
                  echo json_encode($response);
                  exit;
             }  else  {
                $response = array(
                    'status'      => 'error',
                    'data'        => "कृपया अंग्रेजी दाखिला गर्नुहोस ",
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
    * This function generate new code on edit profile
    * 
  */

  public function generateCodeForEdit() {
      $name             = $this->input->post('name');
      $address_ward     = $this->input->post('address_ward');
      $gapana           = $this->input->post('ganapa');
      $profile_id       = $this->input->post('profile_id');
      $name_array       = array( 
        'A' => '01',
        'B' => '02',
        'C' => '03',
        'D' => '04',
        'E' => '05',
        'F' => '06',
        'G' => '07',
        'H' => '08',
        'I' => '09',
        'J' => '10',
        'K' => '11',
        'L' => '12',
        'M' => '13',
        'N' => '14',
        'O' => '15',
        'P' => '16',
        'Q' => '17',
        'R' => '18',
        'S' => '19',
        'T' => '20',
        'U' => '21',
        'V' => '22',
        'W' => '23',
        'X' => '24',
        'Y' => '25',
        'Z' => '26',
      );
      $name             = strtoupper(trim($name));
      if($address_ward < 10) {
        $first    ='0'.$address_ward;    
      } else {
        $first    = $address_ward;
      }
      $second_alphabet    = substr($name,0,1);
      $second             = $name_array[$second_alphabet];
      $profile_details    = $this->CommonModel->getDataByID('land_owner_profile_basic', $profile_id);
      $name_f_alp         = strtoupper(substr($profile_details['land_owner_name_en'], 0,1));
    
      if($name_f_alp != $second_alphabet) {
        $t                  = $this->CommonModel->getNameCount($second_alphabet);
        $third              = $t->third_sn + 1;
        if($third < 10) {
          $third = '000'.$third;
        } elseif($third >= 10 && $third < 100) {
          $third = '00'.$third;
        } else {
          $third ='0'.$third;
        }
      } else {
        $file_no = explode('-',$profile_details['file_no']);
        $third = $file_no[2];
      }

      if($gapana != GID) {
        $f_word = '00';
      } else {
        if(empty($address_ward)) {
          if($this->session->userdata('PRJ_USER_WARD') == 1) {
            $f_word = '00';
          } else {
            $f_word = $this->session->userdata('PRJ_USER_WARD');
            if($f_word < 10) {
              $f_word = '0'.$this->session->userdata('PRJ_USER_WARD');
            } else {
              $f_word = $address_ward;
            }
          }
        } else {
          $f_word = $first;
        }
      }
      $res = $f_word.'-'.$second.'-'.$third;
      echo  $res;
  }


  //get district by state
  public function getDistrictByState() {
    if($this->input->is_ajax_request()) {
        $state = $this->input->post('state');
        get_district_dropdown($state);
    } else {
      exit('no direct script allowed');
    }
  }

  //get Gapanapa By Districts
  public function getGapanapaByDistricts() {
    if($this->input->is_ajax_request()) {
        $district = $this->input->post('district');
        get_ganapa_dropdown($district);
    } else {
      exit('no direct script allowed');
    }
  }

  /**
    * This function on ajaxcall load server side data into datatable
    * @param  NULL
    * @return json 
   */
  public function GetProfileList() 
  {
      if($this->input->is_ajax_request()) {
          $columns = array( 
            0   => 'id', 
            1   => 'file_no',
            2   => 'land_owner_name_en',
            3   => 'lo_czn_no',
            4   => 'land_owner_contact_no'
          );

          $limit                  = $this->input->post('length');
          $start                  = $this->input->post('start');
          $sn                     = $start+1;
          $org_file_no            = $this->input->post('file_no');
          $org_name               = $this->input->post('org_name');
          $reg_no                 = $this->input->post('darta_no');
          $contact_no             = $this->input->post('contact_no');
          $paid_status             = $this->input->post('paid_status');

          $order                  = $columns[$this->input->post('order')[0]['column']];
          $dir                    = $this->input->post('order')[0]['dir'];
          $totalData              = $this->ProfileModel->CountProfile($org_file_no,$org_name,$reg_no,$contact_no, $paid_status);
          $totalFiltered          = $totalData;
          $posts                  = $this->ProfileModel->Getprofile($limit,$start,$order,$dir, $org_file_no,$org_name,$reg_no,$contact_no,$paid_status);
          //pp($posts);
          $data           = array();
          if(!empty($posts))
          {
              $i = 1;
              foreach ($posts as $post)
              {
                    $nestedData['sn']               = $this->mylibrary->convertedcit($sn++);
                    $nestedData['date']               = $this->mylibrary->convertedcit($post->added_on);
                    $nestedData['id']               = $post->id;
                    $nestedData['file_no']          = $this->mylibrary->convertedcit($post->file_no);
                    $nestedData['file_no_en']       = $post->file_no;
                    $nestedData['org_name']         = $post->land_owner_name_np;
                    $nestedData['reg_num']          = $this->mylibrary->convertedcit($post->lo_czn_no);
                    $nestedData['contact_no']       = $this->mylibrary->convertedcit($post->land_owner_contact_no);
                    $nested['current_flag']         = $post->current_flag;
                    $check_if_bill_exits = check_tax_pax_for_current_fiscal_year($post->file_no, current_fiscal_year());
                    // if($nestedData['current_flag'] == 1) {
                    //   $nestedData['is_paid'] = 'Paid';
                    // } else {
                    //   $nestedData['is_paid'] = 'Not Paid';
                      
                    // }
                  if($check_if_bill_exits == 1) {
                    $nestedData['is_paid'] = 'Paid';
                  } else {
                    $nestedData['is_paid'] = 'Not Paid';
                  }
                  $data[] = $nestedData;
              }
          }
          //pp($data);
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

  /**
    * This function delete data from database.
    * check proper id is in format of not.
    * @param $id int pk
    * @return boolean.
  */
  public function removeFamaily() {
      if($this->input->is_ajax_request()) {
          $id = $this->input->post('id');
          $result = $this->CommonModel->deleteData('land_owner_family_details',$id);
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

  public function deleteProfile() {
      if($this->input->is_ajax_request()) {
          $id = $this->input->post('id');
          //$result = $this->CommonModel->deleteData('land_owner_profile_basic',$id);
          // if(has_land($id) == 1) {
          //   $condition =array(
          //     'ld_file_no' => $id,
          //   );
          //   $this->CommonModel->bulkDelete($id,'land_description_details', $condition);
          // }
          // if(has_sanrachana($id) == 1){
          //   $condition =array(
          //     'ls_file_no' => $id,
          //   );
           
          //   $this->CommonModel->bulkDelete($id, 'sanrachana_details',$condition);
          // }
          $result = $this->ProfileModel->deleteProfile($id);
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
    * view profile
  */
  public function view($fileNo) {
    $data['profile_details']        = $this->ProfileModel->getProfileDetails($fileNo);
    $data['jobs']                   = $this->CommonModel->getDataByID('settings_job',$data['profile_details']['land_owner_occupation']);
    $data['lo_state']               = $this->CommonModel->getDataByID('provinces',$data['profile_details']['lo_state']);
    $data['lo_districts']           = $this->CommonModel->getDataByID('settings_district',$data['profile_details']['lo_district']);
    $data['lo_gapanapa']            = $this->CommonModel->getDataByID('settings_vdc_municipality',$data['profile_details']['lo_gapa_napa']);
    $data['lo_temp_state']          = $this->CommonModel->getDataByID('provinces',$data['profile_details']['lo_temp_state']);
    $data['lo_temp_districts']      = $this->CommonModel->getDataByID('settings_district',$data['profile_details']['lo_temp_dis']);
    $data['lo_temp_gapanapa']       = $this->CommonModel->getDataByID('settings_vdc_municipality',$data['profile_details']['lo_temp_gapanapa']);
    $data['lo_fi_state']            = $this->CommonModel->getDataByID('provinces',$data['profile_details']['lo_fi_state']);
    $data['lo_fi_district']         = $this->CommonModel->getDataByID('settings_district',$data['profile_details']['lo_fi_gapa_napa']);
    $data['lo_fi_gapanapa']         = $this->CommonModel->getDataByID('settings_vdc_municipality',$data['profile_details']['lo_fi_gapa_napa']);
    $data['family_details']         = $this->CommonModel->getAllDataBySelectedFields('land_owner_family_details','profile_file_no', $data['profile_details']['file_no']);
    $data['nationality']            = $this->CommonModel->getDataByID('settings_nationality', $data['profile_details']['nationality']);
    $data['profile_details']        = $this->ProfileModel->getProfileDetails($fileNo);
    $data['Billsdetails']           = $this->ProfileModel->GetProfileDetailsForBills($fileNo);
    $data['page'] = 'view';
    $this->load->view('main', $data);
  }

  /**
    * This function list tax paid profile
    * check proper id is in format of not.
    * @param $id int pk
    * @return boolean.
  */
  public function paidProfileList() {
    if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
      $data['page'] = 'list_paid_personal_profile';
      $this->load->view('main', $data);
    } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }

  public function unpaidProfieList() {
    if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
      $data['page'] = 'list_unpaid_personal_profile';
      $this->load->view('main', $data);
    } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }


   /**
    * This function on ajaxcall load server side data into datatable
    * @param  NULL
    * @return json 
   */
  public function GetPaidProfileList() 
  {
      if($this->input->is_ajax_request()) {
          $columns = array( 
            0   => 'id', 
            1   => 'file_no',
            2   => 'land_owner_name_en',
            3   => 'lo_czn_no',
            4   => 'land_owner_contact_no'
          );

          $limit                  = $this->input->post('length');
          $start                  = $this->input->post('start');
          $org_file_no            = $this->input->post('file_no');
          $org_name               = $this->input->post('org_name');
          $reg_no                 = $this->input->post('darta_no');
          $contact_no             = $this->input->post('contact_no');
          $order                  = $columns[$this->input->post('order')[0]['column']];
          $dir                    = $this->input->post('order')[0]['dir'];

          $sn                     = $start+1;
          // echo $start;exit;
          $totalData              = $this->ProfileModel->CountPaidProfile($org_file_no,$org_name,$reg_no,$contact_no);
          $totalFiltered          = $totalData;
          $posts                  = $this->ProfileModel->GetPaidProfile($limit,$start,$order,$dir, $org_file_no,$org_name,$reg_no,$contact_no);
          $data           = array();
          if(!empty($posts))
          {
              $i = 1;
              foreach ($posts as $post)
              {
                  $nestedData['sn']               = $this->mylibrary->convertedcit($sn++);
                  $nestedData['id']               = $post->id;
                  $nestedData['file_no']          = $this->mylibrary->convertedcit($post->file_no);
                  $nestedData['file_no_en']       = $post->file_no;
                  $nestedData['org_name']         = $post->land_owner_name_np;
                  $nestedData['reg_num']          = $this->mylibrary->convertedcit($post->lo_czn_no);
                  $nestedData['contact_no']       = $this->mylibrary->convertedcit($post->land_owner_contact_no);
                  $check_if_bill_exits = check_tax_pax_for_current_fiscal_year($post->file_no, get_current_fiscal_year());
                 
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


  /**
    * This function on ajaxcall load server side data into datatable
    * @param  NULL
    * @return json 
   */
  public function GetUnPaidProfileList() 
  {
      if($this->input->is_ajax_request()) {
          $columns = array( 
            0   => 'id', 
            1   => 'file_no',
            2   => 'land_owner_name_en',
            3   => 'lo_czn_no',
            4   => 'land_owner_contact_no'
          );

          $limit                  = $this->input->post('length');
          $start                  = $this->input->post('start');
          $org_file_no            = $this->input->post('file_no');
          $org_name               = $this->input->post('org_name');
          $reg_no                 = $this->input->post('darta_no');
          $contact_no             = $this->input->post('contact_no');
          $order                  = $columns[$this->input->post('order')[0]['column']];
          $dir                    = $this->input->post('order')[0]['dir'];
          $sn                     = $start+1;
          // echo $start;exit;
          $totalData              = $this->ProfileModel->CountUnPaidProfile($org_file_no,$org_name,$reg_no,$contact_no);
          $totalFiltered          = $totalData;
          $posts                  = $this->ProfileModel->GetUnPaidProfile($limit,$start,$order,$dir, $org_file_no,$org_name,$reg_no,$contact_no);
          $data           = array();
          if(!empty($posts))
          {
              $i = 1;
              foreach ($posts as $post)
              {
                  $nestedData['sn']               = $this->mylibrary->convertedcit($sn++);
                  $nestedData['id']               = $post->id;
                  $nestedData['file_no']          = $this->mylibrary->convertedcit($post->file_no);
                  $nestedData['file_no_en']       = $post->file_no;
                  $nestedData['org_name']         = $post->land_owner_name_np;
                  $nestedData['reg_num']          = $this->mylibrary->convertedcit($post->lo_czn_no);
                  $nestedData['contact_no']       = $this->mylibrary->convertedcit($post->land_owner_contact_no);
                  $check_if_bill_exits = check_tax_pax_for_current_fiscal_year($post->file_no, get_current_fiscal_year());
                 
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


  //view details
  public function ProfileDetailView() {
    $data['ward'] = $this->CommonModel->getData('wardwise_address','ASC','ward');
    $data['page'] = 'profile_details_v';
    $this->load->view('main',$data);
    // if(!empty($data['ward'])) {
    //   foreach($data['ward'] as $key => $ward) {
    //     $data['paidkar'] = $this->ProfileModel->ACountPaidProfile($ward['ward']);
    //   }
    // }
    // pp($data['paidKar']);
  }

  public function addFamilyDetails($file_no) {
    if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
      $data['page'] = 'add_family_details';
      $data['file_no'] = $this->uri->segment(3);
      $data['rel']          = $this->CommonModel->getData('settings_relation', 'DESC');
      $this->load->view('main', $data);
    } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }

  public function saveFamilyDetails() {
      if($this->input->is_ajax_request()) {
        $family_member_name               = $this->input->post('family_member_name');
        $family_member_dob                = $this->input->post('family_member_dob');
        $family_member_relation           = $this->input->post('family_member_relation');
        $citizenship_no                   = $this->input->post('citizenship_no');
        $birth_darta                      = $this->input->post('birth_darta');
        $file_no                          = $this->input->post('file_no');
        $this->form_validation->set_rules('family_member_name[]',     'सदस्यहरुको नाम', 'required');
        $this->form_validation->set_rules('family_member_dob[]',     'जन्म मिति', 'required');
        $this->form_validation->set_rules('family_member_relation[]', 'नाता','required');
        $this->form_validation->set_rules('citizenship_no[]', 'नागरिकता नं', 'required');
        $this->form_validation->set_rules('birth_darta[]', 'जन्म दर्ता नं', 'required');
        if($this->form_validation->run() == false) {
            $response = array(
                'status'      => 'validation_error',
                'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
        $details = array();
        foreach ($family_member_name as $key => $indexv) {
            $details[] = array(
                'member_name'               => $family_member_name[$key],
                'member_age'                => $family_member_dob[$key],
                'member_relation'           => $family_member_relation[$key],
                'citizenship_no'            => $citizenship_no[$key],
                'birth_darta'               => $birth_darta[$key],
                'profile_file_no'           => $file_no,
                'added_by'                  => $this->session->userdata('PRJ_USER_ID'),
                'added_on'                  =>  convertDate(date('Y-m-d')),
            );
        }
        // pp($details);
        $result = $this->ProfileModel->saveFamilyDetails($details);
        if($result) {
            $response = array(
                'status'      => 'success',
                'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                'message'     => 'redirect',
                'redirect_url'       => base_url().'PersonalProfile/view/'.$file_no,
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
    }
  }

  public function editFamilyDetails($file_no) {
    if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
      $data['page'] = 'edit_family_details';
      $data['file_no'] = $this->uri->segment(3);
      $data['rel']          = $this->CommonModel->getData('settings_relation', 'DESC');
      $data['family_detials'] = $this->CommonModel->getAllDataBySelectedFields('land_owner_family_details','profile_file_no',$file_no);
      $this->load->view('main', $data);
    } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }

   public function updateFamilyDetails() {
      if($this->input->is_ajax_request()) {
        $id                               = $this->input->post('member_id');
        $family_member_name               = $this->input->post('family_member_name');
        $family_member_dob                = $this->input->post('family_member_dob');
        $family_member_relation           = $this->input->post('family_member_relation');
        $citizenship_no                   = $this->input->post('citizenship_no');
        $birth_darta                      = $this->input->post('birth_darta');
        $file_no                          = $this->input->post('file_no');
        // $this->form_validation->set_rules('family_member_name[]',     'सदस्यहरुको नाम', 'required');
        // $this->form_validation->set_rules('family_member_dob[]',     'नाता', 'required');
        // $this->form_validation->set_rules('family_member_relation[]', 'जन्म मिति', 'required');
        // $this->form_validation->set_rules('citizenship_no[]', 'नागरिकता नं', 'required');
        // $this->form_validation->set_rules('birth_darta[]', 'जन्म दर्ता नं', 'required');
        // if($this->form_validation->run() == false) {
        //     $response = array(
        //         'status'      => 'validation_error',
        //         'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
        //     );
        //     header("Content-type: application/json");
        //     echo json_encode($response);
        //     exit;
        // }
        $details = array();
        foreach ($family_member_name as $key => $indexv) {
            $details[] = array(
                'id'                        => $id[$key],
                'member_name'               => $family_member_name[$key],
                'member_age'                => $family_member_dob[$key],
                'member_relation'           => $family_member_relation[$key],
                'citizenship_no'            => $citizenship_no[$key],
                'birth_darta'               => $birth_darta[$key],
                'profile_file_no'           => $file_no,
                'added_by'                  => $this->session->userdata('PRJ_USER_ID'),
                'added_on'                  =>  convertDate(date('Y-m-d')),
            );
        }
        // pp($details);
        $result = $this->ProfileModel->updateFamilyDetails($id, $details);
        if($result) {
            $response = array(
                'status'      => 'success',
                'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                'message'     => 'redirect',
                'redirect_url'       => base_url().'PersonalProfile/view/'.$file_no,
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
    }
  }

  public function downloadProfile() {
    
  }
}//end of class
?>
