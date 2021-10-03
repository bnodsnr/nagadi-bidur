<?php 
/**
 * 
 */
class Reportmodel extends CI_Model
{

	/*
	    * this function get wardwise total net total sum
	    * @ param int ward
	    * @ return net_total_amount
  	*/
	public function getTotalSampatBhumiKarByWard($ward = NULL) {
		$this->db->select('SUM(net_total_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('added_ward', $ward);
		$query = $this->db->get();
		return $query->row(); 
	}

	/*
	    * this function get wardwise total net total sum by provided paramenters
	    * @ param int ward
	    * @ param varchar date
	    * @ param varchar fiscal year
	    * @ return net_total_amount
  	*/
	public function getNagadiReport( $date, $ward, $fiscal_year){
		$this->db->select('SUM(net_total_amount) as total,added_ward');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if(!empty($fiscal_year)){
			$this->db->where('fiscal_year', $fiscal_year);
		}
		if(!empty($ward)){
			$this->db->where('added_ward', $ward);
		}
		if(!empty($date)){
			$this->db->where('added_on', $date);
		}
		$query = $this->db->get();
		return $query->row();
	}

	public function getTotalCollectionReport() {
		$this->db->select('t1.*,t2.*')->from('sampati_kar_bhumi_kar_bill_details t1');
		$this->db->join('land_owner_profile_basic t2','t2.file_no = t1.nb_file_no', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}
}