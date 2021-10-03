<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class LandModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getJaagaKoRate() {
        $this->db->select('t.*, t.id as rate_id, t.fiscal_year as fy,t.ward as jw, t.road_name as road,r.*,l.*');
        $this->db->from('settings_area_minimal_cost t');
        $this->db->join('settings_road r','r.id = t.road_name','left');
        $this->db->join('settings_land_area_type l','l.id = t.land_area_type','left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function checkUnique($value, $data,$fiscal_year) {
        $condition = array(
            'from_rate' =>$value,
            'to_rate'=>$data,
            'fiscal_year'=>$fiscal_year
        );
        $this->db->select('*')->from('sampati_bhumi_kar_rate');
        $this->db->where($condition);
        return $this->db->get();
    }
}