<?php
class SanrachanaDetailsModel extends CI_Model{

	/**
		* This function get land owner list.
        * @param NULL
        * @return array
	*/
	// public function getLandOwnerDetails() {
	// 	$user = $this->session->userdata('PRJ_USER_ID');
	// 	$this->db->select('*')->from('land_owner_profile_basic');
	// 	if(!empty($user) && $user != 1) {
	// 		$this->db->where('added_by', $user);
	// 	}
	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }
    
    /**
     * This function check if kar paid or not for current fiscal year   
     * @param varchar $fiscal_year, varchar $file_no
     * @return boolean
    */
    public function checkIfTaxPaid($file_no) {
        $fiscal_year = get_current_fiscal_year();
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('nb_file_no', $file_no);
        $query = $this->db->get('sampati_kar_bhumi_kar_bill_details');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }


    /**
     * This function check if kar paid or not for current fiscal year   
     * @param varchar $fiscal_year, varchar $file_no
     * @return boolean
    */
    public function getLandDetails($file_no) {
        $this->db->select('t1.*, t2.road_name as setting_road_name');
        $this->db->from('land_description_details as t1');
        $this->db->join('settings_road as t2', 't1.road_name = t2.id', 'left');
        $this->db->where('t1.ld_file_no', $file_no);
       // $this->db->where('initial_flag !=', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    /**
        * This function create business profile.
        * @param array $post_data
        * @return bool
    */
    public function saveLands($post_data) {
        $this->db->trans_start();
        $this->db->insert('land_description_details',$post_data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:$this->db->insert_id();
    }

    /**
        * This function update business profile.
        * @param array $post_data,int $id
        * @return bool
    */
    public function updateLandDetails($basic_info, $id) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('land_description_details',$basic_info);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:$this->db->insert_id();
    }
    //public function getBusinessDetails() {
//         SELECT   t.country, SUM(t.impressions), SUM(e.totalSells)
// FROM     Traffic t LEFT JOIN (
//            SELECT   trafficID, SUM(sells) AS totalSells
//            FROM     Events
//            GROUP BY trafficID
//          ) e ON e.trafficID = t.id
// GROUP BY t.country
        // $sql = 'SELECT t.*,s.* FROM land_description_details t LEFT JOIN(
        //     SELECT * FROM sanrachana_details 
        //     GROUP BY k_no
        // ) s ON s.k_no = t.k_number
        // group by t.k_number';
        // $result = $this->db->query($sql);
        // return $result->result_array();
        // $this->db->select('l.*,s.*')
        // $this->db->select('t1.*,t2.*,t3*,')->from('land_owner_profile_basic t1');
        // $this->db->join('land_descriptions t2')
   //}
    /**
        * This function get sanrachan land and sanrachana.
        * @param NULL$limit,$start,$col,$dir,
        * @return array
    */
    public function GetSanrachanaDetails( $file_no = NULL,$kitta_no= NULL)
    {  
        if(empty($file_no)) {
            return null;
        } else{
            $this->db->select('t1.*,t2.structure_type as st,t3.architect_type');
            $this->db->from('sanrachana_details t1');
            $this->db->join('settings_architect_structure t2', '.t2.id = t1.sanrachana_banot_kisim', 'left');
            $this->db->join('settings_architect_type t3', '.t3.id = t1.sanrachana_prakar', 'left');
            $this->db->where('ls_file_no', $file_no);
            // if(!empty($kitta_no)){
            //     $this->db->where('t1.k_no', $kitta_no);
            // }
            // if(!empty($user) && $user != 1) {
            //     $this->db->where('t1.added_by', $user);
            // }
            // $this->db->limit($limit, $start);
            // $this->db->order_by('t1.'.$col,$dir);
            $query = $this->db->get();
            if($query->num_rows()>0)
            {
                return $query->result_array(); 
            }
            else
            {
                return null;
            }
        }
        
    }

    /**
        * This function get sanrachan land and sanrachana.
        * @param NULL
        * @return array
    */
    public function SanrachanaDescriptionCount($file_no = NULL,$kitta_no= NULL)
    {
        if(empty($file_no)) {
            return null;
        } else{
            $this->db->select('*')->from('sanrachana_details');
            if(!empty($kitta_no)){
                $this->db->where('k_no', $kitta_no);
            }
            $this->db->where('ls_file_no', $file_no);
            $query = $this->db->get();
            return $query->num_rows();
        }
    }

    /**
        * This function get land details with id reference.
        * @param int $id
        * @return row array
    */
    public function GetLandDetailsRow($condition) {
        $this->db->where($condition);
        $result = $this->db->get('land_description_details');
        !empty($result)?$result->row_array:false;
    }

    /**
        * This function get land details with id reference.
        * @param array $condition
        * @return row array
    */

    public function getLandDescriptionByKittaNo($kno,$road_name, $nn_number,$file_no) {
        //$fy = get_current_fiscal_year();
        $condition = array(
            'k_number' => $kno,
            'ld_file_no' =>$file_no,
            'road_name' =>$road_name,
            'nn_number' =>$nn_number,
        );
        return $this->db->select('*')
                        ->from('land_description_details')
                        ->where($condition)
                        ->get()
                        ->row_array();
    }


    //get min strucuture amount
    public function getMinStrucureAmount($land_area_type, $structure_type) {
        $get_current_fiscal_year = current_fiscal_year();
        $condition = array(
            'structure_type_id' => $land_area_type,
            'structure_id' => $structure_type,
            'fiscal_year'=> $get_current_fiscal_year
        );
        return $this->db->select('*')
                        ->from('settings_structure_minimum_amount')
                        ->where($condition)
                        ->get()
                        ->row_array();
    }

    //get depricitated percent
    public function getDepricitatedPercentByStrucuture($land_area_type) {
        $fiscal_year = current_fiscal_year();
        return $this->db->select('*')
                        ->from('settings_architect_age_rate')
                        ->where('structure_id', $land_area_type)
                        ->where('fiscal_year',$fiscal_year)
                        ->get()
                        ->row_array();
    }

    //get dep range
    public function getDepRange($year_range) {
        $fiscal_year = current_fiscal_year();
        $sql = "
            SELECT * from settings_architect_age where ".$year_range. " BETWEEN from_range and to_range
        and fiscal_year ='$fiscal_year'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    //get dep percent
    public function getDepPercent($age, $land_area_type) {
        $condition = array(
            'age_range_id' => $age,
            'structure_id' => $land_area_type,
            'fiscal_year'  => current_fiscal_year()
        );
        return $this->db->select('*')
                        ->from('settings_architect_age_rate')
                        ->where($condition)
                        ->get()
                        ->row_array();
    }
    public function GetSanrachanaDetailsRow($id) {
        $this->db->select('*');
        $this->db->from('sanrachana_details');
        // $this->db->join('settings_architect_structure t2', '.t2.id = t1.sanrachana_banot_kisim', 'left');
        // $this->db->join('settings_architect_type t3', '.t3.id = t1.sanrachana_prakar', 'left');
        $this->db->where('id', $id);
        $query = $this->db->get();
         return !empty($result)?$result->row_array():false;
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $del=$this->db->delete('sanrachana_details');
        if($del) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
     //get sanrachana by kitta no
    public function getSanrachanaByDKNo($kitta, $file_no) {
        $this->db->select('*');
        $this->db->from('sanrachana_details');
        $this->db->where('k_no', $kitta);
        $this->db->where('ls_file_no', $file_no);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get();
         return !empty($result)?$result->row_array():false;
    }
    
    public function checkSanrachanaDetails($k_no, $file_no) {
        $this->db->select('*')->from('sanrachana_details');
        $this->db->where('k_no', $k_no);
        $this->db->where('ls_file_no', $file_no);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getAll($ward) {
       $this->db->select('*')->from('sanrachana_details');
         $this->db->where('added_ward',$ward);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getListByIDS($ids) {
        //pp($ids);
        $this->db->select('*')->from('sanrachana_details');
        $this->db->where_in('id',$ids);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCurrentBilling() {
        $fiscal_year    = current_fiscal_year();
        $this->db->select('*')->from('sampati_kar_bhumi_kar_bill_details');
        $this->db->where('added_ward','1');
        $this->db->where('fiscal_year',$fiscal_year);
        $result         = $this->db->get();
        return $result->result_array();
    }

    public function updateBillingDetails($id, $post_array) {
        $this->db->trans_start();
        //$this->db->where('guid', $id);
        $this->db->update_batch('sanrachana_details',$post_array,'id');
        $this->db->trans_complete();
        // was there any update or error?
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            return true;
        }
    }


    public function saveFloorDetails($post_data) {
    	$this->db->trans_start();
    	$this->db->insert_batch('floor_details',$post_data);
    	$this->db->trans_complete();        
    	return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

    public function batchUpdate($id, $post_array) {
        $this->db->trans_start();
        $this->db->update_batch('floor_details', $post_array, 'id');
        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            // any trans error?
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            return true;
        }
    }

}//end of class

?>
