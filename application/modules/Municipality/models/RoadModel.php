<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class RoadModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //get sadak data
    public function getSadakData() {
        $this->db->select(
            't1.* ,t1.fiscal_year as fy ,t2.*'
        );
        $this->db->from('settings_road t1');
        $this->db->join('settings_road_type t2' ,'t2.id = t1.road_type','left');
        $query = $this->db->get();
        return $query->result_array();
    }
}