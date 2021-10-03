<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class WardAddress extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        // $this->load->model("RoadModel");
        $this->module_code = 'SET-WARD-ADDRESS';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }
 
    /*
        * This function list all the land minimun rate
        @param 
        return load view with list

     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['ward'] = $this->CommonModel->getData('settings_ward','DESC');
            $data['wardaddress'] = $this->CommonModel->getData('wardwise_address','DESC');
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }
    public function addWardAddress() {
          $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
          $data['ward'] = $this->CommonModel->getData('settings_ward','DESC');
         $this->load->view('add_ward_address', $data);

    }

    public function save(){
     if($this->input->is_ajax_request()) {
            $post_data = array(
                'ward' => $this->input->post('ward'),
                'address'  => $this->input->post('address')
            );

            $result = $this->CommonModel->insertData('wardwise_address', $post_data);
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
    
    public function updateWardAddress() {
        $id = $this->input->post('updateID');
        $data['pageTitle'] = "editward";
        $data['ward'] = $this->CommonModel->getData('settings_ward','DESC');
        $data['editData'] = $this->CommonModel->getDataByID('wardwise_address',$id);
        $this->load->view('edit_ward',$data);
    }

    public function update(){
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $post_data = array(
                'ward' => $this->input->post('ward'),
                'address'  => $this->input->post('updateWard')
            );

            $result = $this->CommonModel->updateData('wardwise_address', $id,  $post_data);
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
}