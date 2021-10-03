<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class Importdatamodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //get sadak data
    public function getSadakData() {
        $this->db->select(
            't1.* ,t1.fiscal_year as fy ,t2.*'
        );
        $this->db->from('settings_road t1');
        $this->db->join('settings_road_type t2' ,'t2.id = t1.road_type','left');
        $query = $this->db->get();
        return $query->result_array();
    }

    //nagadi detials
    public function getNagadiDetails($fiscal_year, $month) {
        $this->db->select('*')->from('nagadi_rasid');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(date)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('initial_flag', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    //getNagadiAmountDetails
    public function getNagadiAmountDetails($fiscal_year, $month) {
        $this->db->select('*')->from('nagadi_amount_details');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->result_array();
    }
    //getNagadiCancelBills
    public function getNagadiCancelBills($fiscal_year = NULL, $month) {
        $this->db->select('*')->from('nagadi_cancle_reason');
        $this->db->where('month(date)',$month);
        $query = $this->db->get();
        return $query->result_array();
    }

    //getProfileDetails
    public function getProfileDetails($fiscal_year, $month) {
        $this->db->select('*')->from('land_owner_profile_basic');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->result_array();
    }

    //get famaily details
    public function getFamailyDetails($fiscal_year=NULL, $month) {
        $this->db->select('*')->from('land_owner_family_details');
        //$this->db->where('fiscal_year', $fiscal_year);
        //echo $this->session->userdata('PRJ_USER_ID');exit;
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->result_array();
    }

    //getLandDetails
    public function getLandDetails($fiscal_year, $month) {
        $this->db->select('*')->from('land_description_details');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->result_array();
    }

    //getSanrachanaDetails
    public function getSanrachanaDetails($fiscal_year, $month) {
        $this->db->select('*')->from('sanrachana_details');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->result_array();
    }

    //getBDetails
    public function getBDetails($fiscal_year, $month) {
        $this->db->select('*')->from('ba_details');
        //$this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getsampatiKarDetails($fiscal_year, $month) {
        $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->result_array();
    }
}