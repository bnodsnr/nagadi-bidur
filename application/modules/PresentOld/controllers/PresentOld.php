<?php

class PresentOld extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->module_code = 'LAND-CATEGORY';
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
            $data['datas'] = $this->CommonModel->getData('settings_old_and_present','ASC','present_ward');
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /**
        * This function on ajaxcall load add form in modal**
        * @param NULL
        * @return void
     */
    public function add() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $data['title'] = '';
            if(!empty($id)) {
                $data['row'] = $this->CommonModel->getDataByID('settings_old_and_present', $id);
            }
            $data['old_ward'] = $this->CommonModel->getUniqueOldWard();
           // pp($data['old_ward']);
            $this->load->view('add', $data);
        } else {
            exit('No direct script allowed!');
        }
        
    }

    /**
        * This function on ajaxcall submit land area type data
     */ 
    public function Save() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $present_name = $this->input->post('present_name');
            $present_ward = $this->input->post('present_ward');
            $old_name = $this->input->post('old_name');
            $old_ward = $this->input->post('old_ward');
            $post_data = array(
                'present_name'  => $present_name,
                'present_ward'  => $present_ward,
                'old_name'      => $old_name,
                'old_ward'      => $old_ward,
                'fiscal_year'   => get_current_fiscal_year(),
                // 'added_by'      => $this->session->userdata('PRJ_USER_ID'),
                // 'added_on'      => convertDate(date('Y-m-d')),
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('settings_old_and_present',$post_data);
                if($result) {
                    $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                        // 'message'     => 'redirect',
                        // 'redirect_url'       => base_url().'Road',
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                }   
            } else {
                 $result = $this->CommonModel->UpdateData('settings_old_and_present',$id, $post_data);
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
            }
        }
    }

    /**
        * This function delete data from database.
        * check proper id is in format of not.
        * @param $id int pk
        * @return boolean.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $result = $this->CommonModel->remove($id,'settings_old_and_present');
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