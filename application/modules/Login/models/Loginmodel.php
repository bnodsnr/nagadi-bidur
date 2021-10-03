<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/1/16
 * Time: 2:53 PM
 */
class Loginmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->logtable = 'userlog';
    }

    public function getLoggedInUserDetails($username, $password) {
        $this->db->where('user_name', $username);
        $this->db->where('password', $password);
        $this->db->where('Status', 1);
        return $this->db->get($this->table);
    }

    public function setUserLog($data){
        $this->db->insert($this->logtable, $data);
    }
}