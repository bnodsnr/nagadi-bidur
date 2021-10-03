<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


  if ( ! function_exists('get_current_fiscal_year')){
   function get_current_fiscal_year(){
       //get main CodeIgniter object
       $ci =& get_instance();
       //load databse library
       $ci->load->database();
       //get data from database
       $query = $ci->db->get_where('fiscal_year',array('is_current'=>1));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['year'];
       }else{
           return false;
       }
   }
  }

  

  if ( ! function_exists('get_current_login_user'))
  {
    function get_current_login_user($userid){
      $ci =& get_instance();
       //load databse library
      $ci->load->database();
       //get data from database
      $query = $ci->db->get_where('users',array('userid'=>$userid));
      if($query->num_rows() > 0){
          $result = $query->row_array();
          return $result;
      } else {
          return false;
      }
    }
  }

  if ( ! function_exists('check_tax_pax_for_current_fiscal_year'))
  {
    function check_tax_pax_for_current_fiscal_year($file_no = NULL, $fiscal_year = NULL){
     
      $ci =& get_instance();
       //load databse library
      $ci->load->database();
       //get data from database
      $ci->db->where('fiscal_year', $fiscal_year);
      $ci->db->where('nb_file_no', $file_no);
      $ci->db->where('status', '1');
      $query = $ci->db->get('sampati_kar_bhumi_kar_bill_details');
      if ($query->num_rows() > 0){
            return true;
      }
      else {
          return false;
      }
    }
  }

  /** 
    * This function generate file no for land owner
    * @param string $_POST['name'], int ward $_POST['ward'], int GAPANPA ID $_POST['gapana']
    * @return string file_no
  */
  if(!function_exists('generate_file_no'))
  { 
    function generate_file_no($name = NULL, $address_ward =NULL, $gapana= NULL) {
      $ci =& get_instance();
      $ci->load->model('CommonModel');
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
      $name       = strtoupper(trim($name));
      if($address_ward < 10) {
        $first    ='0'.$address_ward;    
      } else {
        $first    = $address_ward;
      }
      $second_alphabet    = substr($name,0,1);
      $second             = $name_array[$second_alphabet];
      $t                  = $ci->CommonModel->getNameCount($second_alphabet);
      $third              = $t->third_sn + 1;
    
      if($third < 10) {
          $third = '000'.$third;
      } elseif($third >= 10 && $third < 100) {
          $third = '00'.$third;
      } else {
          $third ='0'.$third;
      }
      if($gapana != GID) {
        $f_word = '00';
      } else {
        if(empty($address_ward)) {
          if($ci->session->userdata('PRJ_USER_WARD') == 1) {
            $f_word = '00';
          } else {
            $f_word = $ci->session->userdata('PRJ_USER_WARD');
            if($f_word < 10) {
              $f_word = '0'.$ci->session->userdata('PRJ_USER_WARD');
            } else {
              $f_word = $address_ward;
            }
          }
        } else {
          $f_word = $first;
        }
      }
      $res = $f_word.'-'.$second.'-'.$third;
      //echo $f_word;
      return $res;
    }
  }

  /** 
    * This function generate file no for land owner
    * @param string $_POST['name'], int ward $_POST['ward'], int GAPANPA ID $_POST['gapana']
    * @return string file_no
  */
  if(!function_exists('getDistricts'))
  {
    function getDistricts($state = NULL) 
    {
      $ci =& get_instance();
      //load databse library
      $ci->load->database();
     //get data from database
      if(!empty($state)){
        $ci->db->where('state', $state);
      }
      $query = $ci->db->get('settings_district');
      if ($query->num_rows() > 0){
        return $query->result_array();
      }
      else {
          return false;
      }
    }
  }

  if(!function_exists('get_district_dropdown')) {
    function get_district_dropdown($state) {
      if(!empty($state)) {
        $state = $state;
      } else {
        $state = STATE;
      }
      $district = getDistricts($state);
      if(!empty($district)){
        $option = '';
        $option .= '<option value="">छान्नुहोस्</option>';
        foreach ($district as $key => $value) :
          $option .= "<option value = '".$value['id']."''>".$value['name']."</option>";
        endforeach;
        $response = array(
          'status'      => 'success',
          'option' => $option,
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
      }
    }
  }
  if(!function_exists('get_gapanapa'))
  {
    function get_gapanapa($district = NULL) 
    {
      $ci =& get_instance();
      //load databse library
      $ci->load->database();
     //get data from database
      if(!empty($district)){
        $ci->db->where('district_id', $district);
      } else {
        $ci->db->where('district_id', DID);
      }
      $query = $ci->db->get('settings_vdc_municipality');
      if ($query->num_rows() > 0){
          return $query->result_array();
      }
      else {
          return false;
      }
    }
  }

  if(!function_exists('get_ganapa_dropdown')) {
    function get_ganapa_dropdown($district = NULL) {
      if(!empty($district)) {
        $district = $district;
      } else {
        $district = DID;
      }
      $gapa = get_gapanapa($district);
      if(!empty($gapa)){
        $option = '';
        $option .= '<option value="">छान्नुहोस्</option>';
        foreach ($gapa as $key => $value) :
          $option .= "<option value = '".$value['id']."''>".$value['name']."</option>";
        endforeach;
        $response = array(
          'status'      => 'success',
          'option' => $option,
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
      }
    }
  }

  //check uinque fileno
  if(!function_exists('is_unique_file_no')) {
    function is_unique_file_no($file_no = NULL){
      $ci =& get_instance();
       //load databse library
      $ci->load->database();
      $ci->db->where('file_no', $file_no);
      $query = $ci->db->get('land_owner_profile_basic');
      if ($query->num_rows() > 0){
        return true;
      }
      else {
        return false;
      }
    }
  }

  //check if has land descritpion
  if(!function_exists('has_land')) {
    function has_land($file_no = NULL){
      $ci =& get_instance();
       //load databse library
      $ci->load->database();
      $ci->db->where('ld_file_no', $file_no);
      $query = $ci->db->get('land_description_details');
      if ($query->num_rows() > 0){
        return true;
      }
      else {
        return false;
      }
    }
  }

  if(!function_exists('has_sanrachana')) {
    function has_sanrachana($file_no = NULL){
      $ci =& get_instance();
       //load databse library
      $ci->load->database();
      $ci->db->where('ls_file_no', $file_no);
      $query = $ci->db->get('sanrachana_details');
      if ($query->num_rows() > 0){
        return true;
      }
      else {
        return false;
      }
    }
  }

  if(!function_exists('check_unique_kitta_no')) {
    function check_unique_kitta_no($kitta = NULL, $ward){
      $ci =& get_instance();
      //load databse library
      $ci->load->database();
      $ci->db->where('k_number', $kitta);
      $ci->db->where('old_ward', $ward);
      $query = $ci->db->get('land_description_details');
      if ($query->num_rows() > 0){
        return true;
      }
      else {
        return false;
      }
    }
  }
  
   if(!function_exists('check_unique_bill_no')) {
    function check_unique_bill_no($user = NULL, $bill_type=NULL, $fiscal_year =NULL){
      $ci =& get_instance();
      //load databse library
      $ci->load->database();
      $ci->db->where('user_id',  $user);
      $ci->db->where('bill_type', $bill_type);
      $ci->db->where('fiscal_year', $fiscal_year);
      $query = $ci->db->get('settings_bill_setup');
      if ($query->num_rows() > 0){
        return true;
      }
      else {
        return false;
      }
    }
  }
  
   if(!function_exists('check_bill_no_exits')) {
    function check_bill_no_exits($bill_type = NULL, $from=NULL, $to=NULL, $fiscal_year=NULL){
      $ci =& get_instance();
      //load databse library
      $ci->load->database();
      $ci->db->where('bill_type', $bill_type);
      $ci->db->where('bill_from', $from);
      $ci->db->where('bill_to', $to);
      $ci->db->where('fiscal_year', $fiscal_year);
     
      $query = $ci->db->get('settings_bill_setup');
      if ($query->num_rows() > 0){
        return true;
      }
      else {
        return false;
      }
    }
   }

  if(!function_exists('check_if_has_nagadi_bills')) {
    function check_if_has_nagadi_bills($table, $fiscal_year,$ward){
      $ci =& get_instance();
      $ci->db->select('bill_no');
      $ci->db->from($table);
      $ci->db->where('fiscal_year', $fiscal_year);
      $ci->db->where('added_ward', $ward);
      $query = $ci->db->get();
      return $query->result();
      $query = $ci->db->get('settings_bill_setup');
      if ($query->num_rows() > 0){
        return true;
      }
      else {
        return false;
      }
    }
  }

