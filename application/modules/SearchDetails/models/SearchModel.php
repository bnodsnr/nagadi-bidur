<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class SearchModel extends CI_Model
{
/*-------------------------------------------------------------------------------------
search
-----------------------------------------------------------------------------------------*/

    public function getNagadiSearchDetails($from_date =NULL,$to_date=NULL, $ward=NULL, $fiscal_year=NULL,$user = NULL) {
        //exit;
        $this->db->select('t1.*,t1.bill_no,t1.added_by,t1.added_ward,t2.customer_name,t2.payment_mode,t2.status,t3.topic_name,t4.sub_topic,t5.topic_title, t6.reason,
            t7.name');
        $this->db->from('nagadi_amount_details t1');
        $this->db->join('nagadi_rasid t2', 't2.guid = t1.guid', 'left');
        $this->db->join('main_topic t3','t3.id = t1.main_topic','left');
        $this->db->join('topic t4','t4.id = t1.sub_topic','left');
        $this->db->join('sub_topic t5','t5.id = t1.topic','left');
        $this->db->join('nagadi_cancle_reason t6','t6.trans_id = t2.id','left');
        $this->db->join('users t7','t7.userid = t1.added_by','left');
        if($from_date!='-' && $to_date !='-') {
            $this->db->where('t1.added >=', $from_date);
            $this->db->where('t1.added <=', $to_date);
        }
        if($this->session->userdata('PRJ_USER_ID') != 1){
            //$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
            $this->db->where('t1.added_by', $this->session->userdata('PRJ_USER_ID'));
        } else {
            if($ward != '-' && !empty($ward)) {
                if($ward == 'palika') {
                    $this->db->where('t1.added_ward','0');
                } else {
                    $this->db->where('t1.added_ward', $ward);
                }
            }
        }
        if($fiscal_year != '-') {
            $this->db->where('t1.fiscal_year', $fiscal_year);
        }
        if(!empty($user)) {
            $this->db->where('t1.added_by', $user);
        }
        $this->db->order_by('t1.added', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getCancelAmountDetailsBySearch($from_date =NULL,$to_date=NULL, $ward =NULL,$fiscal_year=NULL,$user=NULL) {
        $this->db->select('SUM(t_rates) as cancel_bills')->from('nagadi_amount_details');
        if($from_date!='-' && $to_date !='-') {
            $this->db->where('added >=', $from_date);
            $this->db->where('added <=', $to_date);
        }
        if($this->session->userdata('PRJ_USER_ID') != 1){
            $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        } else {
            if($ward != '-' && !empty($ward)) {
                if($ward == 'palika') {
                    $this->db->where('added_ward','0');
                } else {
                    $this->db->where('added_ward', $ward);
                }
            }
        }
        if($fiscal_year != '-') {
            $this->db->where('fiscal_year', $fiscal_year);
        }
        if(!empty($user)) {
            $this->db->where('added_by', $user);
        }
        $this->db->where('initial_flag',1);
        !empty($fiscal_year)?$this->db->where('fiscal_year', $fiscal_year):$this->db->where('fiscal_year', $this->fy);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getSearchSampatiKarDetails($from_date =NULL,$to_date=NULL, $ward =NULL, $fiscal_year, $user=NULL) {
        $this->db->select('t1.*, t2.land_owner_name_np, t3.reason,t4.name')->from('sampati_kar_bhumi_kar_bill_details t1');
        $this->db->join('land_owner_profile_basic t2','t2.file_no = t1.nb_file_no','left');
        $this->db->join('sampati_rasid_cancel_reason t3','t3.bill_no = t1.bill_no','left');
        $this->db->join('users t4','t4.userid = t1.added_by','left');
        if($from_date!='-' && $to_date !='-') {
            $this->db->where('t1.billing_date >=', $from_date);
            $this->db->where('t1.billing_date <=', $to_date);
        }
        if($this->session->userdata('PRJ_USER_ID') != 1){
            //$this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
            $this->db->where('t1.added_by', $this->session->userdata('PRJ_USER_ID'));
        } else {
            if($ward != '-' && !empty($ward) ) {
                if($ward == 'palika') {
                    $this->db->where('t1.added_ward','0');
                } else {
                    $this->db->where('t1.added_ward', $ward);
                }
            }
        }
        if(!empty($user)){
            $this->db->where('t1.added_by', $user);
        }
        if($fiscal_year != '-') {
            $this->db->where('t1.fiscal_year', $fiscal_year);
        }
        if(!empty($user)) {
            $this->db->where('t1.added_by', $user);
        }
        $this->db->order_by('t1.bill_no','ASC');
        $query = $this->db->get();
        //PP($this->db->last_query());
        return $query->result_array();
    }
    public function getCancelSampatikarAmountDetailsBySearch($from_date =NULL,$to_date=NULL,$ward =NULL, $fiscal_year =NULL, $user=NULL) {
        $this->db->select('SUM(net_total_amount) as sampati_cancel_bills')->from('sampati_kar_bhumi_kar_bill_details');
        if($from_date!='-' && $to_date !='-') {
            $this->db->where('billing_date >=', $from_date);
            $this->db->where('billing_date <=', $to_date);
        }
        if($this->session->userdata('PRJ_USER_ID') != 1){
            $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
            //$this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
        } else {
            if($ward != '-' && !empty($ward) ) {
                if($ward == 'palika') {
                    $this->db->where('added_ward','0');
                } else {
                    $this->db->where('added_ward', $ward);
                }
            }
        }
        if($this->session->userdata('PRJ_USER_ID') != 1){
            $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
        }
        if(!empty($user)){
            $this->db->where('added_by', $user);
        }
        if($fiscal_year != '-') {
            $this->db->where('fiscal_year', $fiscal_year);
        }
        if(!empty($user)) {
            $this->db->where('added_by', $user);
        }
        $this->db->where('status',2);
        !empty($fiscal_year)?$this->db->where('fiscal_year', $fiscal_year):$this->db->where('fiscal_year', $this->fy);
        $query = $this->db->get();
        return $query->row_array();
    }
}