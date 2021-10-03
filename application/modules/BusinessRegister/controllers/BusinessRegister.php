<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class BusinessRegister extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("BusinessRegisterModel");
        $this->module_code = 'BUSINESS-REGISTER';
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
            $data['lists'] = $this->BusinessRegisterModel->getBusinessRegisterList();
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
        $data['ward'] = $this->CommonModel->getData('settings_ward','DESC');
        $data['dis'] = $this->CommonModel->getData('settings_district','DESC');
        $data['page'] = 'add';
        $this->load->view('main', $data);
    }

    //save kin bech
    public function save() {
        if($this->input->post('Submit')) {
            $post = $this->input->post();
            $trans_name = implode(',',$post['trans_name']);
            $trans_address = implode(',',$post['trans_address']);
            $trans_date = implode(',',$post['trans_date']);
            $trans_verify = implode(',',$post['trans_verify']);
            $userfile = $_FILES['userfile']['name'];
            $this->load->library('form_validation'); 
            // form validation 
            $this->form_validation->set_rules('fiscal_year','Fiscal Year','trim|required');
            $this->form_validation->set_rules('register_date','Register Date','required');
            $this->form_validation->set_rules('certificate_no','certificate_no','trim|required');
            $this->form_validation->set_rules('owner_name','owner_name','trim|required');
            $this->form_validation->set_rules('owner_road_name','owner_road_name','trim|required');
            $this->form_validation->set_rules('owner_house_no','owner_house_no','trim|required');
            $this->form_validation->set_rules('owner_per_napa','owner_per_napa','trim|required');
            $this->form_validation->set_rules('owner_per_ward','owner_per_ward','trim|required');
            $this->form_validation->set_rules('owner_per_tol','owner_per_tol','trim|required');
            $this->form_validation->set_rules('owner_present_na','owner_present_na','trim|required');
            $this->form_validation->set_rules('owner_present_ward','owner_present_ward','trim|required');
            $this->form_validation->set_rules('owner_present_tol','owner_present_tol','trim|required');
            $this->form_validation->set_rules('firm_capital','firm_capital','trim|required');
            $this->form_validation->set_rules('firm_aim','firm_aim','trim|required');
            $this->form_validation->set_rules('firm_employee_no','firm_employee_no','trim|required');
            $this->form_validation->set_rules('firm_branch','firm_branch','trim|required');
            $this->form_validation->set_rules('firm_name_nepali','firm_name_nepali','trim|required');
            $this->form_validation->set_rules('firm_name_en','firm_name_en','trim|required');
            $this->form_validation->set_rules('firm_income_bill','firm_income_bill','trim|required');
            $this->form_validation->set_rules('firm_level','firm_level','trim|required');
            $this->form_validation->set_rules('firm_address','firm_address','trim|required');
            $this->form_validation->set_rules('firm_ward','firm_ward','trim|required');
            $this->form_validation->set_rules('firm_tol','firm_tol','trim|required');
            $this->form_validation->set_rules('firm_operator_name','firm_operator_name','trim|required');
            $this->form_validation->set_rules('firm_operator_address','firm_operator_address','trim|required');
            $this->form_validation->set_rules('firm_land_rent','firm_land_rent','trim|required');
            $this->form_validation->set_rules('firm_road_name','firm_road_name','trim|required');
            $this->form_validation->set_rules('firm_house_number','firm_house_number','trim|required');
            // $this->form_validation->set_rules('trans_name','trans_name','trim|required');
            // $this->form_validation->set_rules('trans_address','trans_address','trim|required');
            // $this->form_validation->set_rules('trans_date','trans_date','trim|required');
            // $this->form_validation->set_rules('trans_verify','trans_verify','trim|required');
            // $this->form_validation->set_rules('czn_no','czn_no','trim|required');
            $this->form_validation->set_rules('czn_date','czn_date','trim|required');
            $this->form_validation->set_rules('czn_dis','czn_dis','trim|required');
            if($this->form_validation->run() == false) {
                $message =  validation_errors();
                $this->session->set_flashdata('ERR_VALIDATION',$message);
                redirect('BusinessRegister/addNew');
            } else {
                if(!empty($userfile)) {
                $config = array(
                    'upload_path'=>'./assets/business_owner/',
                    'allowed_types'=> "jpg|png|PNG|jpeg|JPEG",
                    'max_size'=> 1024,
                    'overwrite' => TRUE,
                    'file_name' => $userfile,
                );
                $this->load->library('upload');
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('userfile')) {
                    $error =  'Could Not upload'.$this->upload->display_errors();
                    $this->session->set_flashdata('ERR_UPLOAD',$error);
                    redirect('BusinessRegister/addNew');
                } else{
                    $this->upload->do_upload();
                }
            }
            $save_array = array(
                'fiscal_year'            => $post['fiscal_year'],
                'register_date'          => $post['register_date'],
                'certificate_no'         => $post['certificate_no'],
                'owner_name'             => $post['owner_name'],
                'owner_gender'           => $post['owner_gender'],
                'owner_number'           => $post['owner_number'],
                'userfile'               => !empty($userfile)?$userfile:'',
                'owner_road_name'        => $post['owner_road_name'],
                'owner_house_no'         => $post['owner_house_no'],
                'owner_per_napa'         => $post['owner_per_napa'],
                'owner_per_ward'         => $post['owner_per_ward'],
                'owner_per_tol'          => $post['owner_per_tol'],
                'owner_present_na'       => $post['owner_present_na'],
                'owner_present_ward'     => $post['owner_present_ward'],
                'owner_present_tol'      => $post['owner_present_tol'],
                'firm_capital'           => $post['firm_capital'],
                'firm_aim'               => $post['firm_aim'],
                'firm_employee_no'       => $post['firm_employee_no'],
                'firm_branch'            => $post['firm_branch'],
                'firm_name_nepali'       => $post['firm_name_nepali'],
                'firm_name_en'           => $post['firm_name_en'],
                'firm_income_bill'       => $post['firm_income_bill'],
                'firm_level'             => $post['firm_level'],
                'firm_address'           => $post['firm_address'],
                'firm_ward'              => $post['firm_ward'],
                'firm_tol'               => $post['firm_tol'],
                'firm_operator_name'     => $post['firm_operator_name'],
                'firm_operator_address'  => $post['firm_operator_address'],
                'firm_land_rent'         => $post['firm_land_rent'],
                'firm_road_name'         => $post['firm_road_name'],
                'firm_house_number'      => $post['firm_house_number'],
                'trans_name'             => '',
                'trans_address'          => '',
                'trans_date'             => '',
                'trans_verify'           => '',
                'czn_no'                 => $post['czn_no'],
                'czn_date'               => $post['czn_date'],
                'czn_dis'                => $post['czn_dis'],
                'added_by'               => $this->session->userdata('PRJ_USER_ID'),
                'added_on'               => convertDate(date('Y-m-d')),
                'modified_by'            => '',
                'modified_on'            => '',
                'status'                 =>'1',
                'initial_flag'           => 0
            );
            //pp($save_array);
            $result = $this->BusinessRegisterModel->insertData($save_array);
            if($result) {
                $id = $this->db->insert_id();
                if(!empty($post['trans_name'])) {
                    foreach ($post['trans_name'] as $key => $indexv) {
                        $topic_details[]    = array(
                            'trans_name'    => $post['trans_name'][$key],
                            'trans_address'     => $post['trans_address'][$key],
                            'trans_date'         => $post['trans_date'][$key],
                            'trans_verify'     => $post['trans_verify'][$key],
                            'firm_id'           => $id
                        );
                    }
                }
                $this->BusinessRegisterModel->firm_transaction($topic_details);
                $this->session->set_flashdata('MSG_SUCCESS','व्यापार सफलतापूर्वक दर्ता गरिएको छ');
                redirect('BusinessRegister/');
            } else {
                $this->session->set_flashdata('ERR_UPLOAD','Error');
                redirect('BusinessRegister/addNew');
            }
            //
            }
            
        }
    }

    //view details
    public function ViewDetails($id = NULL) {
        $id = $this->uri->segment(3);
        if(empty($id)) {
            show_404();
        } else {
            $data['data'] = $this->BusinessRegisterModel->getSelectedBusinessRegisterList($id);
            $data['firm_trans'] = $this->BusinessRegisterModel->getFirmTransaction($id);
            $data['page'] ='view_details';
            $this->load->view('main', $data);
        }
      
    }

    public function Edit($id) {
        $data['page'] = 'edit';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['ward'] = $this->CommonModel->getData('settings_ward','DESC');
        $data['dis'] = $this->CommonModel->getData('settings_district','DESC');
        $data['business'] = $this->BusinessRegisterModel->getSelectedBusinessRegisterList($id);
        $data['firm_trans'] = $this->BusinessRegisterModel->getFirmTransaction($id);
        $this->load->view('main', $data);
    }

    //update details
    public function update() {
        if($this->input->post('Submit')) {
            $post = $this->input->post();
            $id = $post['id'];
            $trans_name = $post['trans_name'];
            $trans_address = $post['trans_address'];
            $trans_date = $post['trans_date'];
            $trans_verify = $post['trans_verify'];
            $bid    = $post['bid'];
            $userfile = $_FILES['userfile']['name'];
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fiscal_year','Fiscal Year','trim|required');
            $this->form_validation->set_rules('register_date','Register Date','required');
            $this->form_validation->set_rules('certificate_no','certificate_no','trim|required');
            $this->form_validation->set_rules('owner_name','owner_name','trim|required');
            $this->form_validation->set_rules('owner_road_name','owner_road_name','trim|required');
            $this->form_validation->set_rules('owner_house_no','owner_house_no','trim|required');
            $this->form_validation->set_rules('owner_per_napa','owner_per_napa','trim|required');
            $this->form_validation->set_rules('owner_per_ward','owner_per_ward','trim|required');
            $this->form_validation->set_rules('owner_per_tol','owner_per_tol','trim|required');
            $this->form_validation->set_rules('owner_present_na','owner_present_na','trim|required');
            $this->form_validation->set_rules('owner_present_ward','owner_present_ward','trim|required');
            $this->form_validation->set_rules('owner_present_tol','owner_present_tol','trim|required');
            $this->form_validation->set_rules('firm_capital','firm_capital','trim|required');
            $this->form_validation->set_rules('firm_aim','firm_aim','trim|required');
            $this->form_validation->set_rules('firm_employee_no','firm_employee_no','trim|required');
            $this->form_validation->set_rules('firm_branch','firm_branch','trim|required');
            $this->form_validation->set_rules('firm_name_nepali','firm_name_nepali','trim|required');
            $this->form_validation->set_rules('firm_name_en','firm_name_en','trim|required');
            $this->form_validation->set_rules('firm_income_bill','firm_income_bill','trim|required');
            $this->form_validation->set_rules('firm_level','firm_level','trim|required');
            $this->form_validation->set_rules('firm_address','firm_address','trim|required');
            $this->form_validation->set_rules('firm_ward','firm_ward','trim|required');
            $this->form_validation->set_rules('firm_tol','firm_tol','trim|required');
            $this->form_validation->set_rules('firm_operator_name','firm_operator_name','trim|required');
            $this->form_validation->set_rules('firm_operator_address','firm_operator_address','trim|required');
            $this->form_validation->set_rules('firm_land_rent','firm_land_rent','trim|required');
            $this->form_validation->set_rules('firm_road_name','firm_road_name','trim|required');
            $this->form_validation->set_rules('firm_house_number','firm_house_number','trim|required');
            $this->form_validation->set_rules('czn_date','czn_date','trim|required');
            $this->form_validation->set_rules('czn_dis','czn_dis','trim|required');
            if($this->form_validation->run() == false) {
                $message =  validation_errors();
                $this->session->set_flashdata('ERR_VALIDATION',$message);
                redirect('BusinessRegister/addNew');
            } else {
                if(!empty($userfile)) {
                $config = array(
                    'upload_path'=>'./assets/business_owner/',
                    'allowed_types'=> "jpg|png|PNG|jpeg|JPEG",
                    'max_size'=> 1024,
                    'overwrite' => TRUE,
                    'file_name' => $userfile,
                );
                $this->load->library('upload');
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('userfile')) {
                    $error =  'Could Not upload'.$this->upload->display_errors();
                    $this->session->set_flashdata('ERR_UPLOAD',$error);
                    redirect('BusinessRegister/addNew');
                } else{
                    $this->upload->do_upload();
                }
            }
            $save_array = array(
                'fiscal_year'            => $post['fiscal_year'],
                'register_date'          => $post['register_date'],
                'certificate_no'         => $post['certificate_no'],
                'owner_name'             => $post['owner_name'],
                'owner_gender'           => $post['owner_gender'],
                'owner_number'           => $post['owner_number'],
                'userfile'               => !empty($userfile)?$userfile:'',
                'owner_road_name'        => $post['owner_road_name'],
                'owner_house_no'         => $post['owner_house_no'],
                'owner_per_napa'         => $post['owner_per_napa'],
                'owner_per_ward'         => $post['owner_per_ward'],
                'owner_per_tol'          => $post['owner_per_tol'],
                'owner_present_na'       => $post['owner_present_na'],
                'owner_present_ward'     => $post['owner_present_ward'],
                'owner_present_tol'      => $post['owner_present_tol'],
                'firm_capital'           => $post['firm_capital'],
                'firm_aim'               => $post['firm_aim'],
                'firm_employee_no'       => $post['firm_employee_no'],
                'firm_branch'            => $post['firm_branch'],
                'firm_name_nepali'       => $post['firm_name_nepali'],
                'firm_name_en'           => $post['firm_name_en'],
                'firm_income_bill'       => $post['firm_income_bill'],
                'firm_level'             => $post['firm_level'],
                'firm_address'           => $post['firm_address'],
                'firm_ward'              => $post['firm_ward'],
                'firm_tol'               => $post['firm_tol'],
                'firm_operator_name'     => $post['firm_operator_name'],
                'firm_operator_address'  => $post['firm_operator_address'],
                'firm_land_rent'         => $post['firm_land_rent'],
                'firm_road_name'         => $post['firm_road_name'],
                'firm_house_number'      => $post['firm_house_number'],
                'trans_name'             => '',
                'trans_address'          => '',
                'trans_date'             => '',
                'trans_verify'           => '',
                'czn_no'                 => $post['czn_no'],
                'czn_date'               => $post['czn_date'],
                'czn_dis'                => $post['czn_dis'],
                'added_by'               => $this->session->userdata('PRJ_USER_ID'),
                'added_on'               => convertDate(date('Y-m-d')),
                'modified_by'            => '',
                'modified_on'            => '',
                'status'                 =>'1',
                'initial_flag'           => 0
            );
            
            $result = $this->BusinessRegisterModel->updateDetails($id,$save_array);
            if($result) {
                $id = $this->db->insert_id();
                if(!empty($post['trans_name'])) {
                    foreach ($post['trans_name'] as $key => $indexv) {
                        $topic_details[]    = array(
                            'id'            => $bid[$key],
                            'trans_name'    => $trans_name[$key],
                            'trans_address'     => $trans_address[$key],
                            'trans_date'         => $trans_date[$key],
                            'trans_verify'     => $trans_verify[$key],
                        );
                    }
                }
                $this->BusinessRegisterModel->updateTransDetails($bid,$topic_details);
                $this->session->set_flashdata('MSG_SUCCESS','व्यापार सफलतापूर्वक दर्ता गरिएको छ');
                redirect('BusinessRegister/ViewDetails/'.$post['id']);
            } else {
                $this->session->set_flashdata('ERR_UPLOAD','Error');
                redirect('BusinessRegister');
            }
            //
            }
            
        }
    }

}