<?php
/**
  * This class create profile for business owner.
*/
class BusinessProfile extends MX_Controller
{
  /**
    * This class create profile for business owner.
  */
  public function __construct()
  {
    parent::__construct();
    $this->module_code = 'PROFILE';
    $this->load->model("CommonModel");
    $this->load->model("BusinessProfileModel");
    if(!$this->authlibrary->IsLoggedIn()) {
      $this->session->set_userdata('return_url', current_url());
      redirect('Login','location');
    }
  }

  /**
    * This function show business owner profile list.
    * @param NULL
    * @return void
  */
  public function Index() {
    if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
      $data['page']         = 'list_business_profile';
      $this->load->view('main', $data);
    } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }

  /**
    * This function loads create view form.
    * @param NULL
    * @return void
  */
  public function CreateProfile( $id = NULL) {
    if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
      $id                     = $this->uri->segment(3);
      $data['page']           = 'create_profile';
      $data['fiscal_year']    = $this->CommonModel->getData('fiscal_year');
      $data['occupation']     = $this->CommonModel->getData('settings_job');
      $data['provinces']      = $this->CommonModel->getData('provinces');
      $data['districts']      = $this->CommonModel->getData('settings_district');
      $data['ward']           = $this->CommonModel->getData('settings_ward');
      $data['nationality']    = $this->CommonModel->getData('settings_nationality');
      $data['rel']            = $this->CommonModel->getData('settings_relation');
      $data['land_category']  = $this->CommonModel->getData('land_category');
      $data['gapana']         = $this->CommonModel->getGapaNapa();
      if(!empty($id)) {
        $data['row']          = $this->BusinessProfileModel->GetProfileRow($condition = array('id' => $id));
      }
      $this->load->view('main', $data);
    } else {
      $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
      redirect('Dashboard');
    }
  }


  public function Save() {
    if($this->input->is_ajax_request()) {
      /*------- land owner basic details--------------------------------*/
      $this->form_validation->set_rules('land_owner_name_np',     'संस्थाको नाम', 'required');
      $this->form_validation->set_rules('land_owner_name_en',     'संस्थाको नाम (अंग्रेजी)', 'required');
      $this->form_validation->set_rules('land_owner_grandpa_name', 'दर्ता मिती', 'required');
      $this->form_validation->set_rules('lo_czn_no', 'संस्थाको दर्ता न', 'required');
      $this->form_validation->set_rules('lo_pan_no', 'पान न', 'required');
      $this->form_validation->set_rules('land_owner_grandpa_name', 'दर्ता मिती', array('trim','required'));
      $this->form_validation->set_rules('land_owner_occupation', 'संस्थाको किसिम', array('trim','required'));
      $this->form_validation->set_rules('land_owner_contact_no', 'सम्पर्क फोन नं', array('trim','required'));

      $this->form_validation->set_rules('lo_province', 'स्थायी ठेगाना प्रदेश', array('trim','required'));
      $this->form_validation->set_rules('lo_district', 'स्थायी जिल्ला', array('trim','required'));
      $this->form_validation->set_rules('gpana', 'गा पा / न पा', array('trim','required'));
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

    
      $id                               = $this->input->post('id');
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
      $lo_district_id                   = $this->input->post('lo_district');
      $lo_gapanapa                      = $this->input->post('gpana');
      $lo_address_ward                  = $this->input->post('lo_address_ward');

      $lo_temp_add                      = $this->input->post('lo_temp_add');
      $lo_house_no                      = $this->input->post('lo_house_no');
      $lo_tol                           = $this->input->post('lo_tol');
      $lo_file_no                       = $this->input->post('lo_file_no');
      $lo_land_lac_ward                 = $this->input->post('lo_land_ward');
      $lo_czn_no                        = $this->input->post('lo_czn_no');
      $lo_pan_no                        = $this->input->post('lo_pan_no');
      /*----------form filler details-------------------------------*/
      $form_filler_state                = $this->input->post('lo_fi_state');
      $form_filler_district             = $this->input->post('lo_fi_district');
      $form_filler_vdc_municipality_id  = $this->input->post('lo_fi_gapa_napa');
      $form_filler_ward_no_id           = $this->input->post('lo_fi_relation');
      $form_filler_relation             = $this->input->post('lo_fi_ward');
      $form_filler_name                 = $this->input->post('lo_fi_name');
      $form_filler_date                 = $this->input->post('lo_fi_date');
      /*-------------------------land owner temp address--------------------------*/
      $lo_temp_state                    = $this->input->post('lo_temp_state');
      $lo_temp_dis                      = $this->input->post('lo_temp_district');
      $lo_temp_gapanapa                 = $this->input->post('lo_temp_gapanapa');
      $lo_temp_ward                     = $this->input->post('lo_temp_ward');
      $lo_temp_tol                      = $this->input->post('lo_temp_tol');
      $lo_temp_house_no                 = $this->input->post('lo_temp_house_no');
      
      
      $suchak_state                     = $this->input->post('suchak_state');
      $suchak_district                  = $this->input->post('suchak_district');
      $suchak_gapanapa                  = $this->input->post('suchak_gapanapa');
      $suchak_ward                      = $this->input->post('suchak_ward');
      $suchak_name                      = $this->input->post('suchak_name');
      $suchak_relation                  = $this->input->post('suchak_relation');
      $basic_info = array(
        'fiscal_year'                 => get_current_fiscal_year(),
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
        
        'suchak_state'                => $suchak_state,
        'suchak_district'             => $suchak_district,
        'suchak_gapanapa'             => $suchak_gapanapa,
        'suchak_ward'                 => $suchak_ward,
        'suchak_name'                 => $suchak_name,
        'suchak_relation'             => $suchak_relation,
        
        'lo_fi_state'                 => $form_filler_state,
        'lo_fi_district'              => $form_filler_district,
        'lo_fi_gapa_napa'             => $form_filler_vdc_municipality_id,
        'lo_fi_relation'              => $form_filler_relation ,
        'lo_fi_ward'                  => $form_filler_ward_no_id,
        // 'lo_fi_name'                  => $form_filler_relation,
        'lo_fi_name'                  => $form_filler_name,
        'lo_fi_date'                  => $form_filler_date,
        'fiscal_year'                 => get_current_fiscal_year(),
        'remarks'                     => $land_owner_remarks,
        'status'                      => 1,
        'added_by'                    => $this->session->userdata('PRJ_USER_ID'),
        'added_on'                    =>  convertDate(date('Y-m-d')),
        'modified_on'                 => '',
        'modified_by'                 => ''
      );

      if(empty($id)) {
          $result = $this->CommonModel->insertData('land_owner_profile_basic',$basic_info);
          if($result) {
              $response = array(
                  'status'      => 'success',
                  'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                  'message'     => 'redirect',
                  'redirect_url'       => base_url().'LandDetails/veiwLandDescription/'.$lo_file_no,
              );
              header("Content-type: application/json");
              echo json_encode($response);
              exit;
          }   
      } else {
           $result = $this->CommonModel->UpdateData('land_owner_profile_basic',$id, $basic_info);
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
    }
  }

  /**
    * This function on ajaxcall load server side data into datatable
    * @param  NULL
    * @return json 
   */
  public function GetBusinessProfileList() 
  {
      if($this->input->is_ajax_request()) {
          $columns = array( 
                              0   => 'id', 
                              1   => 'file_no',
                              2   => 'land_owner_name_en',
                              3   => 'lo_czn_no',
                              4 =>'land_owner_contact_no'
                          );

          $limit                  = $this->input->post('length');
          $start                  = $this->input->post('start');

          $org_file_no            = $this->mylibrary->convertNos($this->input->post('file_no'));
          $org_name               = $this->input->post('org_name');
          $reg_no                 = $this->mylibrary->convertNos($this->input->post('darta_no'));
          $contact_no             = $this->mylibrary->convertNos($this->input->post('contact_no'));
          
          $order                  = $columns[$this->input->post('order')[0]['column']];
          $dir                    = $this->input->post('order')[0]['dir'];
          $totalData              = $this->BusinessProfileModel->business_profile_count($org_file_no,$org_name,$reg_no,$contact_no);
          $totalFiltered          = $totalData;
          $posts                  = $this->BusinessProfileModel->business_profile($limit,$start,$order,$dir, $org_file_no,$org_name,$reg_no,$contact_no);
          $data           = array();
          if(!empty($posts))
          {
              $i = 1;
              foreach ($posts as $post)
              {
                  $nestedData['sn']               = $this->mylibrary->convertedcit($i++);
                  $nestedData['id']               = $post->id;
                  $nestedData['file_no']      = $this->mylibrary->convertedcit($post->file_no);
                  $nestedData['file_no_en']      = $post->file_no;
                  $nestedData['org_name']   = $post->land_owner_name_np;
                  $nestedData['reg_num']   = $post->lo_czn_no;
                  $nestedData['contact_no']   = $this->mylibrary->convertedcit($post->land_owner_contact_no);
                  $check_if_bill_exits = $this->BusinessProfileModel->checkIfTaxPaid($post->file_no);
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
   //generate code
  public function generateCode() {
    if($this->input->is_ajax_request()) {
      $n = $this->input->post('name');
      $w = $this->input->post('address_ward');
      $ganapa = $this->input->post('ganapa');
      $file_no = generate_file_no($n, $w, $ganapa);
      echo $file_no;exit;
    } else {
      exit('no direct script allowed');
    }
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
}//end of class
?>
