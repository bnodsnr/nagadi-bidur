<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class Userprofile extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Userprofilemodel');
        $this->load->model('CommonModel');
        // $this->module_code = 'USERS';
    }

    public function Index()
    {
        // if($this->authlibrary->IsLoggedIn()){
        //     if(!$this->authlibrary->HasModulePermission($this->module_code, 'VIEW')){
        //         $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
        //         redirect('Dashboard');
        //     }
        //     redirect('Users/ListAll','location');
        // }else{
        //     $this->session->set_flashdata('error','Please login with your username and password');
        //     $this->session->set_userdata('return_url', current_url());
        //     redirect('Login','location');
        // }
    }


    //deactivate users
    public function ViewProfile($id = NULL) {
        if($this->authlibrary->IsLoggedIn()) {
            // if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
            //     $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
            //     redirect('Dashboard');
            // }
           
            $id = $this->uri->segment(3);
            $data['query'] = $this->Userprofilemodel->getUserData($id);
            $group = $this->Userprofilemodel->listgroup();
            $data['group'] = $group;
            $this->breadcrumb->populate(array(
                'Home' => '',
                'Users' => 'Users/ListAll',
                'Edit'
            ));
            $data['breadcrumb'] = $this->breadcrumb->output();
            $data['title'] = 'Deactive User';
            $data['pagetitle'] = 'Deactive User';
            $data['page'] = 'user_profile';
            //$data['script'] = 'addscript';
            $this->load->vars($data);
            $this->load->view('main');
        }else{
            $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN','Please login with your username and password.');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
    }

    public function demandForm($id = NULL) {
        if($this->authlibrary->IsLoggedIn()) {
            // if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
            //     $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
            //     redirect('Dashboard');
            // }

            $id = $this->uri->segment(3);
            $data['id'] = $id;
            $data['query'] = $this->Userprofilemodel->getUserData($id);
            $data['users'] = $this->Userprofilemodel->listUser();
            $parentmodules = $this->Userprofilemodel->listmodule();
            $data['parentmodules'] = $parentmodules;
            $data['permission_access_request']  = $this->Userprofilemodel->get_premission_access_demant();
            $this->breadcrumb->populate(array(
                'Home' => '',
                'Users' => 'Users/ListAll',
                'Edit'
            ));
            $data['breadcrumb'] = $this->breadcrumb->output();
            $data['title'] = 'Deactive User';
            $data['pagetitle'] = 'Deactive User';
            $data['page'] = 'premission_access_demand_list';
            $this->load->vars($data);
            $this->load->view('main');
        } else {
            $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN','Please login with your username and password.');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
    }

    //demand form
    public function demandAddForm($id) {
        if($this->authlibrary->IsLoggedIn()) {
            // if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
            //     $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
            //     redirect('Dashboard');
            // }

            $id = $this->uri->segment(3);
            $data['query'] = $this->Userprofilemodel->getUserData($id);
            // print_r($data['query']);

            $data['users'] = $this->Userprofilemodel->listUser();
            $parentmodules = $this->Userprofilemodel->listmodule();
            $data['parentmodules'] = $parentmodules;
            $data['permission_access_request']  = $this->Userprofilemodel->get_premission_access_demant();
            $this->breadcrumb->populate(array(
                'Home' => '',
                'Users' => 'Users/ListAll',
                'Edit'
            ));
            $data['breadcrumb'] = $this->breadcrumb->output();
            $data['title'] = 'Deactive User';
            $data['pagetitle'] = 'Deactive User';
            $data['page'] = 'permission_access_demand_form';
            $this->load->vars($data);
            $this->load->view('main');
        } else {
            $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN','Please login with your username and password.');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
    }
    public function saveAccessDemandForm() {
        if($this->input->post('Save')) {
            $menu = $this->input->post('menu');
            $request_menu = implode(',', $menu);
            $user_id = $this->session->userdata('PRJ_USER_ID');
            $reason = $this->input->post('reason');
            $refer_by = $this->input->post('refer_by');
            $data = array(
                'userid' =>$user_id,
                'menu' => $request_menu,
                'reason_for_access' => $reason,
                'refer_by' => $refer_by,
                'added_date' => convertDate(date('Y-m-d'))
            );
            $result = $this->Userprofilemodel->savePermissionAccess($data);
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', 'Successfully saved');
                redirect('Users');
            }
        }
    }
    //generate pdf
    public function generatePermissionDemand($id) {
        $stylesheet = file_get_contents('assets/css/style.css');
        $id = $this->uri->segment(3);
        $data['reason'] = $this->Userprofilemodel->getPermissionDetailsbyID($id);
        $menu = explode(',', $data['reason']->menu);
        $data['menu_details'] = $this->Userprofilemodel->getMenuName($menu);
        $data['pmenu'] = array();
        foreach ($data['menu_details'] as $key => $value) {
           $data['pmenu'][] = $value->menuid;
        }
        // print_r($data['pmenu']);
        // exit;
        $data['query'] = $this->Userprofilemodel->getUserData($data['reason']->userid);
        $data['users'] = $this->Userprofilemodel->listUser();
        $parentmodules = $this->Userprofilemodel->listmodule();
        $data['parentmodules'] = $parentmodules;
        $mpdf = new \Mpdf\Mpdf(['mode' => 'UTF-8']);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'iso-8859-4';
        $html = $this->load->view('access_demand_form',$data, true);
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
    }

    //get ajax user details
    public function getSelectedUserDetails() {
        if($this->input->is_ajax_request()) {
            $userid = $this->input->post('userid');
            $data = $this->Userprofilemodel->getUserData($userid);
            echo json_encode($data->designation);
        } else {
            exit('no script allowed');
        }
    }
}
