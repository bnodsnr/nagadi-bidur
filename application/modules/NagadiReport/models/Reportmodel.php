<?php 

/**

 * 

 */

class Reportmodel extends CI_Model

{
    public function __contruct() {
        parent::__consturct();
        $this->fy = current_fiscal_year();
    }
    
    public function __construct()
	{
		parent:: __construct();
		$this->fy = current_fiscal_year();
	}
	//get data by ward and topic title

	public function getNagadiTotalByTopic($topic,$ward) {
		$fiscal_year = $this->input->post('fiscal_year');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		
		$this->db->select('SUM(t_rates) as total');
		$this->db->from('nagadi_amount_details');
		$this->db->where('main_topic', $topic);
		if(!empty($from_date)) {
			$this->db->where('added >=', $from_date);
		}
		if(!empty($to_date)) {
			$this->db->where('added <=', $to_date);
		}
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year',$fiscal_year);
		} else {
		    $this->db->where('fiscal_year', $this->fy);
		}
		$this->db->where('added_ward', $ward);
		$this->db->where('initial_flag !=',1);
		$query = $this->db->get();
		return $query->row(); 
	}



	public function getNagadiTotalByMT($topic) {
	    $fiscal_year = $this->input->post('fiscal_year');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$this->db->select('SUM(t_rates) as total');
		$this->db->from('nagadi_amount_details');
		$this->db->where('main_topic', $topic);
		$this->db->where('initial_flag !=', 1);
        if(!empty($from_date)) {
			$this->db->where('added >=', $from_date);
		}
		if(!empty($to_date)) {
			$this->db->where('added <=', $to_date);
		}
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year',$fiscal_year);
		} else {
		    $this->db->where('fiscal_year', $this->fy);
		}
	//	$this->db->where('added_ward', $ward);
		$query = $this->db->get();
	//	pp($this->db->last_query());
		return $query->row(); 

	}



	public function getNagadiTotalByWard($ward) {
	    
		$fiscal_year = $this->input->post('fiscal_year');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		
		$this->db->select('SUM(t_rates) as total');
		$this->db->from('nagadi_amount_details');
		$this->db->where('added_ward', $ward);
	    if(!empty($from_date)) {
			$this->db->where('added >=', $from_date);
		}
		if(!empty($to_date)) {
			$this->db->where('added <=', $to_date);
		}
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year',$fiscal_year);
		} else {
		    $this->db->where('fiscal_year', $this->fy);
		}
		$this->db->where('initial_flag !=', 1);
        //$this->db->where('fiscal_year', $this->fy);
		$query = $this->db->get();
		return $query->row(); 

	}

	//search total report
	// public function searchNagadiTotalByWard($ward) {
	// 	$date = $this->input->post('date');
	// 	$month = $this->input->post('month');
		
	// 	$this->db->select('SUM(t_rates) as total');

	// 	$this->db->from('nagadi_amount_details');

	// 	$this->db->where('added_ward', $ward);
		
	// 		$this->db->where('added', $date);
		
	// 		$this->db->where('SUBSTRING(added, 6,2)=',$month);
		
	// 	$this->db->where('initial_flag !=', 1);

	// 	$query = $this->db->get();

	// 	return $query->row(); 

	// }

	/*--------------------------------------------------------------------------------------

		//daily report

	/*---------------------------------------------------------------------------------------*/



	public function getNagadiTotalByTopicD($topic = NULL ,$ward= NULL, $date = NULL) {

		

		$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('main_topic', $topic);

		$this->db->where('added_ward', $ward);

		if(!empty($date)) {

			$this->db->where('added', $date);

		}
		$this->db->where('initial_flag !=', 1);
		$query = $this->db->get();
        $this->db->where('fiscal_year', $this->fy);
		return $query->row(); 

	}



	public function getNagadiTotalByMTD($topic = NULL,$date = NULL) {

		$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('main_topic', $topic);

		

		if(!empty($date)) {

			$this->db->where('added', $date);

		}
		$this->db->where('initial_flag !=', 1);
		$this->db->where('fiscal_year', $this->fy);
		$query = $this->db->get();

		return $query->row(); 

	}



	public function getNagadiTotalByWardD($ward,$date = NULL) {

		$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

		$this->db->where('added_ward', $ward);

		if(!empty($date)) {

			$this->db->where('added', $date);

		}
		$this->db->where('initial_flag !=', 1);
		$this->db->where('fiscal_year', $this->fy);
		$query = $this->db->get();



		return $query->row(); 

	}



    public function getNagadiMonthlyTotal($month =NULL, $ward =NULL, $main_topic= NULL) {

    	$this->db->select('SUM(t_rates) as total');

		$this->db->from('nagadi_amount_details');

    	$this->db->where('added_ward', $ward);

    	// $this->db->where('SUBSTRING(added, 6,2)', $month);
    	$this->db->where('SUBSTRING(added, 6,2)=',$month);

    	$this->db->where('main_topic', $main_topic);
    	$this->db->where('initial_flag !=', 1);
    	$this->db->where('fiscal_year', $this->fy);
    	$query = $this->db->get();

    	return $query->row();

    }

    //get sampati details by ward
    public function getSampatiTotalByWard($ward) {
        
        $fiscal_year = $this->input->post('fiscal_year');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
	
    	$this->db->select('SUM(net_total_amount) as sampati_total');
    	$this->db->from('sampati_kar_bhumi_kar_bill_details');
    	if(!empty($from_date)) {
			$this->db->where('billing_date >=', $from_date);
		}
		if(!empty($to_date)) {
			$this->db->where('billing_date <=', $to_date);
		}
		if(!empty($fiscal_year)) {
			$this->db->where('fiscal_year',$fiscal_year);
		} else {
		    $this->db->where('fiscal_year', $this->fy);
		}
    	$this->db->where('added_ward', $ward);
    	$this->db->where('status',1);
    	$query = $this->db->get();
    //	print_r($this->db->last_query());
    	return $query->row();
    }

}