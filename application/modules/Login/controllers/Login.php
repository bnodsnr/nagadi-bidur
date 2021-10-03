<?php

/**
 * Created by PhpStorm.
 * Binod Sunar
 * User: root
 */
class Login extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Loginmodel');
    }

    public function Index(){
        if($this->authlibrary->IsLoggedIn()) {
            redirect('Dashboard');
        }else{
            if ($this->input->post('Login')) {
                $username = $this->input->post('Username');
                $password = $this->input->post('Password');
                // Get the record of the user according to the login details provided
                $userdetails = $this->Loginmodel->getLoggedInUserDetails($username, md5($password));
                if ($userdetails->num_rows() > 0) {
                    // Set all the user details in the session
                    $userdata = array(
                        'PRJ_USER_ID' => $userdetails->row()->userid,
                        'PRJ_USER_GROUP' => $userdetails->row()->user_group,
                        'PRJ_USER_NAME' => $userdetails->row()->user_name,
                        'PRJ_USER_NAME_FIRST' =>  $userdetails->row()->first_name,
                        'PRJ_USER_NAME_SECOND' => $userdetails->row()->last_name,
                        'PRJ_USER_EMAIL' => $userdetails->row()->email,
                        'PRJ_USER_WARD' => $userdetails->row()->ward
                    );
                    $this->session->set_userdata($userdata);

                    // Update the log table
                    $data['userlog']['userid'] = $userdetails->row()->userid;
                    $data['userlog']['log_time'] = date('Y-m-d H:i:s');
                    $data['userlog']['action'] = 'login';

                    $this->Loginmodel->setUserLog($data['userlog']);

                    if($this->session->userdata('return_url') != ''){
                        redirect($this->session->userdata('return_url'));
                    }else{
                        redirect('Dashboard');
                    }
                } else {
                    $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN', 'गलत लगईन विवरण');
                    redirect('Login');
                }
            }
            $this->load->view('login');
        }
    }
}