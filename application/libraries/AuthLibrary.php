<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/1/16
 * Time: 2:09 PM
 */
class AuthLibrary
{
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function IsLoggedIn(){
        if($this->CI->session->userdata('PRJ_USER_ID') != '')
            return TRUE;
        else
            return FALSE;
    }

    public function HasModulePermission($module_code, $user_action_code){
        $login_id = $this->CI->session->userdata('PRJ_USER_ID');
        $sql = "SELECT fn_CheckPermissionByLoginId('". $module_code . "','". $user_action_code . "','". $login_id ."') AS permission";
        $query = $this->CI->db->query($sql);
        $result = $query->row();
        if($result->permission){
            //echo 'i have the permissin';
            return TRUE;
        } else {
           return FALSE;
            // $this->CI->session->set_flashdata("MSG_ERR_AUTH_ACCESS", "Unauthorized Access to Restricted Module!");
            // redirect('Home');
        }

    }
}