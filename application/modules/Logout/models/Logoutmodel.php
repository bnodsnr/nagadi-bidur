<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 11:49 AM
 */
class Logoutmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->logtable = 'userlog';
    }

    public function setUserLog($data){
        $this->db->insert($this->logtable, $data);
    }
}