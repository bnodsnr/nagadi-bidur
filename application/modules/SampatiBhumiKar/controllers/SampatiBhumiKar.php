<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class SampatiBhumiKar extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("LandModel");
        $this->module_code = 'SAMPATI-BHUMI-KAR';
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
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC','');
            $data['sampati_bhumi_kar'] = $this->CommonModel->getAllDataBySelectedFields('sampati_bhumi_kar_rate','fiscal_year',get_current_fiscal_year());
            $this->load->view('main',$data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /* *
        *this function add or modify the list if id is set to null it will update detais
        @param int id incase of edit
        return true on success  
     */
    public function SaveSampatiBhumiKar() {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("from","देखि","trim|required",               
                array('required' => 'कृपया देखि रकम भर्नु होस्')
            );
            $this->form_validation->set_rules("to","देखि", "trim|required",
                array('required'=>'कृपया सम्म रकम भर्नु होस्','uni')
            );

            $this->form_validation->set_rules("sampati_kar","देखि", "trim|required",
                array('required'=>'कृपया सम्पतिकर भर्नु होस्')
            );

            $this->form_validation->set_rules("bhunmi_kar","देखि", "trim|required",
                array('required'=>'कृपया भूमिकर भर्नु होस् ')
            );
            if ($this->form_validation->run() === false) {
                $form_errors = array();
                foreach ($_POST as $key => $value) {
                    $errors[] = form_error($key);
                    $err = preg_replace('/[^A-Za-z0-9., -]/', '', $errors);
                    if (!empty($errors)) {
                        $form_errors[] = array(
                            'id' => strtoupper($key),
                            'message' => $err
                        );
                    }
                }
                $response = array(
                    'status'      => 'error',
                    'data'         => $form_errors,
                    'message'     => 'form_error'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } else {
                $data = $this->input->post();

                $isUnique = $this->LandModel->checkUnique($data['from'],$data['to'],$data['fiscal_year']);
                if($isUnique->num_rows()>0) {
                    $error_message = "<div class='alert alert-success'>".$data['from'].'-'.$data['to']."पहिले नै दर्ता गरिएको छ" ."</div>";
                    $response = array(
                        'status'      => 'error',
                        'data'         => "<div class='alert alert-danger'>".$data['fiscal_year']." डाटा पहिले नै अवस्थित छ</div>",
                        'message'     => 'du_error'
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                } else {
                    $post_data = array(
                        'from_rate'=>$data['from'],
                        'to_rate'=>$data['to'],
                        'sampati_kar'=>$data['sampati_kar'],
                        'bhumi_kar'=>$data['bhunmi_kar'],
                        'fiscal_year' =>$data['fiscal_year']
                    );
                    $result = $this->CommonModel->insertData('sampati_bhumi_kar_rate',$post_data);
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
    }

    /**
        **
        This funtion load add form 
    */
    public function addNew() {
        $id = $this->uri->segment(3);
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        if(empty($id)) {
            $data['row'] = $this->CommonModel->getDataByID('sampati_bhumi_kar_rate',$id);
        }
        $this->load->view('add',$data);
    }


    public function editDetailsView() {
        $id = $this->input->post('id');
        $data['pageTitle'] = "EDIT DETAILS";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['editData'] = $this->CommonModel->getDataBySelectedFields('sampati_bhumi_kar_rate','id',$id);
        $this->load->view('edit_details',$data);
    }

    public function UpdateSampatiBhumiKar() {
         if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("from","देखि","trim|required",               
                array('required' => 'कृपया देखि रकम भर्नु होस्')
            );
            $this->form_validation->set_rules("to","देखि", "trim|required",
                array('required'=>'कृपया सम्म रकम भर्नु होस्','uni')
            );

            $this->form_validation->set_rules("sampati_kar","देखि", "trim|required",
                array('required'=>'कृपया सम्पतिकर भर्नु होस्')
            );

            $this->form_validation->set_rules("bhunmi_kar","देखि", "trim|required",
                array('required'=>'कृपया भूमिकर भर्नु होस् ')
            );
            if ($this->form_validation->run() === false) {
                $form_errors = array();
                foreach ($_POST as $key => $value) {
                    $errors[] = form_error($key);
                    $err = preg_replace('/[^A-Za-z0-9., -]/', '', $errors);
                    if (!empty($errors)) {
                        $form_errors[] = array(
                            'id' => strtoupper($key),
                            'message' => $err
                        );
                    }
                }
                $response = array(
                    'status'      => 'error',
                    'data'         => $form_errors,
                    'message'     => 'form_error'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } else {
                $data = $this->input->post();
                $id = $this->input->post('id');
                $post_data = array(
                    'from_rate'=>$data['from'],
                    'to_rate'=>$data['to'],
                    'sampati_kar'=>$data['sampati_kar'],
                    'bhumi_kar'=>$data['bhunmi_kar'],
                    'fiscal_year' =>$data['fiscal_year']
                );
              
                $result = $this->CommonModel->UpdateData('sampati_bhumi_kar_rate',$id,$post_data);
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
    
     /**
        * This function delete data the id.
        * check proper id is in format of not.
        * @param $id int pk
        * @return json.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $result = $this->CommonModel->remove($id,'sampati_bhumi_kar_rate');
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