<?php

class NagadiTitleWiseReportModel extends CI_Model

{

	public function __construct()

	{

		parent:: __construct();

      	$this->today 			= convertdate(date('Y-m-d'));

      	$this->current_month 	= get_current_month();

      	$this->current_fy 		= current_fiscal_year();

	}

	public function setCategoryTree($id = false) {

		$categories = array();

		$this->db->select('*')->from('main_topic');

		if($id) {

			$this->db->where('id', $id);

		}

		$this->db->order_by('ID','DESC');

		$query = $this->db->get();

		$child = array();

		foreach ($query->result() as $row) {

			$this->db->select('*, id as subid')->from('topic');

			$this->db->where('main_topic', $row->id);

			$query_child = $this->db->get();

			if(count($query_child->result()) > 0 ) {

				foreach ($query_child->result() as $key => $subchild) {

					$child[$key] = $subchild;

					$row->children = $child;

				}

			} 

			$categories[] = $row;

		}

		return $categories;

	}



	private function getChilderen($parentId) {

		$child = array();

		$query = $this->db->query('SELECT * FROM topic WHERE main_topic = '.$parentId);

		if (count($query->result()) > 0) {

			foreach ($query->result() as $i => $row) {

				if ($row->id > 0) {

					$row->child = $this->getChilderen($row->main_topic);

				}

				$child[$i] = $row;

			}

			return $child;

		} else {

			return false;

		}

	}



	public function getMonthlySum($id) {

		$this->db->select('SUM(t_rates) AS total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('sub_topic', $id);

		$this->db->where('initial_flag !=',1);

		$this->db->where('SUBSTRING(added, 6,2)=', $this->current_month);

		$this->db->where('fiscal_year', $this->current_fy);

		if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0 ) {

			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));

		}

		$query = $this->db->get();

		return  $query->row();

	}



	//search nagadai details 

	public function getMonthlySearchNagadi($id, $from_date =NULL, $to_date =NULL, $ward=NULL) {

		$this->db->select('SUM(t_rates) AS total');

		$this->db->from('nagadi_amount_details');

		if(!empty($id)) {

			$this->db->where('sub_topic', $id);

		}

		if($from_date !='00') {

			$this->db->where('added >=', $from_date);

		}

		if($to_date !="00") {

			$this->db->where('added <=', $to_date);

		}

		if($this->session->userdata('PRJ_USER_ID') !=1 ) {

			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));

		} else {

			if($ward !='00') {

				if($ward == "palika"){

					$this->db->where('added_ward','0');

				} else {

					$this->db->where('added_ward',$ward);

				}

			}

		}

		

		$this->db->where('initial_flag !=', 1);

		$this->db->where('fiscal_year', $this->current_fy);

		$query = $this->db->get();

		return  $query->row();

	}



	public function SampatiKarMonthly() {

	    $this->db->select('SUM(sampati_kar) + SUM(bakeyuta_amount) + SUM(fine_amount) + sum(other_amount) - sum(discount_amount) as total');

		$this->db->from('sampati_kar_bhumi_kar_bill_details');

		$this->db->where('SUBSTRING(billing_date, 6,2)=', $this->current_month);

		if($this->session->userdata('PRJ_USER_GROUP') != 1  ) {

			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));

		}

		$this->db->where('fiscal_year', $this->current_fy);

		$this->db->where('status',1);

		$query =$this->db->get();

		return $query->row_array();

	}



	//monthly bhumi/malpot kar 

	public function BhumiKarMonthly() {

		$this->db->select('SUM(bhumi_kar) + SUM(bhumi_baykeuta_amount) as total');

		$this->db->from('sampati_kar_bhumi_kar_bill_details');

		$this->db->where('SUBSTRING(billing_date, 6,2)=', $this->current_month);

		if($this->session->userdata('PRJ_USER_GROUP') != 1  ) {

			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));

		}

		$this->db->where('fiscal_year', $this->current_fy);

		$this->db->where('status',1);

		$query =$this->db->get();

		return $query->row_array();

	}



	public function SearchSampatiKarMonthly($from_date =NULL,$to_date=NULL, $ward =NULL) {

		$this->db->select('SUM(sampati_kar) + SUM(bakeyuta_amount) + SUM(fine_amount) + sum(other_amount) -sum(discount_amount) as total');

		$this->db->from('sampati_kar_bhumi_kar_bill_details');

		if(!empty($from_date) && empty($to_date)) {

			$this->db->where('billing_date = ', $from_date);

		} 

		if(!empty($from_date) && !empty($to_date) ) {

			$this->db->where('billing_date >=', $from_date);

			$this->db->where('billing_date <=', $to_date);

		}

		if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0 ) {

			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));

		} else {

			if(!empty($ward)) {

				if($ward == "palika"){

					$this->db->where('added_ward','0');

				} else {

					$this->db->where('added_ward',$ward);

				}

			}

		}

		

		$this->db->where('status',1);

		$query =$this->db->get();

		return $query->row_array();

	}



	public function SearchBhumikarKarMonthly($from_date =NULL,$to_date=NULL, $ward =NULL) {

		$this->db->select('SUM(bhumi_kar) + SUM(bhumi_baykeuta_amount) as total');

		$this->db->from('sampati_kar_bhumi_kar_bill_details');

		if(!empty($from_date) && empty($to_date)) {

			$this->db->where('billing_date = ', $from_date);

		} 

		if(!empty($from_date) && !empty($to_date)) {

			$this->db->where('billing_date >=', $from_date);

			$this->db->where('billing_date <=', $to_date);

		}

		if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0 ) {

			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));

		} else {

			if(!empty($ward)) {

				if($ward == "palika"){

					$this->db->where('added_ward','0');

				} else {

					$this->db->where('added_ward',$ward);

				}

			}

		}

		$this->db->where('status',1);

		$query =$this->db->get();

		return $query->row_array();

	}



	/*-------------------------------------------------------------

	--------------------------------------------------------------*/

	public function getMontlhyNagadiBillDetails($topic_id= NULL) {

		$this->db->select('t1.*,t2.customer_name,t2.payment_mode,t2.status,t3.topic_name as main_topic,t3.topic_no as topicno,t4.sub_topic,t5.topic_title,t6.reason,t7.name');

		$this->db->from('nagadi_amount_details t1');

		$this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');

		$this->db->join('main_topic t3','t3.id = t1.main_topic','left');

		$this->db->join('topic t4','t4.id = t1.sub_topic','left');

		$this->db->join('sub_topic t5','t5.id = t1.topic','left');

		$this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');

		$this->db->join('users t7','t7.userid = t1.added_by','left');

		$this->db->where('SUBSTRING(t1.added, 6,2)=',$this->current_month);

		if(!empty($topic_id)) {

			$this->db->where('t1.main_topic', $topic_id);

		}

		if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0 ) {

			$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));

		}

		$this->db->order_by('t1.added','ASC');

		$query = $this->db->get();

		return $query->result_array();

	}



	public function getCancelAmountDetailsByMonth($topic_id = NULL ) {

		$this->db->select('SUM(t_rates) as cancel_bills')->from('nagadi_amount_details');

		$this->db->where('SUBSTRING(added, 6,2)=',$this->current_month);

		if(!empty($topic_id)) {

			$this->db->where('main_topic', $topic_id);

		}

		$this->db->where('initial_flag',1);

		$query = $this->db->get();

		return $query->row_array();

	}

	//getMontlhyNagadiBillDetailsBySearch

	public function getMontlhyNagadiBillDetailsBySearch($topic_id, $from_date,$to_date,$ward) {

		$this->db->select('t1.*,t2.customer_name,t2.payment_mode,t2.status,t3.topic_name as main_topic,t3.topic_no as topicno,t4.sub_topic,t5.topic_title,t6.reason,t7.name');

		$this->db->from('nagadi_amount_details t1');

		$this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');

		$this->db->join('main_topic t3','t3.id = t1.main_topic','left');

		$this->db->join('topic t4','t4.id = t1.sub_topic','left');

		$this->db->join('sub_topic t5','t5.id = t1.topic','left');

		$this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');

		$this->db->join('users t7','t7.userid = t1.added_by','left');

		if(!empty($topic_id)) {

			$this->db->where('t1.main_topic', $topic_id);

		}

		if($from_date !='00') {

			$this->db->where('t1.added >=', $from_date);

		}

		if($to_date !="00") {

			$this->db->where('t1.added <=', $to_date);

		}

		if($this->session->userdata('PRJ_USER_ID') !=1 && $this->session->userdata('PRJ_USER_WARD')!= '0') {

			$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));

		} else {

			if($ward !='00') {

				if($ward == "palika"){

					$this->db->where('t1.added_ward','0');

				} else {

					$this->db->where('t1.added_ward',$ward);

				}

			}

		}

		$this->db->order_by('t1.added','ASC');

		$query = $this->db->get();

		return $query->result_array();

	}



	public function getCancelAmountDetailsByMonthBySearch($topic_id = NULL, $from_date = NULL,$to_date = NULL,$ward = NULL) {

		$this->db->select('SUM(t_rates) as cancel_bills')->from('nagadi_amount_details');

		$this->db->where('SUBSTRING(added, 6,2)=',$this->current_month);

		if(!empty($topic_id)) {

			$this->db->where('main_topic', $topic_id);

		}

		if($from_date !='00') {

			$this->db->where('added >=', $from_date);

		}

		if($to_date !="00") {

			$this->db->where('added <=', $to_date);

		}

		if($this->session->userdata('PRJ_USER_ID') !=1 && $this->session->userdata('PRJ_USER_WARD')!= '0') {

			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));

		} else {

			if($ward !='00') {

				if($ward == "palika"){

					$this->db->where('added_ward','0');

				} else {

					$this->db->where('added_ward',$ward);

				}

			}

		}

		$this->db->where('initial_flag',1);

		$query = $this->db->get();

		return $query->row_array();

	}



	/*----------------------------------------------------

		search sampati kar

	------------------------------------------------------*/

	public function MonthlySampatiBhumiKarSearch($from_date,$to_date,$ward){

		$this->db->select('t1.*, t2.land_owner_name_np, t3.reason,t4.name')->from('sampati_kar_bhumi_kar_bill_details t1');

		$this->db->join('land_owner_profile_basic t2','t2.file_no = t1.nb_file_no','left');

		$this->db->join('sampati_rasid_cancel_reason t3','t3.bill_no = t1.bill_no','left');

		$this->db->join('users t4','t4.userid = t1.added_by','left');

		

		if(!empty($from_date)) {

			$this->db->where('t1.billing_date >=', $from_date);

		} 

		if(!empty($to_date)) {

			$this->db->where('t1.billing_date <=', $to_date);

		}

		if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0 ) {

			$this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));

		} else {

			if($ward !='00') {

				if($ward == "palika"){

					$this->db->where('t1.added_ward','0');

				} else {

					$this->db->where('t1.added_ward',$ward);

				}

			}

		}

		$this->db->where('t1.status', 1);

		$this->db->where('t1.fiscal_year', $this->current_fy);

		$this->db->order_by('t1.bill_no','ASC');

		$query = $this->db->get();

		return $query->result_array();

	}



	public function getCancelSampatikarAmountDetailsByMonthSearch($from_date,$to_date,$ward) {

		$this->db->select('SUM(net_total_amount) as sampati_cancel_bills')->from('sampati_kar_bhumi_kar_bill_details');

		// $this->db->where('SUBSTRING(billing_date, 6,2)=',$this->current_month);

		$this->db->where('status',2);

		$this->db->where('fiscal_year', $this->current_fy);

		if(!empty($from_date)) {

			$this->db->where('billing_date >=', $from_date);

		} 

		if(!empty($to_date)) {

			$this->db->where('billing_date <=', $to_date);

		}

		if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0 ) {

			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));

		} else {

			if($ward !='00') {

				if($ward == "palika"){

					$this->db->where('added_ward','0');

				} else {

					$this->db->where('added_ward',$ward);

				}

			}

		}

		$query = $this->db->get();

		return $query->row_array();

	}

}