<?php

/**

* created by php strom

  Name:Binod Sunar

  Date:2018/02/01:11:14 AM.

*/

require_once FCPATH.'/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class NagadiReport extends MX_Controller

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

      $data['page'] = 'dashboard';

      $data['title'] = '';

      $data['pagetitle'] = '';

      $this->load->view('main', $data);

  	}



    public function OverallReport() {

        if ($this->authlibrary->HasModulePermission('OVER-ALL-NAGADI-REPORT', "VIEW")) {
          $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));
          $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
          $data['page'] = 'overall_report_file';
          $this->load->view('main', $data);
        }

     }



     //DAILY REPORT

     public function DailyNagadiReport(){

        if ($this->authlibrary->HasModulePermission('DAILY-NAGADI-REPORT', "VIEW")) {

          $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');

          $data['ward'] = $this->CommonModel->getData('settings_ward', 'DESC');

          $data['page'] = 'daily_n_report';

          $this->load->view('main', $data);

        }

     }



    //SearchDailyReportBy

    public function SearchDailyReportBy() {

      if($this->input->is_ajax_request()) {

        $date = $this->input->post('date');

        $data['date'] = $date;

        $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');

        $data_view = $this->load->view('ajax_search_daily_report', $data, true);

        $response = array(

          'status'            => 'success',

          'data'              => $data_view

        );

        header("Content-type: application/json");

        echo json_encode($response);

        exit;

      }

    }



    //generate pdf for over allreport

    public function overAllNagadiReport() {

      if ($this->authlibrary->HasModulePermission('OVER-ALL-NAGADI-REPORT', "VIEW")) {

        $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');

        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');

        $data['ward'] = $this->CommonModel->getData('settings_ward', 'DESC');

        $data['page'] = 'search_report';

        $this->load->view('main', $data);

      }

    }



    //search report

    public function dailyReportLedger() {

      if ($this->authlibrary->HasModulePermission('OVER-ALL-NAGADI-REPORT', "VIEW")) {

        $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');

        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');

        $data['ward'] = $this->CommonModel->getData('settings_ward', 'DESC');

        $data['page'] = 'daily_report_ledger';

        $this->load->view('main', $data);

      }

    }



    public function printOverAllReport() {

        $data['main_topic'] = $this->CommonModel->getData('main_topic', 'ASC');

        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');

        $data['ward'] = $this->CommonModel->getData('settings_ward', 'DESC');

        $this->load->view('p_over_all_report', $data);

    }

    

    //export to excel 

    public function exportOverAllReport() {

      $main_topic = $this->CommonModel->getData('main_topic', 'ASC');

      $spreadsheet = new Spreadsheet();

      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'आम्दानी शिर्षक');

      $sheet->setCellValue('B1', 'शिर्षक नं');

      $sheet->setCellValue('C1', 'नगरपालिका');

      $sheet->setCellValue('D1', 'वडा १');

      $sheet->setCellValue('E1', 'वडा २');

      $sheet->setCellValue('F1', 'वडा ३');

      $sheet->setCellValue('G1', 'वडा ४');

      $sheet->setCellValue('H1', 'वडा ५');

      $sheet->setCellValue('I1', 'वडा ६');

      $sheet->setCellValue('J1', 'वडा ७');

      $sheet->setCellValue('K1', 'वडा ८');

      $sheet->setCellValue('L1', 'वडा ९');

      $sheet->setCellValue('M1', 'वडा १०');

      $sheet->setCellValue('N1', 'वडा ११');

      $sheet->setCellValue('O1', 'वडा १२');

      $sheet->setCellValue('P1', 'वडा १३');

      $rowCount = 2;

      foreach ($main_topic as $element) {

          $ward_0 = $this->Reportmodel->getNagadiTotalByTopic($element['id'], '0');

          $ward_1 = $this->Reportmodel->getNagadiTotalByTopic($element['id'], '1');

          $ward_2 = $this->Reportmodel->getNagadiTotalByTopic($element['id'], '2');

          $ward_3 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'3');

          $ward_4 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'4');

          $ward_5 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'5');

          $ward_6 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'6');

          $ward_7 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'7');

          $ward_8 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'8');

          $ward_9 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'9');

          $ward_10 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'10');

          $ward_11 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'11');

          $ward_12 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'12');

          $ward_13 = $this->Reportmodel->getNagadiTotalByTopic($element['id'],'13');

          $sheet->setCellValue('A' . $rowCount, $element['topic_name']);

          $sheet->setCellValue('B' . $rowCount, $element['topic_no']);

          $sheet->setCellValue('C' . $rowCount, !empty($ward_0->total)?$ward_0->total:0);

          $sheet->setCellValue('D' . $rowCount, !empty($ward_1->total)?$ward_1->total:0);

          $sheet->setCellValue('E' . $rowCount, !empty($ward_2->total)?$ward_2->total:0);

          $sheet->setCellValue('F' . $rowCount, !empty($ward_3->total)?$ward_3->total:0);

          $sheet->setCellValue('G' . $rowCount, !empty($ward_4->total)?$ward_4->total:0);

          $sheet->setCellValue('H' . $rowCount, !empty($ward_5->total)?$ward_5->total:0);

          $sheet->setCellValue('I' . $rowCount, !empty($ward_6->total)?$ward_6->total:0);

          $sheet->setCellValue('J' . $rowCount, !empty($ward_7->total)?$ward_7->total:0);

          $sheet->setCellValue('K' . $rowCount, !empty($ward_8->total)?$ward_8->total:0);

          $sheet->setCellValue('L' . $rowCount, !empty($ward_9->total)?$ward_9->total:0);

          $sheet->setCellValue('M' . $rowCount, !empty($ward_10->total)?$ward_10->total:0);

          $sheet->setCellValue('N' . $rowCount, !empty($ward_11->total)?$ward_11->total:0);

          $sheet->setCellValue('O' . $rowCount, !empty($ward_12->total)?$ward_12->total:0);

          $sheet->setCellValue('P' . $rowCount, !empty($ward_13->total)?$ward_13->total:0);

          $rowCount++;

      }

    //set style for A1,B1,C1 cells

    $cell_st =[

     'font' =>['bold' => true],

     'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],

     'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]

    ];

    $spreadsheet->getActiveSheet()->getStyle('A1:P1')->applyFromArray($cell_st);

    $writer = new Xlsx($spreadsheet);

    $filename = 'शिर्षकगत संकलन-'.convertDate(date('Y-m-d'));

    $spreadsheet->getActiveSheet()->setTitle($filename); //set a title for Worksheet

    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 

    header('Cache-Control: max-age=0');

    $writer->save('php://output'); // download file

    }





  public function wardReport() {

    $data['page'] = 'ward_wise_v';

    $data['ward'] = $this->CommonModel->getData('settings_ward');

    $this->load->view('main', $data);

  }





  //ajax SearchWardReport

  public function SearchWardReport() {

    $month = $this->input->post('month');

    $ward  = $this->input->post('ward');

    $data['main_topic'] = $this->CommonModel->getData('main_topic');

    $data['month'] = $month;

    $data['ward'] = $ward;

    $data_view = $this->load->view('ajax_ward_monthly_report', $data, true);

    $response = array(

      'status'            => 'success',

      'data'              => $data_view

    );

    header("Content-type: application/json");

    echo json_encode($response);

    exit;

  }

  public function search() {
    $fiscal_year = $this->input->post('fiscal_year');
    //pp($fiscal_year);
    $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fiscal_year));
    $data['month'] = $month;
    $data['ward'] = $ward;
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