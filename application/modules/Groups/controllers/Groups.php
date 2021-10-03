<?php



/**

 * Created by PhpStorm.

 * User: root

 * Date: 12/2/16

 * Time: 9:57 PM

 */

class Groups extends MX_Controller

{

    public function __construct()

    {

        parent::__construct();

        $this->load->model('Groupsmodel');

        $this->module_code = 'MANAGE-GROUP';

    }



    public function Index()

    {

        if($this->authlibrary->IsLoggedIn() && $this->authlibrary->HasModulePermission($this->module_code, "VIEW")){

            redirect('Groups/ListAll','location');

        }else{

            $this->session->set_flashdata('error','Please login with your username and password');

            $this->session->set_userdata('return_url', current_url());

            redirect('Login','location');

        }

    }



    

    function ListAll(){

        if($this->authlibrary->IsLoggedIn()){

            if(!$this->authlibrary->HasModulePermission($this->module_code, 'VIEW')){

                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");

                redirect('Home');

            }

            $query = $this->Groupsmodel->listGroup();

            $data['pagetitle'] 	= 'Groups';

            $data['title'] 	= 'Groups';

            $data['groups'] = $query;

            $data['page'] = 'listgroup';

            $this->breadcrumb->populate(array(

                'Home' => '',

                'Groups' => 'Groups/ListAll',

                'List All'

                ));

            $data['breadcrumb'] = $this->breadcrumb->output();

            $this->load->vars($data);

            $this->load->view('main');

        } else {

            $this->session->set_flashdata('error', 'Please login with your username and password');

            $this->session->set_userdata('return_url', current_url());

            redirect('Login', 'location');

        }

    }

    public function AddGroup(){

            if(!$this->authlibrary->HasModulePermission($this->module_code, 'ADD')) {

                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");

                redirect('Dashboard');

            } else {

                $data['pageTitle'] = 'भूमिका';

                $id = $this->input->post('id');



                $this->load->view('addgroup',$data);

            }

    }

        //save group

    public function saveGroup() {

        if(!$this->authlibrary->HasModulePermission($this->module_code, 'ADD')) {

            $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");

            redirect('Dashboard');

        } else {

            if($this->input->post('Submit'))

            {

                $value['details']['group_name'] = $this->input->post('groupname');

                $value['details']['created_by'] = $this->session->userdata('PRJ_USER_ID');

                $value['details']['created_ip'] = $this->input->ip_address();

                $this->Groupsmodel->addGroup($value['details']);



                $this->session->set_flashdata('MSG_SUC_ADD','A new group has been added with name: '.$this->input->post('groupname'));

                redirect('Groups/ListAll');

            }

        }

    }

    public function EditGroup() {

        $id = $this->input->post('id');

        $query = $this->Groupsmodel->getGroup($id);

        $data['query'] = $query;

        //$data['pagetitle']  = 'Edit Group';

       //$data['title']  = 'Edit Group';

        //$data['script'] = 'addscript';

        $data['page'] = 'editgroup';

        //$data['breadcrumb'] = $this->breadcrumb->output();

        $this->load->vars($data);

        $this->load->view('editgroup');

    }

    function UpdateGroup(){

        if($this->authlibrary->IsLoggedIn()){

            if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){

                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");

                redirect('Home');

            }

            if($this->input->post('Submit'))

            {

                $id = $this->input->post('ID');

                $value['details']['group_name'] = $this->input->post('groupname');

                $this->Groupsmodel->editGroup($value['details'],$id);



                $this->session->set_flashdata('MSG_SUC_ADD','A group information with the name '.$this->input->post('groupname').' has been modified.');

                redirect('Groups/ListAll');

            }

           

        } else {

            $this->session->set_flashdata('error', 'Please login with your username and password');

            $this->session->set_userdata('return_url', current_url());

            redirect('Login', 'location');

        }

    }

    function EditGroupPerm(){

        if($this->authlibrary->IsLoggedIn()){

            if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){

                $this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");

                redirect('Home');

            }

            if($this->input->post('Submit'))

            {

                $chk_permission = $this->input->post('chk_permission');

                $login_id = $this->session->userdata('PRJ_USER_ID');
            
                $group_id = $this->uri->segment(3);

                $this->Groupsmodel->updategroup_permision($chk_permission, $group_id, $login_id);

                $this->session->set_flashdata('success_message', 'Group Permission Saved Successfully.');

                redirect('Groups/ListAll', 'location');

            }

            $id = $this->uri->segment(3);

            

            $parentmodules = $this->Groupsmodel->listmodule();

            

            $data['parentmodules'] = $parentmodules;

            // echo "<pre>";

            // print_r($data['parentmodules']->result());

            // exit;



            $data['pagetitle']  = 'Edit Group Permission for '.$this->Groupsmodel->getgroupname($id);;

            $data['title']  = 'Edit Group Permission';

            $data['script'] = 'addscript';

            $data['page'] = 'editgroupperm_v';

            $this->load->vars($data);

            $this->load->view('main');

        } else {

            $this->session->set_flashdata('error', 'Please login with your username and password');

            $this->session->set_userdata('return_url', current_url());

            redirect('Login', 'location');

        }

    }

}