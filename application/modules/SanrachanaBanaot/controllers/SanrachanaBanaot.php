<?php
class SanrachanaBanaot extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->module_code = 'SANRACHANA-BANAOT';
        $this->fy = current_fiscal_year();
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /**
        * This fetch raod type list.
        * @param NULL
        * @return void load view.
     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['datas'] = $this->CommonModel->getAllDataByField('settings_architect_structure','fiscal_year',$this->fy);
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
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $data['title'] = '';
            if(!empty($id)) {
                $data['row'] = $this->CommonModel->getDataByID('settings_architect_structure', $id);
            }
            $this->load->view('add', $data);
        } else {
            exit('No direct script allowed!');
        }
    }

    /**
        * Call on ajax request
        * save fiscal year
        * @return NULL
     */
    public function Save() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $this->form_validation->set_rules('structure_type', 'संरचनाको प्रकार', 'required');
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
                'fiscal_year'       => get_current_fiscal_year(),
                'structure_type'    => $this->input->post('structure_type'),
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('settings_architect_structure',$post_data);
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
                 $result = $this->CommonModel->UpdateData('settings_architect_structure',$id, $post_data);
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
        } else {
            exit('no direct script allowed');
        }
    }
 
    /**
        * This function delete data from database.
        * check proper id is in format of not.
        * @param $id int pk
        * @return json.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $result = $this->CommonModel->remove($id,'settings_architect_structure');
           
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