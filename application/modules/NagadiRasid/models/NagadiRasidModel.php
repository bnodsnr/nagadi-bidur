<?php



class NagadiRasidModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->fy = current_fiscal_year();
    }
    public function getNagadiRasidList() {

        $date = convertDate('Y-m-d');

        $user_data = $this->session->userdata('PRJ_USER_ID');

        $this->db->select('*')->from('nagadi_rasid');

        if($user_data != 1) {

            $this->db->where('added_by',$user_data);

        }

        $this->db->where('date', convertDate(date('Y-m-d')));

        $query = $this->db->get();

        return $query->result_array();

    }



	//get bill no

	public function getBillNo() {

		$this->db->select('*');

		$this->db->from('settings_bill_setup');

		$this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));

        $this->db->where('bill_type',1);

		$query = $this->db->get();

		return $query->row_array();

	}

    public function getActiveBill() {
        $this->db->select('*');
        $this->db->from('settings_bill_setup');
        $this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('bill_type',1);
        $this->db->where('status', 1 );
        $this->db->where('fiscal_year', $this->fy);
        $query = $this->db->get();
        return $query->row_array();
    }



	//get sub topic by main topic

	public function getSubTopicByMainTopic($main_topic) {

        $fy = current_fiscal_year();

		$this->db->select('*');

		$this->db->from('topic');

		$this->db->where('main_topic',$main_topic);

		$query = $this->db->get();

		return $query->result_array();		

	}

	//get subtopic details by id

	public function getSubTopicByID($id) {

		return $this->db->select('*')

						->from('sub_topic')

						->where('id',$id)

						->get()

						->row_array();

	}



	public function getUserDetails($added_by = NULL) {

        return $this->db->select('*')

                        ->from('users')

                        ->where('userid', $added_by)

                        ->get()

                        ->row();

    }

    public function bill_exists($bill_no)
    {
        $this->db->where('bill_no', $bill_no);
        $this->db->where('fiscal_year', $this->fy);
        $query = $this->db->get('nagadi_rasid');
        if ($query->num_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    //insert bill details

    public function insertBillDetails($post_data) {
    	$query = $this->db->insert('nagadi_rasid',$post_data);
        if($query){
    	   return $this->db->insert_id();
        } else {
            return FALSE;
        }


    }



    public function saveNagadiAmountDetails($post_data) {

    	$this->db->trans_start();

    	$this->db->insert_batch('nagadi_amount_details',$post_data);

    	$this->db->trans_complete();        

    	return ($this->db->trans_status() === FALSE)? FALSE:TRUE;

    }



    public function saveOthersNagadiAmountDetails($post_data) {

        $this->db->trans_start();

        $this->db->insert_batch('nagadi_amount_details',$post_data);

        $this->db->trans_complete();        

        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;

    }



    public function getViewBillDetails($id) {

    	return $this->db->select('*')

    					->from('nagadi_rasid')

    					->where('id', $id)

    					->get()

    					->row_array();

    }



    public function getViewBillDetailsByGuid($guid) {

        return $this->db->select('*')

                        ->from('nagadi_rasid')

                        ->where('guid', $guid)

                        ->get()

                        ->row_array();

    }

    public function getNagadiMainDetails($id) {

        $this->db->select('t1.*,t1.sub_topic as st,t2.topic_name,t2.topic_no,t3.sub_topic, t3.id as subtopic_id, t4.topic_title,t4.is_percent');

        $this->db->from('nagadi_amount_details as t1');

        $this->db->join('main_topic as t2','t2.id = t1.main_topic','left');

        $this->db->join('topic as t3','t3.id = t1.sub_topic','left');
        $this->db->join('sub_topic as t4','t4.id = t1.topic','left');
        $this->db->where('t1.guid',$id);
        $query = $this->db->get();
        return $query->result_array();

    }

    //get bill no
    public function checkBill() {
        $this->db->select('*');
        $this->db->from('nagadi_rasid');
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('fiscal_year', $this->fy);
        $this->db->order_by('id', "DESC");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function GetMaxBillNo()
    {
        $maxid = 0;
        $row = $this->db->query("SELECT MAX('bill_no') AS `bill_no` FROM `nagadi_rasid` where user_id")->row();
        return $row;
    }

    //get bill range by user

    public function getBillRange() {
        $this->db->select('*');
        $this->db->from('settings_bill_setup');
        $this->db->where('bill_type', 1);
        $this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));
        //$this->db->where('status !=',1);
        $query = $this->db->get();
        return $query->row_array();

    }

    public function getBillRangeLast() {
        $this->db->select('*');
        $this->db->from('settings_bill_setup');
        $this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('bill_type', 1);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->row_array();
    }



    /*

        * on Ajax call this function return the list of topic details with rate 

        @param int sub topic id

        return array

    */

    public function getTopicRate($subtopic) {

        $fy = get_current_fiscal_year();

       

        $condition = array(

            'sub_topic' => $subtopic,

            'fiscal_year' => $fy

        );

        return $this->db->select('*')->from('sub_topic')

                                    ->where($condition)

                                    ->get()

                                    ->result_array();



    }

    public function getTopicRateDetailsByID($topic) {

        $fiscal_year = get_current_fiscal_year();

        $condition = array(

            'id' => $topic,

            'fiscal_year' => $fiscal_year

        );

        return $this->db->select('*')->from('sub_topic')

                                    ->where($condition)

                                    ->get()

                                    ->row_array();



    }



     //update rate details

    public function updateNagadiDetails($id, $update_array) {

        $this->db->trans_start();

        $this->db->where('id', $id);

        $this->db->update('nagadi_rasid',$update_array);

        $this->db->trans_complete();

        // was there any update or error?

        if ($this->db->affected_rows() == '1') {

            return TRUE;

        } else {

            // any trans error?

            if ($this->db->trans_status() === FALSE) {

                return false;

            }

            return true;

        }

    }



    //update batch for nadadi billing details

    public function updateBillingDetails($id, $post_array) {

        $this->db->trans_start();

        //$this->db->where('guid', $id);

        $this->db->update_batch('nagadi_amount_details',$post_array,'id');

        $this->db->trans_complete();

        // was there any update or error?

        if ($this->db->affected_rows() == '1') {

            return TRUE;

        } else {

            // any trans error?

            if ($this->db->trans_status() === FALSE) {

                return false;

            }

            return true;

        }

    }



    //count all details

    public function getCountNagadiMainDetails($guid = 0) {

        return $this->db->where('guid', $guid)->count_all_results('nagadi_amount_details');

    }



    //update report

    public function updateReport() {

        $post = $this->input->post();

        $ward                   = $post['ward_no'];

        $t_total                = $post['t_total'];

        $main_topic             = $post['main_topic'];

        $mt = implode(',', $main_topic);



        if($ward == 0) {

           $where = 'ward_0';

        }

        if($ward == 1) {

          $where = 'ward_1';

        }

        if($ward == 2) {

           $where = 'ward_2';

        }

        if($ward == 3) {

            $where = 'ward_3';

        }

        if($ward == 4) {

           $where = 'ward_4';

        }

        if($ward == 5) {

           $where = 'ward_5';

        }

        if($ward == 6) {

            $where = 'ward_6';

        }

        if($ward == 7) {

            $where = 'ward_7';

        }

        if($ward == 8) {

           $where = 'ward_8';

        }

        if($ward == 9) {

            $where = 'ward_9';

        }

        if($ward == 10) {

            $where = 'ward_10';

        }

        if($ward == 11) {

            $where = 'ward_11';

        }

        if($ward == 12) {

            $where = 'ward_12';

        }

         if($ward == 13) {

            $where = 'ward_12';

        }



        if($ward == 0) {

            $post_array = array(

                'ward_0' => $t_total,

            );

        }

        if($ward == 1) {

          $post_array = array(

                'ward_1' => $t_total,

            );

        }

        if($ward == 2) {

            $post_array = array(

                'ward_2' => $t_total,

            );

        }

        if($ward == 3) {

            $post_array = array(

                'ward_3' => $t_total,

            );

        }

        if($ward == 4) {

          $post_array = array(

                'ward_4' => $t_total,

            );

        }

        if($ward == 5) {

           $post_array = array(

                'ward_5' => $t_total,

            );

        }

        if($ward == 6) {

           $post_array = array(

                'ward_6' => $t_total,

            );

        }

        if($ward == 7) {

            $post_array = array(

                'ward_7' => $t_total,

            );

        }

        if($ward == 8) {

           $post_array = array(

                'ward_8' => $t_total,

            );

        }

        if($ward == 9) {

            $post_array = array(

                'ward_9' => $t_total,

            );

        }

        if($ward == 10) {

            $post_array = array(

                'ward_10' => $t_total,

            );

        }

        if($ward == 11) {

            $post_array = array(

                'ward_11' => $t_total,

            );

        }

        if($ward == 12) {

           $post_array = array(

                'ward_12' => $t_total,

            );

        }

         if($ward == 13) {

            $post_array = array(

                'ward_13' => $t_total,

            );

        }

        foreach ($main_topic as $key => $value) {

          $data = $this->getTotalUsingMTopic($main_topic[$key]);

          $this->db->where('m_topic',$main_topic[$key]);

          $this->db->update('nagadi_ward_report', $post_array);      

        }

    }



    //select total value using 

    public function getTotalUsingMTopic($main_topic) {

         $this->db->select('*')->from('nagadi_ward_report');

        //$this->db->where($where, $ward);

        $this->db->where('m_topic', $main_topic);

        $result = $this->db->get()->row();

        return $result;

    }





    /**

     * This function on ajax call get list of land owner profile

     * This function is used for datatables for server side uses

     * @param INT $limit, INT $start, INT $col, INT $fiscal, INT $fiscal_year

     * @return json

    */

    public function GetAllBills($limit,$start,$col,$dir, $name =NULL,$bill_no =NULL,$from_date =NULL,$status=NULL,$fiscal_year=NULL)

    {  

        $this->db->select('t1.*, t2.name as user_name')->from('nagadi_rasid t1');

        $this->db->join('users t2', 't2.userid = t1.added_by','left');

        if(!empty($bill_no)){

            $this->db->where('t1.bill_no', $bill_no);

        }
        if(!empty($from_date)) {

            $this->db->where('t1.date', $from_date);

        }

        if(!empty($status)) {

            $this->db->where('t1.status', $status);

        }

        

         if(!empty($name)) {

            $this->db->like('t1.customer_name', $name);

        }


        // $this->db->where('t1.added_by', $this->session->userdata('PRJ_USER_ID'));
        if($this->session->userdata('PRJ_USER_ID') != 1) {

            // $this->db->where('t1.added_ward',$this->session->userdata('PRJ_USER_WARD'));
            $this->db->where('t1.added_by', $this->session->userdata('PRJ_USER_ID'));

        }

        if(!empty($fiscal_year)) {
            $this->db->where('t1.fiscal_year', $fiscal_year);
        } else {
            $this->db->where('t1.fiscal_year', $this->fy);
        }

        $this->db->limit($limit, $start);

        $this->db->order_by('t1.'.$col,$dir);

        $query = $this->db->get();

        if($query->num_rows()>0)

        {

            return $query->result(); 

        }

        else

        {

            return null;

        }

        

    }



    /**

     * This function on ajax call get list of land owner profile

     * This function is used for datatables for server side uses

     * @param INT $limit, INT $start, INT $col, INT $fiscal, INT $fiscal_year

     * @return json

    */

    public function CountBills($name= NULL, $bill_no = NULL, $from_date =NULL, $status = "", $fiscal_year =NULL)

    {

        $this->db->select('*')->from('nagadi_rasid');



        if(!empty($bill_no)){

            $this->db->where('bill_no', $bill_no);

        }



        if(!empty($from_date)) {

            $this->db->where('date', $from_date);

        }



        if(!empty($status)) {

            $this->db->where('status', $status);

        }



        if(!empty($name)) {

            $this->db->like('customer_name', $name);

        }


    // $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));


        if($this->session->userdata('PRJ_USER_ID') != 1) {

            $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));

        }

        if(!empty($fiscal_year)) {
            $this->db->where('fiscal_year', $fiscal_year);
        } else {
            $this->db->where('fiscal_year', $this->fy);
        }

        $query = $this->db->get();

        return $query->num_rows();

    }



    public function getReason($bill_no) {

        if(empty($bill_no)) {

            return false;

        } else {

            $this->db->select('*')->from('nagadi_cancle_reason');

            $this->db->where('trans_id', $bill_no);

            $query = $this->db->get();

            return $query->row_array();

        }

    }



    public function getAllCancelBills() {

        $this->db->select('t1.*,t2.customer_name,t2.guid, t3.name,t4.name as canname')->from('nagadi_cancle_reason t1');

        $this->db->join('nagadi_rasid t2','t2.bill_no = t1.bill_no', 'left');

        $this->db->join('users t3','t3.userid = t2.added_by', 'left');
        $this->db->join('users t4','t4.userid = t1.added_by', 'left');

        if($this->session->userdata('PRJ_USER_ID') != 1 ) {

            $this->db->where('t2.added_ward', $this->session->userdata('PRJ_USER_WARD'));

        }
      
        $this->db->order_by('t1.date','DESC');

        $query = $this->db->get();

        return $query->result_array();

    }

    public function updateTotalRates($amount, $guid) {

        $data = array('t_total' => $amount);

        $this->db->where('guid', $guid);

        $query = $this->db->update('nagadi_rasid', $data);

        if($query) {

            return TRUE;

        } else {

            return FALSE;

        }

    }
    
    public function getInactiveBills() {
        $this->db->select('*')->from('settings_bill_setup');
        $this->db->where('status !=', 1);
        $this->db->where('bill_type', 1);
        $this->db->where('fiscal_year', $this->fy);
        $this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->row_array();
    }

}

