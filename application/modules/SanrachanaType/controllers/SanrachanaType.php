<?php
class SanrachanaType extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->module_code = 'SANRACHANA-TYPE';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
        $this->fy = current_fiscal_year();
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
            $data['datas'] = $this->CommonModel->getAllDataByField('settings_architect_type','fiscal_year', $this->fy);

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
                $data['row'] = $this->CommonModel->getDataByID('settings_architect_type', $id);
            }
            $data['fy'] = $this->fy;
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
            $this->form_validation->set_rules('architect_type', 'संरचनाको प्रकार', 'required');
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
                'fiscal_year'       => $this->fy,
                'architect_type'    => $this->input->post('architect_type'),
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('settings_architect_type',$post_data);
                if($result) {
                    $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                }   
            } else {
                 $result = $this->CommonModel->UpdateData('settings_architect_type',$id, $post_data);
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
            $result = $this->CommonModel->remove($id,'settings_architect_type');
           
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