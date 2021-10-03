<?php



/**

 * Created by PhpStorm.

 * User: root

 */

class BankDepositModel extends CI_Model

{

    public function __construct()

    {

        parent::__construct();
        $this->fy = current_fiscal_year();

    }



    public function getTotalNagadi() {

        $this->db->select_sum('t_rates');
        if($this->session->userdata('PRJ_USER_ID') !=1 ){
            $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
        }
        $this->db->where('initial_flag !=', 1);
        $this->db->where('fiscal_year',$this->fy);
        $this->db->from('nagadi_amount_details');
        return $this->db->get()->row();

    }



    public function getTotalsampatikar() {

        $this->db->select_sum('net_total_amount');
        if($this->session->userdata('PRJ_USER_ID') !=1 ){
            $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
        }
        $this->db->where('status', 1);
        $this->db->where('fiscal_year',$this->fy);
        $this->db->from('sampati_kar_bhumi_kar_bill_details');
        
        return $this->db->get()->row();

    }

    public function getTotaldeposit() {
        $this->db->select_sum('deposit_amt');
        if($this->session->userdata('PRJ_USER_ID') !=1 ){
            $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
        }
        $this->db->from('bank_dakhila');
        $this->db->where('fiscal_year',$this->fy);
        return $this->db->get()->row();
    }
    
    public function getTotalNagadiSearch($fiscal_year = NULL , $ward = NULL) {
        $this->db->select_sum('t_rates');
        // if($this->session->userdata('PRJ_USER_ID') !=1 ){
        //     $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
        // }
        $this->db->where('initial_flag !=', 1);
        if(!empty($fiscal_year)) {
            $this->db->where('fiscal_year',$fiscal_year);
        }
        if(!empty($ward)) {
            if($ward == 'palika') {
                $this->db->where('added_ward','0');
            } else {
                $this->db->where('added_ward', $ward);
            }
        }
        $this->db->from('nagadi_amount_details');
        return $this->db->get()->row();

    }



    public function getTotalsampatikarSearch($fiscal_year = NULL,$ward =NULL) {
        $this->db->select_sum('net_total_amount');
        // if($this->session->userdata('PRJ_USER_ID') !=1 ){
        //     $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
        // }
        $this->db->where('status', 1);
        if(!empty($fiscal_year)) {
            $this->db->where('fiscal_year',$fiscal_year);
        }
        if(!empty($ward)) {
            if($ward == 'palika') {
                $this->db->where('added_ward','0');
            } else {
                $this->db->where('added_ward', $ward);
            }
        }
        $this->db->from('sampati_kar_bhumi_kar_bill_details');
        
        return $this->db->get()->row();

    }
    public function getTotaldepositSearch($fiscal_year = NULL, $ward = NULL) {
        $this->db->select_sum('deposit_amt');
       
        $this->db->from('bank_dakhila');
       if(!empty($fiscal_year)) {
            $this->db->where('fiscal_year',$fiscal_year);
        }
        if(!empty($ward)) {
            if($ward == 'palika') {
                $this->db->where('added_ward','0');
            } else {
                $this->db->where('added_ward', $ward);
            }
        }
        return $this->db->get()->row();
    }

    /** 
    * This function on ajax call get list of land owner profile
    * This function is used for datatables for server side uses
    * @param INT $limit, INT $start, INT $col, INT $fiscal, INT $fiscal_year
    * @return json
    */

    public function GetDepositList($limit,$start,$col,$dir, $ward= NULL, $bank_name = NULL,$voucher_no = NULL,$fiscal_year = NULL )
    { 
        $this->db->select('t1.*,t2.name as username')->from('bank_dakhila t1');
        $this->db->join('users t2','t2.userid = t1.added_by','left');
        if(!empty($ward)){
            //echo 'here';
            if($ward == 'Palika' ) {
                $this->db->where('t1.added_ward', '0');
            } else {
                $this->db->where('t1.added_ward', $ward);
            }
        } 
        if($this->session->userdata('PRJ_USER_ID')!= 1 ){
            $this->db->where('t1.added_ward', $this->session->userdata('PRJ_USER_WARD'));
        }
        if(!empty($bank_name)){
            $this->db->where('t1.bank_name', $bank_name);
        }
        if(!empty($voucher_no)) {
            $this->db->where('t1.voucher_no',$voucher_no);
        }
         if(!empty($fiscal_year)) {
            $this->db->where('fiscal_year', $fiscal_year);
        } else {
            $this->db->where('fiscal_year',$this->fy);
        }
        // if(!empty($fiscal_year)) {
        //     $this->db->where('t1.fiscal_year', $fiscal_year);
        // }
        $this->db->limit($limit, $start);
        $this->db->order_by('t1.id', 'DESC');
        $query = $this->db->get();
        //pp($this->db->last_query());
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

    public function CountAllList($ward= NULL, $bank_name = NULL, $voucher_no, $fiscal_year)
    {
        $this->db->select('*')->from('bank_dakhila');
        if(!empty($ward)){
            if($ward == 'Palika' ) {
                $this->db->where('added_ward', '0');
            } else {
                $this->db->where('added_ward', $ward);
            }
        } else {
            if($this->session->userdata('PRJ_USER_ID')!= 1 ){
                $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
            }
        }
        if(!empty($bank_name)){
            $this->db->where('bank_name', $org_name);
        }
        if(!empty($voucher_no)) {
            $this->db->where('voucher_no',$voucher_no);
        }
        if(!empty($fiscal_year)) {
            $this->db->where('fiscal_year', $fiscal_year);
        } else {
            $this->db->where('fiscal_year',$this->fy);
        }
        $query = $this->db->get();

        return $query->num_rows();

    }

}