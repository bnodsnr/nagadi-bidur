<?php

class Usermodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getPassword  ($userid){
        $this->db->where('userid',$userid);
        return $this->db->get('users');
    }
    function updateuser($userid,$data)
    {
        $this->db->where('userid',$userid);
        $this->db->update('users',$data);
    }    

    public function GetEmployeeInformation($empid)
    {
        $this->db->select('t1.*, t2.department_name as department_name, t3.name as job_name, t4.fullname as manager_name, t5.fullname as supervisor_name, t3.level');
        $this->db->from('employee t1');
        $this->db->join('department_management t2','t1.department_id=t2.id','left');
        $this->db->join('job_management t3','t1.job_id=t3.id','left');
        $this->db->join('employee t4','t1.manager=t4.employee_id','left');
        $this->db->join('employee t5','t1.supervisor=t5.employee_id','left');
        $this->db->where('t1.employee_id', $empid);
        return $this->db->get();
    }

    public function UpdatePersonalInformation($empid, $data)
    {
        $this->db->where('employee_id', $empid);
        $this->db->update('employee', $data);
    }

    public function DeleteAcademicQualification($empid)
    {
        $this->db->where('employee_id', $empid);
        $this->db->delete('employee_academic');
    }

    public function AddAcademicQualification($data)
    {
        $this->db->insert('employee_academic', $data);
    }

    public function DeleteWorkExperience($empid)
    {
        $this->db->where('employee_id', $empid);
        $this->db->delete('employee_work_experience');
        $id = $this->db->insert_id();
        $this->db->query('ALTER TABLE employee_work_experience AUTO_INCREMENT='.$id);
    }

    public function AddWorkExperience($data)
    {
        $this->db->insert('employee_work_experience', $data);
    }

    public function DeleteTraining($empid)
    {
        $this->db->where('employee_id', $empid);
        $this->db->delete('employee_training');
    }

    public function AddTraining($data)
    {
        $this->db->insert('employee_training', $data);
    }

    public function GetEmployeeAdditionalInfo($empid, $table)
    {
        $this->db->where('employee_id', $empid);
        return $this->db->get($table);
    }


    public function getDocumentNameBySessionID($empid)
    {
        $this->db->select('d.*, dt.documenttype_name as document_type_text');
        $this->db->from('documents d');
        $this->db->join('documenttype dt','d.document_type=dt.id','left');
        $this->db->where('d.document_ref','employee');
        $this->db->where('d.document_ref_id', $empid);
        return $this->db->get();
    }

    function getShiftNScheduleValue($empid)
    {
        $this->db->select('t2.shift_name as shift, t3.title as schedule');
        $this->db->from('user_shift_management t1');
        $this->db->join('shift_management t2','t1.shift=t2.id','left');
        $this->db->join('schedule_management t3','t1.schedule=t3.GUID','left');
        $this->db->where('t1.employee_id',$empid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row()->shift.'^'.$query->row()->schedule;
        }else{
            return 'N/A^N/A';
        }
    }


    public function getLeaveList($id)
    {
        $this->db->select('l.*, a.LeaveType as LeaveType');
        $this->db->from('assignleaves l');
        $this->db->join('annualleaves a','a.ID = l.LeaveID');
        $this->db->where('l.EmployeeID',$id);
        return $this->db->get();
    }

    public function getNumberOfDaysOfLeaves($leave,$employee_id){
        $this->db->select('LeaveDuration');
        $this->db->where("EmployeeID",$employee_id);
        $this->db->where("LeaveID",$leave);
        $this->db->where("Status","Approved");
        $this->db->where("IsActive","Active");
        $query = $this->db->get('leaverequest');
        $numberOfDays = 0;
        $status = "success";
        if($query->num_rows()>0){
            foreach($query->result() as $row):
                $numberOfDays += $row->LeaveDuration;
            endforeach;
        } else {
            $status = "empty";
        }
        return (string)$numberOfDays;
    }

    public function getEmpCountLeave($leaveID, $employeeID)
    {
        $this->db->select('SUM(LeaveDuration) as LeaveDuration');
        ($leaveID!='')?$this->db->where('LeaveID',$leaveID):'';
        $this->db->where('Status','Approved');
        $this->db->where('EmployeeID',$employeeID);
        $query = $this->db->get('leaverequest');
        if($query->num_rows()>0){
        // $return = $query->result_array();
            $return = $query->result_array();
        }else{
            $return = $query->result_array();   
        }
        return $return;
    }

    public function getEmpTotalLeave($leaveID, $employeeID)
    {
        $this->db->select('*');
        $this->db->from('assignleaves');
        $this->db->where('employeeID' , $employeeID);
        $this->db->where('LeaveID' , $leaveID);
        $getResult = $this->db->get();
        if($getResult->num_rows()>0){
            // $return = $getResult->result_array();
            $return = $getResult->result_array();
        }else{
            $this->db->select('LeaveDays as LeaveDays');
            $this->db->from('annualleaves');
            $this->db->where('ID',$leaveID);
            $query = $this->db->get();
            // $return = $query->result_array();
            $return = $query->result_array();

        }
        return $return;
        // return $query->result_array();
        // return $this->db->last_query();

    }
    

    // public function getAttSummary($empid)
    // {
    //     $this->db->where('employee_id', $empid);
    //     $query = $this->db->get('attendance');
    //     return $query->result_array();
    // }
    function getleaves(){
        return $this->db->get('annualleaves');
    }
    public function getTotalPresentDays($empid) 
    {
        $this->db->select('*')->from('attendance')->where('employee_id', $empid)->where('status','Present'); 
        $q = $this->db->get(); 
        return $q->num_rows();
    }

    public function getTotalAbsentDays($empid) 
    {
        $this->db->select('*')->from('attendance')->where('employee_id', $empid)->where('status','Absent'); 
        $q = $this->db->get(); 
        return $q->num_rows();
    }

    public function getScheduleByShift($shift=null)
    {
        $this->db->where('GUID',$shift);
        return $this->db->get('schedule_management');
    }

    public function getShiftForEmployee($empid)
    {
        $this->db->where('employee_id',$empid);
        $query = $this->db->get('user_shift_management');
        if($query->num_rows()>0){
            return $query->row()->schedule;
        }else{
            return '';
        }
    }

    public function getShiftGroups()
    {
        $this->db->where('status',1);
        return $this->db->get('schedule_groups');
    }
    function getAttendanceReport($empID='', $date,$department){
        $condition = ($department != 'all')?'AND e.department_id = '.$department:'';
        $employeeID = ($empID != '')?'AND e.employee_id = '.$empID:'';
        $query = $this->db->query("SELECT e.employee_id,e.employee_code, e.fullname,d.department_name,a.attendance_date,a.office_in,a.office_out,a.status as attendance_status,a.attendance_remark FROM employee as e LEFT JOIN attendance as a ON e.employee_id= a.employee_id AND a.attendance_date = '".$date."' LEFT JOIN department_management as d ON e.department_id = d.id WHERE e.status = 1 ".$condition.$employeeID." ORDER BY e.fullname");
        return $query;
    }
    function getDepartmentlist($id){
        $this->db->select('id,department_name');
        $this->db->from('department_management');
        $this->db->where('status',1);
        $query = $this->db->get();
        $optionlist = '';
        if($query->num_rows() > 0){
            foreach($query->result() as $row):
                $selected = ($row->id == $id)?'selected="selected"':'';
            $optionlist .= '<option value="'.$row->id.'" '.$selected.'>'.$row->department_name.'</option>';
            endforeach;
            $query->free_result();
        }
        return $optionlist;
    }
    function getemployee($id){
        $this->db->select('e.employee_id, e.fullname');
        $this->db->where('e.employee_id', $id);
        $this->db->where('e.status',1);
        $this->db->from('employee e');
        return $this->db->get();        

    }

    function getEmployeeAttendance($employeeid,$date='')
    {   
        $date=($date!='')?$date:date('Y-m-d');
        $this->db->select('a.*');
        $this->db->where('a.employee_id',$employeeid);
        $this->db->where('a.attendance_date',$date);
        $this->db->from($this->table .' a');
        return $this->db->get();        
    }
    public function getEmployeeDepartment($employeeId=null)
    {
        $this->db->where('employee_id', $employeeId);
        $getID = $this->db->get('employee');

        $getUsers = $this->db->where('employee_id', $employeeId)->get('users')->row();
        $deptID = $getID->result()[0]->department_id;
        
        $this->db->select('e.employee_id as EmployeeID, d.department_name as Department, 
            e.phone as Phone, e.fullname as FullName'); $this->db->from('employee'.' e');
        if(!(($getUsers->user_group=='1')||($getUsers->user_group=='14'))){
            $this->db->where('d.id', $deptID);
        }
        $this->db->join('job_management j','j.id =e.job_id','left');
        $this->db->join('department_management d','d.id =e.department_id','left');
        $result = $this->db->get();
        return $result->result();
    }
    public function getDocumentTypeList()
    {
        $this->db->where('status',1);
        $this->db->order_by('documenttype_name');
        return $this->db->get('documenttype');
    }
    public function getDocumentListData($empid){
        $this->db->select('d.*, dt.documenttype_name as document_type_text');
        $this->db->from('documents d');
        $this->db->join('documenttype dt','d.document_type=dt.id','left');
        $this->db->where('d.document_ref','employee');
        $this->db->where('d.document_ref_id', $empid);
        return $this->db->get();
    }
    public function uploadEmployeeDocument($data)
    {
        $this->db->insert('documents', $data);
    }

    public function getDocumentNameByID($id)
    {
        $this->db->where('document_id', $id);
        return $this->db->get('documents');
    }
    public function deleteDocument($id){
        $this->db->where('document_id', $id);
        $this->db->delete('documents');
    }

}