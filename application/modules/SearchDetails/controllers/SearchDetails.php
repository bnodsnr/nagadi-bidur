<?php

require_once FCPATH . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SearchDetails extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->module_code = 'REPORT';
    $this->load->model('CommonModel');
    $this->load->model('SearchModel');
    if (!$this->authlibrary->IsLoggedIn()) {
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
      $data['wards']              = $this->CommonModel->getData('wardwise_address', 'ASC');
      $data['page']               = 'search';
      $this->load->view('main', $data);
    }
  }

  /**
   * This function on ajax call get all daily report.
   * @param varchar $date, int $ward
   * @return json.
   */
  public function AdminSearchReport()
  {
    if ($this->input->is_ajax_request()) {
      $ward_no                        = $this->input->post('search_added_ward');
      $from_date                      = $this->input->post('from_date');
      $to_date                        = $this->input->post('to_date');
      $fiscal_year                    = $this->input->post('fiscal_year');
      $user                           = $this->input->post('user_id');
      $data['from_date']              = !empty($from_date) ? $from_date : '-';
      $data['to_date']                = !empty($to_date) ? $to_date : '-';
      $data['ward_no']                = !empty($ward_no) ? $ward_no : '-';
      $data['fiscal_year']            = !empty($fiscal_year) ? $fiscal_year : '-';
      if ($fiscal_year != '-') {
        $data['fy'] = str_replace("/", '-', $fiscal_year);
      }
      $data['nagadi_details']         = $this->SearchModel->getNagadiSearchDetails($from_date, $to_date, $ward_no, $fiscal_year, $user);
      $data['cancel_amount']          = $this->SearchModel->getCancelAmountDetailsBySearch($from_date, $to_date, $ward_no, $fiscal_year, $user);
      $data['sampatikar']             = $this->SearchModel->getSearchSampatiKarDetails($from_date, $to_date, $ward_no, $fiscal_year, $user);
      $data['sampati_cancel_amount']  = $this->SearchModel->getCancelSampatikarAmountDetailsBySearch($from_date, $to_date, $ward_no, $fiscal_year, $user);
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

  public function PrintDetails($from_date = NULL, $to_date = NULL, $ward_no = NULL, $fiscal_year = NULL, $user = NULL)
  {
    $data['from_date']                        = $from_date;
    $data['to_date']                          = $to_date;
    $ward_no                                  = $ward_no;
    $user                                     = $user;
    $data['ward_no']                          = $ward_no;
    $fy                                       = str_replace("-", '/', $fiscal_year);
    $data['nagadi_details']                   = $this->SearchModel->getNagadiSearchDetails($from_date, $to_date, $ward_no, $fy, $user);
    $data['cancel_amount']                    = $this->SearchModel->getCancelAmountDetailsBySearch($from_date, $to_date, $ward_no, $fy, $user);
    $data['sampatikar']                       = $this->SearchModel->getSearchSampatiKarDetails($from_date, $to_date, $ward_no, $fy, $user);
    $data['sampati_cancel_amount']            = $this->SearchModel->getCancelSampatikarAmountDetailsBySearch($from_date, $to_date, $ward_no, $fiscal_year, $user);
    $this->load->view('print_search', $data);
  }

  public function ExportToPDF($from_date = NULL, $to_date = NULL, $ward_no = NULL, $fiscal_year = NULL, $user = NULL)
  {
    $mpdf                                     = new \Mpdf\Mpdf(['mode' => 'utf-8']);
    $mpdf->showImageErrors                    = true;
    $mpdf->autoPageBreak                      = true;
    $mpdf->shrink_tables_to_fit               = 1;
    $mpdf->AddPage();
    $mpdf->use_kwt                            = true;
    $mpdf->allow_charset_conversion           = true;
    $mpdf->curlAllowUnsafeSslRequests         = true;
    $mpdf->charset_in                         = 'iso-8859-4';
    $data['from_date']                        = $from_date;
    $data['to_date']                          = $to_date;
    $ward_no                                  = $ward_no;
    $user                                     = $user;
    $data['ward_no']                          = $ward_no;
    $fy                                       = str_replace("-", '/', $fiscal_year);
    $data['nagadi_details']                   = $this->SearchModel->getNagadiSearchDetails($from_date, $to_date, $ward_no, $fy, $user);
    $data['cancel_amount']                    = $this->SearchModel->getCancelAmountDetailsBySearch($from_date, $to_date, $ward_no, $fy, $user);
    $data['sampatikar']                       = $this->SearchModel->getSearchSampatiKarDetails($from_date, $to_date, $ward_no, $fy, $user);
    $data['sampati_cancel_amount']            = $this->SearchModel->getCancelSampatikarAmountDetailsBySearch($from_date, $to_date, $ward_no, $fy, $user);
    $html                                     = $this->load->view('pdf_report', $data, true);
    $mpdf->WriteHTML($html);
    $mpdf->Output(); // opens in browser
  }

  public function ExortToExcel($from_date = NULL, $to_date = NULL, $ward_no = NULL, $fiscal_year = NULL, $user = NULL)
  {
    $data['from_date']                        = $from_date;
    $data['to_date']                          = $to_date;
    $ward_no                                  = $ward_no;
    $user                                     = $user;
    $data['ward_no']                          = $ward_no;
    $fy                                       = str_replace("-", '/', $fiscal_year);
    $data['nagadi_details']                   = $this->SearchModel->getNagadiSearchDetails($from_date, $to_date, $ward_no, $fy, $user);
    $data['cancel_amount']                    = $this->SearchModel->getCancelAmountDetailsBySearch($from_date, $to_date, $ward_no, $fy, $user);
    $data['sampatikar']                       = $this->SearchModel->getSearchSampatiKarDetails($from_date, $to_date, $ward_no, $fy, $user);
    $sampati_cancel_amount                    = $this->SearchModel->getCancelSampatikarAmountDetailsBySearch($from_date, $to_date, $ward_no, $fy, $user);

    $sampati_badar = !empty($sampati_cancel_amount['sampati_cancel_bills']) ? $sampati_cancel_amount['sampati_cancel_bills'] : 0;
    $ntotal = 0;
    $htmlString = '';
    $extra_text = '( मिति  ' . $this->mylibrary->convertedcit($from_date) . ' देखि मिति' . $this->mylibrary->convertedcit($to_date) . ' सम्म )';
    $htmlString .= '<table class="">
        <tr>
          <td colspan="10" style="text-align: center;background-color:#1b5693;color:#e5e5e5">नगदी विवरण</td>
        </tr>
        <tr>
          <td colspan="10" style="text-align: center;font-size:10px;">' . $extra_text . '</td>
        </tr>
       
      </table>
    <table class="">
     
     
          <tr>
            <th>मिति</th>
            <th>रसिद नं</th>
            <th>करदाताको नाम</th>
            <th class="hidden-phone">मुख्य शिर्षक</th>
            <th class="hidden-phone">सह शिर्षक</th>
            <th class="hidden-phone">शिर्षक</th>
            <th class="hidden-phone">रकम</th>
            <th class="hidden-phone">अवस्था</th>
            <th class="hidden-phone">रसिद काट्नेको नाम </th>
         
          </tr>
        
      <tbody>';

    if (!empty($data['nagadi_details'])) {
      foreach ($data['nagadi_details'] as $key => $nagadi) {
        if ($nagadi['topic'] == "others") {
          $dt =   $nagadi['others_topic'];
        } else {
          $dt =    $nagadi['topic_title'];
        }
        if ($nagadi['status'] == 1) {
          $status =  'सदर';
        } else {
          $status =  'बदर';
        }
        $htmlString .= '<tr>
                <td>' . $this->mylibrary->convertedcit($nagadi['added']) . '</td>
                <td>' . $this->mylibrary->convertedcit($nagadi['bill_no']) . '</td>
                <td>' . $nagadi['customer_name'] . '</td>
                <td>' . $nagadi['topic_name'] . '</td>
                 <td>' . $nagadi['sub_topic'] . '</td>
                <td>' . $dt . '</td>
                <td style="text-align:right">' . $this->mylibrary->convertedcit(round($nagadi['t_rates'], 2)) . '</td>
                <td>' . $status . '</td>
                <td>' . $nagadi['name'] . '</td>
            </tr>';
        $ntotal += $nagadi['t_rates'];
      }
    }
    $cancel_amount = !empty($data['cancel_amount']['cancel_bills']) ? $data['cancel_amount']['cancel_bills'] : 0;
    $net_total = $ntotal - $cancel_amount;
    $htmlString .= '</tbody>';
    $htmlString .= ' <tfooter>
        <tr">
          <td colspan="6" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"">जम्मा नगदी रकम </td>
          <td colspan="" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"">' . $this->mylibrary->convertedcit(round($ntotal, 2)) . '</td>
         <td colspan="2" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"> </td>

        </tr>
        <tr>
          <td colspan="6" style="text-align: right;background-color:#e21a1a;font-size:12px;color:#e5e5e5">बदर भएको नगदी रसिदको जम्मा रकम </td>
          <td colspan=""style="text-align: right;background-color:#e21a1a;font-size:12px;color:#e5e5e5">' . $this->mylibrary->convertedcit(round($cancel_amount, 2)) . '</td>
         <td colspan="2" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"> </td>

        </tr>
        <tr>
          <td colspan="6" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"">कुल जम्मा(नगदी): </td>
          <td colspan="" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"">' . $this->mylibrary->convertedcit(round($net_total, 2)) . '</td>
         <td colspan="2" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"> </td>
        </tr>
      </tfooter>';
    $htmlString .= '</table>';

    // ----------------------------sampati kar details--------------------------------
    $htmlString .= '<table class=""><tr><td colspan="15" style="text-align: center;background-color:#1b5693;color:#e5e5e5">सम्पति / भुमि कर विवरण</td></tr><tr><td colspan="15" style="text-align: center;font-size:10px;">' . $extra_text . '</td></tr></table>
    <table> <thead>
    <tr><th>सि.नं</th>
        <th>मिति</th>
        <th>रसिद नं</th>
        <th>करदाताको नाम</th>
        <th class="hidden-phone">मुख्य शिर्षक</th>
        <th class="hidden-phone">सह शिर्षक</th>
        <th class="hidden-phone">शिर्षक</th>
        <th class="hidden-phone">रकम</th>
        <th class="hidden-phone">अवस्था</th>
        <th class="hidden-phone">रसिद काट्नेको नाम </th>
        
    </tr></thead><tbody>';
    $ssampati = 0;
    $sbhumi = 0;
    $sother_amount = 0;
    $sfine_amount = 0;
    $sbhumiba = 0;
    $ssampatiba = 0;
    $sdiscount = 0;
    $sampati_total = 0;
    if (!empty($data['sampatikar'])) {
      foreach ($data['sampatikar'] as $key => $sampatikar) {
        $ssampati += $sampatikar['sampati_kar'];
        $sbhumi += $sampatikar['bhumi_kar'];
        $sother_amount += $sampatikar['other_amount'];
        $sfine_amount += $sampatikar['fine_amount'];
        $sbhumiba += $sampatikar['bhumi_baykeuta_amount'];
        $ssampatiba += $sampatikar['bakeyuta_amount'];
        $sdiscount += $sampatikar['discount_amount'];
        $sampati_total += $sampatikar['net_total_amount'];
        if ($sampatikar['status'] == 1) {

          $status =  'सदर';
        } else {

          $status =  'बदर';
        }
        $htmlString .= '<tr>
         <td>' . $this->mylibrary->convertedcit($sampatikar['billing_date']) . '</td>
             <td>' . $this->mylibrary->convertedcit($sampatikar['bill_no']) . '</td>
             <td>' . $this->mylibrary->convertedcit($sampatikar['nb_file_no']) . '</td>
             <td>' . $this->mylibrary->convertedcit($sampatikar['land_owner_name_np']) . '</td>
             <td style="text-align:right">' . $this->mylibrary->convertedcit(round($sampatikar['sampati_kar'], 2)) . '</td>
             <td style="text-align:right">' . $this->mylibrary->convertedcit(round($sampatikar['bhumi_kar'], 2)) . '</td>
               <td style="text-align:right">' . $this->mylibrary->convertedcit(round($sampatikar['other_amount'], 2)) . '.</td>
             <td style="text-align:right">' . $this->mylibrary->convertedcit(round($sampatikar['fine_amount'], 2)) . '</td>
             <td style="text-align:right">' . $this->mylibrary->convertedcit(round($sampatikar['bakeyuta_amount'], 2)) . '</td>
             <td style="text-align:right">' . $this->mylibrary->convertedcit(round($sampatikar['bhumi_baykeuta_amount'], 2)) . '</td>
             <td style="text-align:right">' . $this->mylibrary->convertedcit(round($sampatikar['discount_amount'], 2)) . '</td>
            <td style="text-align:right">' . $this->mylibrary->convertedcit(round($sampatikar['net_total_amount'], 2)) . '</td>
             <td>' . $status . '</td>
            <td>' . $sampatikar['name'] . '</td>
           
            </tr>';
      }
    }
    $net_total = $sampati_total - $sampati_badar;
    $htmlString .= ' <tr>
         <td colspan="4" style="text-align: center;background-color:#e5e5e5;font-size:12px;">जम्मा</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;">' . $this->mylibrary->convertedcit(round($ssampati, 2)) . '</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;">' . $this->mylibrary->convertedcit(round($sbhumi, 2)) . '</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;">' . $this->mylibrary->convertedcit(round($sother_amount, 2)) . '</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;">' . $this->mylibrary->convertedcit(round($sfine_amount, 2)) . '</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;">' . $this->mylibrary->convertedcit(round($ssampatiba, 2)) . '</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;">' . $this->mylibrary->convertedcit(round($sbhumiba, 2)) . '</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;">' . $this->mylibrary->convertedcit(round($sdiscount, 2)) . '</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;">' . $this->mylibrary->convertedcit(round($sampati_total, 2)) . '</td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;"></td>
         <td style="text-align: right;background-color:#e5e5e5;font-size:12px;"></td>
         <td colspan="2"></td>
       </tr>';
    $htmlString .= '</tbody>';
    $htmlString .= '<tfoot>
       <tr>
         <td colspan="11" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5">जम्मा रकम </td>
         <td colspan="" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5">' . $this->mylibrary->convertedcit(round($sampati_total, 2)) . '</td>
         <td colspan="2" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"> </td>

       </tr>
       <tr>
         <td colspan="11" style="text-align: right;background-color:#e21a1a;font-size:12px;color:#e5e5e5">बदर भएको रसिदको जम्मा रकम </td>
         <td colspan="" style="text-align: right;background-color:#e21a1a;font-size:12px;color:#e5e5e5">' . $this->mylibrary->convertedcit($sampati_badar) . '</td>
         <td colspan="2" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"> </td>

       </tr>
       <tr>
         <td colspan="11" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5">कुल जम्मा : </td>
         <td colspan="" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5">' . $this->mylibrary->convertedcit(round($net_total, 2)) . '</td>
         <td colspan="2" style="text-align: right;background-color:#556065;font-size:12px;color:#e5e5e5"> </td>

       </tr>
     </tfoot>
    </table>';
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
    $spreadsheet = $reader->loadFromString($htmlString);
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $extra_text . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }
}
