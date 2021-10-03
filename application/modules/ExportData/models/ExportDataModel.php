<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class ExportDataModel extends CI_Model
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
        // $added_by = $this->session->userdata('PRJ_USER_ID');
        // $sql = "SELECT * 
        //         FROM nagadi_rasid 
        //         WHERE added_by = '{$added_by}' AND MONTH(date) = '{$month}' AND added_by = '{$added_by}'AND initial_flag = '0' ";
        //         $query = $this->db->query($sql);
        //         return $query->result_array();
        $this->db->select('*')->from('nagadi_rasid');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(date)',$month);
        $this->db->where('initial_flag','0');
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->result_array();
    }

    //update selected data
    public function UpdateNagadiRasid($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('nagadi_rasid', $post_array);
        return TRUE;
    }
    //getNagadiAmountDetails
    public function getNagadiAmountDetails($fiscal_year, $month) {
        $this->db->select('*')->from('nagadi_amount_details');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('initial_flag','0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateNagadiAmountDetails($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('nagadi_amount_details', $post_array);
        return TRUE;
    }
    //getNagadiCancelBills
    public function getNagadiCancelBills($fiscal_year = NULL, $month) {
        $this->db->select('*')->from('nagadi_cancle_reason');
        $this->db->where('month(date)',$month);
        $this->db->where('initial_flag','0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateNagadiCancelBills($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('nagadi_cancle_reason', $post_array);
        return TRUE;
    }
    // public function UpdateNagadiAmountDetails($id) {
    //     $post_array = array('initial_flag'=>1);
    //     $this->db->where_in('id', $id);
    //     $this->db->update('nagadi_rasid', $post_array);
    //     return TRUE;
    // }

    //getProfileDetails
    public function getProfileDetails($fiscal_year, $month) {
        $this->db->select('*')->from('land_owner_profile_basic');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('initial_flag','0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateProfileDetails($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('land_owner_profile_basic', $post_array);
        return TRUE;
    }

    //get famaily details
    public function getFamailyDetails($fiscal_year=NULL, $month) {
        $this->db->select('*')->from('land_owner_family_details');
        //$this->db->where('fiscal_year', $fiscal_year);
        //echo $this->session->userdata('PRJ_USER_ID');exit;
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('initial_flag','0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateFamailyDetails($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('land_owner_family_details', $post_array);
        return TRUE;
    }

    //getLandDetails
    public function getLandDetails($fiscal_year, $month) {
        $this->db->select('*')->from('land_description_details');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('initial_flag','0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateLandDetails($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('land_description_details', $post_array);
        return TRUE;
    }
    //getSanrachanaDetails
    public function getSanrachanaDetails($fiscal_year, $month) {
        $this->db->select('*')->from('sanrachana_details');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('initial_flag','0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateSanrachanaDetails($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('sanrachana_details', $post_array);
        return TRUE;
    }

    //getBDetails
    public function getBDetails($fiscal_year, $month) {
        $this->db->select('*')->from('ba_details');
        //$this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('initial_flag','0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateBDetails($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('ba_details', $post_array);
        return TRUE;
    }

    public function getsampatiKarDetails($fiscal_year, $month) {
        $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details');
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('month(added_on)',$month);
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('initial_flag','0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdatesampatiKarDetails($id) {
        $post_array = array('initial_flag'=>1);
        $this->db->where_in('id', $id);
        $this->db->update('sampati_kar_bhumi_kar_bill_details', $post_array);
        return TRUE;
    }
}