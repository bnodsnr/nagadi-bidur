<?php
class NagadiTitleWiseReportModel extends CI_Model
{

	public function getReport( $from_date = NULL, $to_date =NULL,$ward_no =NULL) {
		$this->db->select('t1.*, SUM(t1.t_rates) as total,t2.sub_topic as sbutopic,t3.topic_name');//changed
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('topic t2', 't2.id = t1.sub_topic', 'left');
		$this->db->join('main_topic t3', 't3.id = t1.main_topic', 'left');
		
		$this->db->where('t1.initial_flag !=',1);
		if(!empty($from_date) && !empty($to_date)) {
			$this->db->where('t1.added >=', $from_date);
			$this->db->where('t1.added <=', $to_date);
		}
		if(!empty($ward_no)) {
			$this->db->where('t1.added_ward', $ward_no);
		}
		$this->db->group_by("t1.sub_topic");//added
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getSampatiKar($from_date = NULL, $to_date =NULL,$ward_no =NULL) {
		$this->db->select('SUM(sampati_kar) as sampati_total, sum(bakeyuta_amount) as ba_amount, sum(fine_amount) as fa_amount, sum(other_amount) as oa_amount');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('status',1);
		if(!empty($from_date) && !empty($to_date)) {
			$this->db->where('billing_date >=', $from_date);
			$this->db->where('billing_date <=', $to_date);
		}
		if(!empty($ward_no)) {
			$this->db->where('added_ward', $ward_no);
		}
		$query =$this->db->get();
		return $query->row_array();
	}

	public function getBhumiKar($from_date = NULL, $to_date =NULL,$ward_no =NULL) {
		$this->db->select('SUM(bhumi_kar) as bhumi_total, sum(discount_amount) as malpot');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('status',1);
		if(!empty($from_date) && !empty($to_date)) {
			$this->db->where('billing_date >=', $from_date);
			$this->db->where('billing_date <=', $to_date);
		}
		if(!empty($ward_no)) {
			$this->db->where('added_ward', $ward_no);
		}
		$query =$this->db->get();
		return $query->row_array();

	}

}