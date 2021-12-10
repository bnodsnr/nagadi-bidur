<?php

class SearchDetails extends MX_Controller
{
    public function __construct()
    {
      parent:: __construct();
      $this->module_code = 'REPORT';
      $this->load->model('CommonModel');
      $this->load->model('SearchModel');
      if(!$this->authlibrary->IsLoggedIn()){
        $this->session->set_userdata('return_url', current_url());
        redirect('Login');
      }
          $this->container = 'main';
      $this->today = convertdate(date('Y-m-d'));
      $this->current_month = get_current_month();
    }

    public function Index()
    {
        if ($this->authlibrary->HasModulePermission('DAILY-REPORT', "VIEW")) {
          $data['main_topic']         = $this->CommonModel->getData('main_topic', 'ASC');
          $data['fiscal_year']         = $this->CommonModel->getData('fiscal_year', 'ASC');
          $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC');
          $data['page']               = 'search';
          $this->load->view('main',$data);
        }
    }

  /**
     * This function on ajax call get all daily report.
     * @param varchar $date, int $ward
     * @return json.
    */
    public function AdminSearchReport() {
       if($this->input->is_ajax_request()) {
        $ward_no                        = $this->input->post('search_added_ward');
        $from_date                      = $this->input->post('from_date');
        $to_date                        = $this->input->post('to_date');
        $fiscal_year                    = $this->input->post('fiscal_year');
        $user                           = $this->input->post('user_id');
        $data['from_date']              = !empty($from_date)?$from_date:'-';
        $data['to_date']                = !empty($to_date)?$to_date:'-';
        $data['ward_no']                = !empty($ward_no)?$ward_no:'-';
        $data['fiscal_year']            = !empty($fiscal_year)?$fiscal_year:'-';
        if($fiscal_year != '-') {
            $data['fy'] = str_replace("/", '-', $fiscal_year);
        }
        $data['nagadi_details']         = $this->SearchModel->getNagadiSearchDetails($from_date, $to_date, $ward_no, $fiscal_year,$user);
        $data['cancel_amount']          = $this->SearchModel->getCancelAmountDetailsBySearch( $from_date,$to_date, $ward_no,$fiscal_year, $user);
        $data['sampatikar']             = $this->SearchModel->getSearchSampatiKarDetails( $from_date,$to_date, $ward_no,$fiscal_year, $user);
        $data['sampati_cancel_amount']  = $this->SearchModel->getCancelSampatikarAmountDetailsBySearch( $from_date,$to_date, $ward_no,$fiscal_year, $user);
        $data_view                      = $this->load->view('ajax_search_view', $data, true);
        $response                       = array(
          'status'                      => 'success',
          'data'                        => $data_view
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
      }
    }

    public function GetUser() {
      $ward_no = $this->input->post('ward_no');
      $user = $this->CommonModel->getAllDataByField('users','ward', $ward_no);
      //pp($user);
      if(!empty($user)){

        $option = '';
       
        $option .= '<option value="">छान्नुहोस्</option>';
        foreach ($user as $key => $value) :
          $option .= '<option value = '.$value["userid"].'>'.$value["name"].'</option>';
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

    public function PrintDetails($from_date =NULL,$to_date=NULL, $ward_no=NULL,$fiscal_year=NULL,$user=NULL) {
      $data['from_date']                        = $from_date;
      $data['to_date']                          = $to_date;
      $ward_no                                  = $ward_no;
      $user                                     = $user;
      $data['ward_no']                          = $ward_no;
      $fy                                       = str_replace("-", '/', $fiscal_year);
      $data['nagadi_details']                   = $this->SearchModel->getNagadiSearchDetails( $from_date,$to_date, $ward_no,$fy, $user);
      $data['cancel_amount']                    = $this->SearchModel->getCancelAmountDetailsBySearch( $from_date,$to_date, $ward_no,$fy, $user);
      $data['sampatikar']                       = $this->SearchModel->getSearchSampatiKarDetails( $from_date,$to_date, $ward_no,$fy, $user);
      $data['sampati_cancel_amount']            = $this->SearchModel->getCancelSampatikarAmountDetailsBySearch( $from_date,$to_date,$fy,$ward_no, $user);
      $this->load->view('print_search', $data);
    }
}