<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class LandAreaTypeModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $del=$this->db->delete('settings_land_area_type');
        if($del) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //get list
    // public function getList() {
    //     $this->db->select('*')->from('settings_land_area_type')->w;
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
}