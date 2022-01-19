<?php
/**
  * This class create profile for business owner.
*/
class LandDetails extends MY_Controller
{
  /**
    * This class create profile for business owner.
  */
  public function __construct()
  {
    parent::__construct();
    $this->module_code = 'PERSONAL-PROFILE';
    $this->load->model("CommonModel");
    $this->load->model("LandDetailsModel");
    $this->fy = current_fiscal_year();
    if(!$this->authlibrary->IsLoggedIn()) {
      $this->session->set_userdata('return_url', current_url());
      redirect('Login','location');
    }
  }

  public function Index() {}
  /**
    * This function on view land owner details.
    * @param  varchar $file_no
    * @return void 
   */
  public function veiwLandDescription( $file_no ) {
    if(!empty($file_no)) {
      $data['page']         = 'bidur/view_details';
      $data['file_no']      = $file_no;
     
      $data['land_owner']   = $this->CommonModel->GetLandOwnerRowByFileNo($file_no);
      $data['lands']        = $this->LandDetailsModel->GetLandDetails($file_no);
      //pp($data['lands']);
      $data['has_bill']     = $this->LandDetailsModel->checkIfTaxPaid($file_no);
      $this->load->view('main', $data);
    }
  }

  /**
    * This function on view land details.
    * @param  varchar $file_no
    * @return void 
   */
  public function GetLandLists() {
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
          $file_no                = $this->input->post('file_no');
          $kitta_no               = $this->input->post('kitta_no');
          $order                  = $columns[$this->input->post('order')[0]['column']];
          $dir                    = $this->input->post('order')[0]['dir'];
          $totalData              = $this->LandDetailsModel->CountLand($file_no,$kitta_no);
          $totalFiltered          = $totalData;
          $posts                  = $this->LandDetailsModel->GetLandDetails($limit,$start,$order,$dir, $file_no,$kitta_no);
         
          $data           = array();
          if(!empty($posts))
          {
              $i = 1;
              foreach ($posts as $post)
              {
                  $nestedData['sn']                 = $this->mylibrary->convertedcit($i++);
                  $nestedData['id']                 = $post->land_id;
                  $nestedData['file_no']            = $this->mylibrary->convertedcit($post->ld_file_no);
                  $nestedData['file_no_en']         = $post->ld_file_no;
                  $nestedData['kitta_no_en']        = $post->k_number;
                  $nestedData['land_area_type']     = $post->lat;
                  $nestedData['road_name']          = $post->rm;

                  $nestedData['sabik']              = $post->old_gapa_napa.'-'.$this->mylibrary->convertedcit($post->old_ward);
                  $nestedData['present']              = $post->present_gapa_napa.'-'.$this->mylibrary->convertedcit($post->present_ward);
                  $nestedData['land_category']      = $post->category;
                  $biga = !empty($post->a_ropani) ? $post->a_ropani:0;
                  $kattha = !empty($post->a_ana) ? $post->a_ana:0;
                  $dhur = !empty($post->a_paisa) ? $post->a_paisa:0;
                  $dam = !empty($post->a_dam) ? $post->a_dam:0;
                  if(CALC == 1){
                    $nestedData['total_area']               = $this->mylibrary->convertedcit($biga).'.'.$this->mylibrary->convertedcit($kattha).'.'.$this->mylibrary->convertedcit($dhur).'.'.$this->mylibrary->convertedcit($dam).' (रोपनी. आना .पैसा.दाम)';

                  } else {
                    $nestedData['total_area']               = $this->mylibrary->convertedcit($biga).'.'.$this->mylibrary->convertedcit($kattha).'.'.$this->mylibrary->convertedcit($dam).' (बिघा. कठ्ठा .धुर)';
                  }
                  $nestedData['k_number']           = $this->mylibrary->convertedcit($post->k_number);
                  $nestedData['nn_number']          = $this->mylibrary->convertedcit($post->nn_number);
                  $nestedData['min_land_rate']      = $this->mylibrary->convertedcit($post->min_land_rate);
                  $nestedData['k_land_rate']        = $this->mylibrary->convertedcit($post->k_land_rate);
                  $nestedData['old_gapa_napa']      = $post->old_gapa_napa;
                  $nestedData['old_ward']           = $this->mylibrary->convertedcit($post->old_ward);
                  $nestedData['present_gapa_napa']  = $post->present_gapa_napa;
                  $nestedData['present_ward']       = $this->mylibrary->convertedcit($post->present_ward);
                  $nestedData['t_rate']             = $this->mylibrary->convertedcit($post->t_rate);
                  $nestedData['fiscal_year']        = $this->mylibrary->convertedcit($post->fiscal_year);
                  if($post->current_flag  == 1){
                    $nestedData['kar'] = '<p class = "badge badge-success"><i class="fa fa-check-circle"></i></p>';
                  } else{
                    $nestedData['kar'] = '<p class = "badge badge-danger"><i class = "fa fa-times-circle"></i></p>';
                  }

                  if($nestedData['fiscal_year'] = recently_closed_fy()) {
                    $nestedData['update'] = '<p class = "badge badge-danger">कार्य उपलब्ध छैन</p>';
                  } elseif($post->current_flag  == 1) {
                    '<p class = "badge badge-danger">कार्य उपलब्ध छैन</p>';
                  } else {
                    $nestedData['update'] = '<div class="btn-group">
                                  <div class="dropdown">
                                      <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         कार्य
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="'.base_url().'LandDetails/EditLandDetails/'.$post->land_id.'"><i class="fa fa-pencil-square-o"></i> सम्पादन गर्नुहोस्</a>
                                          <button class="dropdown-item   btn-delete" data-id="'.$post->land_id.'" data-kitta="'.$post->k_number.'"><i class="fa fa-trash-o"></i> हटाउनुहोस्</button>
                                      </div
                                  </div>
                              </div>';

                    
                                     
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
    * This function on view land details.
    * @param  varchar $file_no
    * @return void 
   */
   public function AddLandDetails($file_no) {
      if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
          $file_no = $this->uri->segment(3);
          $data['page']           = 'bidur/add_land_details_v_1';
          $data['lo_details']     = $this->CommonModel->GetLandOwnerRowByFileNo($file_no);
          $data['oldwardaddress'] = $this->CommonModel->addressOld();
          $data['wardadrress']    = $this->CommonModel->oldWard();
          $data['roadtype']       = $this->CommonModel->getWhereAll('settings_road',array('fiscal_year'=> $this->fy));
          $data['roadkisim']      = $this->CommonModel->getWhereAll('settings_road_type', array('fiscal_year'=> $this->fy));
          $data['jaggaunit']      = $this->CommonModel->getData('settings_unit', 'DESC');
          $data['land_category']  = $this->CommonModel->getData('land_category', 'DESC');
          $data['areatype']       = $this->CommonModel->getWhereAll('settings_land_area_type',array('fiscal_year'=> $this->fy));
          $this->load->view('main', $data);
      } else {
          $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
          redirect('Dashboard');
      }
   }

  /**
    * This function on view land details.
    * @param  varchar $file_no
    * @return void 
   */
    public function saveLandDetails() {
      if($this->input->is_ajax_request()) {
        $this->form_validation->set_rules('old_gapa_napa',     'साबिक गा.पा/न.पा', 'required');
        $this->form_validation->set_rules('old_ward',     'साबिक वडा नं', 'required');
        $this->form_validation->set_rules('present_gapa_napa', 'हाल गा.पा/न.पा', 'required');
        $this->form_validation->set_rules('present_ward', 'संस्थाको दर्ता न', 'required');
        $this->form_validation->set_rules('road_name', 'हाल वडा नं', 'required');
        $this->form_validation->set_rules('land_area_type', 'सडकको नाम', array('trim','required'));
        if(MODULE == 2) {
          $this->form_validation->set_rules('land_category', 'जग्गाको श्रेणी', array('trim','required'));
        }
        $this->form_validation->set_rules('nn_number', 'नक्सा नं', array('trim','required'));
        $this->form_validation->set_rules('k_number', 'कित्ता नं', 'required|trim');
        $this->form_validation->set_rules('total_square_feet', 'क्षेत्रफल', array('trim','required'));
        $this->form_validation->set_rules('min_land_rate', 'तोकिएको न्युनतम मुल्य(प्रति कठ्ठा )', array('trim','required'));
        $this->form_validation->set_rules('k_land_rate', 'कबुल गरेको मुल्य(प्रति कठ्ठा )', array('trim','required'));
        $this->form_validation->set_rules('t_rate', 'कर लाग्ने मुल्य', array('trim','required'));
        if($this->form_validation->run() == false) {
            $response = array(
                'status'      => 'validation_error',
                'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
        if($this->input->post('min_land_rate') == '0') {
            $response = array(
                'status'      => 'validation_error',
                'message'     => '<div class="alert alert-danger">जाग्को न्युनतम मुल्य तोकिएको छैन </div>',
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
        $old_gapa_napa          = $this->input->post('old_gapa_napa');
        $old_ward               = $this->input->post('old_ward');
        $present_gapa_napa      = $this->input->post('present_gapa_napa');
        $present_ward           = $this->input->post('present_ward');
        $road_name              = $this->input->post('road_name');
        $land_area_type         = $this->input->post('land_area_type');
        $land_category          = $this->input->post('land_category');
        $n_number               = $this->input->post('nn_number');
        $k_number               = $this->input->post('k_number');
        $a_ropani               = $this->input->post('a_ropani');//biga
        $a_ropani               = !empty($a_ropani) ? $a_ropani : 0;
        $a_ana                  = $this->input->post('a_ana');//kattha
        $a_ana                  = !empty($a_ana) ? $a_ana : 0;
        $a_paisa                = $this->input->post('a_paisa');//dhur
        $a_paisa                = !empty($a_paisa) ? $a_paisa : 0;
        $a_dam                  = $this->input->post('a_dam');
        $a_dam                  = !empty($a_dam) ? $a_dam : 0;
        $a_unit                 = $this->input->post('a_unit');
        $total_square_feet      = $this->input->post('total_square_feet');
        $min_land_rate          = $this->input->post('min_land_rate');
        $max_land_rate          = $this->input->post('max_land_rate');
        $k_land_rate            = $this->input->post('k_land_rate');
        $t_rate                 = $this->input->post('t_rate');
        $ld_file_no             = $this->input->post('ld_file_no');
        $data['lo_details']     = $this->CommonModel->GetLandOwnerRowByFileNo($ld_file_no);
        
        $reasontoadd = $this->input->post('reasontoadd');
        if(empty($reasontoadd)) {
             $response = array(
                'status'      => 'error',
                'message'     => 'जग्गा थप्नुको कारण खाली भंएको हुनाले असफल भयो',
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
        if($ld_file_no != $data['lo_details']['file_no']){
          exit('invalid file no');
        }
        // $check_unique_k_no = check_unique_kitta_no($k_number, $old_ward );
        // if($check_unique_k_no == 1 ) {
        //     $response = array(
        //         'status'      => 'error',
        //         'message'     => 'कित्ता कित्ता नं दोहोरिएको हुनाले सम्पादन भएन.',
        //     );
        //     header("Content-type: application/json");
        //     echo json_encode($response);
        //     exit;
        // }
        // check if same road no, naksa number, kitta number for same user exists in databasse
        $check_for_duplicate_entry = $this->CommonModel->checkDuplicateLandEntry($ld_file_no, $road_name, $n_number, $k_number);
        if(count($check_for_duplicate_entry) > 0) {
          $response = array(
            'status'      => 'error',
            'message'     => 'जग्गा पहिलै थपि सक्नु भएको छ',
          );
          header("Content-type: application/json");
          echo json_encode($response);
          exit;
        }
        $post_array = array(
          'old_gapa_napa'     => $old_gapa_napa,
          'old_ward'          => $old_ward,
          'present_gapa_napa' => $present_gapa_napa,
          'present_ward'      => $present_ward,
          'road_name'         => $road_name,
          'land_area_type'    => $land_area_type,
          'land_category'     => $land_category,
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
          'fiscal_year'       => $this->fy,
          't_rate'            => $t_rate,
          'ld_file_no'        => $ld_file_no,
          'reasontoadd'       => $reasontoadd,
          'added_by'          => $this->session->userdata('PRJ_USER_ID'),
          'added_on'          => convertDate(date('Y-m-d'))
        );
        $check_if_bill_exits = check_tax_pax_for_current_fiscal_year($ld_file_no,$this->fy);
        $result = $this->CommonModel->insertData('land_description_details',$post_array);
        if($result) {
          $flag       = array('current_flag' => 0);
          $this->CommonModel->updateDataByField('land_owner_profile_basic','file_no',$ld_file_no,$flag);
            $response = array(
                    'status'          => 'success',
                    'data'            => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'         => 'redirect',
                    'redirect_url'    => base_url().'LandDetails/veiwLandDescription/'.$ld_file_no,
            );
          header("Content-type: application/json");
          echo json_encode($response);
          exit;
        } else {
           $response = array(
                    'status'        => 'fail',
                    'data'          => "oops you got an error",
            );
          header("Content-type: application/json");
          echo json_encode($response);
          exit;
        }
    }
  }

  /**
    * This function on view land details.
    * @param  varchar $file_no
    * @return void 
   */
  public function EditLandDetails($id) {
      if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
          $file_no                  = $this->uri->segment(3);
          
          $data['page']             = 'bidur/edit_land_details_v1';
          $data['oldwardaddress']   = $this->CommonModel->addressOld();
          $data['wardadrress']      = $this->CommonModel->oldWard();
          $data['roadkisim']        = $this->CommonModel->getWhereAll('settings_road_type', array('fiscal_year'=> $this->fy));
          $data['jaggaunit']        = $this->CommonModel->getData('settings_unit', 'DESC');
          $data['landDescription']    = $this->CommonModel->GetLandDetailsByID($id);
          $data['lo_details']       = $this->CommonModel->GetLandOwnerRowByFileNo($data['landDescription']['ld_file_no']);
          $has_bill = check_tax_pax_for_current_fiscal_year($data['landDescription']['ld_file_no'], $this->fy);
          if($data['landDescription']['current_flag'] == 1) {
            $this->session->set_flashdata('MSG_ACCESS','चालु आ. व. को रसिद काटिएको ले सम्पादन गर्न मिल्दैन');
            redirect('LandDetails/veiwLandDescription/'.$data['landDescription']['ld_file_no']);
          }
          
          $data['areatype'] = $this->CommonModel->getWhereAll('settings_land_area_type',array('fiscal_year'=> $this->fy));
          $present_ward =  $data['landDescription']['present_ward'];
          $data['roadtype']          = $this->CommonModel->getAllDataBySelectedFields('settings_road','ward',$present_ward);
          $data['land_category']      = $this->CommonModel->getData('land_category', 'DESC');
          $this->load->view('main', $data);
      } else {
          $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
          redirect('Dashboard');
      }
  }


  /**
    * This function on view land details.
    * @param  varchar $file_no
    * @return void 
  */
  public function updateLandDetails() {
      if($this->input->is_ajax_request()) {
        $id                     = $this->input->post('id');
        $old_gapa_napa          = $this->input->post('old_gapa_napa');
        $old_ward               = $this->input->post('old_ward');
        $present_gapa_napa      = $this->input->post('present_gapa_napa');
        $present_ward           = $this->input->post('present_ward');
        $road_name              = $this->input->post('road_name');
        $land_area_type         = $this->input->post('land_area_type');
        $land_category          = $this->input->post('land_category');
        $n_number               = $this->input->post('nn_number');
        $k_number               = $this->input->post('k_number');
        $a_ropani               = $this->input->post('a_ropani');//biga
        $a_ana                  = $this->input->post('a_ana');//kattha
        $a_paisa                = $this->input->post('a_paisa');//dhur
        $a_dam                  = $this->input->post('a_dam');
        $a_unit                 = $this->input->post('a_unit');
        $total_square_feet      = $this->input->post('total_square_feet');
        $min_land_rate          = $this->input->post('min_land_rate');
        $max_land_rate          = $this->input->post('max_land_rate');
        $k_land_rate            = $this->input->post('k_land_rate');
        $t_rate                 = $this->input->post('t_rate');
        $ld_file_no             = $this->input->post('ld_file_no');
        $k_number_org           = $this->input->post('k_number_org');
        $flag           = $this->input->post('flag');
        $data['lo_details']     = $this->CommonModel->GetLandOwnerRowByFileNo($ld_file_no);
        $data['landDescription']    = $this->CommonModel->GetLandDetailsByID($id);
        if($ld_file_no != $data['lo_details']['file_no']){
          exit('invalid file no');
        }

        $this->form_validation->set_rules('old_gapa_napa',     'साबिक गा.पा/न.पा', 'required');
        $this->form_validation->set_rules('old_ward',     'साबिक वडा नं', 'required');
        $this->form_validation->set_rules('present_gapa_napa', 'हाल गा.पा/न.पा', 'required');
        $this->form_validation->set_rules('present_ward', 'हाल वडा नं', 'required');
        $this->form_validation->set_rules('road_name', 'सडकको नाम', 'required');
        $this->form_validation->set_rules('land_area_type', 'जग्गाको क्षेत्रगत किसिम', array('trim','required'));
        if(MODULE == 2) {
          $this->form_validation->set_rules('land_category', 'जग्गाको श्रेणी', array('trim','required'));
        }
        $this->form_validation->set_rules('nn_number', 'नक्सा नं', array('trim','required'));
        $this->form_validation->set_rules('k_number', 'कित्ता नं', array('trim','required'));
        $this->form_validation->set_rules('total_square_feet', 'क्षेत्रफल', array('trim','required'));
        $this->form_validation->set_rules('min_land_rate', 'तोकिएको न्युनतम मुल्य(प्रति कठ्ठा )', array('trim','required'));
        $this->form_validation->set_rules('k_land_rate', 'कबुल गरेको मुल्य(प्रति कठ्ठा )', array('trim','required'));
        $this->form_validation->set_rules('t_rate', 'कर लाग्ने मुल्य', array('trim','required'));

         if($this->form_validation->run() == false) {
            $response = array(
                'status'      => 'validation_error',
                'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
        
        // $has_bill = check_tax_pax_for_current_fiscal_year($ld_file_no,current_fiscal_year());
        //   if($flag == 1) {
        //       $response = array(
        //         'status'      => 'error',
        //         'message'     => 'चालु आ. व. को रसिद काटिएको ले सम्पादन गर्न मिल्दैन.',
        //     );
        //     header("Content-type: application/json");
        //     echo json_encode($response);
        //     exit;
        //     //$this->session->set_flashdata('MSG_ACCESS','चालु आ. व. को रसिद काटिएको ले सम्पादन गर्न मिल्द
        //     //redirect('LandDetails/veiwLandDescription/'.$data['landDescription']['ld_file_no']);
        // }
          
        // if($data['landDescription']['k_number'] != $flag){
        //   $check_unique_k_no = check_unique_kitta_no($k_number, $old_ward );
        //   if($check_unique_k_no == 1 ) {
        //     $response = array(
        //         'status'      => 'error',
        //         'message'     => 'कित्ता कित्ता नं दोहोरिएको हुनाले सम्पादन भएन.',
        //     );
        //     header("Content-type: application/json");
        //     echo json_encode($response);
        //     exit;
        //   }
        // }
        $post_array = array(
          'old_gapa_napa'       => $old_gapa_napa,
          'old_ward'            => $old_ward,
          'present_gapa_napa'   => $present_gapa_napa,
          'present_ward'        => $present_ward,
          'road_name'           => $road_name,
          'land_area_type'      => $land_area_type,
          'land_category'       => $land_category,
          'nn_number'           => $n_number,
          'k_number'            => $k_number,
          'a_ropani'            => $a_ropani,
          'a_paisa'             => $a_paisa,
          'a_ana'               => $a_ana,
          'a_dam'               => $a_dam,
          'a_unit'              => $a_unit,
          'total_square_feet'   => $total_square_feet,
          'min_land_rate'       => $min_land_rate,
          'max_land_rate'       => $max_land_rate,
          'k_land_rate'         => $k_land_rate,
          't_rate'              => $t_rate,
          // 'ld_file_no' =>$ld_file_no,
          'modified_by'            => $this->session->userdata('PRJ_USER_ID'),
          'modified_on'            => convertDate(date('Y-m-d'))
        );
        $sanrachana_details = $this->LandDetailsModel->HasSanrachana($k_number);
        if($sanrachana_details == true) {
          $sanrachana_details = $this->CommonModel->getAllDataBySelectedFields('sanrachana_details','k_no', $k_number);
          $details = array();
          //$total_land_area = $a_ropani.'-'.$a_ana.'-'.$a_paisa.'-'.$a_dam;
        //   if(!empty($sanrachana_details)) {
        //     foreach($sanrachana_details as $key => $val){
        //       $r_bhumi = $val['r_bhumi_area'] / 5476;
        //       $r_bhumi_tax = $r_bhumi * $k_land_rate;
        //       $details[] = array( 
        //         'k_no'                            => $k_number,
        //         'toal_land_area'                  => $total_land_area,
        //         'total_land_area_sqft'            => $total_square_feet,
        //         'total_land_min_amount'           => $min_land_rate,
        //         'total_land_tax_amount'           => $k_land_rate,
        //         'r_bhumi_kar'                     => $r_bhumi_tax,
        //       );
        //     }
        //     $this->LandDetailsModel->updateSanrachana($details,$k_number);
        //   }
          // pp($sanrachana_details);
          
          // $r_bhumi_tax = $total_square_feet / 72900;
          // $land_tax_amount = $r_bhumi_
          // $data = array(
          //           'k_no'=>$k_number,
          //           'total_land_area' => $total_land_area,
          //           'total_land_area_sqft' => $total_square_feet,,
          //           'total_land_min_amount' =>$min_land_rate,
          //           'total_land_tax_amount' =>$k_land_rate,,
          //         );
          
        }
        $result = $this->CommonModel->updateData('land_description_details',$id,$post_array);
        if($result) {
            
            $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'redirect',
                    'redirect_url'    => base_url().'LandDetails/veiwLandDescription/'.$ld_file_no,
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

  //get minimal cost
  public function GetLandMinCost() {
    if($this->input->is_ajax_request()) {
      $road_name = $this->input->post('road_name');
      $present_ward = $this->input->post('present_ward');
      $data = $this->CommonModel->getwhere('settings_road', array('fiscal_year' => $this->fy));
      $response = array(
        'status'        => 'success',
        'data'          => $data,
      );
      header("Content-type: application/json");
      echo json_encode($response);
      exit;
    }
  }

  /**
    * This function delete data from database.
    * check proper id is in format of not.
    * @param $id int pk
    * @return boolean.
  */
  public function delete() {
      if($this->input->is_ajax_request()) {
          $id = $this->input->post('id');
          $kitta_no = $this->input->post('kitta');
         
          $file_no = $this->CommonModel->getDataById('land_description_details', $id);
          $result = $this->LandDetailsModel->remove($id);
         
          if($result) {
              
              $sanrachana_details = $this->LandDetailsModel->HasSanrachana($kitta_no);
              if($sanrachana_details == true) {
                $this->LandDetailsModel->RemoveSanrachanaDetails($kitta_no);
              }

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
//   public function getNewAddress() {
//     $gapana = $this->input->post('gapana');
//     $ward = $this->input->post('ward');
//     $data = $this->LandDetailsModel->getNewAddressDetails($gapana,$ward);
//     //pp($data);
//     $road_option = "";
//     $road_option .= "<option value=''>छान्नुहोस्</option>";
//     $road['details'] = $this->LandDetailsModel->getRoadDetails($data['present_ward']);
//     if(!empty($road['details'])) {
//       $i=1;
//       foreach ($road['details'] as $key => $value) {
//         $road_option .= "<option value = '".$value['id']."''>".'<b>'.$this->mylibrary->convertedcit($i++).') </b> '.$value['road_name']."</option>";
//       }
//     } else {
//       $road_option .= "<option> Empty Road</option>";
//     }
//     $new_gapana = $data['present_name'];
//     $new_ward = $data['present_ward'];
//     $response = array(
//       'status'      => 'success',
//       'data'         => $data,
//       'road_option' => $road_option,
//     );
//     header("Content-type: application/json");
//     echo json_encode($response);
//     exit;
  //} 
  
  public function getNewAddress() {
    $gapana = $this->input->post('gapana');
    $ward = $this->input->post('ward');
    $data = $this->LandDetailsModel->getNewAddressDetails($gapana,$ward);
    
    $present_ward = '<option value="">हालको वडा छान्नुहोस्</option>';
    if(!empty($data)) {
      foreach($data as $key => $value) {
        $present_ward .= "<option value = '".$value['present_ward']."''>" .$value['present_ward']."</option>";
      }
    }
    //$road_option = "";
    //$road_option .= "<option value=''>छान्नुहोस्</option>";
    //$road['details'] = $this->LandDetailsModel->getRoadDetails($data['present_ward']);
    // if(!empty($road['details'])) {
    //   $i=1;
    //   foreach ($road['details'] as $key => $value) {
    //     $road_option .= "<option value = '".$value['id']."''>".'<b>'.$this->mylibrary->convertedcit($i++).') </b> '.$value['road_name']."</option>";
    //   }
    // } else {
    //   $road_option .= "<option> Empty Road</option>";
    // }
    //$new_gapana = $data['present_name'];
    //$new_ward = $data['present_ward'];
    $response = array(
      'status'      => 'success',
      'data'        => $present_ward,
      'gapa'        => 'विदुर',
    );
    header("Content-type: application/json");
    echo json_encode($response);
    exit;
  } 
    
    //get road details
  public function RoadDetails() {
    $present_ward = $this->input->post('ward');
    $road_option = "";
    $road_option .= "<option value=''>छान्नुहोस्</option>";
    $road['details'] = $this->LandDetailsModel->getRoadDetails($present_ward);
    //pp($road['details']);
    if(!empty($road['details'])) {
      $i=1;
      foreach ($road['details'] as $key => $value) {
        $road_option .= "<option value = '".$value['id']."''>".'<b>'.$this->mylibrary->convertedcit($i++).') </b> '.$value['road_name']."</option>";
      }
    } else {
      $road_option .= "<option> Empty Road</option>";
    }
    $response = array(
      'status'          => 'success',
      'road_option'     => $road_option,
    );
    header("Content-type: application/json");
    echo json_encode($response);
    exit;
  }
  
   /**
    * on ajax request get new address on request old address.
    * check proper id is in format of not.
    * @param $ward int pk
    * @return boolean.
  */
  public function getNewWard() {
    $gapana = $this->input->post('gapana');
    $data = $this->LandDetailsModel->oldWard($gapana);
    $wards = "<option value=''>छान्नुहोस्</option>";
   
    if(!empty($data)) {
      foreach ($data as $key => $value) {
        $wards .= "<option value = '".$value['old_ward']."''>".$value['old_ward']."</option>";
      }
    } else {
      $wards .= "<option></option>";
    }
    $response = array(
      'status'      => 'success',
      'wards' => $wards,
    );
    header("Content-type: application/json");
    echo json_encode($response);
    exit;
  } 


  public function getLandAreaCost() {
    if($this->input->is_ajax_request()) {
      $road_name = $this->input->post('road_name');
      $land_area_type = $this->input->post('land_area_type');
      $ward = $this->input->post('ward');
      $data = $this->LandDetailsModel->getLandCost($road_name,$land_area_type,$ward);
      $response = array(
        'status'      => 'success',
        'data'         => $data,
      );
      header("Content-type: application/json");
      echo json_encode($response);
      exit;
    }
  }
  
  
  
  public function removeKitta() {
      
        $id = $this->input->post('id');
        $data['landdetail'] = $this->CommonModel->getDataByID('land_description_details', $id);
        $this->load->view('kitta_remove_reason',$data);
  }
  
  /**
        * Call on ajax request cancel
        * @param form fields
        * @return NULL
     */
    public function savekittaKut() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('land_id');
            $file_no = $this->input->post('file_no');
            $kitta_no = $this->input->post('kitta_no');
            $post_data = array(
                'land_id'       => $id,
                'kitta_no'      => $kitta_no,
                'file_no'        => $file_no,
                'reason'        => $this->input->post('reason'),
                'created_at'          => convertDate(date('Y-m-d')),
                'created_by'        => $this->session->userdata('PRJ_USER_ID'),
                'created_ward'      => $this->session->userdata('PRJ_USER_WARD'),
                'created_ip'        => $this->input->ip_address(),
            );
            $result = $this->CommonModel->insertData('kitta_cut',$post_data);
            if($result) {
                $data = array('buy_sell_status' => 2);
                $this->CommonModel->UpdateData('land_description_details',$id, $data);
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
    
    public function viewBadarReason() {
        $id = $this->input->post('id');
        $data['reason'] = $this->CommonModel->getWhere('kitta_cut', array('land_id' => $id));
        $this->load->view('badar_reason',$data);
    }


  //transfer kitta
  public function transerLandDetails($file_no)
  {
    $data['page']               = 'bidur/transfer_land';
    $data['file_no']            = $file_no;
    $data['land_owner']         = $this->CommonModel->GetLandOwnerRowByFileNo($file_no);
    $data['transfer_profile']   = $this->CommonModel->GetLandOwnerRowByFileNo($data['land_owner']['transfer_fileno']);
    $data['lands']              = $this->LandDetailsModel->GetLandDetails($data['land_owner']['transfer_fileno']);
    $data['has_bill']           = $this->LandDetailsModel->checkIfTaxPaid($file_no);
    $this->load->view('main', $data);
  }

  //save transfered land data
  public function saveTranserLands()
  {
    $land_ids = $this->input->post('land_id');
    $updateids = implode(',', $land_ids);

    $old_file_no = $this->input->post('old_file_no');
    $ld_file_no = $this->input->post('ld_file_no');
    $remarks = $this->input->post('remarks');
    if (empty($land_ids)) {
      $this->session->set_flashdata('MSG_ACCESS', 'कित्ता नामसारी गर्नुपर्ने कित्ता नं. मा टिक लगानुहोस');
      redirect('LandDetails/transerLandDetails/' . $ld_file_no);
    }

    if (empty($old_file_no)) {
      $this->session->set_flashdata('MSG_ACCESS', 'Invalid request!!! please try again');
      redirect('LandDetails/transerLandDetails/' . $ld_file_no);
    }

    if (empty($ld_file_no)) {
      $this->session->set_flashdata('MSG_ACCESS', 'Invalid request!!! please try again');
      redirect('LandDetails/transerLandDetails/' . $ld_file_no);
    }

    if (empty($remarks)) {
      $this->session->set_flashdata('MSG_ACCESS', 'कैफियत लेख्नुहोस');
      redirect('LandDetails/transerLandDetails/' . $ld_file_no);
    }
    $new_lands = $this->LandDetailsModel->getByIds($land_ids);
    //pp($new_lands);
    $land_data = array();
    if (!empty($new_lands)) {
      foreach ($new_lands as $land) {
        $land_data[] = array(
          'old_gapa_napa'     => $land->old_gapa_napa,
          'old_ward'          => $land->old_ward,
          'present_gapa_napa' => $land->present_gapa_napa,
          'present_ward'      => $land->present_ward,
          'road_name'         => $land->road_name,
          'land_area_type'    => $land->land_area_type,
          'land_category'     => $land->land_category,
          'nn_number'         => $land->nn_number,
          'k_number'          => $land->k_number,
          'a_ropani'          => $land->a_ropani,
          'a_paisa'           => $land->a_paisa,
          'a_ana'             => $land->a_ana,
          'a_dam'             => $land->a_dam,
          'a_unit'            => $land->a_unit,
          'total_square_feet' => $land->total_square_feet,
          'min_land_rate'     => $land->min_land_rate,
          'max_land_rate'     => $land->max_land_rate,
          'k_land_rate'       => $land->k_land_rate,
          'fiscal_year'       => $this->fy,
          't_rate'            => $land->t_rate,
          'ld_file_no'        => $ld_file_no,
          'reasontoadd'       => 3,
          'added_by'          => $this->session->userdata('PRJ_USER_ID'),
          'added_on'          => convertDate(date('Y-m-d'))
        );
      }
    }
    $result = $this->LandDetailsModel->saveTransLand($land_data);
    if ($result) {
      $data = array(
        'status' => 3,
        'buy_sell_status' => 2
      );
      $this->LandDetailsModel->updateTransLand($updateids, $data);
      redirect('LandDetails/veiwLandDescription/' . $ld_file_no);
    }
  } //end of function

    //get land details
    // public function getLandDetailsByFileNo() {
    //   if($this->input->is_ajax_request()) {
    //     $file_no          = $this->input->post('file_no');
    //     $data['lands']    = $this->LandDetailsModel->GetLandDetails($file_no);
    //     $data_view             = $this->load->view('bidur/land_to_transfer', $data, true);
    //     $response = array(
    //       'status'        => 'success',
    //       'data'          => $data_view,
    //     );
    //       header("Content-type: application/json");
    //       echo json_encode($response);
    //       exit;
    //     } else {
    //       echo "invalid request!!!";
    //   }
    // }

}//end of class

?>
