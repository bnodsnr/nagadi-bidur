<?php 
/**
 * 
 */
class MonthlyReportMDL extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
      	$this->current_month 	= get_current_month();
      	$this->current_fy 		= current_fiscal_year();
	}

	//monthly nagadi details.
	public function NagadiMontlhy($topic_id) {
		$this->db->select('SUM(t_rates) as total');
		$this->db->from('nagadi_amount_details');
		$this->db->where('SUBSTRING(added, 6,2)=', $this->current_month);
		if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0) {
			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		}
		if(!empty($topic_id)) {
			$this->db->where('main_topic', $topic_id);
		}
		$this->db->where('fiscal_year', $this->current_fy);
		$this->db->where('initial_flag !=', 1);
		$this->db->order_by('bill_no', 'ASC');
		$query =$this->db->get();
		return $query->row_array();
	}

	//sampati kar details.
	public function SampatiKarMonthly() {
		$this->db->select('SUM(sampati_kar) + SUM(bakeyuta_amount) + SUM(fine_amount) + sum(other_amount) -sum(discount_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('SUBSTRING(billing_date, 6,2)=', $this->current_month);
		if($this->session->userdata('PRJ_USER_ID') != 1  ) {
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
		if($this->session->userdata('PRJ_USER_ID') != 1  ) {
			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		}
		$this->db->where('fiscal_year', $this->current_fy);
		$this->db->where('status',1);
		$query =$this->db->get();
		return $query->row_array();
	}

	/*-------------------------------------------------------------------------------------------------
		search
	---------------------------------------------------------------------------------------------------*/
	public function SearchNagadiMontlhy($topic_id, $ward,$from_date,$to_date, $fiscal_year) {
		$this->db->select('SUM(t_rates) as total');
		$this->db->from('nagadi_amount_details');
		if(!empty($topic_id)) {
			$this->db->where('main_topic', $topic_id);
		}
		if($from_date != '-') {
			$this->db->where('added >=', $from_date);
		}
		if($to_date != '-') {
			$this->db->where('added <=', $to_date);
		}
		if($this->session->userdata('PRJ_USER_GROUP') != 1 ) {
			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		} else {
			if($ward !='-') {
				if($ward =='palika') {
					$this->db->where('added_ward', '0');
				} else {
					$this->db->where('added_ward',$ward);
				}
			}
		}

		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year', $fiscal_year);
		}

		// if($from_date !='00') {
		// 	$this->db->where('added >=', $from_date);
		// }
		// if($to_date !="00") {
		// 	$this->db->where('added <=', $to_date);
		// }
		// if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0 ) {
		// 	$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		// } else {
		// 	if($ward !='00') {
		// 		if($ward == "palika"){
		// 			$this->db->where('added_ward','0');
		// 		} else {
		// 			$this->db->where('added_ward',$ward);
		// 		}
		// 	}
		// }
		
		$this->db->where('initial_flag !=', 1);
		$query =$this->db->get();
		//pp($this->db->last_query());
		return $query->row_array();
	}

	public function SearchSampatiKarMonthly($ward =NULL, $from_date = NULL ,$to_date = NULL,$fiscal_year = NULL ) {
		$this->db->select('SUM(sampati_kar) + SUM(bakeyuta_amount) + SUM(fine_amount) + sum(other_amount) -sum(discount_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if($from_date != '-') {
			$this->db->where('billing_date >=', $from_date);
		}
		if($to_date != '-') {
			$this->db->where('billing_date <=', $to_date);
		}
		if($this->session->userdata('PRJ_USER_GROUP') != 1 ) {
			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		} else {
			if($ward !='-') {
				if($ward == "palika") {
					$this->db->where('added_ward','0');
				} else {
					$this->db->where('added_ward',$ward);
				}
			}
		}
		//exit;
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year', $fiscal_year);
		}
		$this->db->where('status',1);
		$query =$this->db->get();
		return $query->row_array();
	}

	public function SearchBhumikarKarMonthly($ward, $from_date, $to_date, $fiscal_year) {
		$this->db->select('SUM(bhumi_kar) + SUM(bhumi_baykeuta_amount) as total');
		$this->db->from('sampati_kar_bhumi_kar_bill_details');
		if($from_date != '-') {
			$this->db->where('billing_date >=', $from_date);
		}
		if($to_date != '-') {
			$this->db->where('billing_date <=', $to_date);
		}
		if($this->session->userdata('PRJ_USER_GROUP') != 1) {
			$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		} else {
			if($ward !='-') {
				if($ward == "palika"){
					$this->db->where('added_ward','0');
				} else {
					$this->db->where('added_ward',$ward);
				}
			}
		}
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year', $fiscal_year);
		}
		$this->db->where('status',1);
		$query =$this->db->get();
		return $query->row_array();
	}
	/*--------------------------------------------------------------------
				Nagadi bill details
		--------------------------------------------------------------------
	*/
	public function getNagadiBillDetails($topic_id,$from_date =NULL,$to_date=NULL, $ward_no=NULL, $fiscal_year=NULL) {
	    
	    $this->db->select('t1.*,t1.bill_no, t1.fiscal_year as fy,t1.added_by,t1.added_ward,t2.customer_name,t2.payment_mode,t2.status,t3.topic_name,t4.sub_topic,t5.topic_title,t6.reason,t7.name');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');
		$this->db->join('main_topic t3','t3.id = t1.main_topic','left');
		$this->db->join('topic t4','t4.id = t1.sub_topic','left');
		$this->db->join('sub_topic t5','t5.id = t1.topic','left');
		$this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');
		$this->db->join('users t7','t7.userid = t1.added_by','left');
		if(!empty($from_date) && !empty($to_date)) {
			$this->db->where('t1.added >=', $from_date);
			$this->db->where('t1.added <=', $to_date);
		} else {
			$this->db->where('SUBSTRING(added, 6,2)=',$this->current_month);
		}
		
		if($this->session->userdata('PRJ_USER_GROUP') != 1 ) {
			$this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));
		} else {
			if($ward !='-') {
				if($ward =='palika') {
					$this->db->where('t1.added_ward', '0');
				} else {
					$this->db->where('t1.added_ward',$ward);
				}
			}
		}
		// if($this->session->userdata('PRJ_USER_ID') != 1){
		// 	$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
		// }
// 		if(!empty($ward_no) ) {
// 			$this->db->where('t1.added_ward', $ward_no);
// 		} else {
// 		    if($this->session->userdata('PRJ_USER_ID') != 1) {
// 		        $this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 		    }
			
// 		}
		if(!empty($fiscal_year)) {
			$this->db->where('t1.fiscal_year', $fiscal_year);
		} else {
			$this->db->where('t1.fiscal_year', $this->current_fy);
		}
		//!empty($fiscal_year)?$this->db->where('t1.fiscal_year', $fiscal_year):$this->db->where('t1.fiscal_year', $this->fy);
		// $this->db->order_by('t1.bill_no', 'ASC');
		$query = $this->db->get();
		//pp($this->db->last_query());
		//exit;
		return $query->result_array();
		
// 		$this->db->select('t1.*,t1.bill_no, t1.fiscal_year as fy,t1.added_by,t1.added_ward,t2.customer_name,t2.payment_mode,t2.status,t3.topic_name,t4.sub_topic,t5.topic_title,t6.reason,t7.name');
// 		$this->db->from('nagadi_amount_details t1');
// 		$this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');
// 		$this->db->join('main_topic t3','t3.id = t1.main_topic','left');
// 		$this->db->join('topic t4','t4.id = t1.sub_topic','left');
// 		$this->db->join('sub_topic t5','t5.id = t1.topic','left');
// 		$this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');
// 		$this->db->join('users t7','t7.userid = t1.added_by','left');
// 		if(!empty($from_date) && !empty($to_date)) {
// 			$this->db->where('t1.added >=', $from_date);
// 			$this->db->where('t1.added <=', $to_date);
// 		} else {
// 			$this->db->where('SUBSTRING(added, 6,2)=',$this->current_month);
// 		}
// 		// if($this->session->userdata('PRJ_USER_ID') != 1){
// 		// 	$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 		// }
// 		if(!empty($ward_no) ) {
// 			$this->db->where('t1.added_ward', $ward_no);
// 		} else {
// 			$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 		}
// 		if(!empty($fiscal_year)) {
// 			$this->db->where('t1.fiscal_year', $fiscal_year);
// 		} else {
// 			$this->db->where('t1.fiscal_year', $this->current_fy);
// 		}
// 		//!empty($fiscal_year)?$this->db->where('t1.fiscal_year', $fiscal_year):$this->db->where('t1.fiscal_year', $this->fy);
// 		// $this->db->order_by('t1.bill_no', 'ASC');
// 		$query = $this->db->get();
// 		//pp($this->db->last_query());
// 		//exit;
// 		return $query->result_array();
  	}


  	public function getNagadiBillDetailsBySearch($topic_id,$from_date,$to_date,$ward,$fiscal_year) {
  	    //echo $topic_id.'/'.$from_date.'/'.$to_date.'/'.$ward.'/'.$fiscal_year;exit;
		$this->db->select('t1.*,t1.bill_no, t1.fiscal_year as fy,t1.added_by,t1.added_ward,t1.added,t2.customer_name,t2.payment_mode,t2.status,t3.topic_name,t4.sub_topic,t5.topic_title,t6.reason,t7.name');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');
		$this->db->join('main_topic t3','t3.id = t1.main_topic','left');
		$this->db->join('topic t4','t4.id = t1.sub_topic','left');
		$this->db->join('sub_topic t5','t5.id = t1.topic','left');
		$this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');
		$this->db->join('users t7','t7.userid = t1.added_by','left');
		if(!empty($topic_id)) {
		    $this->db->where('t1.main_topic',$topic_id);
		}
		if($from_date != '-') {
			$this->db->where('t1.added >=', $from_date);
		}
		if($to_date != '-') {
			$this->db->where('t1.added <=', $to_date);
		}
		if($this->session->userdata('PRJ_USER_GROUP') != 1 && $this->session->userdata('PRJ_USER_WARD')!= 0 ) {
			$this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));
		} else {
			if($ward !='-') {
				if($ward =='palika') {
					$this->db->where('t1.added_ward', '0');
				} else {
					$this->db->where('t1.added_ward',$ward);
				}
			}
		}
		if(!empty($fiscal_year)) {
			$this->db->where('t1.fiscal_year', $fiscal_year);
		}
		$query = $this->db->get();
		return $query->result_array();
  	}

  	/*--------------------------------------------------------------------
				Nagadi bill details
		--------------------------------------------------------------------
	*/
  	public function getNagadiBillDetailsCancel($from_date =NULL,$to_date=NULL, $ward =NULL,$fiscal_year=NULL,$user=NULL) {
		$this->db->select('SUM(t_rates) as cancel_bills')->from('nagadi_amount_details');
		if(!empty($from_date) && !empty($to_date)) {
			$this->db->where('added >=', $from_date);
			$this->db->where('added <=', $to_date);
		}
		if($this->session->userdata('PRJ_USER_ID') != 1){
			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
		}
		if(!empty($ward)) {
			$this->db->where('added_ward', $ward);
		}
		if(!empty($user)){
			$this->db->where('added_by', $user);
		}
		$this->db->where('initial_flag',1);
		!empty($fiscal_year)?$this->db->where('fiscal_year', $fiscal_year):$this->db->where('fiscal_year', $this->fy);
		$query = $this->db->get();
		return $query->row_array();
	}

	//nagadi by topic 
	public function getNagadiBillDetailsByTopic($topic_id =NULL,$from_date =NULL,$to_date=NULL, $ward_no=NULL, $fiscal_year=NULL,$user = NULL) {
		$this->db->select('t1.*,t1.bill_no, t1.fiscal_year as fy,t1.added_by,t1.added_ward,t2.customer_name,t2.payment_mode,t2.status,t3.topic_name,t4.sub_topic,t5.topic_title,t6.reason,t7.name');
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
		if(!empty($from_date) && !empty($to_date)) {
			$this->db->where('t1.added >=', $from_date);
			$this->db->where('t1.added <=', $to_date);
		} else {
			$this->db->where('SUBSTRING(added, 6,2)=',$this->current_month);
		}
// 		if($this->session->userdata('PRJ_USER_ID') != 1 ) {
		    
// 		}
		if(!empty($ward_no) ) {
			$this->db->where('t1.added_ward', $ward_no);
		} else {
		    if($this->session->userdata('PRJ_USER_ID') != 1) {
		        $this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
		    }
		}
		if(!empty($fiscal_year)) {
			$this->db->where('t1.fiscal_year', $fiscal_year);
		} else {
			$this->db->where('t1.fiscal_year', $this->current_fy);
		}
		$query = $this->db->get();
	
		return $query->result_array();
  	}
  	public function getNagadiBillDetailsCancelByTopic($topic_id =NULL,$from_date =NULL,$to_date=NULL, $ward =NULL,$fiscal_year=NULL,$user=NULL) {
		$this->db->select('SUM(t_rates) as cancel_bills')->from('nagadi_amount_details');
		if(!empty($topic_id)) {
			$this->db->where('main_topic', $topic_id);
		}
		if(!empty($from_date) && !empty($to_date)) {
			$this->db->where('added >=', $from_date);
			$this->db->where('added <=', $to_date);
		}
		
		if($this->session->userdata('PRJ_USER_GROUP') == 1 ) {
		    if($ward != 1 ) {
		        $this->db->where('added_ward', $ward);
		    }
		} elseif($this->session->userdata('PRJ_USER_GROUP') == 2 ) {
		    $this->db->where('added_ward', '0');
		} else {
		    $this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		}
		
// 		if($this->session->userdata('PRJ_USER_ID') != 1){
// 			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 		}
// 		if(!empty($ward)) {
// 			$this->db->where('added_ward', $ward);
// 		}
		if(!empty($user)){
			$this->db->where('added_by', $user);
		}
		$this->db->where('initial_flag',1);
		!empty($fiscal_year)?$this->db->where('fiscal_year', $fiscal_year):$this->db->where('fiscal_year', $this->fy);
		$query = $this->db->get();
		return $query->row_array();
	}


	/*--------------------------------------------------------------------
				Sampati Bill Details
		--------------------------------------------------------------------
	*/

	public function getSearchSampatiKarDetailsByMonth() {
		$this->db->select('t1.*, t2.land_owner_name_np, t3.reason,t4.name')->from('sampati_kar_bhumi_kar_bill_details t1');
		$this->db->join('land_owner_profile_basic t2','t2.file_no = t1.nb_file_no','left');
		$this->db->join('sampati_rasid_cancel_reason t3','t3.bill_no = t1.bill_no','left');
		$this->db->join('users t4','t4.userid = t1.added_by','left');
		$this->db->where('SUBSTRING(t1.billing_date, 6,2)=', $this->current_month);
		$this->db->where('t1.fiscal_year',$this->current_fy);
		if($this->session->userdata('PRJ_USER_ID')!= 1 ) {
		    $this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));
// 		}
//         if($this->session->userdata('PRJ_USER_GROUP') == 1 ) {
// 		    //if($ward != '-' ) {
// 		        $this->db->where('t1.added_ward', $ward);
// 		    //}
// 		} elseif($this->session->userdata('PRJ_USER_GROUP') == 2 ) {
// 		    $this->db->where('t1.added_ward', '0');
// 		} else {
// 		    $this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		}
		$this->db->order_by('t1.bill_no','ASC');
		$query = $this->db->get();
		//pp($this->db->last_query());
		return $query->result_array();
	}
    
    public function getCancelSampatikarAmountDetails() {
		$this->db->select('SUM(net_total_amount) as sampati_cancel_bills')->from('sampati_kar_bhumi_kar_bill_details');
		$this->db->where('SUBSTRING(billing_date, 6,2)=', $this->current_month);
		$this->db->where('status',2);
		$this->db->where('fiscal_year',$this->current_fy);
		if($this->session->userdata('PRJ_USER_GROUP') == 1 ) {
		    if($ward != 1 ) {
		        $this->db->where('added_ward', $ward);
		    }
		} elseif($this->session->userdata('PRJ_USER_GROUP') == 2 ) {
		    $this->db->where('added_ward', '0');
		} else {
		    $this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		}
		$query = $this->db->get();
		return $query->row_array();

	}
	
	public function getSearchSampatiKarDetailsBySearch($from_date =NULL,$to_date=NULL, $ward =NULL, $fiscal_year=NULL) {
		$this->db->select('t1.*, t2.land_owner_name_np, t3.reason,t4.name')->from('sampati_kar_bhumi_kar_bill_details t1');
		$this->db->join('land_owner_profile_basic t2','t2.file_no = t1.nb_file_no','left');
		$this->db->join('sampati_rasid_cancel_reason t3','t3.bill_no = t1.bill_no','left');
		$this->db->join('users t4','t4.userid = t1.added_by','left');

		if($from_date != '-') {
			$this->db->where('t1.billing_date >=', $from_date);
		}
		if($to_date != '-') {
			$this->db->where('t1.billing_date <=', $to_date);
		}
		if($this->session->userdata('PRJ_USER_GROUP') == 1 ) {
		    if($ward != 1 ) {
		        $this->db->where('t1.added_ward', $ward);
		    }
		} elseif($this->session->userdata('PRJ_USER_GROUP') == 2 ) {
		    $this->db->where('t1.added_ward', '0');
		} else {
		    $this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));
		}
		if(!empty($fiscal_year)) {
			$this->db->where('t1.fiscal_year', $fiscal_year);
		}
		$this->db->order_by('t1.bill_no','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getCancelSampatikarAmountDetailsBySearch($from_date =NULL,$to_date=NULL,$ward =NULL, $fiscal_year =NULL, $user=NULL) {
		$this->db->select('SUM(net_total_amount) as sampati_cancel_bills')->from('sampati_kar_bhumi_kar_bill_details');
		if(!empty($from_date) && !empty($to_date)) {
			$this->db->where('billing_date >=', $from_date);
			$this->db->where('billing_date <=', $to_date);
		}

        if($this->session->userdata('PRJ_USER_GROUP') == 1 ) {
		    if($ward != 1 ) {
		        $this->db->where('added_ward', $ward);
		    }
		} elseif($this->session->userdata('PRJ_USER_GROUP') == 2 ) {
		    $this->db->where('added_ward', '0');
		} else {
		    $this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));
		}
		
		if(!empty($user)){
			$this->db->where('added_by', $user);
		}
		$this->db->where('status',2);
		if(!empty($fiscal_year)) {
		    $this->db->where('fiscal_year', $fiscal_year);
		}
		$query = $this->db->get();
		//pp($this->db->last_query());
		return $query->row_array();

	}

}