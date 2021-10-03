<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 11:38 AM
 */
class Logout extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logoutmodel');
    }

    public function Index()
    {
        // Update the log table
        $data['userlog']['userid'] = $this->session->userdata('PRJ_USER_ID');
        $data['userlog']['log_time'] = date('Y-m-d H:i:s');
        $data['userlog']['action'] = 'logout';

        $this->Logoutmodel->setUserLog($data['userlog']);

        $this->session->sess_destroy();
        redirect('Login');
    }
}