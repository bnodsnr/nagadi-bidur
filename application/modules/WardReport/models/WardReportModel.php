<?php 

/**

 * 

 */

class WardReportModel extends CI_Model

{

	public function __construct()

	{

		parent:: __construct();

      	$this->today = convertdate(date('Y-m-d'));

      	$this->current_month = get_current_month();

	}

	//nagadi daily report

	public function DailyNagadiCollection($topic_id, $ward = NULL,$date =NULL) {

		$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('main_topic', $topic_id);

		// if(!empty($date)) {

		// 	$this->db->where('added', $date);

		// }

		// $this->db->where('added',$this->today);

		$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));

		!empty($date)?$this->db->where('added', $date):$this->db->where('added',$this->today);

		$query =$this->db->get();

		return $query->row_array();

	}



	public function DailySampatiKarCollection() {

		$this->db->select('SUM(net_total_amount) as total');

		$this->db->from('sampati_kar_bhumi_kar_bill_details');

		$this->db->where('billing_date',$this->today);

		$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));

		$query =$this->db->get();

		return $query->row_array();

	}



	public function SearchDailyNagadi($topic_id) {

		$date = $this->input->post('date');

		$ward_no = $this->input->post('ward');



		$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('main_topic', $topic_id);

		$this->db->where('added',$date);

		if(!empty($ward_no)) {

			$this->db->where('added_ward', $ward_no);



		} else {

			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));



		}

		$query =$this->db->get();

		return $query->row_array();

	}



	public function SearchDailySampatiKar() {

		$date = $this->input->post('date');

		$ward = $this->input->post('ward');

		$this->db->select('SUM(net_total_amount) as total');

		$this->db->from('sampati_kar_bhumi_kar_bill_details');

		$this->db->where('billing_date',$date);

		if(!empty($ward)) {

			$this->db->where('added_ward', $ward);

		} else {

			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));

		}

		$query =$this->db->get();

		return $query->row_array();

	}



	/**

		* This function get all billing details by day in report

		* @param date ward.

		* @return array

	*/

	public function getDailyReportDetails($date = NULL, $ward =NULL, $topic_id= NULL) {

		$this->db->select('

			t1.*,
			t1.guid as billid,
			t2.customer_name,

			t2.payment_mode,

			t2.status,

			t3.topic_name,

			t4.sub_topic,

			t5.topic_title,

			t6.reason

		');

		$this->db->from('nagadi_amount_details t1');

		$this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');

		$this->db->join('main_topic t3','t3.id = t1.main_topic','left');

		$this->db->join('topic t4','t4.id = t1.sub_topic','left');

		$this->db->join('sub_topic t5','t5.id = t1.topic','left');

		$this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');

		$this->db->where('t1.added', $date);

		$this->db->where('t1.added_ward', $ward);

		if(!empty($topic_id)) {

			$this->db->where('t1.main_topic', $topic_id);

		}

		$query = $this->db->get();

		return $query->result_array();

	}



	public function getDailySampatiKarDetails($date, $ward ) {

		$this->db->select('t1.*, t2.land_owner_name_np, t3.reason')->from('sampati_kar_bhumi_kar_bill_details t1');

		$this->db->join('land_owner_profile_basic t2','t2.file_no = t1.nb_file_no','left');

		$this->db->join('sampati_rasid_cancel_reason t3','t3.bill_no = t1.bill_no','left');

		$this->db->where('t1.billing_date', $date);

		$this->db->where('t1.added_ward', $ward);

		$query = $this->db->get();

		return $query->result_array();

	}



	/**

		* get all cancel amount 



	*/

	public function getCancelAmountDetailsByDate($date, $ward, $topic_id = NULL ) {

		$this->db->select('SUM(t_total) as cancel_bills')->from('nagadi_rasid');

		$this->db->where('date', $date);

		$this->db->where('added_ward', $ward);

		$this->db->where('status',2);

		$query = $this->db->get();

		return $query->row_array();



	}



	public function getCancelSampatikarAmountDetailsByDate($date, $ward ) {

		$this->db->select('SUM(net_total_amount) as sampati_cancel_bills')->from('sampati_kar_bhumi_kar_bill_details');

		$this->db->where('billing_date', $date);

		$this->db->where('added_ward', $ward);

		$this->db->where('status',2);

		$query = $this->db->get();

		return $query->row_array();



	}



		// public function getNagadiDetailByTopic() {



		// }

	/*--------------------------------------------------------------------------------------------------------*/

	public function getMonthlyCollectionReport($topic_id =NULL,$month =NULL, $ward=NULL){

		$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		if(!empty($topic_id)) {

			$this->db->where('main_topic', $topic_id);

		}

		if(!empty($month)) {

			$this->db->where('MONTH(added)',$month);

		}

		if(!empty($ward)) {

			$this->db->where('added_ward', $ward);

		}

		$query =$this->db->get();

		return $query->row_array();

	}



	/**

		* This function get all billing details by day in report

		* @param date ward.

		* @return array

	*/

	public function getMonthlyReportDetails($month = NULL, $ward =NULL, $topic_id= NULL) {

		$this->db->select('

			t1.*,

			t2.customer_name,

			t2.payment_mode,

			t2.status,

			t3.topic_name,

			t4.sub_topic,

			t5.topic_title,

			t6.reason

		');

		$this->db->from('nagadi_amount_details t1');

		$this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');

		$this->db->join('main_topic t3','t3.id = t1.main_topic','left');

		$this->db->join('topic t4','t4.id = t1.sub_topic','left');

		$this->db->join('sub_topic t5','t5.id = t1.topic','left');

		$this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');

		$this->db->where('MONTH(added)',$month);

		$this->db->where('t1.added_ward', $ward);

		if(!empty($topic_id)) {

			$this->db->where('t1.main_topic', $topic_id);

		}

		$query = $this->db->get();

		return $query->result_array();

	}



	public function getMonthlySampatiKarDetails($date, $ward ) {

		$this->db->select('t1.*, t2.land_owner_name_np, t3.reason')->from('sampati_kar_bhumi_kar_bill_details t1');

		$this->db->join('land_owner_profile_basic t2','t2.file_no = t1.nb_file_no','left');

		$this->db->join('sampati_rasid_cancel_reason t3','t3.bill_no = t1.bill_no','left');

		$this->db->where('MONTH(t1.billing_date)', $date);

		//$this->db->where('t1.billing_date', $date);

		$this->db->where('t1.added_ward', $ward);

		$query = $this->db->get();

		return $query->result_array();

	}





	public function SearchMonthltNagadi($topic_id) {

		$date = $this->input->post('date');

		$ward_no = $this->input->post('ward');

		$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('main_topic', $topic_id);

		$this->db->where('MONTH(added)',$date);

		if(!empty($ward_no)) {

			$this->db->where('added_ward', $ward_no);



		} else {

			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));



		}

		$query =$this->db->get();

		return $query->row_array();

	}



	public function GetPrintMonthltNagadi($topic_id, $ward_no =NULL,$month =NULL) {

		// $date = $this->input->post('date');

		// $ward_no = $this->input->post('ward');

		$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('main_topic', $topic_id);

		$this->db->where('MONTH(added)',$month);

		//if(!empty($ward_no)) {

			$this->db->where('added_ward', $ward_no);



		// } else {

		// 	$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));



		// }

		$query =$this->db->get();

		return $query->row_array();

	}



	public function searchAllReport($topic_id = NULL) {

		$month_search = $this->input->post('month_search');

        $from_date = $this->input->post('from_date');

        $to_date = $this->input->post('to_date');

        $search_ward_no = $this->input->post('search_ward_no');

        //$ward_no = !empty($search_ward_no)? $search_ward_no:$this->session->userdata('PRJ_USER_ID');

        $this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('main_topic', $topic_id);



		if(!empty($month_search)) {

			$this->db->where('MONTH(added)',$month_search);

		}

		if(!empty($from_date)) {

			$this->db->where('added',$from_date);

		}

		if(!empty($from_date) && !empty($to_date)) {

			$this->db->where('added >=', $from_date);

			$this->db->where('added <=', $to_date);

		}

		if(empty($search_ward_no) && $this->session->userdata('PRJ_USER_ID')!= 1) {

			$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));

		}

		if(!empty($search_ward_no)){

			$this->db->where('added_ward', $search_ward_no);

		}

		$query =$this->db->get();

		return $query->row_array();

	}

}