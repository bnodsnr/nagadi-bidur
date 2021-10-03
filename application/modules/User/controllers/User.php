<?php

class User extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usermodel');
        $this->module_code = 'PROFILE';
    }

    public function checkPassword(){
        $oldpassword    = md5($this->input->post('oldpassword'));
        $userid         = $this->session->userdata('PRJ_USER_ID');
        $userpassword   = $this->Usermodel->getPassword($userid);
        $password       ='';
        $data['password']='';
        if($userpassword->num_rows()>0){
            $userrecord=$userpassword->row();
            $password=$userrecord->password;
            if($password!=$oldpassword){
                $data['password']="Password Doesnot Matches" ;
            }
        }
        $return = $data['password'];
        echo json_encode($return);
    }

 // Change Password
    public function ChangePassword()
    {
        if($this->authlibrary->IsLoggedIn()) {
            if($this->input->post('Submit'))
            {
                $password = $this->input->post('password');
                $cpassword = $this->input->post('cpassword');
                if($password!=$cpassword){
                    $this->session->set_flashdata('MSG_ERROR','Password Doesnot Matches');
                    redirect('User/ChangePassword');
                }else{
                    $userid                             = $this->session->userdata('PRJ_USER_ID');
                    $value['details']['password']       = md5($this->input->post('password'));
                    $value['details']['modified_date']  = date('Y-m-d H:i:s');
                    $value['details']['modified_by']    = $this->session->userdata('PRJ_USER_ID');
                    $this->Usermodel->updateuser($userid,$value['details']);

                    $this->session->set_flashdata('MSG_SUC_ADD','Password Updated Successfully');
                    redirect('User/ChangePassword');
                }
            }


            $this->breadcrumb->populate(array(
                'Home' => '',
                'Change Password'
                ));
            $data['breadcrumb'] = $this->breadcrumb->output();
            $data['title']      = 'Change Password';
            $userid             = $this->session->userdata('PRJ_USER_ID');
            $userpassword       =$this->Usermodel->getPassword($userid);
            $data['password']   ='';
            if($userpassword->num_rows()>0){
                $userrecord=$userpassword->row();
                $data['password']=$userrecord->password;
            }
            $data['pagetitle']  = 'Change Password';
            $data['page']       = 'changepassword';
            $data['script']     = 'addscript';
            $this->load->vars($data);
            $this->load->view('main');
        }else{
            $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN','Please login with your username and password.');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
    }
    // End of change Password

    function getuser()
    {
        $employeeid = $this->uri->segment(3);
        $datatoreturn = '';
        $employeedetails = $this->Usermodel->getemployee($employeeid);

        if ($employeedetails->num_rows() > 0) {
            $datatoreturn .= '<td><label for="Title">Employee</label></td>
            <td>' . $employeedetails->row()->fullname . '
                <input name="employee_id" value=' . $employeeid . ' class="hidden">
            </td>';

        }

        echo $datatoreturn;
    }

    
}