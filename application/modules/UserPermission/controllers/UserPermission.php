<?php
class UserPermission extends MX_Controller{
	public function __construct()
	{
		$this->container= "main";
		$this->load->model("Userpermissionmodel");
		$this->module_code = "USERPERMISSION";
	}
	public function index()
	{
		if($this->authlibrary->IsLoggedIn() && $this->authlibrary->HasModulePermission($this->module_code, 'VIEW')){
			redirect('UserPermission/ListAll');
		}
		else
		{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}
	/**
	*Calls list page to list all the
	*@params void
	*@returns void
	*@created by Sarju
	*@modified by
	*/
	public function ListAll()
	{
		if($this->authlibrary->IsLoggedIn()){
			if(!$this->authlibrary->HasModulePermission($this->module_code, 'VIEW')){
				$this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
				redirect('Home');
			}
			$data['query']= $this->Userpermissionmodel->ListAll();
			$data['title']= 'Assign Users';
			$data['pagetitle']= 'Assign Users';
			$data['page']= 'list';
			$data['script'] = 'listscript';
			$this->breadcrumb->populate(array(
				'Home' => '',
				'User Permission' => 'UserPermission/ListAll',
				'List All'
				));
			$data['breadcrumb'] = $this->breadcrumb->output();
			$this->load->view($this->container, $data);
		}
		else
		{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}
	/**
	*Displays form and adds data to db
	*@params void
	*@returns void
	*@created by sarju
	*@modified by
	*/
	public function Add()
	{
		if($this->authlibrary->IsLoggedIn()){
			if(!$this->authlibrary->HasModulePermission($this->module_code, 'ADD')){
				$this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
				redirect('Home');
			}
			if($this->input->post('Save')){
				$employeeList = $this->input->post('employeeList');
				// $emp
				if(!empty($employeeList)){
					for ($i=0; $i < sizeof($employeeList); $i++) {
						$adddata['values']['userid']= $employeeList[$i];
						$res = $this->Userpermissionmodel->Add($adddata['values']);
					}
					if($res){
						$this->session->set_flashdata('MSG_SUC_ADD','Users Assigned Successfully.');
						redirect('UserPermission/ListAll');
					}else{
						$this->session->set_flashdata('MSG_ERR_INVALID_DATA','User Already Assigned.');
						redirect('UserPermission/ListAll');
					}
				}
			}
			$data['employeedropdown'] 	= $this->getemployeedropdown('users');
			$data['query']				= $this->Userpermissionmodel->ListAlldata();
			$data['title']				= 'Assign Employee Schedule';
			$data['pagetitle']			= 'Assign Employee Schedule';
			$data['script']			= 'addscript';
			$data['page']			= 'add';
			$this->breadcrumb->populate(array(
				'Home' => '',
				'EmpSchedule' => 'UserPermission/ListAll',
				'Add'
				));
			$data['breadcrumb'] = $this->breadcrumb->output();
			$this->load->view($this->container, $data);
		}
		else
		{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}
	private function getemployeedropdown($table, $id=''){
		$employeeids = array();
		if($table == "users"){
			$employeeids = $this->Userpermissionmodel->AssignedEmployeed();
		}
		$employee = $this->Userpermissionmodel->ListData($table,$employeeids);
		$DataToReturn = '';
		if($employee->num_rows()>0){
			foreach($employee->result() as $employee){
				$selected = ($employee->userid==$id)?'selected="selected"':'';
				$DataToReturn .= '<option value="'.$employee->userid.'" '.$selected.'>'.$employee->name.'</option>';
			}
		}
		return $DataToReturn;
	}
	/**
	*Calls detail page and shows all the details
	*@params void
	*@returns void
	*@created by Sarju
	*@modified by
	*/
	public function Details()
	{
		if($this->authlibrary->IsLoggedIn()){
			if(!$this->authlibrary->HasModulePermission($this->module_code, 'VIEW')){
				$this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
				redirect('Home');
			}
			$id= $this->uri->segment(3);
			$query = $this->Userpermissionmodel->Details($id);
			if($query->num_rows() >0)
			{
				$data['result']= $query;
				$data['title']= 'Assigned Schedule Details of '.$query->row()->employee;
				$data['pagetitle']= 'Assigned Schedule Details of '.$query->row()->employee;
				$data['id'] = $query->row()->ID;
				$data['page']= 'detail';
				$data['script']		= 'listscript';
				$this->breadcrumb->populate(array(
					'Home' => '',
					'EmpSchedule' => 'UserPermission/ListAll',
					'Details'
					));
				$data['breadcrumb'] = $this->breadcrumb->output();
				$this->load->view($this->container, $data);
			}
			else
			{
				$this->session->set_flashdata("MSG_ERR_INVALID_DATA", "No Data Available");
				redirect('UserPermission/ListAll');
			}
		}
		else
		{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}
	/**
	*Calls Edit page to allow changes on the data
	*@params void
	*@returns void
	*@created by Sarju
	*@modified by
	*/
	public function Edit()
	{
		if($this->authlibrary->IsLoggedIn()){
			if(!$this->authlibrary->HasModulePermission($this->module_code, 'EDIT')){
				$this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
				redirect('Home');
			}
			if($this->input->post('Save')){
				$ids    	= $this->input->post('id');
				$userid		= $this->session->userdata('PRJ_USER_ID');
				$date 		= date('Y-m-d H:i:s');
				$LeaveID 	= $this->input->post('LeaveID');
				$LeaveDays 	= $this->input->post('LeaveDays');
				$IsActive 	= $this->input->post('Active');
				$this->Userpermissionmodel->Delete($ids);
				foreach ($LeaveID as $key => $value) {
					if($IsActive[$key]=='Active') {
						$adddata['values']['LeaveID'] 		= $LeaveID[$key];
						$adddata['values']['EmployeeID'] 	= $ids;
						$adddata['values']['LeaveDays'] 	= $LeaveDays[$key];
						$adddata['values']['IsActive'] 		= $IsActive[$key];
						$adddata['values']['ModifiedAt'] 	= $date;
						$adddata['values']['ModifiedBy'] 	= $userid;
						$this->Userpermissionmodel->Add($adddata['values']);
					}
				}
				$this->session->set_flashdata('success', 'Record Updated Successfully!');
				redirect('AssignLeaves/Details/'.$ids);

			}
			$id= $this->uri->segment(3);
			$query= $this->Userpermissionmodel->Details($id);
			if($query->num_rows() > 0)
			{
				$data['query']		= $query;
				$data['leaves']		= $this->Userpermissionmodel->ListAlldata();
				$data['id']			= $query->row()->ID;
				$data['employee_id'] = $id;
				$data['title']		= 'Edit';
				$data['pagetitle'] 	= 'Edit';
				$data['script']		= 'editscript';
				$data['page']	= 'edit';


				$this->breadcrumb->populate(array(
					'Home' => '',
					'EmpSchedule' => 'UserPermission/ListAll',
					'Details'
					));
				$data['breadcrumb'] = $this->breadcrumb->output();

				$this->load->view($this->container, $data);
			}
			else
			{
				redirect('UserPermission/ListAll');
			}
		}
		else
		{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}
	/**
	*Allows to delete the data
	*@params void
	*@returns void
	*@created by Sarju
	*@modified by
	*/
	public function Delete()
	{
		if($this->authlibrary->IsLoggedIn()){
			if(!$this->authlibrary->HasModulePermission($this->module_code, 'DELETE')){
				$this->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
				redirect('Home');
			}
			$empID= $this->uri->segment(3);
			$id= $this->uri->segment(4);
			$this->Userpermissionmodel->Delete($id);
			$this->session->set_flashdata('MSG_SUC_ADD', 'Record Deleted Sucessfully!');
			redirect('UserPermission/ListAll/'.$empID);
		}
		else
		{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}

}
?>
