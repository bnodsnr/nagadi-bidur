<?php
class FiscalYear extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->module_code = 'FISCAL-YEAR';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /**
        * This function list all the land minimun rate
        * @param NULL
        * @return void

     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /**
        * On ajax call load view
        * @param  NULL
        * @return void
     */
    public function add() {
        $data['pageTitle'] = "आर्थिक वर्षको";
        $this->load->view('add',$data);
    }

    /**
        * Call on ajax request
        * save fiscal year
        * @return NULL
     */
    public function save() {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('year', 'year', 'required|is_unique[fiscal_year.year]');
            if($this->form_validation->run() == false) {
                $response = array(
                    'status'      => 'validation_error',
                    'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            $post_data = array(
                'year'    => $this->input->post('year'),
                'is_current'     => $this->input->post('is_current'),
            );
            $result = $this->CommonModel->insertData('fiscal_year',$post_data);
            if($result) {
                $data = array('is_current'=>'0');
                $result = $this->CommonModel->updateFiscalYear($data, $this->db->insert_id());
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } 
        } else {
            exit('no direct script allowed');
        }
    }

     /**
        * On ajax call load view
        * @param  $id $_POST['id']
        * @return void
     */
    public function edit() {
        $id = $this->input->post('id');
        $data['pageTitle'] = "आर्थिक वर्षको";
        $data['row'] = $this->CommonModel->getDataByID('fiscal_year',$id);
        $this->load->view('edit',$data);
    }

     /**
        * This function on ajaxcall update land area type data
        * @param  $_POST
        * @return json response
     */
    public function Update() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $this->form_validation->set_rules('year', 'year', 'required');
            if($this->form_validation->run() == false) {
                $response = array(
                    'status'      => 'validation_error',
                    'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            $post_data = array(
                'year'    => $this->input->post('year'),
                'is_current'     => $this->input->post('is_current'),
            );
            $result = $this->CommonModel->UpdateData('fiscal_year',$id,$post_data);
            if($result) {
                $data = array('is_current'=>'0');
                $result = $this->CommonModel->updateFiscalYear($data, $id);
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } 
        } else {
                exit('no direct script allowed');
        }
    }

    public function UpdateStatus() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $post_data = array(
                'is_current'     => 1,
            );
            $result = $this->CommonModel->UpdateData('fiscal_year',$id,$post_data);
            if($result) {
                $data = array('is_current'=>'0');
                $this->CommonModel->updateFiscalYear($data, $id);
                $response = array(
                    'status'      => 'success',
                    'data'         => "तपाई चालू आर्थिक वर्ष परिवर्तन गर्न सफल हुनु भएको छ.",
                    'message'     => 'success',
                    ''
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } 
        } else {
                exit('no direct script allowed');
        }
    }
}