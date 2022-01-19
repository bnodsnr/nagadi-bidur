<?php

/**
 * created by php strom
  Name:Binod Sunar
  Date:2018/02/01:11:14 AM.
 */
require_once FCPATH . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class NagadiReport extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->module_code = 'REPORT';
    $this->load->model('CommonModel');
    $this->load->model('Reportmodel');
    $this->load->model('PrintModel');
    if (!$this->authlibrary->IsLoggedIn()) {
      $this->session->set_userdata('return_url', current_url());
      redirect('Login');
    }
    $this->container = 'main';
  }
  public function Index()
  {
    $data['page'] = 'dashboard';
    $data['title'] = '';
    $data['pagetitle'] = '';
    $this->load->view('main', $data);
  }

  public function OverallReport()
  {
    if ($this->authlibrary->HasModulePermission('OVER-ALL-NAGADI-REPORT', "VIEW")) {
      $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));
      $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'DESC');
      $data['page'] = 'overall_report_file';
      $this->load->view('main', $data);
    }
  }

  public function PrintOverallReport()
  {
    if ($this->authlibrary->HasModulePermission('OVER-ALL-NAGADI-REPORT', "VIEW")) {
      $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));
      $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'DESC');
      $data['page'] = 'overall_report_file';
      $this->load->view('print_overall_report_file', $data);
    }
  }

  public function exportToPDF()
  {
    $mpdf                               = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'default_font_size' => 18,
      'format' => 'A4-L'
    ]);
    $mpdf->showImageErrors              = true;
    $mpdf->autoPageBreak                = true;
    $mpdf->shrink_tables_to_fit         = 1;
    $mpdf->AddPage();
    $mpdf->use_kwt                      = true;
    $mpdf->allow_charset_conversion     = true;
    $mpdf->curlAllowUnsafeSslRequests   = true;
    $mpdf->charset_in                   = 'iso-8859-4';
    $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));
    $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'DESC');
    $html                               = $this->load->view('overall_report_pdf', $data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output(); // opens in browser
  }

  public function exportToExcel()
  {
    $htmlString = '';
    $extra_text = 'समग्र वडागत रिपोर्ट';
    // ----------------------------sampati kar details--------------------------------
    $htmlString .= '<table class=""><tr><td colspan="17" style="text-align: center;background-color:#1b5693;font-size:28px;color:#e5e5e5">समग्र वडागत रिपोर्ट </td></tr></table>
    <table><thead><tr><th>शिर्षक</th><th>शिर्षक नं</th><th>पालिका</th><th>वडा १</th><th>वडा २</th><th>वडा ३</th><th>वडा ४</th><th>वडा ५</th><th>वडा ६</th><th>वडा ७</th><th class="hidden-phone">वडा ८</th><th class="hidden-phone">वडा ९</th>
									<th class="hidden-phone">वडा १०</th><th class="hidden-phone">वडा ११</th>
									<th class="hidden-phone">वडा १२</th><th class="hidden-phone">वडा १३</th><th>जम्मा रु:</th></tr></thead><tbody>';
    $main_topic = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));
    if (!empty($main_topic)) {
      foreach ($main_topic as $key => $mt) {
        $htmlString .= '<tr><td>' . $mt['topic_name'] . '</td><td>' . $this->mylibrary->convertedcit($mt['topic_no']) . '</td>';
        $ward_0 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '0');
        $ward_1 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '1');
        $ward_2 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '2');
        $ward_3 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '3');
        $ward_4 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '4');
        $ward_5 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '5');
        $ward_6 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '6');
        $ward_7 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '7');
        $ward_8 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '8');
        $ward_9 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '9');
        $ward_10 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '10');
        $ward_11 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '11');
        $ward_12 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '12');
        $ward_13 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '13');
        $total_byMt = $this->Reportmodel->getNagadiTotalByMT($mt['id']);
        //nagadi total amount
        $htmlString .= '<td>' . $this->mylibrary->convertedcit(number_format($ward_0->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_1->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_2->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_3->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_4->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_5->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_6->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_7->total, 2)) .

          '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_8->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_9->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_10->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_11->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_12->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_13->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($total_byMt->total, 2)) . '</td></tr>';
      }
      $sward_0 = $this->Reportmodel->getNagadiTotalByWard('0');
      $sward_1 = $this->Reportmodel->getNagadiTotalByWard('1');
      $sward_2 = $this->Reportmodel->getNagadiTotalByWard('2');
      $sward_3 = $this->Reportmodel->getNagadiTotalByWard('3');
      $sward_4 = $this->Reportmodel->getNagadiTotalByWard('4');
      $sward_5 = $this->Reportmodel->getNagadiTotalByWard('5');
      $sward_6 = $this->Reportmodel->getNagadiTotalByWard('6');
      $sward_7 = $this->Reportmodel->getNagadiTotalByWard('7');
      $sward_8 = $this->Reportmodel->getNagadiTotalByWard('8');
      $sward_9 = $this->Reportmodel->getNagadiTotalByWard('9');
      $sward_10 = $this->Reportmodel->getNagadiTotalByWard('10');
      $sward_11 = $this->Reportmodel->getNagadiTotalByWard('11');
      $sward_12 = $this->Reportmodel->getNagadiTotalByWard('12');
      $sward_13 = $this->Reportmodel->getNagadiTotalByWard('13');
      $nward_0 = !empty($sward_0) ? $sward_0->total : 0;
      $nward_1 = !empty($sward_1) ? $sward_1->total : 0;
      $nward_2 = !empty($sward_2) ? $sward_2->total : 0;
      $nward_3 = !empty($sward_3) ? $sward_3->total : 0;
      $nward_4 = !empty($sward_4) ? $sward_4->total : 0;
      $nward_5 = !empty($sward_5) ? $sward_5->total : 0;
      $nward_6 = !empty($sward_6) ? $sward_6->total : 0;
      $nward_7 = !empty($sward_7) ? $sward_7->total : 0;
      $nward_8 = !empty($sward_7) ? $sward_8->total : 0;
      $nward_9 = !empty($sward_7) ? $sward_9->total : 0;
      $nward_10 = !empty($sward_7) ? $sward_10->total : 0;
      $nward_11 = !empty($sward_7) ? $sward_11->total : 0;
      $nward_12 = !empty($sward_7) ? $sward_12->total : 0;
      $nward_13 = !empty($sward_7) ? $sward_13->total : 0;
      $total_nagadi = $nward_0 + $nward_1 + $nward_2 + $nward_3 + $nward_4 + $nward_5 + $nward_6 + $nward_7 + $nward_8 + $nward_9 + $nward_10 + $nward_11 + $nward_12 + $nward_13; // total nagadi

      //-----------------sampati---------------------------------//
      $sam_ward_1 = $this->Reportmodel->getSampatiTotalByWard('1');
      $sam_ward_2 = $this->Reportmodel->getSampatiTotalByWard('2');
      $sam_ward_3 = $this->Reportmodel->getSampatiTotalByWard('3');
      $sam_ward_4 = $this->Reportmodel->getSampatiTotalByWard('4');
      $sam_ward_5 = $this->Reportmodel->getSampatiTotalByWard('5');
      $sam_ward_6 = $this->Reportmodel->getSampatiTotalByWard('6');
      $sam_ward_7 = $this->Reportmodel->getSampatiTotalByWard('7');
      $sam_ward_7 = $this->Reportmodel->getSampatiTotalByWard('7');

      $sam_ward_8 = $this->Reportmodel->getSampatiTotalByWard('8');
      $sam_ward_9 = $this->Reportmodel->getSampatiTotalByWard('9');
      $sam_ward_10 = $this->Reportmodel->getSampatiTotalByWard('10');
      $sam_ward_11 = $this->Reportmodel->getSampatiTotalByWard('11');
      $sam_ward_12 = $this->Reportmodel->getSampatiTotalByWard('12');
      $sam_ward_13 = $this->Reportmodel->getSampatiTotalByWard('13');

      $sam_1 = !empty($sam_ward_1) ? $sam_ward_1->sampati_total : 0;
      $sam_2 = !empty($sam_ward_2) ? $sam_ward_2->sampati_total : 0;
      $sam_3 = !empty($sam_ward_3) ? $sam_ward_3->sampati_total : 0;
      $sam_4 = !empty($sam_ward_4) ? $sam_ward_4->sampati_total : 0;
      $sam_5 = !empty($sam_ward_5) ? $sam_ward_5->sampati_total : 0;
      $sam_6 = !empty($sam_ward_6) ? $sam_ward_6->sampati_total : 0;
      $sam_7 = !empty($sam_ward_7) ? $sam_ward_7->sampati_total : 0;

      $sam_8 = !empty($sam_ward_8) ? $sam_ward_8->sampati_total : 0;
      $sam_9 = !empty($sam_ward_9) ? $sam_ward_9->sampati_total : 0;
      $sam_10 = !empty($sam_ward_10) ? $sam_ward_10->sampati_total : 0;
      $sam_11 = !empty($sam_ward_11) ? $sam_ward_11->sampati_total : 0;
      $sam_12 = !empty($sam_ward_12) ? $sam_ward_12->sampati_total : 0;
      $sam_13 = !empty($sam_ward_13) ? $sam_ward_13->sampati_total : 0;


      $total_sam = $sam_1 + $sam_2 + $sam_3 + $sam_4 + $sam_5 + $sam_6 + $sam_7 + $sam_8 + $sam_9 + $sam_10 + $sam_11 + $sam_12 + $sam_13;

      //--------------total-----------------//
      $ward_1_collection = $nward_1 + $sam_1;
      $ward_2_collection = $nward_2 + $sam_2;
      $ward_3_collection = $nward_3 + $sam_3;
      $ward_4_collection = $nward_4 + $sam_4;
      $ward_5_collection = $nward_5 + $sam_5;
      $ward_6_collection = $nward_6 + $sam_6;
      $ward_7_collection = $nward_7 + $sam_7;

      $ward_8_collection = $nward_8 + $sam_8;
      $ward_9_collection = $nward_9 + $sam_9;
      $ward_10_collection = $nward_10 + $sam_10;
      $ward_11_collection = $nward_11 + $sam_11;
      $ward_12_collection = $nward_12 + $sam_12;
      $ward_13_collection = $nward_13 + $sam_13;

      $total_collection = $ward_1_collection + $ward_2_collection + $ward_3_collection + $ward_4_collection + $ward_5_collection + $ward_6_collection + $ward_7_collection + $ward_8_collection + $ward_9_collection + $ward_10_collection + $ward_11_collection + $ward_12_collection + $ward_13_collection + $nward_0;


      $htmlString .= '<tr><td colspan="2" align="right" style="background-color:#1b5693; color:#e5e5e5">जम्मा नगदि रु:</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_0->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_1->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_2->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_3->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_4->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_5->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_6->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_7->total, 2)) . '</td>
      
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_8->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_9->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_10->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_11->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_12->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_13->total, 2)) . '</td>

      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(round($total_nagadi, 2)) . '</td>
      
      
      </tr>';
    }
    $htmlString .= '<tr><td colspan="2" align="right">सम्पति/भुमि कर </td><td></td><td>' . $this->mylibrary->convertedcit(number_format($sam_1, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_2, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_3, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_4, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_5, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_6, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_7, 2)) . '</td>

    <td>' . $this->mylibrary->convertedcit(number_format($sam_8, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_9, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_10, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_11, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_12, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_13, 2)) . '</td>
    
    <td>' . $this->mylibrary->convertedcit(number_format($total_sam, 2)) . '</td></tr>';
    $htmlString .= '<tfoot><tr><td colspan="2" align="right" style="background-color:#1b5693; color:#e5e5e5">जम्मा रु:</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(round($nward_0, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_1_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_2_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_3_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_4_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_5_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_6_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_7_collection, 2)) . '</td>

												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_8_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_9_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_10_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_11_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_12_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_13_collection, 2)) . '</td>

												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($total_collection, 2)) . '</td>
											</tr> ';
    $htmlString .= "</tbody></table>";
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
    $spreadsheet = $reader->loadFromString($htmlString);
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . 'समग्र वडागत रिपोर्ट' . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }

  public function search()
  {
    $fiscal_year = $this->input->post('fiscal_year');
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fiscal_year));
    $data['from_date'] = !empty($from_date) ? $from_date : '-';
    $data['to_date'] = !empty($to_date) ? $to_date : '-';
    $fy        = str_replace('/', '-', $fiscal_year);
    $data['fiscal_year'] = !empty($fiscal_year) ? $fy : '-';
    $data_view = $this->load->view('ajax_search_report', $data, true);
    $response = array(
      'status'            => 'success',
      'data'              => $data_view
    );
    header("Content-type: application/json");
    echo json_encode($response);
    exit;
  }

  public function PrintSearchOverallReport($from_date, $to_date, $fiscal_year)
  {
    if ($this->authlibrary->HasModulePermission('OVER-ALL-NAGADI-REPORT', "VIEW")) {
      $from_date = $this->uri->segment(3);
      $to_date = $this->uri->segment(4);
      $fiscal_year = $this->uri->segment(5);
      $fy        = str_replace('-', '/', $fiscal_year);
      $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fy));
      $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'DESC');
      $data['from_date'] = !empty($from_date) ? $from_date : '-';
      $data['to_date'] = !empty($to_date) ? $to_date : '-';

      $data['fiscal_year'] = !empty($fiscal_year) ? $fy : '-';
      $this->load->view('print_overall_report_file_search', $data);
    }
  }

  public function exportSearchToPDF($from_date, $to_date, $fiscal_year)
  {
    $from_date = $this->uri->segment(3);
    $to_date = $this->uri->segment(4);
    $fiscal_year = $this->uri->segment(5);
    $fy        = str_replace('-', '/', $fiscal_year);
    $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fy));
    $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'DESC');
    $data['from_date'] = !empty($from_date) ? $from_date : '-';
    $data['to_date'] = !empty($to_date) ? $to_date : '-';
    $data['fiscal_year'] = !empty($fiscal_year) ? $fy : '-';
    $mpdf                               = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'default_font_size' => 18,
      'format' => 'A4-L'
    ]);
    $mpdf->showImageErrors              = true;
    $mpdf->autoPageBreak                = true;
    $mpdf->shrink_tables_to_fit         = 1;
    $mpdf->AddPage();
    $mpdf->use_kwt                      = true;
    $mpdf->allow_charset_conversion     = true;
    $mpdf->curlAllowUnsafeSslRequests   = true;
    $mpdf->charset_in                   = 'iso-8859-4';
    $html                               = $this->load->view('search_pdf', $data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output(); // opens in browser


    $this->load->view('search_pdf', $data);
  }
  public function exportSearchToExcel($from_date, $to_date, $fiscal_year)
  {
    $from_date = $this->uri->segment(3);
    $to_date      = $this->uri->segment(4);
    $fiscal_year  = $this->uri->segment(5);
    $fy           = str_replace('-', '/', $fiscal_year);
    $main_topic           = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => $fy));
    $data['fiscal_year']  = $this->CommonModel->getData('fiscal_year', 'DESC');
    $data['from_date'] = !empty($from_date) ? $from_date : '-';
    $data['to_date'] = !empty($to_date) ? $to_date : '-';
    $data['fiscal_year'] = !empty($fiscal_year) ? $fy : '-';
    $htmlString = '';
    $extra_text = ' मिति : ' . $from_date . 'देखि :  ' . $to_date . ' सम्म - आ. व. -' . $fy;
    // ----------------------------sampati kar details--------------------------------
    $htmlString .= '<table class=""><tr><td colspan="17" style="text-align: center;background-color:#1b5693;font-size:28px;color:#e5e5e5">समग्र वडागत रिपोर्ट </td></tr><tr><td colspan="17" style="text-align: center;background-color:#1b5693;font-size:10px;color:#e5e5e5">' . $extra_text . '</td></tr></table>
    <table><thead><tr><th>शिर्षक</th><th>शिर्षक नं</th><th>पालिका</th><th>वडा १</th><th>वडा २</th><th>वडा ३</th><th>वडा ४</th><th>वडा ५</th><th>वडा ६</th><th>वडा ७</th><th class="hidden-phone">वडा ८</th><th class="hidden-phone">वडा ९</th>
									<th class="hidden-phone">वडा १०</th><th class="hidden-phone">वडा ११</th>
									<th class="hidden-phone">वडा १२</th><th class="hidden-phone">वडा १३</th><th>जम्मा रु:</th></tr></thead><tbody>';
    if (!empty($main_topic)) {
      foreach ($main_topic as $key => $mt) {
        $htmlString .= '<tr><td>' . $mt['topic_name'] . '</td><td>' . $this->mylibrary->convertedcit($mt['topic_no']) . '</td>';
        $ward_0 = $this->PrintModel->getNagadiTotalByTopic($mt['id'], '0', $from_date, $to_date, $fy);
        $ward_1 = $this->PrintModel->getNagadiTotalByTopic($mt['id'], '1', $from_date, $to_date, $fy);
        $ward_2 = $this->PrintModel->getNagadiTotalByTopic($mt['id'], '2', $from_date, $to_date, $fy);
        $ward_3 = $this->PrintModel->getNagadiTotalByTopic($mt['id'], '3', $from_date, $to_date, $fy);
        $ward_4 = $this->PrintModel->getNagadiTotalByTopic($mt['id'], '4', $from_date, $to_date, $fy);
        $ward_5 = $this->PrintModel->getNagadiTotalByTopic($mt['id'], '5', $from_date, $to_date, $fy);
        $ward_6 = $this->PrintModel->getNagadiTotalByTopic($mt['id'], '6', $from_date, $to_date, $fy);
        $ward_7 = $this->PrintModel->getNagadiTotalByTopic($mt['id'], '7', $from_date, $to_date, $fy);

        $ward_8 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '8', $from_date, $to_date, $fy);
        $ward_9 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '9', $from_date, $to_date, $fy);
        $ward_10 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '10', $from_date, $to_date, $fy);
        $ward_11 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '11', $from_date, $to_date, $fy);
        $ward_12 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '12', $from_date, $to_date, $fy);
        $ward_13 = $this->Reportmodel->getNagadiTotalByTopic($mt['id'], '13', $from_date, $to_date, $fy);
        $total_byMt = $this->PrintModel->getNagadiTotalByMT($mt['id'], $from_date, $to_date, $fy);
        //nagadi total amount
        $htmlString .= '<td>' . $this->mylibrary->convertedcit(number_format($ward_0->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_1->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_2->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_3->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_4->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_5->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_6->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_7->total, 2)) .

          '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_8->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_9->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_10->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_11->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_12->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($ward_13->total, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($total_byMt->total, 2)) . '</td></tr>';
      }
      //-----------------sampati---------------------------------//
      $sward_0 = $this->PrintModel->getNagadiTotalByWard('0', $from_date, $to_date, $fy);
      $sward_1 = $this->PrintModel->getNagadiTotalByWard('1', $from_date, $to_date, $fy);
      $sward_2 = $this->PrintModel->getNagadiTotalByWard('2', $from_date, $to_date, $fy);
      $sward_3 = $this->PrintModel->getNagadiTotalByWard('3', $from_date, $to_date, $fy);
      $sward_4 = $this->PrintModel->getNagadiTotalByWard('4', $from_date, $to_date, $fy);
      $sward_5 = $this->PrintModel->getNagadiTotalByWard('5', $from_date, $to_date, $fy);
      $sward_6 = $this->PrintModel->getNagadiTotalByWard('6', $from_date, $to_date, $fy);
      $sward_7 = $this->PrintModel->getNagadiTotalByWard('7', $from_date, $to_date, $fy);

      $sward_8 = $this->PrintModel->getNagadiTotalByWard('8', $from_date, $to_date, $fy);
      $sward_9 = $this->PrintModel->getNagadiTotalByWard('9', $from_date, $to_date, $fy);
      $sward_10 = $this->PrintModel->getNagadiTotalByWard('10', $from_date, $to_date, $fy);
      $sward_11 = $this->PrintModel->getNagadiTotalByWard('11', $from_date, $to_date, $fy);
      $sward_12 = $this->PrintModel->getNagadiTotalByWard('12', $from_date, $to_date, $fy);
      $sward_13 = $this->PrintModel->getNagadiTotalByWard('13', $from_date, $to_date, $fy);



      $nward_0 = !empty($sward_0) ? $sward_0->total : 0;
      $nward_1 = !empty($sward_1) ? $sward_1->total : 0;
      $nward_2 = !empty($sward_2) ? $sward_2->total : 0;
      $nward_3 = !empty($sward_3) ? $sward_3->total : 0;
      $nward_4 = !empty($sward_4) ? $sward_4->total : 0;
      $nward_5 = !empty($sward_5) ? $sward_5->total : 0;
      $nward_6 = !empty($sward_6) ? $sward_6->total : 0;
      $nward_7 = !empty($sward_7) ? $sward_7->total : 0;

      $nward_8 = !empty($sward_8) ? $sward_8->total : 0;
      $nward_9 = !empty($sward_9) ? $sward_9->total : 0;
      $nward_10 = !empty($sward_10) ? $sward_10->total : 0;
      $nward_11 = !empty($sward_11) ? $sward_11->total : 0;
      $nward_12 = !empty($sward_12) ? $sward_12->total : 0;
      $nward_13 = !empty($sward_13) ? $sward_13->total : 0;

      $total_nagadi = $nward_0 + $nward_1 + $nward_2 + $nward_3 + $nward_4 + $nward_5 + $nward_6 + $nward_7 + $nward_8 + $nward_9 + $nward_10 + $nward_11 + $nward_12 + $nward_13;

      // -------------------------sampati -----------------------//
      $sam_ward_1 = $this->PrintModel->getSampatiTotalByWard('1', $from_date, $to_date, $fy);
      $sam_ward_2 = $this->PrintModel->getSampatiTotalByWard('2', $from_date, $to_date, $fy);
      $sam_ward_3 = $this->PrintModel->getSampatiTotalByWard('3', $from_date, $to_date, $fy);
      $sam_ward_4 = $this->PrintModel->getSampatiTotalByWard('4', $from_date, $to_date, $fy);
      $sam_ward_5 = $this->PrintModel->getSampatiTotalByWard('5', $from_date, $to_date, $fy);
      $sam_ward_6 = $this->PrintModel->getSampatiTotalByWard('6', $from_date, $to_date, $fy);
      $sam_ward_7 = $this->PrintModel->getSampatiTotalByWard('7', $from_date, $to_date, $fy);

      $sam_ward_8 = $this->PrintModel->getSampatiTotalByWard('8', $from_date, $to_date, $fy);
      $sam_ward_9 = $this->PrintModel->getSampatiTotalByWard('9', $from_date, $to_date, $fy);
      $sam_ward_10 = $this->PrintModel->getSampatiTotalByWard('10', $from_date, $to_date, $fy);
      $sam_ward_11 = $this->PrintModel->getSampatiTotalByWard('11', $from_date, $to_date, $fy);
      $sam_ward_12 = $this->PrintModel->getSampatiTotalByWard('12', $from_date, $to_date, $fy);
      $sam_ward_13 = $this->PrintModel->getSampatiTotalByWard('13', $from_date, $to_date, $fy);

      $sam_1 = !empty($sam_ward_1) ? $sam_ward_1->sampati_total : 0;
      $sam_2 = !empty($sam_ward_2) ? $sam_ward_2->sampati_total : 0;
      $sam_3 = !empty($sam_ward_3) ? $sam_ward_3->sampati_total : 0;
      $sam_4 = !empty($sam_ward_4) ? $sam_ward_4->sampati_total : 0;
      $sam_5 = !empty($sam_ward_5) ? $sam_ward_5->sampati_total : 0;
      $sam_6 = !empty($sam_ward_6) ? $sam_ward_6->sampati_total : 0;
      $sam_7 = !empty($sam_ward_7) ? $sam_ward_7->sampati_total : 0;

      $sam_8 = !empty($sam_ward_8) ? $sam_ward_8->sampati_total : 0;
      $sam_9 = !empty($sam_ward_9) ? $sam_ward_9->sampati_total : 0;
      $sam_10 = !empty($sam_ward_10) ? $sam_ward_10->sampati_total : 0;
      $sam_11 = !empty($sam_ward_11) ? $sam_ward_11->sampati_total : 0;
      $sam_12 = !empty($sam_ward_12) ? $sam_ward_12->sampati_total : 0;
      $sam_13 = !empty($sam_ward_13) ? $sam_ward_13->sampati_total : 0;

      $total_sam = $sam_1 + $sam_2 + $sam_3 + $sam_4 + $sam_5 + $sam_6 + $sam_7 + $sam_8 + $sam_9 + $sam_10 + $sam_11 + $sam_12 + $sam_13;
      //--------------total-----------------//
      $ward_1_collection = $nward_1 + $sam_1;
      $ward_2_collection = $nward_2 + $sam_2;
      $ward_3_collection = $nward_3 + $sam_3;
      $ward_4_collection = $nward_4 + $sam_4;
      $ward_5_collection = $nward_5 + $sam_5;
      $ward_6_collection = $nward_6 + $sam_6;
      $ward_7_collection = $nward_7 + $sam_7;

      $ward_8_collection = $nward_8 + $sam_8;
      $ward_9_collection = $nward_9 + $sam_9;
      $ward_10_collection = $nward_10 + $sam_10;
      $ward_11_collection = $nward_11 + $sam_11;
      $ward_12_collection = $nward_12 + $sam_12;
      $ward_13_collection = $nward_13 + $sam_13;


      $total_collection = $ward_1_collection + $ward_2_collection + $ward_3_collection + $ward_4_collection + $ward_5_collection + $ward_6_collection + $ward_7_collection + $ward_8_collection + $ward_9_collection + $ward_10_collection + $ward_11_collection + $ward_12_collection + $ward_13_collection + $nward_0;


      $htmlString .= '<tr><td colspan="2" align="right" style="background-color:#1b5693; color:#e5e5e5">जम्मा नगदि रु:</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_0->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_1->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_2->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_3->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_4->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_5->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_6->total, 2)) . '</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_7->total, 2)) . '</td>
      
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_8->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_9->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_10->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_11->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_12->total, 2)) . '</td>
      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($sward_13->total, 2)) . '</td>

      <td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(round($total_nagadi, 2)) . '</td>
      
      
      </tr>';
    }
    $htmlString .= '<tr><td colspan="2" align="right">सम्पति/भुमि कर </td><td></td><td>' . $this->mylibrary->convertedcit(number_format($sam_1, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_2, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_3, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_4, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_5, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_6, 2)) . '</td><td>' . $this->mylibrary->convertedcit(number_format($sam_7, 2)) . '</td>

    <td>' . $this->mylibrary->convertedcit(number_format($sam_8, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_9, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_10, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_11, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_12, 2)) . '</td>
    <td>' . $this->mylibrary->convertedcit(number_format($sam_13, 2)) . '</td>
    
    <td>' . $this->mylibrary->convertedcit(number_format($total_sam, 2)) . '</td></tr>';
    $htmlString .= '<tfoot><tr><td colspan="2" align="right" style="background-color:#1b5693; color:#e5e5e5">जम्मा रु:</td><td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(round($nward_0, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_1_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_2_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_3_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_4_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_5_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_6_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_7_collection, 2)) . '</td>

												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_8_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_9_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_10_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_11_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_12_collection, 2)) . '</td>
												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($ward_13_collection, 2)) . '</td>

												<td style="background-color:#1b5693; color:#e5e5e5">' . $this->mylibrary->convertedcit(number_format($total_collection, 2)) . '</td>
											</tr> ';
    $htmlString .= "</tbody></table>";
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
    $spreadsheet = $reader->loadFromString($htmlString);
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $extra_text . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }
}
