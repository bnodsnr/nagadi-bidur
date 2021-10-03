<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class DeteriorationStructure extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("DeteriorationStructureModel");
        $this->module_code = 'DETERIORATION-STRUCTURE';
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
            $data['page'] = 'list_all';
            //$data['fiscal_year'] = $this->CommonModel->getWhereAll('fiscal_year','DESC');
            $data['data'] = $this->DeteriorationStructureModel->getList();
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function add($id = NULL) {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $id = $this->uri->segment(3);
            $data['page'] = 'add_new_details';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['settings_architect_age'] = $this->CommonModel->getData('settings_architect_age', 'DESC');
            $data['settings_architect_structure'] = $this->CommonModel->getData('settings_architect_structure','DESC');
            if(!empty($id)) {
                $data['row'] = $this->CommonModel->getDataByID('settings_architect_age_rate',$id);
            }
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function SaveAgeTax() {

        $id = $this->input->post('id');
        $structure_type = $this->input->post('structure_type');
        $structure_age = $this->input->post('structure_age');
        $tax_percent = $this->input->post('tax_percent');
        $fiscal_year = $this->input->post('fiscal_year');
        $post_data = array(
            'age_range_id'     => $structure_age,
            'structure_id'     => $structure_type,
            'rate'          => $tax_percent,
            'fiscal_year'   => $fiscal_year
        );
       
        if(empty($id)) {
            $result = $this->CommonModel->insertData('settings_architect_age_rate',$post_data);
        } else{
            $result = $this->CommonModel->UpdateData('settings_architect_age_rate',$id, $post_data);
        }
        if($result) {
            $this->session->set_flashdata('MSG_SUCCESS', "सफलतापूर्वक अपडेट गरियो");
            redirect('DeteriorationStructure');
        }
    }
    /*--------------------------------------------------------------
        संरचनाको आयु-----------------------------------------------*/
    public function strucureAge() {
        $data['pageTitle'] = "Add Road Type";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $this->load->view('add_age', $data);
    }

    public function saveAge() {
        if($this->input->is_ajax_request()) {
            $post_data = array(
                'from_range' => $this->input->post('from_range'),
                'to_range' => $this->input->post('to_range'),
            );
            $result = $this->CommonModel->insertData('settings_architect_age',$post_data);
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "<div class='alert alert-success'>सफलतापूर्वक सम्मिलित गरियो</div>",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
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
            $result = $this->CommonModel->remove($id,'settings_architect_age_rate');
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