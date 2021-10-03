<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class Users extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usersmodel');
        $this->load->model('CommonModel');
        $this->module_code = 'USERS';
    }

    public function Index()
    {
        if($this->authlibrary->IsLoggedIn()){
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'VIEW')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Dashboard');
            }
            redirect('Users/ListAll','location');
        }else{
            $this->session->set_flashdata('error','Please login with your username and password');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    public function ListAll()
    {
        if($this->authlibrary->IsLoggedIn()){
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'VIEW')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Dashboard');
            }
            $data['users'] = $this->Usersmodel->listUser();
            $data['title'] 	= 'Manage Users';
            $data['pagetitle'] = 'Manage Users';
            $data['page'] = 'list';
            // $data['script'] = 'listscript';
            $this->breadcrumb->populate(array(
                'Home' => '',
                'Users' => 'Users/ListAll',
                'List All'
                ));
            $data['breadcrumb'] = $this->breadcrumb->output();
            $this->load->vars($data);
            $this->load->view('main');
         } else{
            $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN','Please login with your username and password');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
    }
    public function Add()
    {
        if($this->authlibrary->IsLoggedIn())
        {
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'ADD')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Customer');
            }
            if($this->input->post('Save')){
                $value['details']['employee_id']            = $this->input->post('symbol_no');
                $value['details']['name']                   = $this->input->post('name');
                $value['details']['email']                  = $this->input->post('email');
                $value['details']['phone']                  = $this->input->post('phone');
                $value['details']['user_group']             = $this->input->post('role');
                $value['details']['user_name']              = $this->input->post('username');
                $value['details']['branch_name']            = $this->input->post('branch');
                $value['details']['password']               = md5($this->input->post('password'));
                $value['details']['added_date']             = convertDate(date('Y-m-d'));
                $value['details']['added_by']               = $this->session->userdata('PRJ_USER_ID');
                $value['details']['status']                 = 1;
                $value['details']['symbol_no']              = $this->input->post('symbol_no');
                $value['details']['designation']            = $this->input->post('designation');
                $value['details']['office_join_date']       = $this->input->post('office_join_date');
                $value['details']['provience']              = $this->input->post('provience_id');
                $value['details']['district']               = $this->input->post('district_id');
                $value['details']['gapa_napa']              = $this->input->post('gapa_napa');
                $value['details']['ward']                   = $this->input->post('ward');
                $value['details']['for_use']                = '';
                $value['details']['software_name']          = '';
                $value['details']['software_description']   = '';
                $value['details']['access_level']           = '';
                $result = $this->Usersmodel->insertuser($value['details']);
                if($result) {
                    // $token          = 'bswyNpfLAiwK3jPY412dSFR4DR6Yxp5jIua';
                    // $to             = $this->input->post('phone');
                    // $sender         = 'SITE NAME';
                    // $message        = 'Congrulations! your account has been created'.PHP_EOL;
                    // $message        .= 'Your username: '.$this->input->post('username').PHP_EOL;
                    // $message        .= "Password: ". $this->input->post('password');
                    // $content =  [
                    //     'token'=>rawurlencode($token),
                    //     'to'=>rawurlencode($to),
                    //     'sender'=>rawurlencode($sender),
                    //     'message'=>rawurldecode($message),
                    // ];
                    // $ch = curl_init();
                    // curl_setopt($ch, CURLOPT_URL,"http://beta.thesmscentral.com/api/v3/sms?");
                    // curl_setopt($ch, CURLOPT_POST, 1);
                    // curl_setopt($ch, CURLOPT_POSTFIELDS,$content);
                    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // $server_output = curl_exec ($ch);
                    // curl_close ($ch);
                    $action = "user created";
                    $this->trans_logs($action);
                    $this->session->set_flashdata('MSG_SUCCESS', 'User Created Successfully!');
                    redirect('Users/ListAll');
                }
            }
            $data['title']= 'Add User';
            $data['subtitle']= '';
            $data['pagetitle'] = 'Add User';
            //$data['branch']= $this->Usersmodel->getBranch();
            $this->breadcrumb->populate(array(
                'Home' => '',
                'Users' => 'ListAll',
                'Add'
            ));

            $data['today_date_nep']         = convertDate(date('Y-m-d'));
            $data['breadcrumb'] = $this->breadcrumb->output();
            $data['page']= 'add';
            $data['script']= 'addscript';
            $group = $this->Usersmodel->listgroup();
            $data['gapana'] = $this->CommonModel->getGapaNapa();
            $data['ward'] = $this->CommonModel->getData('settings_ward', 'DESC');
            $data['group'] = $group;
            $this->load->vars($data);
            $this->load->view('main');
        }
        else
        {
            $this->session->set_flashdata('login_error', 'Invalid login details');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
    }

    //view user details
    public function Detail()
    {
        // if($this->authlibrary->IsLoggedIn()){
        //     if(!$this->authlibrary->HasModulePermission($this->module_code, 'VIEW')){
        //         $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
        //         redirect('Customer');
        //     }
        //     $id = $this->uri->segment(3);
        //     $this->breadcrumb->populate(array(
        //         'Home' => '',
        //         'Users' => 'Users/ListAll',
        //         'Detail'
        //     ));
        //     $data['breadcrumb'] = $this->breadcrumb->output();
        //     $data['users'] = $this->Usersmodel->listUserByID($id);
        //     $data['title']  = 'Manage Users';
        //     $data['pagetitle'] = 'Manage Users';
        //     $data['page'] = 'detailuser';
        //     $data['script'] = 'listscript';
        //     $this->load->vars($data);
        //     $this->load->view('main');
        // }else{
        //     $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN','Please login with your username and password');
        //     $this->session->set_userdata('return_url', current_url());
        //     redirect('Login');
        // }

        if($this->authlibrary->IsLoggedIn()) {
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Dashboard');
            }
           
            $id = $this->uri->segment(3);
            $data['query'] = $this->Usersmodel->getUserData($id);
            $group = $this->Usersmodel->listgroup();
            $data['group'] = $group;
            $this->breadcrumb->populate(array(
                'Home' => '',
                'Users' => 'Users/ListAll',
                'Edit'
            ));
            $data['breadcrumb'] = $this->breadcrumb->output();
            $data['title'] = 'Deactive User';
            $data['pagetitle'] = 'Deactive User';
            $data['page'] = 'deactive_users';
            //$data['script'] = 'addscript';
            $this->load->vars($data);
            $this->load->view('main');
        }else{
            $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN','Please login with your username and password.');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
    }

    public function EditUser()
    {
        if($this->authlibrary->IsLoggedIn()) {
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Customer');
            }
           
            $id = $this->uri->segment(3);

            $data['query'] = $this->Usersmodel->getUserData($id);
            $group = $this->Usersmodel->listgroup();
            $data['group'] = $group;
            $this->breadcrumb->populate(array(
                'Home' => '',
                'Users' => 'Users/ListAll',
                'Edit'
            ));
            $data['breadcrumb'] = $this->breadcrumb->output();
            $data['title'] = 'Edit User';
            $data['pagetitle'] = 'Edit User';
            $data['page'] = 'edit_v';
            $data['script'] = 'addscript';
            $data['gapana'] = $this->CommonModel->getGapaNapa();
            $data['ward'] = $this->CommonModel->getData('settings_ward', 'DESC');
            $this->load->vars($data);
            $this->load->view('main');
        }else{
            $this->session->set_flashdata('MSG_ERR_INVALID_LOGIN','Please login with your username and password.');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login');
        }
    }

    public function updateUsers() {
     if($this->input->post('Submit')=='Submit')
     {
        $id                                 = $this->input->post('userid');
        $value['details']['employee_id']            = $this->input->post('symbol_no');
        $value['details']['name']                   = $this->input->post('name');
        $value['details']['email']                  = $this->input->post('email');
        $value['details']['phone']                  = $this->input->post('phone');
        $value['details']['user_group']             = $this->input->post('role');
        $value['details']['branch_name']            = $this->input->post('branch');
        $value['details']['password']               = md5($this->input->post('password'));
        $value['details']['added_date']             = convertDate(date('Y-m-d'));
        $value['details']['added_by']               = $this->session->userdata('PRJ_USER_ID');
        $value['details']['status']                 = 1;
        $value['details']['symbol_no']              = $this->input->post('symbol_no');
        $value['details']['designation']            = $this->input->post('designation');
        $value['details']['office_join_date']       = $this->input->post('office_join_date');
        $value['details']['for_use']                = '';
        $value['details']['software_name']          = '';
        $value['details']['software_description']   = '';
        $value['details']['access_level']           = '';
        $value['details']['gapa_napa']              = $this->input->post('gapa_napa');
        $value['details']['ward']                   = $this->input->post('ward');
        $result = $this->Usersmodel->updateuser($id,$value['details']);
        if($result!=0){
             $action = "Edit user";
                    $this->trans_logs($action);
            $this->session->set_flashdata('MSG_SUC_ADD','User Information successfully changed for '.$this->input->post('username'));
            redirect('Users/ListAll');
        }else{
            $this->session->set_flashdata('MSG_ERR_ADD','Nothing to update.');
            redirect('Users/ListAll');
        }
        }
    }

    function EditUserPerm(){
        if($this->authlibrary->IsLoggedIn()){
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Customer');
            }
            if($this->input->post('Submit'))
            {
                $chk_permission = $this->input->post('chk_permission');
                $login_id = $this->session->userdata('PRJ_USER_ID');
                $user_id = $this->uri->segment(3);
                $this->Usersmodel->updateuser_perm($chk_permission, $user_id, $login_id);
                $this->session->set_flashdata('MSG_SUC_ADD', 'User Permission Saved Successfully.');
                redirect('Users/ListAll', 'location');
            }

            $user_id = $this->uri->segment(3);
            $group_id = $this->Usersmodel->getgroupid($user_id);
            $parentmodules = $this->Usersmodel->listmodule();
        
            $data['group_id'] = $group_id;
            $data['parentmodules'] = $parentmodules;
            $data['pagetitle']  = 'Edit User Permission';
            $data['title']  = 'Edit User Permission';
            $data['script'] = 'addscript';
            $data['page'] = 'edituserperm_v';
            $this->load->vars($data);
            $this->load->view('main');
        } else {
            $this->session->set_flashdata('error', 'Please login with your username and password');
            $this->session->set_userdata('return_url', current_url());
            redirect('Login', 'location');
        }
    }
    function getFormhelperDropDownGroup($query,$id=''){
        $datatoreturn = array('भूमिका छनौट गर्नुहोस्');
        $a = array('');
        $c = array();
        if($query)
        {
            foreach ($query as $row) {
                array_push($a, $row->groupid);
                array_push($datatoreturn, $row->group_name);
                $c = array_combine($a, $datatoreturn);
            }
            return $c;
        }
        else
        {
            return '';
        }
    }
    function getFormhelperDropDown($query,$id=''){
        $datatoreturn = array('--Select--');
        $a = array('0');
        $c = array();
        if($query)
        {
            foreach ($query->result() as $row) {
                array_push($a,$row->ID);
                array_push($datatoreturn,$row->Title);
                $c = array_combine($a,$datatoreturn);
            }
            return $c;
        }
        else
        {
            return '';
        }
    }
    public function GetEmployeeData()
    {
        $employeeid = $this->input->get('employee');
        $employee = $this->Usersmodel->GetEmployeeData($employeeid);
        echo json_encode($employee);
    }

    public function GenerateUsersForEmployees()
    {
      $employeelist = $this->Usersmodel->GetEmployeesWithNoUsers();
      $count = 0;
      if($employeelist->num_rows()>0){
        foreach($employeelist->result() as $row){
          $password = $this->generateStrongPassword();

          $data['user']['name'] = $row->fullname;
          $data['user']['email'] = $row->email;
          $data['user']['employee_id'] = $row->employee_id;
          $data['user']['password'] = md5($password);
          $data['user']['added_date'] = date('Y-m-d');
          $data['user']['status'] = 1;
          $data['user']['user_group'] = 2;

          $this->Usersmodel->insertuser($data['user']);

          // Send the login details to company email
          $emaildata = array(
              'name' => $this->input->post('fullname'),
              'emailaddress' => $this->input->post('email'),
              'password' => $password
          );
          $email_content = $this->load->view('email_templates/usertemplete.php', $emaildata, TRUE);

          $this->load->library('email');


          $config['mailtype'] = 'html';
          $config['charset'] = 'iso-8859-1';

          $config['protocol'] = 'smtp';
          $config['smtp_host'] = 'mail.ctxpress.com';
          $config['smtp_user'] = 'no-reply@ctxpress.com';
          $config['smtp_pass'] = 'system@123';
          $config['smtp_port'] = '26';
          $config['wordwrap'] = TRUE;
          $this->email->initialize($config);

          $this->email->from('no-reply@ctxpress.com', 'City Express HR Admin');
          $this->email->to($this->input->post('email'));
          $this->email->subject('City HR - New Account Registered.');
          $this->email->message($email_content);

          $this->email->send();

          $count++;
        }
        $this->session->set_flashdata('MSG_SUC_ADD','Successfully created the missing users for '.$count.' employees.');
        redirect('Users/ListAll');
      }else{
        $this->session->set_flashdata('MSG_SUC_ADD','Users already Created!!!');
        redirect('Users/ListAll');
      }
    }

    function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if(!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    //trans log
    public function trans_logs($action) {
        $data = array(
            'user_id'               => $this->session->userdata('PRJ_USER_ID'),
            'module_link'           => $this->uri->segment(1).'/'.$this->uri->segment(2),
            'user_action'           => $action,
            'trans_log_date_ad'     => convertDate(date('Y-m-d')),
            'trans_log_date_nepali' => date('Y-m-d'),
            'trans_log_ip'=> '',
            'module_code' => $this->module_code

        );
        $this->CommonModel->insertData('trans_log',$data);
    }

    //deactivate users
    public function UserProfile($id = NULL) {
        if($this->authlibrary->IsLoggedIn()) {
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Dashboard');
            }
           
            $id = $this->uri->segment(3);
            $data['query'] = $this->Usersmodel->getUserData($id);
            $group = $this->Usersmodel->listgroup();
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
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Dashboard');
            }

            $id = $this->uri->segment(3);
            $data['id'] = $id;
            $data['query'] = $this->Usersmodel->getUserData($id);
            $data['users'] = $this->Usersmodel->listUser();
            $parentmodules = $this->Usersmodel->listmodule();
            $data['parentmodules'] = $parentmodules;
            $data['permission_access_request']  = $this->Usersmodel->get_premission_access_demant();
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
            if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
                redirect('Dashboard');
            }

            $id = $this->uri->segment(3);
            $data['query'] = $this->Usersmodel->getUserData($id);
            // print_r($data['query']);

            $data['users'] = $this->Usersmodel->listUser();
            $parentmodules = $this->Usersmodel->listmodule();
            $data['parentmodules'] = $parentmodules;
            $data['permission_access_request']  = $this->Usersmodel->get_premission_access_demant();
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
            $result = $this->Usersmodel->savePermissionAccess($data);
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
        $data['reason'] = $this->Usersmodel->getPermissionDetailsbyID($id);
        $menu = explode(',', $data['reason']->menu);
        $data['menu_details'] = $this->Usersmodel->getMenuName($menu);
        $data['pmenu'] = array();
        foreach ($data['menu_details'] as $key => $value) {
           $data['pmenu'][] = $value->menuid;
        }
        // print_r($data['pmenu']);
        // exit;
        $data['query'] = $this->Usersmodel->getUserData($data['reason']->userid);
        $data['users'] = $this->Usersmodel->listUser();
        $parentmodules = $this->Usersmodel->listmodule();
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
            $data = $this->Usersmodel->getUserData($userid);
            echo json_encode($data->designation);
        } else {
            exit('no script allowed');
        }
    }
}
