<?php
class RajasowTitleWiseModel extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
      	$this->today 				= convertdate(date('Y-m-d'));
      	$this->current_month 		= get_current_month();
      	$this->current_fy 			= current_fiscal_year();
      	$this->fy = current_fiscal_year();
      	//$this->fiscal_year_details 	= current_fiscal_year_details();
      	$this->ignore 				= array(01,02,03);
	}
	public function getTitles() {
		$ignores = array(11313, 11314);
		$this->db->select('*')->from('rajasow_report_title');
		$this->db->where_not_in('topic_id', $ignores);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getOtherTitleCurrentMonth($topic_no){
		$this->db->select('sum(t1.t_rates) as total,t1.sub_topic,t2.topic_no')->from('nagadi_amount_details t1');
		$this->db->join('topic t2','t2.id = t1.sub_topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t1.topic','others');
		$this->db->where('t3.topic_id', $topic_no);
		$this->db->where('substring(t1.added,6,2)', $this->current_month);
		$this->db->where('t1.initial_flag !=', 1);
		$this->db->where('t1.fiscal_year', $this->current_fy);
	    $this->db->group_by('t3.topic_id');
		$query = $this->db->get();
        //print_r($this->db->last_query());
		return $query->row_array();
	}
	
	
	public function getOtherTitleUptoLastMonth($topic_no){
		$this->db->select('sum(t1.t_rates) as total,t1.sub_topic,t2.topic_no')->from('nagadi_amount_details t1');
		$this->db->join('topic t2','t2.id = t1.sub_topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t1.topic','others');
		$this->db->where('t3.topic_id', $topic_no);
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
		$this->db->group_by('t3.topic_id');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	public function getSubByTopicNo($topic_no) {
		$this->db->select('sum(t1.t_rates) as total,t1.sub_topic,t1.topic, t2.id,t3.topic_name,t3.topic_id');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('sub_topic t2','t2.id = t1.topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t3.topic_id', $topic_no);
		$this->db->where('t1.topic!=','others');
		$this->db->where('substring(t1.added,6,2)', $this->current_month);
		$this->db->where('t1.initial_flag !=', 1);
		$this->db->where('t1.fiscal_year', $this->current_fy);
		if($this->session->userdata('PRJ_USER_ID') != 1) {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('t1.added_ward', '0');
			} else {
				$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getSubByTopicNoUptoLastMonth($topic_no) {
		$this->db->select('sum(t1.t_rates) as total, t2.id,t3.topic_name,t3.topic_id');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('sub_topic t2','t2.id = t1.topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t3.topic_id', $topic_no);
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
		else if($this->current_month >= '02' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
			
		} 
		else if($this->current_month >= '03' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
			
		} else {
			$this->db->where('substring(t1.added,6,2) !=', $this->current_month);
		}


		$this->db->where('initial_flag !=', 1);
		$this->db->where('t1.topic!=','others');
		$this->db->where('t1.fiscal_year', $this->current_fy);
		if($this->session->userdata('PRJ_USER_ID') != 1) {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward', '0');
			} else {
				$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$query = $this->db->get();
		return $query->row_array();
	}

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
	//	$this->db->where('fiscal_year', $this->fy);
		$query =$this->db->get();
	//	pp($this->db->last_query());
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
	//	$this->db->where('fiscal_year', $this->fy);
		$query =$this->db->get();
		//pp($this->db->last_query());
		return $query->row_array();
		
// 		$this->db->from('sampati_kar_bhumi_kar_bill_details');
// 		$this->db->where('substring(billing_date,6,2)',$this->current_month);
// 		$this->db->where('fiscal_year', $this->current_fy);
// 		$this->db->where('status',1);
// 		if($this->session->userdata('PRJ_USER_ID') != 1) {
// 			if($this->session->userdata('PRJ_USER_WARD') == '0') {
// 				$this->db->where('added_ward', '0');
// 			} else {
// 				$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 			}
// 		}
// 		$this->db->where('fiscal_year', $this->fy);
// 		pp($this->db->last_query());
// 		$query =$this->db->get();
// 		return $query->row_array();
	}

	public function getBhumiKaruptoLastMonth() {
		$this->db->select('SUM(bhumi_kar) as bhumi_total, sum(bhumi_baykeuta_amount) as bhumi_bakeyuta , sum(discount_amount) as malpot');
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
		//pp($this->db->last_query());
		return $query->row_array();
	}
	/*-----------------------------------------------------------------------------------
		Other Topic Details
	-------------------------------------------------------------------------------------*/
	public function getCurrentMonthOtherTopic($topic_no=NULL) {
		$this->db->select('sum(t1.t_rates) as total,t1.sub_topic,t1.topic, t2.id,t3.topic_name,t3.topic_id');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('topic t2','t2.id = t1.sub_topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t1.topic','others');
		$this->db->where('t3.topic_id', $topic_no);
		$this->db->where('substring(added,6,2)', $this->current_month);
		$this->db->where('t1.fiscal_year', $this->current_fy);
		$this->db->where('initial_flag !=', 1);
		if($this->session->userdata('PRJ_USER_ID') != 1) {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward', '0');
			} else {
				$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$query = $this->db->get();
		return $query->row_array();


	}

	public function getSubByTopicNoUptoLastMonthOtherTopic($topic_no) {
		$this->db->select('sum(t1.t_rates) as total,t1.sub_topic,t1.topic, t2.id,t3.topic_name,t3.topic_id');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('topic t2','t2.id = t1.sub_topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t1.topic','others');
		$this->db->where('t3.topic_id', $topic_no);
		//$this->db->where('substring(added,6,2) != ', $this->current_month);

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
			//$this->db->where('substring(t1.added,6,2) >', $this->current_month);
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12'));
		} 
		else if($this->current_month == '02' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
			// $this->db->where('substring(t1.added,6,2) >', $this->current_month);
			// $this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} 
		else if($this->current_month == '03' ) {
			$this->db->where_in('substring(t1.added,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
			// $this->db->where('substring(t1.added,6,2) >', $this->current_month);
			// $this->db->where_not_in('substring(t1.added,6,2)', $this->ignore);
		} else {
			$this->db->where('substring(t1.added,6,2) !=', $this->current_month);
		}

		// if($this->current_month == 04 ) {
		// 	$this->db->where('substring(t1.added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('substring(t1.added,6,2)', $ignore);
		// } else if($this->current_month > 04 && $this->current_month < 05 ) {
		// 	$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month > 04 && $this->current_month < 06 ) {
		// 	$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month > 04 && $this->current_month < 07 ) {
		// 	$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month > 04 && $this->current_month < 08  ) {
		// 	$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month > 04 && $this->current_month < 09  ) {
		// 	$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month > 04 && $this->current_month < 10 ) {
		// 	$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month > 04 && $this->current_month < 11 ) {
		// 	$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month > 04 && $this->current_month < 12 ) {
		// 	$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month == 01 ) {
		// 	//$this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	$this->db->where_in('t1.substring(added,6,2)', array(04,05,06,07,08,09,10,11,12));
		// } 
		// else if($this->current_month > 02 ) {
		// 	$this->db->where_in('t1.substring(added,6,2)', array(04,05,06,07,08,09,10,11,12,01));
		// 	// $this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	// $this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else if($this->current_month > 03 ) {
		// 	$this->db->where_in('t1.substring(added,6,2)', array(04,05,06,07,08,09,10,11,12,01,03));
		// 	// $this->db->where('t1.substring(added,6,2) >', $this->current_month);
		// 	// $this->db->where_not_in('t1.substring(added,6,2)', $ignore);
		// } 
		// else {
		// 	$this->db->where('t1.substring(added,6,2) !=', $this->current_month);
		// }

		$this->db->where('t1.fiscal_year', $this->current_fy);
		$this->db->where('initial_flag !=', 1);
		if($this->session->userdata('PRJ_USER_ID') != 1) {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward', '0');
			} else {
				$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$query = $this->db->get();
		return $query->row_array();
	}

	/*-----------------------------------------------------------------------------------
	search query
	-------------------------------------------------------------------------------------*/
	public function getSearchSampatiKarCurrentMonth($ward = NULL, $month = NULL) {
		$this->db->select('SUM(sampati_kar) as sampati_total, sum(bakeyuta_amount) as ba_amount, sum(fine_amount) as fa_amount, sum(other_amount) as oa_amount');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if(!empty($month) && $month !='-') {
			$this->db->where('substring(billing_date,6,2)',$month);
		}
		$this->db->where('status',1);
		if($this->session->userdata('PRJ_USER_ID') == 1 ) {
			if(!empty($ward) && $ward != '-') {
				if($ward == 'PALIKA') {
					$this->db->where('added_ward' ,'0');
				} else {
					$this->db->where('added_ward', $ward);
				}
			}
		} else {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward' ,'0');
			} else {
					$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		
		$this->db->where('fiscal_year', $this->current_fy);
		$query =$this->db->get();

		return $query->row_array();
	}

	public function getSearchSampatiKarCurrentUptoLastMonth($ward = NULL, $month = NULL) {
		$this->db->select('SUM(sampati_kar) as sampati_total, sum(bakeyuta_amount) as ba_amount, sum(fine_amount) as fa_amount, sum(other_amount) as oa_amount');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('status',1);
		if(!empty($month)  && $month !='-') {
			//$this->db->where('substring(billing_date,6,2) <',$month);

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
			//$this->db->where('substring(billing_date,6,2) >', $month);
				$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12'));
			} 
			else if($month == '02' ) {
				$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
			// $this->db->where('substring(billing_date,6,2) >', $month);
			// $this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
			} 
			else if($month == '03' ) {
				$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
			// $this->db->where('substring(billing_date,6,2) >', $month);
			// $this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
			} else {
				$this->db->where('substring(billing_date,6,2) !=', $month);
			}
		}
		$this->db->where('status',1);
		if($this->session->userdata('PRJ_USER_ID') == 1 ) {
			if(!empty($ward) && $ward != '-') {
				if($ward == 'PALIKA') {
					$this->db->where('added_ward' ,'0');
				} else {
					$this->db->where('added_ward', $ward);
				}
			}
		} else {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward' ,'0');
			} else {
					$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		// if(!empty($ward) && $ward != '-') {
		// 	if($ward == 'PALIKA') {
		// 		$this->db->where('added_ward' ,'0');
		// 	} else {
		// 		$this->db->where('added_ward', $ward);
		// 	}
		// }
		$this->db->where('fiscal_year', $this->current_fy);
		$query =$this->db->get();
		return $query->row_array();
	}

	/*---------------------------------------------------------------------------*/
	public function getSearchBhumiKarCurrentMonth($ward = NULL, $month = NULL) {
		$this->db->select('SUM(bhumi_kar) as bhumi_total,sum(bhumi_baykeuta_amount) as bhumi_bakeyuta , sum(discount_amount) as malpot');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('status',1);
		if(!empty($month) && $month !='-') {
			$this->db->where('substring(billing_date,6,2)',$month);
		}
		$this->db->where('status',1);

		if($this->session->userdata('PRJ_USER_ID') == 1 ) {
			if(!empty($ward) && $ward != '-') {
				if($ward == 'PALIKA') {
					$this->db->where('added_ward' ,'0');
				} else {
					$this->db->where('added_ward', $ward);
				}
			}
		} else {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward' ,'0');
			} else {
					$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}

		// if(!empty($ward) && $ward != '-') {
		// 	if($ward == 'PALIKA') {
		// 		$this->db->where('added_ward' ,'0');
		// 	} else {
		// 		$this->db->where('added_ward', $ward);
		// 	}
		// }
		$this->db->where('fiscal_year', $this->current_fy);
		$query =$this->db->get();
		return $query->row_array();
	}

	public function getSearchBhumiKaruptoLastMonth($ward = NULL, $month = NULL) {
		$this->db->select('SUM(bhumi_kar) as bhumi_total,sum(bhumi_baykeuta_amount) as bhumi_bakeyuta, sum(discount_amount) as malpot');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('status',1);
		if(!empty($month) && $month !='-') {
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
			//$this->db->where('substring(billing_date,6,2) >', $month);
				$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12'));
			} 
			else if($month == '02' ) {
				$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01'));
			// $this->db->where('substring(billing_date,6,2) >', $month);
			// $this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
			} 
			else if($month == '03' ) {
				$this->db->where_in('substring(billing_date,6,2)', array('04','05','06','07','08','09','10','11','12','01','02'));
			// $this->db->where('substring(billing_date,6,2) >', $month);
			// $this->db->where_not_in('substring(billing_date,6,2)', $this->ignore);
			} else {
				$this->db->where('substring(billing_date,6,2) !=', $month);
			}

		}
		$this->db->where('status',1);

		if($this->session->userdata('PRJ_USER_ID') == 1 ) {
			if(!empty($ward) && $ward != '-') {
				if($ward == 'PALIKA') {
					$this->db->where('added_ward' ,'0');
				} else {
					$this->db->where('added_ward', $ward);
				}
			}
		} else {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('added_ward' ,'0');
			} else {
					$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}

		$this->db->where('fiscal_year', $this->current_fy);
		$query =$this->db->get();
		return $query->row_array();
	}

	/*-----------------------------------------------------------------------*/
	public function getSearchSubByTopicNo($topic_no,$ward=NULL,$month=NULL) {
		$this->db->select('sum(t1.t_rates) as total, t2.id,t3.topic_name,t3.topic_id');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('sub_topic t2','t2.id = t1.topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t3.topic_id', $topic_no);
		$this->db->where('t1.initial_flag !=', 1);
		if(!empty($month) && $month !='-') {
			$this->db->where('substring(t1.added,6,2)',$month);
		}
		$this->db->where('initial_flag!=',1);

		if($this->session->userdata('PRJ_USER_ID') == 1 ) {
			if(!empty($ward) && $ward != '-') {
				if($ward == 'PALIKA') {
					$this->db->where('t1.added_ward' ,'0');
				} else {
					$this->db->where('t1.added_ward', $ward);
				}
			}
		} else {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('t1.added_ward' ,'0');
			} else {
					$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$this->db->where('t1.fiscal_year', $this->current_fy);
		$query = $this->db->get();
		//pp($this->db->last_query());
		return $query->row_array();
	}

	public function getSearchSubByTopicNoUptoLastMonth($topic_no,$ward=NULL,$month=NULL) {
		$this->db->select('sum(t1.t_rates) as total, t2.id,t3.topic_name,t3.topic_id');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('sub_topic t2','t2.id = t1.topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t3.topic_id', $topic_no);
		$this->db->where('initial_flag !=', 1);
		if(!empty($month) && $month !='-') {
			//$this->db->where('substring(t1.added,6,2) <',$month);

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
		}
		
		if($this->session->userdata('PRJ_USER_ID') == 1 ) {
			if(!empty($ward) && $ward != '-') {
				if($ward == 'PALIKA') {
					$this->db->where('t1.added_ward' ,'0');
				} else {
					$this->db->where('t1.added_ward', $ward);
				}
			}
		} else {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('t1.added_ward' ,'0');
			} else {
					$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}

		$this->db->where('t1.fiscal_year', $this->current_fy);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getCurrentMonthSearchOtherTopic($topic_no, $ward=NULL,$month=NULL) {
		$this->db->select('sum(t1.t_rates) as total,t1.sub_topic,t1.topic, t2.id,t3.topic_name,t3.topic_id');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('topic t2','t2.id = t1.sub_topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t1.topic','others');
		$this->db->where('t3.topic_id', $topic_no);
		$this->db->where('t1.initial_flag !=', 1);
		if(!empty($month) && $month !='-') {
			$this->db->where('substring(t1.added,6,2)',$month);
		}
		// if(!empty($ward)  && $ward != '-') {
		// 	if($ward == 'PALIKA') {
		// 		$this->db->where('t1.added_ward' ,'0');
		// 	} else {
		// 		$this->db->where('t1.added_ward', $ward);
		// 	}
		// }

		if($this->session->userdata('PRJ_USER_ID') == 1 ) {
			if(!empty($ward) && $ward != '-') {
				if($ward == 'PALIKA') {
					$this->db->where('t1.added_ward' ,'0');
				} else {
					$this->db->where('t1.added_ward', $ward);
				}
			}
		} else {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('t1.added_ward' ,'0');
			} else {
					$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}

		$this->db->where('t1.fiscal_year', $this->current_fy);
		$query = $this->db->get();
		return $query->row_array();


	}

	public function getSubByTopicNoUptoLastMonthSearchOtherTopic($topic_no,$ward=NULL,$month=NULL) {
		$this->db->select('sum(t1.t_rates) as total,t1.sub_topic,t1.topic, t2.id,t3.topic_name,t3.topic_id');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('topic t2','t2.id = t1.sub_topic','left');
		$this->db->join('rajasow_report_title t3','t3.topic_id = t2.topic_no','left');
		$this->db->where('t1.topic','others');
		$this->db->where('t3.topic_id', $topic_no);
		$this->db->where('t1.initial_flag !=', 1);
		if(!empty($month) && $month !='-') {
			//$this->db->where('substring(t1.added,6,2) < ',$month);

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
		}
		// if(!empty($ward)  && $ward != '-') {
		// 	if($ward == 'PALIKA') {
		// 		$this->db->where('t1.added_ward' ,'0');
		// 	} else {
		// 		$this->db->where('t1.added_ward', $ward);
		// 	}
		// }

		if($this->session->userdata('PRJ_USER_ID') == 1 ) {
			if(!empty($ward) && $ward != '-') {
				if($ward == 'PALIKA') {
					$this->db->where('t1.added_ward' ,'0');
				} else {
					$this->db->where('t1.added_ward', $ward);
				}
			}
		} else {
			if($this->session->userdata('PRJ_USER_WARD') == '0') {
				$this->db->where('t1.added_ward' ,'0');
			} else {
					$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
			}
		}
		$this->db->where('t1.fiscal_year', $this->current_fy);
		$query = $this->db->get();
		return $query->row_array();
	}


}