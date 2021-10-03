<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class DeteriorationStructureModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->fy = current_fiscal_year();
    }
    //get sadak data
    public function getList() {
        $this->db->select(
            't1.* ,t1.fiscal_year as fy ,t2.structure_type, t3.from_range, t3.to_range'
        );
        $this->db->from('settings_architect_age_rate t1');
        $this->db->join('settings_architect_structure t2' ,'t2.id = t1.structure_id','left');
        $this->db->join('settings_architect_age t3' ,'t3.id = t1.age_range_id','left');
        $this->db->where('t1.fiscal_year', $this->fy);
        $query = $this->db->get();
        return $query->result_array();
    }
}