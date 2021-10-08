<?php
class RajasowTitle extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("RajasowTitleModel");
        $this->module_code = 'RAJASOW-TITLE';
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
            $data['datas'] = $this->RajasowTitleModel->getRajasowTitle();
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

            $this->form_validation->set_rules('topic_name', 'topic_name', 'required');
            $this->form_validation->set_rules('topic_id', 'topic_id', 'required');
            $this->form_validation->set_rules('annual_income', 'annual_income', 'required');
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
                'topic_name'        => $this->input->post('topic_name'),
                'topic_id'          => $this->input->post('topic_id'),
                'annual_income'     => $this->input->post('annual_income'),
            );
            $result = $this->CommonModel->insertData('rajasow_report_title',$post_data);
            if($result) {
                $response = array(
                    'status'        => 'success',
                    'data'          => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'       => 'success'
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
        $data['row'] = $this->CommonModel->getDataByID('rajasow_report_title',$id);
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
            $this->form_validation->set_rules('topic_name', 'topic_name', 'required');
            $this->form_validation->set_rules('topic_id', 'topic_id', 'required');
            $this->form_validation->set_rules('annual_income', 'annual_income', 'required');
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
                'topic_name'        => $this->input->post('topic_name'),
                'topic_id'          => $this->input->post('topic_id'),
                'annual_income'     => $this->input->post('annual_income'),
            );
            $result = $this->CommonModel->UpdateData('rajasow_report_title',$id,$post_data);
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

    public function View($topic_id) {
        if(empty($topic_id)) {
            redirect('RajasowTitle');
        } else {
            $data['page']           = "list_rates";
            $data['sub_topics']     = $this->CommonModel->getAllDataBySelectedFields('sub_topic','topic_no', $topic_id);
            $data['title']         = $this->CommonModel->getDataBySelectedFields('rajasow_report_title','topic_id',$topic_id);
            $this->load->view('main', $data);
        }
    }
    public function addRates($topic_id = NULL ) {
        $topic_id = $this->uri->segment(3);
        if(!empty($topic_id)) {
            $data['topic_id'] = $this->uri->segment(3);
        }
        $data['page']   = "add_rate_list";
        $data['sub_topics'] = $this->RajasowTitleModel->getRates('sub_topic');
        $data['titles'] = $this->CommonModel->getData('rajasow_report_title');
        $arr = array();
        foreach ($data['sub_topics'] as $key => $item) {
            $arr[$item['main_topic_name']][$key] = $item;
        }
        $data['report'] = $arr;
        $this->load->view('main', $data);
    }

    public function EditTopicRates() {
        if($this->input->is_ajax_request()) {
            $rajasow_title  = $this->input->post('rajasow_title');
            $id             = $this->input->post('rate_id');
            $this->form_validation->set_rules('rate_id', 'rate_id', 'required');
            if($this->form_validation->run() == true) {
                $response = array(
                    'status'      => 'validation_error',
                    'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            $ids = implode(',',$id);
            //$update = array('topic_no' => NULL);
            $post_array = array('topic_no' => $rajasow_title);
            $result = $this->RajasowTitleModel->updateRates($post_array, $id);
            if($result) {
                $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                        'message'     => 'redirect',
                        'redirect_url'    => base_url().'RajasowTitle/View/'.$rajasow_title
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
           
        } else {
            exit('no direct script allowed');
        }
    }

    public function getTopicRatesDetails() {
        if($this->input->is_ajax_request()){
            $rajasow_no = $this->input->post('rajasow_no');
            $data['sub_topics'] = $this->RajasowTitleModel->getRates('sub_topic');
            $data['titles'] = $this->CommonModel->getData('rajasow_report_title');
            $arr = array();
            $htm = '';
            foreach ($data['sub_topics'] as $key => $item) {
                $arr[$item['main_topic_name']][$key] = $item;
            }
            $data['report'] = $arr;
            $data['topic_no'] = $rajasow_no;
            $data_view                  = $this->load->view('add_new_rate', $data, true);
            $response                   = array(
                'status'                  => 'success',
                'data'                    => $data_view
            );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
        } else {
            exit('invalid request');
        }
    }
    //edit topic no in subtile
    public function editTopicNo() {
        $id                 = $this->input->post('id');
        $data['row']         = $this->CommonModel->getDataById('sub_topic',$id);
        $data['titles']     = $this->CommonModel->getData('rajasow_report_title');
        $this->load->view('edit_topic_no',$data);
    }

    public function UpdateTopicNo() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $this->form_validation->set_rules('topic_no', 'topic_no', 'required');
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
                'topic_no'        => $this->input->post('topic_no'),
            );
            $result = $this->CommonModel->UpdateData('sub_topic',$id,$post_data);
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
}