<?php

/**
 *created by php strom
 *Name:Binod Sunar
 */
require_once FCPATH . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MonthlyReport extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->module_code = 'REPORT';
    $this->load->model('CommonModel');
    $this->load->model('MonthlyReportMDL');
    if (!$this->authlibrary->IsLoggedIn()) {
      $this->session->set_userdata('return_url', current_url());
      redirect('Login');
    }
    $this->container = 'main';
    $this->today = convertdate(date('Y-m-d'));
    $this->current_month = get_current_month();
    $this->fy = current_fiscal_year();
  }
  public function Index()
  {
    if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
      $data['current_month']      = $this->current_month;
      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
      $data['wards']              = $this->CommonModel->getData('wardwise_address', 'ASC', "ward");
      $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
      $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year', 'DESC');
      $data['sampati_kar']        = $this->MonthlyReportMDL->SampatiKarMonthly();
      $data['bhumi_kar']          = $this->MonthlyReportMDL->BhumiKarMonthly();
      $data['page']               = 'index';
      $this->load->view('main', $data);
    }
  }

  public function printMonthlyReport()
  {
    if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
      $data['wards']              = $this->CommonModel->getData('wardwise_address', 'ASC', "ward");
      $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
      $data['current_month']      = $this->current_month;
      $data['sampati_kar']        = $this->MonthlyReportMDL->SampatiKarMonthly();
      $data['bhumi_kar']          = $this->MonthlyReportMDL->BhumiKarMonthly();
      $this->load->view('print_monthly_details', $data);
    }
  }

  //export monthly report 
  public function exportToExcel()
  {
    $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
    $data['wards']              = $this->CommonModel->getData('wardwise_address', 'ASC', "ward");
    $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
    $data['current_month']      = $this->current_month;
    $data['sampati_kar']        = $this->MonthlyReportMDL->SampatiKarMonthly();
    $data['bhumi_kar']          = $this->MonthlyReportMDL->BhumiKarMonthly();
    $nagadi_total = 0;
    $extra_text = 'मािसक कर सङ्कलन िरपोट';
    // $extra_text = '( मिति  ' . $this->mylibrary->convertedcit($from_date) . ' देखि मिति' . $this->mylibrary->convertedcit($to_date) . ' सम्म )';
    $htmlString = '<table class=""><tr><td colspan="3" style="text-align: center;background-color:#1b5693;font-size:18px;color:#e5e5e5">' . $extra_text . '</td>
        </tr></table>
    <table class=" table table-bordered">
      <thead>
        <tr>
          <th class="hidden-phone">शिर्षक नं </th>
          <th>आम्दानी शिर्षक</th>
          <th class="hidden-phone">मुल्य रु</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>११३१३</td>
          <td>एकीकृत सम्पती कर</td>
          <td>' . $this->mylibrary->convertedcit($data['sampati_kar']['total']) . '</td>
        </tr>
        <tr>
          <td>११३१४</td>
          <td>भुमिकर/मालपोत</td>
          <td>' . $this->mylibrary->convertedcit($data['bhumi_kar']['total']) . '</td>
        </tr>';
    if (!empty($data['main_topic'])) {
      foreach ($data['main_topic'] as $key => $nagadi) {
        $collection_rate = $this->MonthlyReportMDL->NagadiMontlhy($nagadi['id']);
        $htmlString .= '<tr>
            <td>' . $this->mylibrary->convertedcit($nagadi['topic_no']) . '</td>
              <td>' . $nagadi['topic_name'] . '</td>
              <td>' . $this->mylibrary->convertedcit(round($collection_rate['total'], 2)) . '</td>
          </tr>';
        $nagadi_total += $collection_rate['total'];
      }
    }
    $htmlString .= '</tbody>';
    $htmlString .= '<tfooter>
      <tr>
          <td colspan="2" style="text-align: right;background-color:#1b5693;color:#e5e5e5"><b>जम्मा</b></td>';
    $net_total = $nagadi_total + $data['sampati_kar']['total'] + $data['bhumi_kar']['total'];
    $htmlString .= '<td colspan="1" style="text-align: left;background-color:#1b5693;color:#e5e5e5">' . $this->mylibrary->convertedcit(round($net_total, 2)) . '</td>
        </tr></tfooter>';
    $htmlString .= '</table>';
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
    $spreadsheet = $reader->loadFromString($htmlString);
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . 'मासिक-प्रतिबेदन-' . $this->current_month . '-' . $this->fy . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output'); // download file
  }

  //export to pdf monthly report
  public function exportToPDF()
  {
    $mpdf                               = new \Mpdf\Mpdf(['mode' => 'utf-8']);
    $mpdf->showImageErrors              = true;
    $mpdf->autoPageBreak                = true;
    $mpdf->shrink_tables_to_fit         = 1;
    $mpdf->AddPage();
    $mpdf->use_kwt                      = true;
    $mpdf->allow_charset_conversion     = true;
    $mpdf->curlAllowUnsafeSslRequests   = true;
    $mpdf->charset_in                   = 'iso-8859-4';
    $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
    $data['wards']              = $this->CommonModel->getData('wardwise_address', 'ASC', "ward");
    $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
    $data['current_month']      = $this->current_month;
    $data['sampati_kar']        = $this->MonthlyReportMDL->SampatiKarMonthly();
    $data['bhumi_kar']          = $this->MonthlyReportMDL->BhumiKarMonthly();
    $html                               = $this->load->view('monthly_report_pdf', $data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output(); // opens in browser
  }
  //bills view for monthly report
  public function viewOverAllDetails()
  {
    if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
      $data['wards']              = $this->CommonModel->getData('wardwise_address', 'ASC', "ward");
      $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
      $data['current_month']      = $this->current_month;
      $data['nagadibilldetials']  = $this->MonthlyReportMDL->getNagadiBillDetails();
      $data['sampatikardetails']  = $this->MonthlyReportMDL->getSearchSampatiKarDetails();
      $this->load->view('view_billdetails', $data);
    }
  }
  //view monthly details by nagadi topic id.
  public function viewMonthlyNagadiDetails($topic_id)
  {
    if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
      $data['main_topic']         = $this->CommonModel->getWhere('main_topic', array('id' => $topic_id));
      $data['nagadibilldetails']  = $this->MonthlyReportMDL->getNagadiBillDetailsByTopic($topic_id);
      $data['cancel_amount']      = $this->MonthlyReportMDL->getNagadiBillDetailsCancelByTopic($topic_id);
      $this->load->view('view_nagadibilldetailsbytopic', $data);
    }
  }
  //view nagadi details by serach.
  public function viewMonthlyNagadiDetailsSearch($topic_id, $from_date, $to_date, $ward_no, $fiscal_year, $user)
  {
    if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
      $data['main_topic']         = $this->CommonModel->getWhere('main_topic', array('id' => $topic_id));
      $fy                         = str_replace('-', '/', $fiscal_year);
      $data['nagadibilldetails']  = $this->MonthlyReportMDL->getNagadiBillDetailsBySearch($topic_id, $from_date, $to_date, $ward_no, $fy, $user);
      $data['cancel_amount']      = $this->MonthlyReportMDL->getNagadiBillDetailsCancelByTopic($topic_id, $from_date, $to_date, $ward_no, $fy, $user);
      $this->load->view('view_nagadibilldetailsbytopic', $data);
    }
  }
  //get sampati billing details by month
  public function MonthlySampatiBhumiKarDetailsbyMonth()
  {
    $data['current_month']      = $this->current_month;
    $data['sampati_bhumi_kar']  = $this->MonthlyReportMDL->getSearchSampatiKarDetailsByMonth();
    $data['cancelamount']       = $this->MonthlyReportMDL->getCancelSampatikarAmountDetails();
    $this->load->view('monthly_sampati_details', $data);
  }
  public function MonthlySampatiBhumiKarDetailSearch($from_date, $to_date, $ward_no, $fiscal_year, $user)
  {
    $fy        = str_replace('-', '/', $fiscal_year);
    $data['sampati_bhumi_kar']  = $this->MonthlyReportMDL->getSearchSampatiKarDetailsBySearch($from_date, $to_date, $ward_no, $fy, $user);
    $data['cancelamount']       = $this->MonthlyReportMDL->getCancelSampatikarAmountDetailsBySearch($from_date, $to_date, $ward_no, $fy, $user);
    $this->load->view('monthly_sampati_details', $data);
  }
  //------------------------------------------------------------------------------------------------------------------------
  /**
   * This function on ajax call get all MONTHLY report.
   * @param varchar $date, int $ward
   * @return json.
   */
  //--------------------------------------
  public function AdminMonthlyReport()
  {
    if ($this->input->is_ajax_request()) {
      $from_date                  = $this->input->post('from_date');
      $to_date                    = $this->input->post('to_date');
      $ward                       = $this->input->post('ward');
      $fiscal_year                = $this->input->post('fiscal_year');
      $user                       = $this->input->post('user');
      $data['ward_no']            = !empty($ward) ? $ward : '-';
      $data['from_date']          = !empty($from_date) ? $from_date : '-';
      $data['to_date']            = !empty($to_date) ? $to_date : '-';
      $data['user']               = !empty($user) ? $user : '-';
      $data['fiscal_year']        = str_replace('/', '-', $fiscal_year);
      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fiscal_year));
      $data['sampati_kar']        = $this->MonthlyReportMDL->SearchSampatiKarMonthly($data['ward_no'], $data['from_date'], $data['to_date'], $fiscal_year, $data['user']);
      $data['bhumi_kar']          = $this->MonthlyReportMDL->SearchBhumikarKarMonthly($data['ward_no'], $data['from_date'], $data['to_date'], $fiscal_year, $data['user']);
      $data_view                  = $this->load->view('admin_monthly_report', $data, true);
      $response                   = array(
        'status'                  => 'success',
        'data'                    => $data_view
      );
      header("Content-type: application/json");
      echo json_encode($response);
      exit;
    }
  }
  //-------------------------------------------------------
  //print by search
  //--------------------------------------------------------
  public function printSearchMonthlyReport()
  {
    $from_date                  = $this->uri->segment(3);
    $to_date                    = $this->uri->segment(4);
    $ward                       = $this->uri->segment(5);
    $user                       = $this->uri->segment(7);
    $data['ward_no']            = !empty($ward) ? $ward : '-';
    $data['from_date']          = !empty($from_date) ? $from_date : '-';
    $data['to_date']            = !empty($to_date) ? $to_date : '00';
    $data['fiscal_year']        = $this->uri->segment(6);
    $data['user']               = !empty($user) ? $user : '-';
    $fiscal_year                = str_replace('-', '/', $data['fiscal_year']);
    $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fiscal_year));
    $data['sampati_kar']        = $this->MonthlyReportMDL->SearchSampatiKarMonthly($ward, $from_date, $to_date, $fiscal_year, $user);
    $data['bhumi_kar']          = $this->MonthlyReportMDL->SearchBhumikarKarMonthly($ward, $from_date, $to_date, $fiscal_year, $user);
    $this->load->view('print_search_report', $data);
  }

  public function exportSearchToPDF()
  {
    $mpdf                               = new \Mpdf\Mpdf(['mode' => 'utf-8']);
    $mpdf->showImageErrors              = true;
    $mpdf->autoPageBreak                = true;
    $mpdf->shrink_tables_to_fit         = 1;
    $mpdf->AddPage();
    $mpdf->use_kwt                      = true;
    $mpdf->allow_charset_conversion     = true;
    $mpdf->curlAllowUnsafeSslRequests   = true;
    $mpdf->charset_in                   = 'iso-8859-4';
    $from_date                  = $this->uri->segment(3);
    $to_date                    = $this->uri->segment(4);
    $ward                       = $this->uri->segment(5);
    $user                       = $this->uri->segment(7);
    $data['ward_no']            = !empty($ward) ? $ward : '-';
    $data['from_date']          = !empty($from_date) ? $from_date : '-';
    $data['to_date']            = !empty($to_date) ? $to_date : '00';
    $data['fiscal_year']        = $this->uri->segment(6);
    $data['user']               = !empty($user) ? $user : '-';
    $fiscal_year                = str_replace('-', '/', $data['fiscal_year']);
    $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fiscal_year));
    $data['sampati_kar']        = $this->MonthlyReportMDL->SearchSampatiKarMonthly($ward, $from_date, $to_date, $fiscal_year, $user);
    $data['bhumi_kar']          = $this->MonthlyReportMDL->SearchBhumikarKarMonthly($ward, $from_date, $to_date, $fiscal_year, $user);
    $html                               = $this->load->view('search_report_pdf', $data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output(); // opens in browser
  }

  public function exportSearchToExcel()
  {
    $from_date                  = $this->uri->segment(3);
    $to_date                    = $this->uri->segment(4);
    $ward                       = $this->uri->segment(5);
    $user                       = $this->uri->segment(7);
    $data['ward_no']            = !empty($ward) ? $ward : '-';
    $data['from_date']          = !empty($from_date) ? $from_date : '-';
    $data['to_date']            = !empty($to_date) ? $to_date : '00';
    $data['fiscal_year']        = $this->uri->segment(6);
    $data['user']               = !empty($user) ? $user : '-';
    $fiscal_year                = str_replace('-', '/', $data['fiscal_year']);
    $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fiscal_year));
    $data['sampati_kar']        = $this->MonthlyReportMDL->SearchSampatiKarMonthly($ward, $from_date, $to_date, $fiscal_year, $user);
    $data['bhumi_kar']          = $this->MonthlyReportMDL->SearchBhumikarKarMonthly($ward, $from_date, $to_date, $fiscal_year, $user);
    $nagadi_total = 0;
    $extra_text = 'मिति  ' . $this->mylibrary->convertedcit($from_date) . ' देखि मिति' . $this->mylibrary->convertedcit($to_date) . ' सम्म )';
    $htmlString = '<table class=""><tr><td colspan="3" style="text-align: center;background-color:#1b5693;font-size:18px;color:#e5e5e5">' . 'मासिक रिपोर्ट' . '</td></tr><tr><td colspan="3" style="text-align: center;">' . $extra_text . '</td></tr></table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="hidden-phone">शिर्षक नं </th>
          <th>आम्दानी शिर्षक</th>
          <th class="hidden-phone">मुल्य रु</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>११३१३</td>
          <td>एकीकृत सम्पती कर</td>
          <td>' . $this->mylibrary->convertedcit($data['sampati_kar']['total']) . '</td>
        </tr>
        <tr>
          <td>११३१४</td>
          <td>भुमिकर/मालपोत</td>
          <td>' . $this->mylibrary->convertedcit($data['bhumi_kar']['total']) . '</td>
        </tr>';
    if (!empty($data['main_topic'])) {

      foreach ($data['main_topic'] as $key => $nagadi) {

        $collection_rate = $this->MonthlyReportMDL->SearchNagadiMontlhy($nagadi['id'], $ward, $from_date, $to_date, $fiscal_year, $user);
        $htmlString .= '<tr>
            
            <td>' . $this->mylibrary->convertedcit($nagadi['topic_no']) . '</td>
              <td>' . $nagadi['topic_name'] . '</td>
              <td>' . $this->mylibrary->convertedcit(round($collection_rate['total'], 2)) . '</td>
          </tr>';
        $nagadi_total += $collection_rate['total'];
      }
    }
    $htmlString .= '</tbody>';
    $htmlString .= '<tfooter>
      <tr>
          <td colspan="2" style="text-align: center;background-color:#1b5693;color:#e5e5e5"><b>जम्मा</b></td>';
    $net_total = $nagadi_total + $data['sampati_kar']['total'] + $data['bhumi_kar']['total'];
    $htmlString .= '<td colspan="1" align="left" style="text-align: center;background-color:#1b5693;color:#e5e5e5">' . $this->mylibrary->convertedcit(round($net_total, 2)) . '</td>
        </tr></tfooter>';
    $htmlString .= '</table>';
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
    $spreadsheet = $reader->loadFromString($htmlString);
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $extra_text . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output'); // download file
  }

  public function viewOverAllDetailsBySearch()
  {
    if ($this->authlibrary->HasModulePermission('MONTHLY-REPORT', "VIEW")) {
      $from_date                  = $this->uri->segment(4);
      $to_date                    = $this->uri->segment(5);
      $ward                       = $this->uri->segment(3);
      $data['ward_no']            = !empty($ward) ? $ward : '-';
      $data['from_date']          = !empty($from_date) ? $from_date : '-';
      $data['to_date']            = !empty($to_date) ? $to_date : '00';
      $data['fiscal_year']        = $this->uri->segment(6);
      $fiscal_year                = str_replace('-', '/', $data['fiscal_year']);
      $data['main_topic']         = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $this->fy));
      $data['wards']              = $this->CommonModel->getData('wardwise_address', 'ASC', "ward");
      $data['session_ward']       = $this->session->userdata('PRJ_USER_WARD');
      $data['current_month']      = $this->current_month;
      $data['nagadibilldetials']  = $this->MonthlyReportMDL->getNagadiBillDetailsBySearch($from_date, $to_date, $ward, $fiscal_year);
      $data['sampatikardetails']  = $this->MonthlyReportMDL->getSearchSampatiKarDetailsBySearch($from_date, $to_date, $ward, $fiscal_year);
      $this->load->view('view_billdetails', $data);
    }
  }

  //get user
  public function GetUser()
  {
    $ward_no = $this->input->post('ward_no');
    $user = $this->CommonModel->getAllDataByField('users', 'ward', $ward_no);
    //pp($user);
    if (!empty($user)) {

      $option = '';

      $option .= '<option value="">छान्नुहोस्</option>';
      foreach ($user as $key => $value) :
        $option .= '<option value = ' . $value["userid"] . '>' . $value["name"] . '</option>';
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
}//end of class