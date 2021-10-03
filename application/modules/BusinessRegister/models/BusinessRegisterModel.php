<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class BusinessRegisterModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    //insert function 
    public function insertData($data)
    {
        $query = $this->db->insert('business_register', $data);
        if($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function firm_transaction($post_data) {
        $this->db->trans_start();
        $this->db->insert_batch('firm_transaction',$post_data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }
    /*
     *This function get all profile details
     *param null
     *retrun array
    */
    public function getBusinessRegisterList() {
        $this->db->select('*')->from('business_register');
        $query  = $this->db->get();
        return $query->result_array();
    }

    /**
     *This function get all profile details
     *@param int $id
     *@retrun array
    */
    public function getSelectedBusinessRegisterList($id) {
        $this->db->select('*')->from('business_register');
        $this->db->where('id', $id);
        $query  = $this->db->get();
        return $query->row_array();
    }

    public function getFirmTransaction($id) {
        $this->db->select('*')->from('firm_transaction');
        $this->db->where('firm_id', $id);
        $query  = $this->db->get();
        return $query->result_array();
    }

    /*
     *This function get all land description by file no
     *param str $filenum
     *retrun array
    */
    public function getKittaNumber($fileNo) {
        return $this->db->select('k_number')
                        ->from('land_description_details')
                        ->where('ld_file_no', $fileNo)
                        ->get()
                        ->result_array();
    }

    /*
     *This function get all land description by file no
     * param string $kittaNo
     * @retrun array
    */
    public function getLandDetails($kittaNo) {
        return $this->db->select('*')
                        ->from('land_description_details')
                        ->where('k_number', $kittaNo)
                        ->get()
                        ->row_array();
    }

    /*
     *This function get has sanrachan or not
     *param str $kittaNo kittaNo
     *retrun array
    */
    public function checkHasSanrachana($kittaNo) {
        return $this->db->select('*')
                        ->from('sanrachana_details')
                        ->where('k_no', $kittaNo)
                        ->get()
                        ->row_array();
    }

    //update land details
    public function updateLandDetails($postData, $kno) {
       $this->db->trans_start();
        $this->db->where('k_number', $kno);
        $this->db->update('land_description_details',$postData);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:$this->db->insert_id();
    }

    //create land details 
    public function insertLandDetails($post_array) {
        $this->db->trans_start();
        $this->db->insert('land_description_details',$post_array);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

    public function insertBuySellDetails($post_array) {
        $this->db->trans_start();
        $this->db->insert(' buy_sell',$post_array);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

    //get list
    public function getList(){
        $this->db->select('t1.*,t2.land_owner_name_np as seller_name, t3.land_owner_name_np as buyer_name');
        $this->db->from('buy_sell t1');
        $this->db->join('land_owner_profile_basic t2','t2.file_no = t1.seller_file_no');
        $this->db->join('land_owner_profile_basic t3','t3.file_no = t1.buyer_file_no');
        $query = $this->db->get();
        return $query->result_array();
    }


     //update batch for nadadi billing details
    public function updateTransDetails($id, $post_array) {
        $this->db->trans_start();
        $this->db->update_batch('firm_transaction',$post_array,'id');
        $this->db->trans_complete();
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
     //update rate details
    public function updateDetails($id, $update_array) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('business_register',$update_array);
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
}