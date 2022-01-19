<?php
/**
 * Created by Binod Sunar.
 * User: root
 */
class BillSetting extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model('BillSettingModel');
        $this->module_code = 'BILL-SETTING';
        $this->fy = current_fiscal_year();
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }
    /*
        *This function list all the land minimun rate
        @param 
        return array of all land_minimum rate
     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page']           = 'list_all';
            $data['fiscal_year']    = $this->CommonModel->getData('fiscal_year','DESC');
            $data['nagadi_bills']   = $this->BillSettingModel->getBillData(1);
            $data['sampati_bills']  = $this->BillSettingModel->getBillData(2);
            $data['nagadiCheck']    = check_bill_no_exits();
            //pp($data['nagadiCheck']);
            $data['reserved_bills'] = $this->BillSettingModel->getReservedBills('reserve_bills');
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function add() {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $data['page']           = 'add_new_details';
            $data['fiscal_year']    = $this->CommonModel->getData('fiscal_year','DESC');
            $data['user']           = $this->BillSettingModel->getUser();
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function saveBillSetting() {
        if($this->input->post('Submit')) {
            $user_id            = $this->input->post('user_id');
            $bill_type          = $this->input->post('bill_type');
            $fiscal_year        = get_current_fiscal_year();
            $bill_from          = $this->input->post('bill_from');
            $bill_to            = $this->input->post('bill_to');
            $is_valid_from      = $this->BillSettingModel->isValidFromBill($bill_from, $bill_type);
            $is_valid_to        = $this->BillSettingModel->isValidFromBill($bill_to, $bill_type);
            $check_active_bill  = $this->BillSettingModel->checkActiveBill($user_id, $bill_type);
            if(!empty($is_valid_from)){
                $this->session->set_flashdata('MSG_ALERT','Bill Range is already in used');
                redirect('BillSetting/add');
            }
            if(!empty($is_valid_to)){
                $this->session->set_flashdata('MSG_ALERT','Bill Range is already in used');
                redirect('BillSetting/add');
            }
            if(!empty($check_active_bill)) {
                $this->session->set_flashdata('MSG_ALERT','Acitve bill eixts. Please close bill first');
                redirect('BillSetting/add');
            }
            $post_data = array(
                'user_id'       => $this->input->post('user_id'),
                'bill_type'     => $this->input->post('bill_type'),
                'bill_from'     => $this->input->post('bill_from'),
                'bill_to'       => $this->input->post('bill_to'),
                'fiscal_year'   => $this->input->post('fiscal_year'),
                'added_by'      => $this->session->userdata('PRJ_USER_ID'),
                'status'        => 1,
                'added_on'      => date('Y-m-d h:i:s')
            );
            $result = $this->CommonModel->insertData('settings_bill_setup', $post_data);
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', "सफलतापूर्वक अपडेट गरियो");
                redirect('BillSetting');
            }
        }
    }
    
    
    /**
        * This function delete data the id.
        * check proper id is in format of not.
        * @param $id int pk
        * @return json.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $billDetails = $this->CommonModel->getDataByID('settings_bill_setup',$id);
            $userdatails = $this->CommonModel->getDataBySelectedFields('users','userid',$billDetails['user_id']);
            if($billDetails['type'] == 1 ) {
                $delete = 'nagadi_amount_details';
            } else {
                $delete ='sampati_bhumi_kar_details';
            }
            $checkBill = check_if_has_nagadi_bills($delete, $this->fy,$userdatails['ward']);
            if(!empty($checkBill)) {
                $response = array(
                    'status'      => 'error',
                    'data'         => "रसिद काटिसकेको हुनाले हटाउन मिल्दैन",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            $result = $this->CommonModel->remove($id,'settings_bill_setup');
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

    //close nagadi bills
    public function closeNagadi($id) {
        $rows = $this->CommonModel->getDataByID('settings_bill_setup',$id);
        $checkformaxbills = $this->BillSettingModel->getMaxActiveNagadiBills($rows['user_id']);
        if($checkformaxbills['bill_no'] == $rows['bill_to']) {
            $data = array('status' => 2);
            $result = $this->CommonModel->updateData('settings_bill_setup',$id,$data);
            if($result) {
                redirect('BillSetting');
            }
        } else {
            $this->session->set_flashdata('MSG_WARN', 'रसिद काट्न बाकी भएको यो रसिद बन्द गर्न मिलेन');
            redirect('BillSetting');
        }
    }

    public function closeSampati($id)
    {
        $rows = $this->CommonModel->getDataByID('settings_bill_setup', $id);
        $checkformaxbills = $this->BillSettingModel->getMaxActiveSampatiBills($rows['user_id']);
        if ($checkformaxbills['bill_no'] == $rows['bill_to']) {
            $data = array('status' => 2);
            $result = $this->CommonModel->updateData('settings_bill_setup', $id, $data);
            if ($result) {
                redirect('BillSetting');
            }
        } else {
            $this->session->set_flashdata('MSG_WARN', 'रसिद काट्न बाकी भएको यो रसिद बन्द गर्न मिलेन');
            redirect('BillSetting');
        }
    }

   
}
