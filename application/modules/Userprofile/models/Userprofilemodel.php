<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 10:03 PM
 */
class Userprofilemodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listUser(){
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->where('userid!=','1');
        $this->db->order_by('name','asc');
        return $this->db->get();
    }
    public function listUserByID($id){
        $this->db->select('u.status, user_name, group_name, user_group, name, email,phone, userid, u.added_date');
        $this->db->from('users u');
        $this->db->join('group g','g.groupid=u.user_group');
        $this->db->where('userid',$id);
        $this->db->where('u.status !=','2');
        $this->db->where('userid!=','1');
        $this->db->order_by('name','asc');
        return $this->db->get();
    }
    function listgroup($limit = null){
        $this->db->where('status',0);
        $this->db->where('groupid!=','1');
        (!$limit == null)?$this->db->limit($limit['start'],$limit['end']):"";
        return $this->db->get('group')->result();
    }
    function insertuser($data)
    {
        $this->db->insert('users', $data);
        return TRUE;
    }
    function updateuser($userid,$data)
    {
        $this->db->where('userid',$userid);
        $this->db->update('users',$data);
        return $this->db->affected_rows();
    }
    function getUserData($id)
    {
        $this->db->where('userid',$id);
        $query = $this->db->get('users');
        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else
        {
            return '';
        }
    }
    function addGroup($data){
            $this->db->insert('group',$data);
    }
    function getGroup($id){
        $this->db->where('groupid',$id);
        $query = $this->db->get('group');
        if($query->num_rows()>0){
            return $query->row();
        }
        else{
            return '';
        }
    }
    function editGroup($data,$id){
        $this->db->where('groupid',$id);
        $this->db->update('group',$data);
    }
    function listmodule($parent_id = 0,$limit=null){
        $this->db->select('*');
        $this->db->from('admin_menu');
        if($this->session->userdata('usergroup')!=1){
            $this->db->where('status','1');
        }
        (!$limit == null)?$this->db->limit($limit['start'],$limit['end']):"";
        $res = $this->db->get();
        return $res;
    }
    function getgroupname($group_id){
        $this->db->select('group_name');
        $this->db->where('groupid',$group_id);
        $query = $this->db->from('group');
        $result = $this->db->get();
        $group = $result->row();
        return $group->group_name;
    }
    function listuseraction($limit=null){
        $this->db->select('*');
        $this->db->from('user_actions');
        (!$limit == null)?$this->db->limit($limit['start'],$limit['end']):"";
        $res = $this->db->get();
        return $res;
    }
    function checkgroup_permision($module_id, $user_action_id, $group_id){
        $query = "SELECT
                    fn_CheckGroupPermission(". $module_id .",". $user_action_id .",". $group_id .")
                  AS permission
                 ";
        $result = $this->db->query($query);
        $permission = $result->row();
        return $permission->permission;
    }
    function updategroup_permision($permissions, $group_id, $login_id){
        $this->db->trans_start();
        $permission_set = '';
        if(count($permissions)>0){
            $permission_set = implode(",", $permissions);
        }
        $parameters = array($permission_set, $group_id,$login_id);
        $qry_res = $this->db->query('CALL sp_InsertGroupPermission(?,?,?)', $parameters);
        $this->db->trans_complete();
    }
    function getgroupid($user_id){
        $this->db->select('user_group');
        $this->db->where('userid',$user_id);
        $query = $this->db->from('users');
        $result = $this->db->get();
        $group = $result->row();
        return $group->user_group;
    }
    function checkuser_perm($module_id, $user_action_id, $user_id){
        $query = "SELECT
                    fn_CheckUserPermission(". $module_id .",". $user_action_id .",". $user_id .")
                  AS permission
                 ";
        $result = $this->db->query($query);
        $permission = $result->row();
        return $permission->permission;
    }
    function updateuser_perm($permissions, $user_id, $login_id){
        $this->db->trans_start();
        $permission_set = '';
        if(count($permissions)>0){
            $permission_set = implode(",", $permissions);
        }
        $parameters = array($permission_set, $user_id, $login_id);
        $qry_res = $this->db->query('CALL sp_InsertUserPermission(?,?,?)', $parameters);
        $this->db->trans_complete();
    }
    function listEmployee()
    {
        $this->db->select('customer_id as ID, name as Title');
        return $this->db->get('customer_info');
    }
    function GetEmployeeData($id)
    {
        $this->db->select('fullname, email, mobile');
        $this->db->where('employee_id',$id);
        $query = $this->db->get('employee');
        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else
        {
            return array();
        }
    }

    public function GetEmployeesWithNoUsers()
    {
      // Get the employeeids whose users already exists
      $users = $this->db->get('users');
      $userarray = array();
      if($users->num_rows()>0){
        foreach($users->result() as $row){
          $userarray = array_merge($userarray, array($row->employee_id));
        }
      }
      $empids = implode(",",$userarray);
      // Get the employee information whose users are not present
      $this->db->where('status','1')->where_not_in('employee_id', $empids, false);
      return $this->db->get('employee');
    }
    // public function getBranch()
    // {
    //     $result_set = $this->db->get("branch");
    //     if($result_set->num_rows()>0){

    //         return $result_set->result_array();
    //     }
    //     else{
    //         return NULL;
    //     }
    // }

    //save savePermissionAccess
    public function savePermissionAccess($data) {
        $this->db->insert('user_permission_access_demad_form', $data);
        if($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function get_premission_access_demant() {

        $id = $this->session->userdata('PRJ_USER_ID');
        return $this->db->select('*')
                ->from('user_permission_access_demad_form')
                ->where('userid', $id)
                ->get()
                ->result();
    }

    public function getPermissionDetailsbyID($id) {
         return $this->db->select('*')
                ->from('user_permission_access_demad_form')
                ->where('id', $id)
                ->get()
                ->row();
    }

    public function getMenuName($menu) {
       
        return $this->db->select('*')
                ->from('admin_menu')
                ->where_in('menuid', $menu)
                ->get()
                ->result();
    }
}
