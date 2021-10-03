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
        $fy = get_current_fiscal_year();
        $this->db->select('t.*, t.id as rate_id, t.fiscal_year as fy,t.ward as jw, t.road_name as road,r.*,l.*');
        $this->db->from('settings_area_minimal_cost t');
        $this->db->join('settings_road r','r.id = t.road_name','left');
        $this->db->join('settings_land_area_type l','l.id = t.land_area_type','left');
        //if(empty($fiscal_year)) {
        $this->db->where('t.fiscal_year', $fy);
        //}
        $this->db->order_by('t.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
     public function getRoadDetails($ward) {
        $condition = array(
            'ward' => $ward,
            'fiscal_year' => get_current_fiscal_year(),
        );
        return $this->db->select('*')
                        ->from('settings_road')
                        ->where($condition)
                        ->get()
                        ->result_array();
    }
}