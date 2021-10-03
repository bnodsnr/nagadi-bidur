<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class Nationality extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        // $this->load->model("RoadModel");
        $this->module_code = 'SET-NATIONALITY';
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
            $data['nationality'] = $this->CommonModel->getData('settings_nationality','DESC');
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }
    
}