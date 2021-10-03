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
           //pp($data['list']);
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
            $data['file_no'] = $file_no;
            $data['land_details'] = $this->CommonModel->getWhereAll('land_description_details', array('ld_file_no' => $file_no));
            $data_view = $this->load->view('ajax_view',$data,true);
            $response = array(
                'status' => 'success',
                'data'   => $data_view,
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
            $j_ropani       = $this->input->post('j_ropani');
            $j_aana         = $this->input->post('j_aana');
            $j_paisa        = $this->input->post('j_paisa');
            $j_dam          = $this->input->post('j_dam');
            $totalLand      = $this->input->post('total_land');
            $minRate        = $this->input->post('min_amount');
            $kubul_amount   = $this->input->post('kubul_amount');
            $tax_amount     = $this->input->post('tax_amount');

            //new kitta details
            $buyer_file_no          = $this->input->post('buyer_file_no');
            $new_kitta_no           = $this->input->post('new_ktta_cut');
            $new_ropani             = $this->input->post('new_ropani');
            $new_aana               = $this->input->post('new_aana');
            $new_paisa              = $this->input->post('new_paisa');
            $new_dam                = $this->input->post('new_dam');
            $new_sq_feet            = $this->input->post('new_sq_feet');
            $new_sq_meter           = $this->input->post('new_sq_meter');
            $new_total_land_rate    = $this->input->post('new_total_land_rate');
            $add_buy_sell = array();
            $sum_ropani = 0;
            $sum_aana   = 0;
            $sum_paisa  = 0;
            $sum_dam    = 0;
            $sum_sq_feet = 0;
            $sum_total_amount = 0;
            if(!empty($new_kitta_no)) {
                foreach ($new_kitta_no as $key => $indexv) {
                    $sum_ropani+= $new_ropani[$key];
                    $sum_aana+= $new_aana[$key];
                    $sum_paisa+= $new_paisa[$key];
                    $sum_dam+= $new_dam[$key];
                    $sum_sq_feet += $new_sq_feet[$key];
                    $sum_total_amount += $new_total_land_rate[$key];
                    $add_buy_sell[]    = array(
                        'reg_no'            => '0',
                        'seller_file_no'    => $sellerFileNo,
                        'jk_no'             => $jkNo,
                        's_ropani'          => !empty($j_ropani)?$j_ropani:'0',
                        's_aana'            => !empty($j_aana)?$j_aana:'0',
                        's_paisa'           => !empty($j_paisa)?$j_paisa:'0',
                        's_dam'             => !empty($s_dam)?$j_dam:'0',
                        'total_land'        => $totalLand,
                        'min_rate'          => $minRate,
                        'l_k_amount'        => $kubul_amount,
                        'tax_amount'        => $tax_amount,
                        'buyer_file_no'     => !empty($buyerFileNo)?$buyerFileNo[$key]:'',
                        'new_kitta_no'      => $new_kitta_no[$key],
                        'b_ropani'          => !empty($new_ropani)?$new_ropani[$key]:'0',
                        'b_aana'            => !empty($new_aana)?$new_aana[$key]:'0',
                        'b_paisa'           => !empty($new_paisa)?$new_paisa[$key]:'0',
                        'b_dam'             => !empty($new_dam)?$new_dam[$key]:'0',
                        'new_sq_feet'       => !empty($new_sq_feet)?$new_sq_feet[$key]:'0',
                        'new_sq_meter'      => !empty($new_sq_meter)?$new_sq_meter[$key]:'0',
                        'new_tax_amount'    => $new_total_land_rate[$key],
                        'added_by'          => $this->session->userdata('PRJ_USER_ID'),
                        'added_on'          => convertDate(date('Y-m-d')).date('H:i:s'),
                        'status'            => '1',
                        'remarks'           => $remarks
                    );
                }
                $result = $this->BuySellModel->saveBuySellDetails($add_buy_sell);
                $seller_new_ropani   = $j_ropani    - $sum_ropani;
                $seller_new_aana     = $j_aana      - $sum_aana;
                $seller_new_paisa    = $j_paisa     - $sum_paisa;
                $seller_new_dam      = $j_dam       - $sum_dam;
                $new_sq_feet         = $totalLand   - $sum_sq_feet;
                $seller_total_amount = $tax_amount - $sum_total_amount;
                $land_new_kitta = $jkNo;
                $rem_area = array(
                    'file_no' => $sellerFileNo,
                    'new_area' => $seller_new_ropani.'-'.$seller_new_aana.'-'.$seller_new_paisa.'-'.$seller_new_dam,
                    'new_sq_feet' => $new_sq_feet,
                    'new_sq_meter' => '',
                    'new_kitta_no' => '',
                    'old_kitta_no' => $jkNo
                );
                $res = $this->BuySellModel->insertBuySellLandDetails($rem_area);
                if($res) {
                    $this->session->set_flashdata('MSG_SUCCESS','Success!');
                    redirect('BuySell/ViewDetails/'.$sellerFileNo);
                }
            }
        }
    }

    //view details
    public function ViewDetails($seller_file_no) {

        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'detail';

            //$data['kittacutdetails']  = $this->CommonModel->getWhere('land_area_after_buy_sell', array('file_no' => $seller_file_no));
           // pp($data['kittacutdetails']);         
            $data['land_details'] = $this->CommonModel->getWhereAll('land_description_details',array('ld_file_no' => $seller_file_no));
            //pp($data['land_details']);
            $data['list'] = $this->CommonModel->getWhereAll('buy_sell',array('seller_file_no' => $seller_file_no));
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }


    /**
        * This function delete data the id.
        * check proper id is in format of not.
        * @param $id int pk
        * @return json.
     */
    public function removeKitta() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $data = array('buy_sell_status' => 2);

            $result = $this->CommonModel->UpdateData('land_description_details',$id, $data);
            if($result) {
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


}