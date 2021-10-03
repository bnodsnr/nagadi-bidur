<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class BuySell extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("BuySellModel");
        $this->module_code = 'BUY-SELL';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }
 
    /*
     * This function load add buy or sell form
     * @param NULL
     * return load view with list
     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['list'] = $this->BuySellModel->getList();
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /*
     * This function load add buy or sell form
     * @param NULL
     * return view
     */
    public function addNew() {
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['profile'] = $this->BuySellModel->getProfile();

        $data['page'] = 'buy_sell';
        $this->load->view('main', $data);
    }


    /*
     * This function on ajaxcall get land owner details
     * @param file no
     * return array
     */
    public function getLandOwnerDetails() {
        if($this->input->is_ajax_request()) {
            $file_no = $this->input->post('file_no');
            $kitta_no = $this->BuySellModel->getKittaNumber($file_no);

            $option = "";
            $option .= "<option value=''>कित्ता नं छनौट गर्नुहोस्</option>";
            if(!empty($kitta_no)) {
                foreach ($kitta_no as $key => $value) {
                    $option .= "<option value='".$value['k_number']."'>".$value['k_number']."</option>";
                }
            } 
            $response = array(
                'status' => 'success',
                'data'   => $option,
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        } else {
            exit('no direct script allowed');
        }
    }

    /*
     * This function on ajax call get land details and sanrachana details
     * @param kitta number
     * return array
     */
    public function getLandDetails() {
        if($this->input->is_ajax_request()){
            $kittaNo = $this->input->post('kitta_no');
            $file_no = $this->input->post('file_no');
           
            $landDetails = $this->BuySellModel->getLandDetails($kittaNo, $file_no);
            //pp($landDetials);
            //$sanrachanaDetails = $this->BuySellModel->checkHasSanrachana($kittaNo);
            $response = array(
            'status' => 'success',
            'data'   => $landDetails,
            //'sanrachana' => $sanrachanaDetails,
            );
            header("Content-type:application/json");
            echo json_encode($response);
            exit;
        }else {
            exit('No Direct Script Allowed!!!');
        }
    }

    //save kin bech
    public function save() {
        if($this->input->post('Submit')) {

            $regNo          = $this->input->post('reg_no');
            $sellerFileNo   = $this->input->post('seller_file_no');
            $jkNo           = $this->input->post('jk_no');
            $totalLand      = $this->input->post('total_land');
            $minRate        = $this->input->post('minRate');
            $lkAmount       = $this->input->post('lkAmount');
            $taxAmount      = $this->input->post('tax_amount');
            $buyerFileNo    = $this->input->post('buyer_file_no');
            $newKitta       = $this->input->post('new_s_kitta_no');
            $newKAmount     = $this->input->post('new_k_amount');
            $nLandArea      = $this->input->post('n_land_area');
            $newTaxAmount   = $this->input->post('new_tax_amount');
            $nRopani        = $this->input->post('n_ropani');
            $naana          = $this->input->post('n_aana');
            $nPaisa         = $this->input->post('n_paisa');
            $nDam           = $this->input->post('n_paisa');

            $j_ropani       = $this->input->post('j_ropani');
            $j_aana         = $this->input->post('j_aana');
            $j_paisa        = $this->input->post('j_paisa');
            $j_dam          = $this->input->post('j_dam');

            $n_ropani       = $this->input->post('n_ropani');
            $n_aana         = $this->input->post('n_aana');
            $n_paisa        = $this->input->post('n_paisa');
            $n_dam          = $this->input->post('n_dam');

            $remarks        = $this->input->post('remarks');
            $sID = '';
            //$landDescription    = $this->BuySellModel->getLandDetails($jkNo);
            $hasSanrachana      = $this->BuySellModel->checkHasSanrachana($jkNo);//check if has sanrachan or not

            $new_total_land     = $totalLand - $nLandArea;
            $new_ropani         = $j_ropani - $n_ropani;
            $new_aana           = $j_aana - $n_aana;
            $new_paisa          = $j_paisa - $nPaisa;
            $new_dam            = $j_dam - $nDam;

            //echo $new_dam

            $newTaxRate = $landDescription['t_rate'] - $newTaxAmount;

            if($landDescription['total_square_feet'] == $nLandArea) {
                $post_ld_update = array(

                    'k_land_rate'   => $newKAmount,
                    'ld_file_no'    => $buyerFileNo,
                    't_rate'        => $newTaxAmount,
                );

               $this->BuySellModel->updateLandDetails($post_ld_update, $jkNo);


            } else {

                $post_ld = array(
                    'old_gapa_napa'     => $landDescription['old_gapa_napa'],
                    'old_ward'          => $landDescription['old_ward'],
                    'present_gapa_napa' => $landDescription['present_gapa_napa'],
                    'present_ward'      => $landDescription['present_ward'],
                    'road_name'         => $landDescription['road_name'],
                    'land_area_type'    => $landDescription['land_area_type'],
                    'nn_number'         => $landDescription['nn_number'],
                    'k_number'          => $this->input->post('new_b_kitta_no'),

                    'a_ropani'          => $this->input->post('n_ropani'),
                    'a_ana'             => $this->input->post('n_aana'),
                    'a_paisa'           => $this->input->post('n_paisa'),
                    'a_dam'             => $this->input->post('n_dam'),

                    'a_unit'            => $landDescription['a_unit'],
                    'total_square_feet' => $new_total_land,
                    'min_land_rate'     => $landDescription['min_land_rate'],
                    'max_land_rate'     => '',
                    'k_land_rate'       => $newKAmount,
                    'fiscal_year'       =>current_fiscal_year(),
                    't_rate'            => $newTaxAmount,
                    'ld_file_no'        => $buyerFileNo,
                    'added_by' => $this->session->userdata('PRJ_USER_ID'),
                    'added_on' => convertDate(date('Y-m-d').'H:i:s')
                );

                //pp($post_ld);
                //update buyer data
                $update_buyer = array(
                    'a_ropani'          => $new_ropani,
                    'a_ana'             => $new_aana,
                    'a_paisa'           => $new_paisa,
                    'a_dam'             => $new_dam,
                    
                    'total_square_feet' => $new_total_land,
                    'k_land_rate'       => $newKAmount,
                    't_rate'            => $newTaxRate,
                    'k_number'          => $this->input->post('new_s_kitta_no'),
                );

                $this->BuySellModel->updateLandDetails($update_buyer,$jkNo);
                $this->BuySellModel->insertLandDetails($post_ld);
            }
            
            $post_data = array(
                'reg_no'            => $regNo,
                'seller_file_no'    => $sellerFileNo,
                'jk_no'             => $jkNo,
                'total_land'        => $totalLand,
                'min_rate'          => $minRate,
                'l_k_amount'        => $lkAmount,
                'tax_amount'        => $taxAmount,
                'buyer_file_no'     => !empty($buyerFileNo)?$buyerFileNo:'',
                'new_kitta_no'      => $newKitta,
                'new_k_amount'      => $newKAmount,
                'n_land_area'       => $nLandArea,
                'new_s_kitta_no'    => $this->input->post('new_s_kitta_no'),
                'new_tax_amount'    => $newTaxAmount,

                's_sanrachana'      => !empty($hasSanrachana['id'])?$hasSanrachana['id']:'',
                's_ropani'          => !empty($j_ropani)?$j_ropani:'0',
                's_aana'            => !empty($j_aana)?$j_aana:'0',
                's_paisa'           => !empty($j_paisa)?$j_paisa:'0',
                's_dam'             => !empty($s_dam)?$j_paisa:'0',

                'b_ropani'          => !empty($n_ropani)?$n_ropani:'0',
                'b_aana'            => !empty($n_aana)?$n_aana:'0',
                'b_paisa'           => !empty($n_paisa)?$n_paisa:'0',
                'b_dam'             => !empty($n_dam)?$n_dam:'0',

                'added_by'          => $this->session->userdata('PRJ_USER_ID'),
                'added_on'          => convertDate(date('Y-m-d').'H:i:s'),
                'status'            => '1',
                'remarks'           => $remarks
            );

            $result = $this->BuySellModel->insertBuySellDetails($post_data);
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS','!');
                redirect('BuySell');
            }
        }
    }

    //view details
    public function ViewDetails($id) {
        $data['list'] = $this->BuySellModel->getSelectedList( $id );
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $mpdf->autoPageBreak = false;
        $mpdf->AddPage();
        $mpdf->use_kwt = true;
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'iso-8859-4';
        $html = $this->load->view('view_details',$data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
        $mpdf->Output($file_name, "D");
    }
}