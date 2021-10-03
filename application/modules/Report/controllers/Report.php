<?php
/**
* created by php strom
  Name:Binod Sunar
  Date:2018/02/01:11:14 AM.
*/
class Report extends MX_Controller
{	
	public function __construct()
	{
		parent:: __construct();
        $this->module_code = 'REPORT';
        $this->load->model('CommonModel');
        $this->load->model('Reportmodel');
        if(!$this->authlibrary->IsLoggedIn()){

            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
		$this->container='main';
	}

	public function Index()
	{
    
	}

  /*
    * This function get all total sampati-bhumi kar details by ward
    * @param NULL
    * @ return view
  */
  public function OverallReport() {
      if ($this->authlibrary->HasModulePermission($this->module_code, "VIEW")) {
        $data['page'] = 'list_report';
        $this->load->view('main', $data);
      }
  }

  /*
    * On ajax call this function get all total sampati-bhumi kar details by given parament
    * @ param $_POST['date']
    * @ param $_POST['fiscal_year']
    * @ param $_POST['ward']
    * @ return json_response
  */
  public function searchReport() {
    

    if($this->input->is_ajax_request()) {
      $date = $this->input->post('date');
      $fiscal_year = $this->input->post('fiscal_year');
      $ward = $this->input->post('ward_no');
      $data['result'] = $this->Reportmodel->getNagadiReport($date, $ward, $fiscal_year);
      $data_view = $this->load->view('ajax_search_report', $data, true);
      $response = array(
        'status'            => 'success',
        'data'              => $data_view
      );
      header("Content-type: application/json");
      echo json_encode($response);
      exit;
    }

  }

  public function viewAllReport() {

  }


}//end of class