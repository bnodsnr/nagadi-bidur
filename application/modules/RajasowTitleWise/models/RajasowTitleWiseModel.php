<?php
class RajasowTitleWiseModel extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
      	$this->today 				= convertdate(date('Y-m-d'));
      	$this->current_month 		= get_current_month();
      	$this->current_fy 			= current_fiscal_year();
      	$this->fy 					= current_fiscal_year();
      	$this->ignore 				= array(01,02,03);
	}
	public function getTitles() {
		$ignores = array(11313, 11314);
		$this->db->select('*')->from('rajasow_report_title');
		$this->db->where_not_in('topic_id', $ignores);
		$query = $this->db->get();
		return $query->result_array();
	}
	/*-------------------------------------------
		upto last month total details----------*/
	public function getTotalSumUpToLastMonth($topic_id) {
		$this->db->select('sum(t1.t_rates) as total,t1.tpn')->from('nagadi_amount_details t1');
		if($this->current_month == '04' ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} else if($this->current_month >= '04' && $this->current_month <= '05' ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '06' ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '07' ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '08' ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '09'  ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '10' ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '11' ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '12' ) {
			$this->db->where('substring(t1.added,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month == '01' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12'));
		} 
		else if($this->current_month == '02' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
		} 
		else if($this->current_month == '03' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
			
		} else {
			$this->db->where('substring(t1.added,6,2) !=', $this->current_month);
		}
		$this->db->where('t1.initial_flag !=', 1);
		$this->db->where('t1.fiscal_year', $this->current_fy);
		$this->db->where('t1.tpn', $topic_id);
		$this->db->group_by('t1.tpn');
		$query = $this->db->get();
		//
		return $query->row_array();
	}
	//search nagadi upto
	public function getTotalSumSearchUpToLastMonth($topic_id,$fiscal_year = NULL, $ward = NULL, $month = NULL) {
		$this->db->select('sum(t1.t_rates) as total,t1.tpn')->from('nagadi_amount_details t1');
		if($month == '04' ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} else if($month >= '04' && $month <= '05' ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '06' ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '07' ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '08' ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '09'  ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '10' ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '11' ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '12' ) {
			$this->db->where('substring(t1.added,6,2) <', $month);
			$this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($month == '01' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12'));
		} 
		else if($month == '02' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
		} 
		else if($month == '03' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
			
		} else {
			$this->db->where('substring(t1.added,6,2) !=', $month);
		}
		$this->db->where('t1.initial_flag !=', 1);
		if(!empty($fiscal_year)) {
			$this->db->where('t1.fiscal_year', $fiscal_year);
		}
		
		$this->db->where('t1.tpn', $topic_id);
		$this->db->group_by('t1.tpn');
		$query = $this->db->get();
		return $query->row_array();
	}
	//search nagadi current.
	public function getNagadiSearchCurrentMonth($topic_id, $fiscal_year = NULL , $ward = NULL, $month = NULL ) {
		$this->db->select('sum(t1.t_rates) as mtotal,t1.tpn,');
		$this->db->from('nagadi_amount_details t1');
		$this->db->where('t1.tpn', $topic_id);
		$this->db->where('substring(t1.added,6,2)', $month);
		$this->db->where('t1.fiscal_year', $fiscal_year);
		if($this->session->userdata('PRJ_USER_ID') != 1 ) {
			$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
		} else {
			if(!empty($ward)) {
				$this->db->where('t1.added_ward', $ward);
			}
		}
		$this->db->where('t1.initial_flag !=', 1);
		$query = $this->db->get();
		return $query->row_array();
	}
	/*-------------------------------------------
		current month sum----------*/
	public function getTotalSumCurrentMonth($topic_id) {
		$this->db->select('sum(t1.t_rates) as mtotal,t1.tpn,');
		$this->db->from('nagadi_amount_details t1');
		$this->db->where('t1.tpn', $topic_id);
		$this->db->where('substring(t1.added,6,2)', $this->current_month);
		$this->db->where('t1.fiscal_year', $this->current_fy);
		$this->db->where('t1.initial_flag !=', 1);
		// if($this->session->userdata('PRJ_USER_ID') != 1) {
		// 	if($this->session->userdata('PRJ_USER_WARD') == '0') {
		// 		$this->db->where('added_ward', '0');
		// 	} else {
		// 		$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
		// 	}
		// }
		$query = $this->db->get();
		return $query->row_array();
	}


	/*-----------------------------------------------------
	sampati kar <details-----------------------------------*/
	public function getSampatiKarCurrentMonth() {
		$this->db->select('SUM(sampati_kar) as sampati_total, sum(bakeyuta_amount) as ba_amount, sum(fine_amount) as fa_amount, sum(other_amount) as oa_amount');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('substring(billing_date,6,2)',$this->current_month);
		$this->db->where('status',1);
		$this->db->where('fiscal_year', $this->current_fy);
		if($this->session->userdata('PRJ_USER_ID') != 1) {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward', '0');
			} else {
				$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$query =$this->db->get();
		return $query->row_array();
	}

	//search current month details
	public function getSampatiKarMonthlySearch($fiscal_year = NULL, $ward = NULL, $month = NULL) {
		$this->db->select('SUM(sampati_kar) + SUM(bakeyuta_amount) + SUM(fine_amount) + sum(other_amount) -sum(discount_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year', $fiscal_year);
		}
		if(!empty($month)) {
			$this->db->where('substring(billing_date,6,2)',$month);
		}
		if($this->session->userdata('PRJ_USER_ID') != 1 ) {
			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
		} else {
			if(!empty($ward)) {
				$this->db->where('added_ward', $ward);
			}
		}
		$this->db->where('status',1);
		$query =$this->db->get();
		return $query->row_array();
	}
	public function getSampatiKarCurrentUptoLastMonth() {
		$this->db->select('SUM(sampati_kar) as sampati_total, sum(bakeyuta_amount) as ba_amount, sum(fine_amount) as fa_amount, sum(other_amount) as oa_amount');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if($this->current_month == '04' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} else if($this->current_month >= '04' && $this->current_month <= '05' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '06' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '07' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '08' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '09'  ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '10' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '11' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '12' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month == '01' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12'));
		} 
		else if($this->current_month == '02' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
		} 
		else if($this->current_month == '03' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
		} else {
			$this->db->where('substring(billing_date,6,2) !=', $this->current_month);
		}
		$this->db->where('status',1);
		$this->db->where('fiscal_year', $this->current_fy);
		if($this->session->userdata('PRJ_USER_ID') != 1) {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward', '0');
			} else {
				$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$this->db->where('fiscal_year', $this->fy);
		$query =$this->db->get();
		
		return $query->row_array();
	}
	//search sampati upto last month
	public function getSampatiKarSearchUptoLastMonth($fiscal_year = NULL, $ward = NULL, $month = NULL) {
		$this->db->select('SUM(sampati_kar) + SUM(bakeyuta_amount) + SUM(fine_amount) + sum(other_amount) -sum(discount_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if($month == '04' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} else if($month >= '04' && $month <= '05' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '06' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '07' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '08' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '09'  ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '10' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '11' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '12' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month == '01' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12'));
		} 
		else if($month == '02' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
		} 
		else if($month == '03' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
		} else {
			$this->db->where('substring(billing_date,6,2) !=', $month);
		}
		$this->db->where('status',1);
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year', $fiscal_year);
		}
		
		if($this->session->userdata('PRJ_USER_ID') != 1 ) {
			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
		} else {
			if(!empty($ward)) {
				$this->db->where('added_ward', $ward);
			}
		}
		$query =$this->db->get();
		return $query->row_array();
	}
	/*------------------------------------------
	bhumi kar details -------------------------*/
	public function getBhumiKarCurrentMonth() {
		$this->db->select('SUM(bhumi_kar) as bhumi_total, sum(bhumi_baykeuta_amount) as bhumi_bakeyuta , sum(discount_amount) as malpot');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('substring(billing_date,6,2)',$this->current_month);
		$this->db->where('status',1);
		$this->db->where('fiscal_year', $this->current_fy);
		if($this->session->userdata('PRJ_USER_ID') != 1) {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward', '0');
			} else {
				$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$query =$this->db->get();
		return $query->row_array();
	}
	//search bhumikar details
	public function getBhumiMonthlySearch($fiscal_year = NULL, $ward = NULL, $month = NULL) {
		$this->db->select('SUM(bhumi_kar) + SUM(bhumi_baykeuta_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year', $fiscal_year);
		}
		if(!empty($month)) {
			$this->db->where('substring(billing_date,6,2)',$month);
		}
		if($this->session->userdata('PRJ_USER_ID') != 1 ) {
			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
		} else {
			if(!empty($ward)) {
				$this->db->where('added_ward', $ward);
			}
		}
		$this->db->where('status',1);
		$query =$this->db->get();
		return $query->row_array();
	}
	public function getBhumiKaruptoLastMonth() {
		$this->db->select('SUM(bhumi_kar) + SUM(bhumi_baykeuta_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if($this->current_month == '04' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} else if($this->current_month >= '04' && $this->current_month <= '05' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '06' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '07' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '08' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '09'  ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '10' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '11' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month >= '04' && $this->current_month <= '12' ) {
			$this->db->where('substring(billing_date,6,2) <', $this->current_month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($this->current_month == '01' ) {
		
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12'));
		} 
		else if($this->current_month == '02' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
			
		} 
		else if($this->current_month == '03' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
		
		} else {
			$this->db->where('substring(billing_date,6,2) !=', $this->current_month);
		}
		
		$this->db->where('status',1);
		$this->db->where('fiscal_year', $this->current_fy);
		if($this->session->userdata('PRJ_USER_ID') != 1) {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward', '0');
			} else {
				$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$this->db->where('fiscal_year', $this->fy);
		$query =$this->db->get();
		
		return $query->row_array();
	}
	//search bhumi upto 
	public function getBhumiKarSearchUptoLastMonth($fiscal_year = NULL, $ward = NULL, $month = NULL ) {
		$this->db->select('SUM(bhumi_kar) + SUM(bhumi_baykeuta_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if($month == '04' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} else if($month >= '04' && $month <= '05' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '06' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '07' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '08' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '09'  ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '10' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '11' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month >= '04' && $month <= '12' ) {
			$this->db->where('substring(billing_date,6,2) <', $month);
			$this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
		} 
		else if($month == '01' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12'));
		} 
		else if($month == '02' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
		} 
		else if($month == '03' ) {
			$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
		} else {
			$this->db->where('substring(billing_date,6,2) !=', $month);
		}
		$this->db->where('status',1);
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year', $fiscal_year);
		}
		
		if($this->session->userdata('PRJ_USER_ID') != 1 ) {
			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
		} else {
			if(!empty($ward)) {
				$this->db->where('added_ward', $ward);
			}
		}
		$query =$this->db->get();
		
		return $query->row_array();
	}
}