<?php
/**
* created by php strom
  Name:Binod Sunar
  Date:2018/02/01:11:14 AM.
*/
class AllReport extends MX_Controller
{	
	public function __construct()
	{
		parent:: __construct();
        $this->module_code = 'REPORT';
        $this->load->model('CommonModel');
        $this->load->model('AllReportmodel');
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
    * this function get all total sampati-bhumi kar details by ward
    * @ param NULL
    * @ return view
  */
  public function dailyCollectionReport() {
      if ($this->authlibrary->HasModulePermission('DAILY-COLLECTION-REPORT', "VIEW")) {
        $data['ward'] = $this->CommonModel->getData('settings_ward', 'ASC');
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'ASC');
        $data['page'] = 'daily_collection_report';
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
      $fiscal_year = $this->input->post('fy');
      $ward = $this->input->post('ward');
      $data['ward'] = $ward;
      $data['fiscal_year'] = $fiscal_year;
      $data['date'] = $date;
      $data['nagadi'] = $this->AllReportmodel->getNagadiReport($date, $ward, $fiscal_year);
      $data['sambhukar'] = $this->AllReportmodel->getTotalSampatBhumiKar($date, $ward, $fiscal_year);
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
  // public function WardWiseReport(){
  //   if ($this->authlibrary->HasModulePermission($this->module_code,"VIEW")){
  //     $data['page'] = 'ward_wise_report';
  //     $data['main_topic'] = $this->CommonModel->getData('main_topic','DESC');
  //     // pp($data['main_topic']);
  //     $this->load->view('main',$data);
  //   }
  // }

  // public function DailyIncomeLedger(){
  //   if ($this->authlibrary->HasModulePermission($this->module_code,"VIEW")){
  //     $data['page'] = 'daily_income_ledger';
  //     $this->load->view('main', $data);
  //   }
  // }
}