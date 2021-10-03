<?php
class Banks extends MX_Controller
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
            $data['banks'] = $this->CommonModel->getData('banks','DESC');
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
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required|is_unique[banks.name]');
            $this->form_validation->set_rules('acc_no', 'acc_no', 'required');
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
                'name'    => $this->input->post('bank_name'),
                'acc_no'     => $this->input->post('acc_no'),
            );
            $result = $this->CommonModel->insertData('banks',$post_data);
            if($result) {
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
        $data['row'] = $this->CommonModel->getDataByID('banks',$id);
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
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
            $this->form_validation->set_rules('acc_no', 'acc_no', 'required');
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
                'name'    => $this->input->post('bank_name'),
                'acc_no'     => $this->input->post('acc_no'),
            );
            $result = $this->CommonModel->UpdateData('banks',$id,$post_data);
            if($result) {
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
        * This function delete data the id.
        * check proper id is in format of not.
        * @param $id int pk
        * @return json.
     */
    public function delete() {
        $id = $this->uri->segment(3);
        $result = $this->CommonModel->remove($id,'banks');
        if($result) {
            $this->session->set_flashdata('MSG_SUCCESS','Successfully Removed');
            redirect('Banks','location');
        } else {
            $this->session->set_flashdata('MSG_ERR','Cannot Delete');
            redirect('Banks','refresh');
        }
    }
}