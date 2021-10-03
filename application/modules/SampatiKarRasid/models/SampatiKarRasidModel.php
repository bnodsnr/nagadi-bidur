<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class SampatiKarRasidModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->fy = current_fiscal_year();
        $this->recently_closed_fy = recently_closed_fy();
    }

    public function getFiscalYear() {
        $current_fiscal_year = current_fiscal_year();
        return $this->db->select('*')
                        ->from('fiscal_year')
                        ->where('year != ',$current_fiscal_year['year'])
                        ->get()
                        ->result_array();
    }

    //get land owner details
    public function getLandOwnerDetails($fileNo) {
        $this->db->select('t1.*,t2.name as gapa');
        $this->db->from('land_owner_profile_basic t1');
        $this->db->join('settings_vdc_municipality t2','t2.id = t1.lo_gapa_napa', 'left');
        $this->db->where('t1.file_no', $fileNo);
        $query = $this->db->get();
        return $query->row_array();
    }
    //get land details
    public function getLandDetails($fileNo) {
        $current_fy = get_current_fiscal_year();
        return $this->db->select('t1.*,t2.architect_type,t3.road_name as rn, t4.land_area_type as lat,t5.category')
                        ->from('land_description_details t1')
                        ->join('settings_architect_type as t2','t2.id = t1.land_area_type','left')
                        ->join('settings_road as t3','t3.id = t1.road_name','left')
                        ->join('settings_land_area_type as t4','t4.id = t1.land_area_type','left')
                        ->join('land_category as t5','t5.id = t1.land_category','left')
                        ->where('ld_file_no',$fileNo)
                        // ->where('t1.fiscal_year', $current_fy)
                        ->get()
                        ->result_array();
    }
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from('land_owner_profile_basic');
        return $this->db->count_all_results();
    }

    public function getSanrachanaDetails($fileNo) {
        $this->db->select('t1.*,t2.structure_type as st,t3.architect_type');
		$this->db->from('sanrachana_details t1');
		$this->db->join('settings_architect_structure t2', '.t2.id = t1.sanrachana_banot_kisim', 'left');
		$this->db->join('settings_architect_type t3', '.t3.id = t1.sanrachana_prakar', 'left');
		$this->db->where('ls_file_no', $fileNo);
		$query = $this->db->get();
		return $query->result_array();
    }


    public function getSanrachanaDetailsByKNo($k_no) {
        $this->db->select('t1.*,t2.structure_type as st,t3.architect_type');
        $this->db->from('sanrachana_details t1');
        $this->db->join('settings_architect_structure t2', '.t2.id = t1.sanrachana_banot_kisim', 'left');
        $this->db->join('settings_architect_type t3', '.t3.id = t1.sanrachana_prakar', 'left');
        $this->db->where('k_no', $k_no);
        $query = $this->db->get();
        return $query->result_array();
    }

    //get bakyeuta land description
    public function getLandDetilsWithSanrachana($fileNo){
        $current_fiscal_year = current_fiscal_year();
        $this->db->select('t1.*,t2.structure_type as st,t3.architect_type');
        $this->db->from('sanrachana_details t1');
        $this->db->join('settings_architect_structure t2', '.t2.id = t1.sanrachana_banot_kisim', 'left');
        $this->db->join('settings_architect_type t3', '.t3.id = t1.sanrachana_prakar', 'left');
        $this->db->where('ls_file_no', $fileNo);
        //$this->db->where('t1.fiscal_year !=',$current_fiscal_year['year']);
        $query = $this->db->get();
        return $query->result_array();
    }
    //get land details where sanrachan doesnot exits
    public function getLandWithoutSanrachana($fileNo) {
       $sql = "SELECT * FROM land_description_details WHERE ld_file_no = '$fileNo'  AND k_number NOT IN (SELECT k_no FROM sanrachana_details)";
        return $this->db->query($sql)->result_array();
    }

    //get bakyeuta land description where saanrachana doesnot exit;
    public function getBlandDescriptionWithoutSarachana($fileNo) {
        $current_fiscal_year = current_fiscal_year();
        $cfy = $current_fiscal_year['year'];
        $sql = "SELECT * FROM land_description_details WHERE ld_file_no = '$fileNo' AND fiscal_year <> '$cfy' AND k_number NOT IN (SELECT k_no FROM sanrachana_details)";
        return $this->db->query($sql)->result_array();
    }

    //get naxa number
    public function getNaxaNumber($kitta_no) {
        return $this->db->select('*')
                        ->from('land_description_details')
                        ->where('k_number', $kitta_no)
                        ->get()
                        ->row_array();
    }
    //get land total kar amount 
    public function getTotalLandTaxAmount($fileNo) {
        $this->db->select_sum('t_rate');
        $this->db->where('ld_file_no', $fileNo);
        $result = $this->db->get('land_description_details')->row();  
        return $result;
    }

    public function getTotalSanrachanaKhudAmount($fileNo) {
        $this->db->select_sum('sanrachana_khud_amount');
        $this->db->where('ls_file_no', $fileNo);
        $result = $this->db->get('sanrachana_details')->row();  
        return $result;
    }

    public function getTotalSanrachanacharchekoAmount($fileNo) {
        $this->db->select_sum('sanrachana_land_tax_amount');
        $this->db->where('ls_file_no', $fileNo);
        $result = $this->db->get('sanrachana_details')->row();  
        return $result;
    }

     public function getTotalSampatiKarAmount($fileNo) {
        $this->db->select_sum('net_tax_amount');
        $this->db->where('ls_file_no', $fileNo);
        $result = $this->db->get('sanrachana_details')->row();  
        return $result;
    }

    public function getTotalBAAmount($fileNo) {
        $this->db->select_sum('bhumi_kar');
        $this->db->where('lb_file_no', $fileNo);
        $result = $this->db->get('ba_details')->row();  
        return $result;
    }

    public function getSampatiKarAmount($rangePrice) {
        $fiscal_year = current_fiscal_year();
        $sql = "SELECT sampati_kar from sampati_bhumi_kar_rate where ".$rangePrice." BETWEEN from_rate and to_rate
            AND fiscal_year = '$fiscal_year'
		";
		$query = $this->db->query($sql);
		return $query->row_array();
    }

    public function getBhumiKarAmount($rangePrice) {
        $fiscal_year = current_fiscal_year();
        $sql = "SELECT bhumi_kar from sampati_bhumi_kar_rate where ".$rangePrice. " BETWEEN from_rate and to_rate
            AND fiscal_year = '$fiscal_year'
        ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    //save sampati kar bhumi kar bill details
    public function saveSamapatiKarBhumiKarBillDetatails($post_array) {
        $this->db->trans_start();
		$this->db->insert('sampati_kar_bhumi_kar_bill_details',$post_array);
		$this->db->trans_complete();        
		return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
        // FROM 'sampati_kar_bhumi_kar_bill_details'
    }


     //get bill no
    public function checkBill() {
        $this->db->select('*');
        $this->db->from('sampati_kar_bhumi_kar_bill_details');
        $this->db->where('added_by', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('fiscal_year',$this->fy);
        $this->db->order_by('bill_no', "DESC");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    //get bill range by user
    public function getBillRange() {
        $this->db->select('*');
        $this->db->from('settings_bill_setup');
        $this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('bill_type', 2);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function getBillRangeLast() {
        $this->db->select('*');
        $this->db->from('settings_bill_setup');
        $this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));
        $this->db->where('bill_type', 2);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->row_array();
    }

    //save ba details
    public function saveBADetails($data) {
        $this->db->trans_start();
        $this->db->insert_batch('ba_details',$data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

    //get bill details
    public function getSampatiBillDetails($fileNo) {
        $this->db->select('*');
        $this->db->from('sampati_kar_bhumi_kar_bill_details');
        $this->db->where('nb_file_no', $fileNo);
        $query = $this->db->get();
        return $query->row_array();

    }

    //count total bill
    public function totalSamptiKarBillDetails()
    {
        $query = $this->db->select("COUNT(*) as num")->get("sampati_kar_bhumi_kar_bill_details");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    //get users detials
    public function getUsers($user) {
          $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userid', $user);
        $query = $this->db->get();
        return $query->row_array();
    }

    //get bill data
    public function getTotalBillAmount($fileNo){
        return $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details')
                                    ->where('nb_file_no', $fileNo)
                                    ->where('status',1)
                                    ->where('fiscal_year', $this->fy)
                                    ->get()
                                    ->result_array();
    }
   
    
    public function getTotalBillAmountDetails($fileNo){
        return $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details')
                                    ->where('nb_file_no', $fileNo)
                                    ->where('status',1)
                                    ->fiscal_year($this->fy)
                                    ->get()
                                    ->row_array();
    }

    public function getbillDetailsview($bill_no){
        return $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details')
                                    ->where('bill_no', $bill_no)
                                    ->get()
                                    ->row_array();
    }

    public function getsampatiRasidDetailsBy($fileNo) {
        return $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details')
                                    ->where('nb_file_no', $fileNo)
                                    ->get()
                                    ->row_array();
    }

    //get land details by k no
    public function getLandDetailsByKNo($kno) {
        return $this->db->select('*')->from('land_description_details')
                                    ->where('k_number', $kno)
                                    ->get()
                                    ->row_array();
    }

    //get bill numbers
    public function getBillNo() {
        $this->db->select('*')->from('settings_bill_setup');
        $this->db->where('status', 1);
        $this->db->where('bill_type', 2);
        $this->db->where('fiscal_year', $this->fy);
        $this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function getInactiveBills() {
        $this->db->select('*')->from('settings_bill_setup');
        $this->db->where('status !=', 1);
        $this->db->where('bill_type', 2);
        $this->db->where('fiscal_year', $this->fy);
        $this->db->where('user_id', $this->session->userdata('PRJ_USER_ID'));
        $query = $this->db->get();
        return $query->row_array();
    }
    /*
    |--------------------------------------------------------------------------
    | Bakayuta
    |--------------------------------------------------------------------------
    |
    | This add details of bakayuta and claculate the tax value for previous.
    */

    public function getNewAddressDetails($gapanapa =NULL, $ward =NULL, $fiscal_year=NULL) {
        $condition = array(
            'old_name' => $gapanapa,
            'old_ward' => $ward
        );
        $this->db->select('*')->from('settings_old_and_present');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getRoadDetails($ward, $fiscal_year) {
        $current_fy = current_fiscal_year();
        $condition = array(
            'ward' => $ward,
            'fiscal_year' => $fiscal_year,
        );
        return $this->db->select('*')
                        ->from('settings_road')
                        ->where($condition)
                        ->get()
                        ->result_array();
    }

    public function getLandCost($road_name, $land_area_type, $fiscal_year) {
        $condition = array(
            'road_name' => $road_name,
            'land_area_type' => $land_area_type,
            'fiscal_year' => $fiscal_year,
        );
        return $this->db->select('*')
                        ->from('settings_area_minimal_cost')
                        ->where($condition)
                        ->get()
                        ->row_array();
    }

    //get bakyeuta land details
    public function getBakayutaLandDetails($fileNo) {
        $current_fiscal_year = current_fiscal_year();
        $cfy = $current_fiscal_year['year'];
        $this->db->select('*')->from('land_description_details');
        $this->db->where('ld_file_no', $fileNo);
        $this->db->where('fiscal_year !=', $cfy);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function getBillBakayutaLandDetails($fileNo, $fy) {
        $current_fiscal_year = current_fiscal_year();
        $cfy = $current_fiscal_year['year'];
        $this->db->select('*')->from('land_description_details');
        $this->db->where('ld_file_no', $fileNo);
        $this->db->where('fiscal_year', $fy);
        $query = $this->db->get();
        return $query->result_array();
    }
    //get sanrachana details by kitta number
    public function getBSanrachanaDetailsByKNo($k_no, $fiscal_year) {

        $this->db->select('t1.*,t2.structure_type as st,t3.architect_type');
        $this->db->from('sanrachana_details as t1');
        $this->db->join('settings_architect_structure as t2', '.t2.id = t1.sanrachana_banot_kisim', 'left');
        $this->db->join('settings_architect_type t3', '.t3.id = t1.sanrachana_prakar', 'left');
        $this->db->where('t1.k_no', $k_no);
        $this->db->where('t1.fiscal_year', $fiscal_year);
        $query = $this->db->get();
       // return $this->db->last_query();
        return $query->result_array();
    }


    public function addressOld(){
        $sql = 'select DISTINCT old_name from settings_old_and_present';
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    public function oldWard(){
        $sql = 'select DISTINCT old_ward from settings_old_and_present';
        $result = $this->db->query($sql);

        return $result->result_array();
    }

    //get land owner details by fileno
    public function getLandOwnerDetailsByFileNo( $fileNo ) {
        return $this->db->select('*')
                        ->from('land_owner_profile_basic')
                        ->where('file_no', $fileNo)
                        ->get()
                        ->row_array();
    }

    public function saveLandDescription($post_data) {
        $this->db->trans_start();
        $this->db->insert('land_description_details',$post_data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }



    //get sampati kar rate
    public function getSampatiKarRateDetails($rangePrice) {
        $fiscal_year = get_current_fiscal_year();
       
        $sql = "
            SELECT amount,is_percent from sampati_kar_rate where ".$rangePrice. " BETWEEN from_rate and to_rate
            AND fiscal_year = '$fiscal_year'
        ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    //get bhumi kar details
    public function getBhumiKarRateDetails($ward_number, $land_category, $land_area_type) {
   // echo $ward_number.$land_category.$land_area_type;exit;

        $this->db->select('*')->from('bhumikar');
        if(!empty($ward_number)){
            $this->db->where('ward', $ward_number);
        }
        if(!empty($land_area_type)){
            $this->db->where('land_area_type', $land_area_type);
        }
        if(!empty($ward_number)){
            $this->db->where('land_category', $land_category);
        }
        // $fiscal_year = get_current_fiscal_year();
        // $sql = "
        //     SELECT rate from bhumikar where ".$rangePrice. " BETWEEN from_rate and to_rate
        //     AND fiscal_year = '$fiscal_year'
        // ";
        $query = $this->db->get();
        return $query->row_array();
    }

    //get sanrachan details row
    public function getSanrachanarowByKNo($k_no) {
        $this->db->select('t1.*,t2.structure_type as st,t3.architect_type');
        $this->db->from('sanrachana_details as t1');
        $this->db->join('settings_architect_structure as t2', '.t2.id = t1.sanrachana_banot_kisim', 'left');
        $this->db->join('settings_architect_type t3', '.t3.id = t1.sanrachana_prakar', 'left');
        $this->db->where('t1.k_no', $k_no);
        $query = $this->db->get();
        return $query->row_array();
    }


    //for budi ganaa
    public function getSanrachanaAllByKNo($k_no) {
        $this->db->select('t1.*,t2.structure_type as st,t3.architect_type');
        $this->db->from('sanrachana_details as t1');
        $this->db->join('settings_architect_structure as t2', '.t2.id = t1.sanrachana_banot_kisim', 'left');
        $this->db->join('settings_architect_type t3', '.t3.id = t1.sanrachana_prakar', 'left');
        $this->db->where('t1.k_no', $k_no);
        $query = $this->db->get();
        return $query->result_array();
    }


    //get bill calculation details
    public function GetProfileDetailsForBills($file_no) {
        $sql = "SELECT 
                p.old_gapa_napa,
                p.old_ward,
                p.old_gapa_napa,
                p.present_gapa_napa,
                p.present_ward,
                p.land_area_type as lat,
                p.road_name,
                p.land_category,
                p.nn_number,
                p.k_number,
                p.a_ropani,
                p.a_ana,
                p.a_dam,
                p.a_paisa,
                p.total_square_feet,
                p.k_land_rate,
                p.t_rate,
                p.ld_file_no,
                s.*,
                lat.id,
                lat.land_area_type,
                lc.id,lc.category,
                op.id,op.old_name,op.present_name,
                r.road_name as rm,
                at.architect_type,
                st.structure_type
                FROM land_description_details p
                LEFT JOIN
                (
                  SELECT
                    id as sanrachana_id,
                    sanrachana_prakar,
                    sanrachana_banot_kisim, 
                    sanrachana_usages, 
                    sanrachana_floor, 
                    sanrachana_ground_housing_area_sqft, 
                    contructed_year, 
                    sanrachana_dep_rate,
                    sanrachana_khud_amount,
                    net_tax_amount,
                    r_bhumi_area,
                    r_bhumi_kar,
                    k_no
                    FROM sanrachana_details
                    WHERE ls_file_no  ='$file_no'
                ) s
                ON s.k_no = p.k_number 
                LEFT JOIN settings_land_area_type lat ON lat.id = p.land_area_type
                LEFT JOIN land_category lc ON lc.id = p.land_area_type
                LEFT JOIN settings_old_and_present op ON op.id = p.old_ward
                LEFT JOIN settings_road r ON r.id = p.road_name
                LEFT JOIN settings_architect_structure st ON st.id = s.sanrachana_banot_kisim
                LEFT JOIN settings_architect_type at ON at.id = s.sanrachana_prakar
                WHERE p.ld_file_no = '$file_no' and initial_flag <> 1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function GetProfileDetailsForCurrentBills($file_no) {
        $sql = "SELECT 
                p.old_gapa_napa,
                p.old_ward,
                p.old_gapa_napa,
                p.present_gapa_napa,
                p.present_ward,
                p.land_area_type as lat,
                p.road_name,
                p.land_category,
                p.nn_number,
                p.k_number,
                p.a_ropani,
                p.a_ana,
                p.a_dam,
                p.a_paisa,
                p.total_square_feet,
                p.k_land_rate,
                p.t_rate,
                p.ld_file_no,
                s.*,
                lat.id,
                lat.land_area_type,
                lc.id,lc.category,
                op.id,op.old_name,op.present_name,
                r.road_name as rm,
                at.architect_type,
                st.structure_type
                FROM land_description_details p
                LEFT JOIN
                (
                  SELECT
                    id as sanrachana_id,
                    sanrachana_prakar,
                    sanrachana_banot_kisim, 
                    sanrachana_usages, 
                    sanrachana_floor, 
                    sanrachana_ground_housing_area_sqft, 
                    contructed_year, 
                    sanrachana_dep_rate,
                    sanrachana_khud_amount,
                    net_tax_amount,
                    r_bhumi_area,
                    r_bhumi_kar,
                    k_no
                    FROM sanrachana_details
                    WHERE ls_file_no  ='$file_no'
                ) s
                ON s.k_no = p.k_number 
                LEFT JOIN settings_land_area_type lat ON lat.id = p.land_area_type
                LEFT JOIN land_category lc ON lc.id = p.land_area_type
                LEFT JOIN settings_old_and_present op ON op.id = p.old_ward
                LEFT JOIN settings_road r ON r.id = p.road_name
                LEFT JOIN settings_architect_structure st ON st.id = s.sanrachana_banot_kisim
                LEFT JOIN settings_architect_type at ON at.id = s.sanrachana_prakar
                WHERE p.ld_file_no = '$file_no' and current_flag <> 1 and buy_sell_status <> 2";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    /**
     * This function on ajax call get list of land owner profile
     * This function is used for datatables for server side uses
     * @param INT $limit, INT $start, INT $col, INT $fiscal, INT $fiscal_year
     * @return json
    */
    public function GetAllBills($limit,$start,$col,$dir, $org_file_no= NULL, $bill_no = NULL, $from_date=NULL,$to_date=NULL, $status =NULL, $fiscal_year = NULL)
    { 
        $this->db->select('t1.*,t2.land_owner_name_np,t3.name')->from('sampati_kar_bhumi_kar_bill_details t1');
        $this->db->join('land_owner_profile_basic t2','t2.file_no =t1.nb_file_no','left');
        $this->db->join('users t3','t3.userid =t1.added_by','left');
        if(!empty($org_file_no)){
            $this->db->where('t1.nb_file_no', $org_file_no);
        }
        if(!empty($bill_no)){
            $this->db->where('t1.bill_no', $bill_no);
            $this->db->order_by('t1.billing_date', 'ASC');
        }
        if(!empty($from_date) & empty($to_date)) {
            $this->db->where('t1.billing_date', $from_date);
        }
        if(!empty($from_date) && !empty($to_date)){
            $this->db->where('t1.billing_date >=', $from_date);
            $this->db->where('t1.billing_date <=', $to_date);
            $this->db->order_by('t1.billing_date', 'ASC');
        }

        if($this->session->userdata('PRJ_USER_ID') != 1) {
            $this->db->where('t1.added_by',$this->session->userdata('PRJ_USER_ID'));
        }
        if(!empty($status)) {
            $this->db->where('t1.status', $status);
        }
        if(!empty($fiscal_year)) {
            $this->db->where('t1.fiscal_year',$fiscal_year);
        } else {
            $this->db->where('t1.fiscal_year',$this->fy);

        }
        $this->db->limit($limit, $start);
        $this->db->order_by($col,$dir);
        $query = $this->db->get();
       // pp($this->db->last_query());
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
    public function GetSearchList($org_file_no= NULL, $bill_no = NULL, $from_date=NULL,$to_date=NULL, $status =NULL, $fiscal_year = NULL) {
        $this->db->select('t1.*,t2.land_owner_name_np,t3.name')->from('sampati_kar_bhumi_kar_bill_details t1');
        $this->db->join('land_owner_profile_basic t2','t2.file_no =t1.nb_file_no','left');
        $this->db->join('users t3','t3.userid =t1.added_by','left');
        if(!empty($org_file_no)){
            $this->db->where('t1.nb_file_no', $org_file_no);
        }
        if(!empty($bill_no)){
            $this->db->where('t1.bill_no', $bill_no);
            $this->db->order_by('t1.billing_date', 'ASC');
        }
        if(!empty($from_date) & empty($to_date)) {
            $this->db->where('t1.billing_date', $from_date);
        }
        if(!empty($from_date) && !empty($to_date)){
            $this->db->where('t1.billing_date >=', $from_date);
            $this->db->where('t1.billing_date <=', $to_date);
            $this->db->order_by('t1.billing_date', 'ASC');
        }

        if($this->session->userdata('PRJ_USER_ID') != 1) {
            $this->db->where('t1.added_by',$this->session->userdata('PRJ_USER_ID'));
        }
        if(!empty($status)) {
            $this->db->where('t1.status', $status);
        }
        if(!empty($fiscal_year)) {
            $this->db->where('t1.fiscal_year',$fiscal_year);
        } else {
            $this->db->where('t1.fiscal_year',$this->fy);

        }
        $this->db->limit($limit, $start);
        $this->db->order_by($col,$dir);
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
    public function CountBills($org_file_no= NULL, $bill_no = NULL, $from_date =NULL,$to_date =NULL, $status =NULL ,$fiscal_year = NULL)
    {
        $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details');
       
        if(!empty($org_file_no)){
            $this->db->where('nb_file_no', $org_file_no);
        }
         if(!empty($bill_no)){
            $this->db->where('bill_no', $bill_no);
        }

        if(!empty($from_date) & empty($to_date)) {
            $this->db->where('billing_date', $from_date);
        }
        if(!empty($from_date) && !empty($to_date)){
            $this->db->where('billing_date >=', $from_date);
            $this->db->where('billing_date <=', $to_date);
        }
        if(!empty($status)) {
            $this->db->where('status', $status);
        }
        if($this->session->userdata('PRJ_USER_ID') != 1) {
            $this->db->where('added_by',$this->session->userdata('PRJ_USER_ID'));
        }
        if(!empty($fiscal_year)) {
            $this->db->where('fiscal_year', $fiscal_year);
        } else {
            $this->db->where('fiscal_year',$this->fy);    
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function on ajax call update bill status
     * @param INT $id
     * @return boolean
    */
    public function updateBillStatus($id, $data){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('sampati_kar_bhumi_kar_bill_details',$data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

    public function checkBillNoExits($bill_no) {
        $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details');
        $this->db->where('bill_no', $bill_no);
        $this->db->where('fiscal_year',$this->fy);
        $query = $this->db->get();
        if($query->num_rows() > 0 ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //

     /*------------------------------------------------------------------------------------------------
    --------------------------------------------------------------------------------------------------
    tripura bhumi kar---------------------------------------------------------------------------------*/
    public function getTripuraBhumiKar($land_area_type, $road_name) {
       
        $condition = array(
            'land_area_type' => $land_area_type,
            'land_category' => $road_name
        );
          return $this->db->select('*')
                        ->from('bhumikar')
                        ->where($condition)
                        ->get()
                        ->row_array();
    }

    public function getTripuraSampatiKar($type, $unit) {
       
        $condition = array(
            'type' => $type,
            'unit' => $unit
        );
          return $this->db->select('*')
                        ->from('sampati_kar_rate')
                        ->where($condition)
                        ->get()
                        ->row_array();
    }

    //ceheck has sanrachana
    public function checkHasSanrachana($file_no) {
        $this->db->select('*')->from('sanrachana_details');
        $this->db->where('ls_file_no', $file_no);
        $query = $this->db->get();
        if($query->num_rows() > 1 ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insertBillDetails($post_array) {

        if ($query = $this->db->insert('sampati_kar_bhumi_kar_bill_details', $post_array)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function updateLandDetails($file_no, $post_array) {
        $this->db->where('ld_file_no', $file_no);
        $this->db->where('initial_flag !=', 1);
        $query = $this->db->update('land_description_details', $post_array);
        if($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function updateCurrentLandDetails($file_no, $post_array) {
        $this->db->where('ld_file_no', $file_no);
        $this->db->where('current_flag !=', 1);
        $query = $this->db->update('land_description_details', $post_array);
        if($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //update bill in cancel details
    public function updateLandDetailsOnBillCancle($file_no, $post_array) {
        $this->db->where('ld_file_no', $file_no);
        $this->db->where('current_flag', 1);
        $query = $this->db->update('land_description_details', $post_array);
        if($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateProfileDetailsOnBillCancle($file_no, $post_array) {
        $this->db->where('file_no', $file_no);
        $query = $this->db->update('land_owner_profile_basic', $post_array);
        if($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
    public function getPrintPreview( $bill_no, $file_no = NULL) {
          $sql = "SELECT 
                p.old_gapa_napa,
                p.old_ward,
                p.old_gapa_napa,
                p.present_gapa_napa,
                p.present_ward,
                p.land_area_type as lat,
                p.road_name,
                p.land_category,
                p.nn_number,
                p.k_number,
                p.a_ropani,
                p.a_ana,
                p.a_dam,
                p.a_paisa,
                p.total_square_feet,
                p.k_land_rate,
                p.t_rate,
                p.ld_file_no,
                s.*,
                lat.id,
                lat.land_area_type,
                lc.id,lc.category,
                op.id,op.old_name,op.present_name,
                r.road_name as rm,
                at.architect_type,
                st.structure_type
                FROM land_description_details p
                LEFT JOIN
                (
                  SELECT
                    id as sanrachana_id,
                    sanrachana_prakar,
                    sanrachana_banot_kisim, 
                    sanrachana_usages, 
                    sanrachana_floor, 
                    sanrachana_ground_housing_area_sqft, 
                    contructed_year, 
                    sanrachana_dep_rate,
                    sanrachana_khud_amount,
                    net_tax_amount,
                    r_bhumi_area,
                    r_bhumi_kar,
                    k_no
                    FROM sanrachana_details
                    WHERE ls_file_no  ='$file_no'
                ) s
                ON s.k_no = p.k_number 
                LEFT JOIN settings_land_area_type lat ON lat.id = p.land_area_type
                LEFT JOIN land_category lc ON lc.id = p.land_area_type
                LEFT JOIN settings_old_and_present op ON op.id = p.old_ward
                LEFT JOIN settings_road r ON r.id = p.road_name
                LEFT JOIN settings_architect_structure st ON st.id = s.sanrachana_banot_kisim
                LEFT JOIN settings_architect_type at ON at.id = s.sanrachana_prakar
                WHERE p.voucher_id = '$bill_no' and p.ld_file_no = '$file_no'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getCurrentPrintPreview( $bill_no, $file_no = NULL) {
        $sql = "SELECT 
                p.old_gapa_napa,
                p.old_ward,
                p.old_gapa_napa,
                p.present_gapa_napa,
                p.present_ward,
                p.land_area_type as lat,
                p.road_name,
                p.land_category,
                p.nn_number,
                p.k_number,
                p.a_ropani,
                p.a_ana,
                p.a_dam,
                p.a_paisa,
                p.total_square_feet,
                p.k_land_rate,
                p.t_rate,
                p.ld_file_no,
                s.*,
                lat.id,
                lat.land_area_type,
                lc.id,lc.category,
                op.id,op.old_name,op.present_name,
                r.road_name as rm,
                at.architect_type,
                st.structure_type
                FROM land_description_details p
                LEFT JOIN
                (
                  SELECT
                    id as sanrachana_id,
                    sanrachana_prakar,
                    sanrachana_banot_kisim, 
                    sanrachana_usages, 
                    sanrachana_floor, 
                    sanrachana_ground_housing_area_sqft, 
                    contructed_year, 
                    sanrachana_dep_rate,
                    sanrachana_khud_amount,
                    net_tax_amount,
                    r_bhumi_area,
                    r_bhumi_kar,
                    k_no
                    FROM sanrachana_details
                    WHERE ls_file_no  ='$file_no'
                ) s
                ON s.k_no = p.k_number 
                LEFT JOIN settings_land_area_type lat ON lat.id = p.land_area_type
                LEFT JOIN land_category lc ON lc.id = p.land_area_type
                LEFT JOIN settings_old_and_present op ON op.id = p.old_ward
                LEFT JOIN settings_road r ON r.id = p.road_name
                LEFT JOIN settings_architect_structure st ON st.id = s.sanrachana_banot_kisim
                LEFT JOIN settings_architect_type at ON at.id = s.sanrachana_prakar
                WHERE p.current_voucher_id = '$bill_no' and p.ld_file_no = '$file_no' and buy_sell_status <> 2";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getTotalBillPreview($bill_no){
        return $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details')
                                    ->where('bill_no', $bill_no)
                                    ->where('fiscal_year', $this->fy)
                                    ->get()
                                    ->row_array();
    }


    public function getCancelBills() {
        $this->db->select('t1.*, t2.nb_file_no, t3.land_owner_name_np,t4.name,t5.name as canname')->from('sampati_rasid_cancel_reason t1');
        $this->db->join('sampati_kar_bhumi_kar_bill_details t2', 't2.bill_no = t1.bill_no','left');
        $this->db->join('land_owner_profile_basic t3', 't2.nb_file_no = t3.file_no','left');
        $this->db->join('users t4','t4.userid = t2.added_by', 'left');
        $this->db->join('users t5','t5.userid = t1.canceled_by', 'left');
        if($this->session->userdata('PRJ_USER_ID') != 1 ) {
            $this->db->where('t2.added_ward', $this->session->userdata('PRJ_USER_WARD'));
        }
        $this->db->order_by('t1.date','DESC');
        $this->db->where('t2.fiscal_year',$this->fy);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function GetCancelBillDetails($file_no) {
        if($this->fy == $this->recently_closed_fy) {
            $sql = "SELECT 
                p.old_gapa_napa,
                p.old_ward,
                p.old_gapa_napa,
                p.present_gapa_napa,
                p.present_ward,
                p.land_area_type as lat,
                p.road_name,
                p.land_category,
                p.nn_number,
                p.k_number,
                p.a_ropani,
                p.a_ana,
                p.a_dam,
                p.a_paisa,
                p.total_square_feet,
                p.k_land_rate,
                p.t_rate,
                p.ld_file_no,
                s.*,
                lat.id,
                lat.land_area_type,
                lc.id,lc.category,
                op.id,op.old_name,op.present_name,
                r.road_name as rm,
                at.architect_type,
                st.structure_type
                FROM land_description_details p
                LEFT JOIN
                (
                  SELECT
                    id as sanrachana_id,
                    sanrachana_prakar,
                    sanrachana_banot_kisim, 
                    sanrachana_usages, 
                    sanrachana_floor, 
                    sanrachana_ground_housing_area_sqft, 
                    contructed_year, 
                    sanrachana_dep_rate,
                    sanrachana_khud_amount,
                    net_tax_amount,
                    r_bhumi_area,
                    r_bhumi_kar,
                    k_no
                    FROM sanrachana_details
                    WHERE ls_file_no  ='$file_no'
                ) s
                ON s.k_no = p.k_number 
                LEFT JOIN settings_land_area_type lat ON lat.id = p.land_area_type
                LEFT JOIN land_category lc ON lc.id = p.land_area_type
                LEFT JOIN settings_old_and_present op ON op.id = p.old_ward
                LEFT JOIN settings_road r ON r.id = p.road_name
                LEFT JOIN settings_architect_structure st ON st.id = s.sanrachana_banot_kisim
                LEFT JOIN settings_architect_type at ON at.id = s.sanrachana_prakar
                WHERE p.voucher_id = '$file_no' and p.initial_flag = 1";
            } else {
                $sql = "SELECT 
                p.old_gapa_napa,
                p.old_ward,
                p.old_gapa_napa,
                p.present_gapa_napa,
                p.present_ward,
                p.land_area_type as lat,
                p.road_name,
                p.land_category,
                p.nn_number,
                p.k_number,
                p.a_ropani,
                p.a_ana,
                p.a_dam,
                p.a_paisa,
                p.total_square_feet,
                p.k_land_rate,
                p.t_rate,
                p.ld_file_no,
                s.*,
                lat.id,
                lat.land_area_type,
                lc.id,lc.category,
                op.id,op.old_name,op.present_name,
                r.road_name as rm,
                at.architect_type,
                st.structure_type
                FROM land_description_details p
                LEFT JOIN
                (
                  SELECT
                    id as sanrachana_id,
                    sanrachana_prakar,
                    sanrachana_banot_kisim, 
                    sanrachana_usages, 
                    sanrachana_floor, 
                    sanrachana_ground_housing_area_sqft, 
                    contructed_year, 
                    sanrachana_dep_rate,
                    sanrachana_khud_amount,
                    net_tax_amount,
                    r_bhumi_area,
                    r_bhumi_kar,
                    k_no
                    FROM sanrachana_details
                    WHERE ls_file_no  ='$file_no'
                ) s
                ON s.k_no = p.k_number 
                LEFT JOIN settings_land_area_type lat ON lat.id = p.land_area_type
                LEFT JOIN land_category lc ON lc.id = p.land_area_type
                LEFT JOIN settings_old_and_present op ON op.id = p.old_ward
                LEFT JOIN settings_road r ON r.id = p.road_name
                LEFT JOIN settings_architect_structure st ON st.id = s.sanrachana_banot_kisim
                LEFT JOIN settings_architect_type at ON at.id = s.sanrachana_prakar
                WHERE p.current_voucher_id = '$file_no' and p.current_flag = 1";
            }
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getbillPreview($bill_no, $file_no, $fiscal_year) {
        if($fiscal_year == recently_closed_fy()) {
            $sql = "SELECT p.old_gapa_napa, p.old_gapa_napa,p.present_gapa_napa,p.present_ward,p.land_area_type as lat,p.road_name,p.land_category,p.nn_number,p.k_number,p.a_ropani, p.a_ana,
                p.a_dam, p.a_paisa,p.total_square_feet, p.k_land_rate,p.t_rate, p.ld_file_no,s.*,lat.id,lat.land_area_type,lc.id,lc.category,op.id,op.old_name,op.present_name,r.road_name as rm,st.structure_type
                FROM land_description_details p LEFT JOIN ( SELECT id as sanrachana_id, sanrachana_prakar,sanrachana_banot_kisim, sanrachana_usages, sanrachana_floor, sanrachana_ground_housing_area_sqft,contructed_year,sanrachana_dep_rate,sanrachana_khud_amount,
                    net_tax_amount,r_bhumi_area, r_bhumi_kar, k_no
                    FROM sanrachana_details
                    WHERE ls_file_no  ='$file_no'
                ) s
                ON s.k_no = p.k_number 
                LEFT JOIN settings_land_area_type lat ON lat.id = p.land_area_type
                LEFT JOIN land_category lc ON lc.id = p.land_area_type
                LEFT JOIN settings_old_and_present op ON op.id = p.old_ward
                LEFT JOIN settings_road r ON r.id = p.road_name
                LEFT JOIN settings_architect_structure st ON st.id = s.sanrachana_banot_kisim
                LEFT JOIN settings_architect_type at ON at.id = s.sanrachana_prakar
                WHERE p.voucher_id = '$bill_no' and p.ld_file_no = '$file_no'";
        } else {
           
            $sql = "SELECT 
                p.old_gapa_napa,
                p.old_ward,
                p.old_gapa_napa,
                p.present_gapa_napa,
                p.present_ward,
                p.land_area_type as lat,
                p.road_name,
                p.land_category,
                p.nn_number,
                p.k_number,
                p.a_ropani,
                p.a_ana,
                p.a_dam,
                p.a_paisa,
                p.total_square_feet,
                p.k_land_rate,
                p.t_rate,
                p.ld_file_no,
                s.*,
                lat.id,
                lat.land_area_type,
                lc.id,lc.category,
                op.id,op.old_name,op.present_name,
                r.road_name as rm,
                at.architect_type,
                st.structure_type
                FROM land_description_details p
                LEFT JOIN
                (
                  SELECT
                    id as sanrachana_id,
                    sanrachana_prakar,
                    sanrachana_banot_kisim, 
                    sanrachana_usages, 
                    sanrachana_floor, 
                    sanrachana_ground_housing_area_sqft, 
                    contructed_year, 
                    sanrachana_dep_rate,
                    sanrachana_khud_amount,
                    net_tax_amount,
                    r_bhumi_area,
                    r_bhumi_kar,
                    k_no
                    FROM sanrachana_details
                    WHERE ls_file_no  ='$file_no'
                ) s
                ON s.k_no = p.k_number 
                LEFT JOIN settings_land_area_type lat ON lat.id = p.land_area_type
                LEFT JOIN land_category lc ON lc.id = p.land_area_type
                LEFT JOIN settings_old_and_present op ON op.id = p.old_ward
                LEFT JOIN settings_road r ON r.id = p.road_name
                LEFT JOIN settings_architect_structure st ON st.id = s.sanrachana_banot_kisim
                LEFT JOIN settings_architect_type at ON at.id = s.sanrachana_prakar
                WHERE p.current_voucher_id = '$bill_no' and p.ld_file_no = '$file_no' and buy_sell_status <> 2";
        }
            
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}