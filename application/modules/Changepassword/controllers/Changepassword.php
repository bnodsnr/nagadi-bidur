<?php
/**
* 
*/
class Changepassword extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Passwordmodel');
		$this->container ='main';
	}

	//Index
	public function Index()
	{
		if($this->authlibrary->IsLoggedIn()) {

			$data['title']= 'Change password';
			$data['pagetitle']='Change password';
			$data['header']='header';
			$this->breadcrumb->populate( array(
				'Dashboard' => '',
				'Change Password'=>'Changepassword',
				
			));
			$data[ 'breadcrumb' ] = $this->breadcrumb->output();
			$data['page']='changepassword';
			$data['script']='script';
			$this->load->view($this->container,$data);
		} else {
			$this->session->set_flashdata('MSG_ERR_INVALID_LOGIN', 'You Are Not Logged In. Please Login First');
			redirect('Login');
		}
	}
	//update
	public function Update()
	{
		$user = $this->session->userdata('PRJ_USER_ID');
		$password = $this->input->post('newpassword');
		$newpassword=md5($password);
		$SaveArr = array('password'=>$newpassword);
		$result = $this->Passwordmodel->UpdatePassword($SaveArr,$user);
		if($result) {
			$this->session->set_flashdata('MSG_SUC_ADD','Successfully Updated');
			redirect('Dashboard');
		} else {
			$this->session->set_flashdata('MSG_ERR_ADD','Successfully Updated');
			redirect('Changepassword');
		}
	}
}