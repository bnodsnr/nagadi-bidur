<?php 
/**
 * 
 */
class AllReportmodel extends CI_Model
{

	/*
	    * this function get wardwise total net total sum
	    * @ param int ward
	    * @ return net_total_amount
  	*/
	public function getTotalSampatBhumiKar($date=NULL, $ward=NULL, $fiscal_year=NULL) {
		$this->db->select('SUM(net_total_amount) as total');
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

	/*
	    * this function get wardwise total net total sum by provided paramenters
	    * @ param int ward
	    * @ param varchar date
	    * @ param varchar fiscal year
	    * @ return net_total_amount
  	*/
	public function getNagadiReport( $date =NULL, $ward = NULL, $fiscal_year = NULL){
		$this->db->select('SUM(t_rates) as total');
		$this->db->from('nagadi_amount_details');
		if(!empty($fiscal_year)){
			$this->db->where('fiscal_year', $fiscal_year);
		}
		if(!empty($ward)){
			$this->db->where('ward', $ward);
		}
		if(!empty($date)){
			$this->db->where('added', $date);
		}
		$query = $this->db->get();
		return $query->row();
	}
}