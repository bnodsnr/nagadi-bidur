<?php 

/**

 * 

 */

class DailyReportModel extends CI_Model

{

	public function __construct()

	{

		parent:: __construct();

      	$this->today = convertdate(date('Y-m-d'));

      	$this->current_month = get_current_month();

	}

	//nagadi daily report

	public function DailyNagadiCollection($topic_id,$date =NULL,$ward = NULL) {
		$this->db->select('SUM(t_rates) as total');
		$this->db->from('nagadi_amount_details');
		if(!empty($topic_id)) {
			$this->db->where('main_topic', $topic_id);
		}
		!empty($date)?$this->db->where('added', $date):$this->db->where('added',$this->today);
        
        if(!empty($ward_no)) {
		    $this->db->where('added_ward',$ward_no);
		} else {
		    if($this->session->userdata('PRJ_USER_ID') !=1){
		  	!empty($ward_no)?$this->db->where('added_ward', $ward_no):$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));  
		    }
		}
		
		$this->db->where('initial_flag !=', 1);

		$query =$this->db->get();

		return $query->row_array();

	}



	public function DailySampatiKarCollection($date = NULL, $ward_no =NULL) {

		$this->db->select('SUM(net_total_amount) as total');

		$this->db->from('sampati_kar_bhumi_kar_bill_details');

		!empty($date)?$this->db->where('billing_date', $date):$this->db->where('billing_date',$this->today);
		if(!empty($ward_no)) {
		    $this->db->where('added_ward',$ward_no);
		} else {
		    if($this->session->userdata('PRJ_USER_ID') !=1){
		  	!empty($ward_no)?$this->db->where('added_ward', $ward_no):$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));  
		    }
		}
		
        $this->db->where('status',1);
		$query =$this->db->get();

		return $query->row_array();

	}

	public function getDailyDetailsByTopic($date = NULL, $ward =NULL, $topic_id= NULL) {
		$this->db->select('
			t1.*,
			t2.customer_name,
			t2.payment_mode,
			t2.status,
			t3.topic_name,
			t4.sub_topic,
			t5.topic_title,
			t6.reason,
			t7.name
		');
		$this->db->from('nagadi_amount_details t1');
		$this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');
		$this->db->join('main_topic t3','t3.id = t1.main_topic','left');
		$this->db->join('topic t4','t4.id = t1.sub_topic','left');
		$this->db->join('sub_topic t5','t5.id = t1.topic','left');
		$this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');
		$this->db->join('users t7','t7.userid = t1.added_by','left');
		// $this->db->where('t1.added', $date);
		// $this->db->where('t1.added_ward', $ward);
		if(!empty($topic_id)) {
			$this->db->where('t1.main_topic', $topic_id);
		}
		!empty($date)?$this->db->where('t1.added', $date):$this->db->where('t1.added',$this->today);
		
		if(!empty($ward)) {
		    $this->db->where('t1.added_ward',$ward);
		} else {
		    if($this->session->userdata('PRJ_USER_ID') !=1){
		  	!empty($ward_no)?$this->db->where('t1.added_ward', $ward):$this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));  
		    }
		}
		
// 		if($this->session->userdata('PRJ_USER_ID') !=1) {
// 		    $this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 		} else {
// 		    if(!empty($ward)) {
// 		        $this->db->where('t1.added_ward',$ward);
// 		    }
// 		}
// 		if(!empty($ward)) {
		    
// 		}
// // 		if($this->session->userdata('PRJ_USER_ID') != 1) {
// 		    !empty($ward)?$this->db->where('t1.added_ward', $ward):$this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));
// 		}
		
		$query = $this->db->get();
		return $query->result_array();
	}



	public function getDailySampatiKarDetails($date, $ward ) {

		$this->db->select('t1.*, t2.land_owner_name_np, t3.reason,t4.name')->from('sampati_kar_bhumi_kar_bill_details t1');

		$this->db->join('land_owner_profile_basic t2','t2.file_no = t1.nb_file_no','left');

		$this->db->join('sampati_rasid_cancel_reason t3','t3.bill_no = t1.bill_no','left');
		$this->db->join('users t4','t4.userid = t1.added_by','left');

		$this->db->where('t1.billing_date', $date);
		
		if(!empty($ward_no)) {
		    $this->db->where('added_ward',$ward_no);
		} else {
		    if($this->session->userdata('PRJ_USER_ID') !=1){
		  	!empty($ward_no)?$this->db->where('t1.added_ward', $ward_no):$this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));  
		    }
		}
		
// 		if($this->session->userdata('PRJ_USER_ID') !=1) {
// 		    $this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 		} else {
// 		    if(!empty($ward)) {
// 		        $this->db->where('t1.added_ward',$ward);
// 		    }
// 		}

		//$this->db->where('t1.added_ward', $ward);

		$query = $this->db->get();

		return $query->result_array();

	}



	/**

		* get all cancel amount 



	*/

	public function getCancelAmountDetailsByDate($date, $ward, $topic_id = NULL ) {

		$this->db->select('SUM(t_total) as cancel_bills')->from('nagadi_rasid');

		$this->db->where('date', $date);
		
		if(!empty($ward)) {
		    $this->db->where('added_ward',$ward);
		} else {
		    if($this->session->userdata('PRJ_USER_ID') !=1){
		  	!empty($ward_no)?$this->db->where('added_ward', $ward):$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));  
		    }
		}
		
//         if($this->session->userdata('PRJ_USER_ID') !=1) {
// 		    $this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 		} else {
// 		    if(!empty($ward)) {
// 		        $this->db->where('t1.added_ward',$ward);
// 		    }
// 		}
		//$this->db->where('added_ward', $ward);

		$this->db->where('status',2);

		$query = $this->db->get();

		return $query->row_array();



	}



	public function getCancelSampatikarAmountDetailsByDate($date, $ward ) {

		$this->db->select('SUM(net_total_amount) as sampati_cancel_bills')->from('sampati_kar_bhumi_kar_bill_details');

		$this->db->where('billing_date', $date);
        
        if(!empty($ward)) {
		    $this->db->where('added_ward',$ward);
		} else {
		    if($this->session->userdata('PRJ_USER_ID') !=1){
		  	!empty($ward_no)?$this->db->where('added_ward', $ward):$this->db->where('added_ward',$this->session->userdata('PRJ_USER_WARD'));  
		    }
		}
		//$this->db->where('added_ward', $ward);
// 		if($this->session->userdata('PRJ_USER_ID') !=1) {
// 		    $this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
// 		} else {
// 		    if(!empty($ward)) {
// 		        $this->db->where('t1.added_ward',$ward);
// 		    }
// 		}

		$this->db->where('status',2);

		$query = $this->db->get();

		return $query->row_array();

	}



	public function getNagadiDailyDetails($date = NULL,$ward_no =NULL) {

		$this->db->select('t1.*, t2.reason')->from('nagadi_rasid  t1');

		$this->db->join('nagadi_cancle_reason t2','t2.bill_no = t1.bill_no','left');

		if(!empty($date)) {

			$this->db->where('t1.date', $date);

		}

// 		if(!empty($ward_no)) {

// 			$this->db->where('t1.added_ward', $ward_no);

// 		}
        
        if(!empty($ward)) {
		    $this->db->where('t1.added_ward',$ward);
		} else {
		    if($this->session->userdata('PRJ_USER_ID') !=1){
		  	!empty($ward_no)?$this->db->where('t1.added_ward', $ward):$this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));  
		    }
		}
		
		$query = $this->db->get();

		return $query->result_array();

	}

	public function getDailyBillDetails($guid) {

		$this->db->select('t1.*,t2.topic_name,t3.sub_topic,t4.topic_title')->from('nagadi_amount_details t1');

		$this->db->join('main_topic t2','t2.id = t1.main_topic','left');

		$this->db->join('topic t3','t3.id = t1.sub_topic','left');

		$this->db->join('sub_topic t4','t4.id = t1.topic','left');

		$this->db->where('guid', $guid);

		$query = $this->db->get();

		return $query->result_array();

	}

}