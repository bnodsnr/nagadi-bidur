<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class SettingModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetMenu() {
        $this->db->select('*')->from('admin_menu');
        $query = $this->db->get();
        return !empty($query)?$query->result_array():false;
    }
}