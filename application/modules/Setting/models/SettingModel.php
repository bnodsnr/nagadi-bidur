<?php
/**
* DashBoard Model
*/
class SettingModel extends CI_Model {
	

	//get fiscal year
	public function get_fiscal_year() {
		$this->db->select('*')->from('fiscal_year');
		return $this->db->get()->result();
	}

	public function checkUnique($value, $data) {
		$condition = array(
			'from_rate' =>$value,
			'to_rate'=>$data
		);
		$this->db->select('*')->from('sampati_bhumi_kar_rate');
		$this->db->where($condition);
		return $this->db->get();
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

	public function getJaagaKoRate() {
		$this->db->select('t.*, t.fiscal_year as fy, t.road_name as road,r.*,l.*');
		$this->db->from('settings_area_minimal_cost t');
		$this->db->join('settings_road r','r.id = t.road_name','left');
		$this->db->join('settings_land_area_type l','l.id = t.land_area_type','left');
		$query = $this->db->get();
		return $query->result_array();
	}

//
//settings_land_area_type

	//get getSettingStructureMinAmount
	public function getSettingStructureMinAmount() {
		$this->db->select('t.*,t.fiscal_year as fy, r.*,l.*');
		$this->db->from('settings_structure_minimum_amount t');
		$this->db->join('settings_architect_type r','r.id = t.structure_type_id','left');
		$this->db->join('settings_architect_structure l','l.id = t.structure_id','left');
		$query = $this->db->get();
		return $query->result_array();

	}
}