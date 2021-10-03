<?php
class BusinessProfileModel extends CI_Model{

	/**
		* This function get land owner list.
        * @param NULL
        * @return array
	*/
	public function getLandOwnerDetails() {
		$user = $this->session->userdata('PRJ_USER_ID');
		$this->db->select('*')->from('land_owner_profile_basic');
		if(!empty($user) && $user != 1) {
			$this->db->where('added_by', $user);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
    /**
     * This function on ajax call get list of land owner profile
     * This function is used for datatables for server side uses
     * @param INT $limit, INT $start, INT $col, INT $fiscal, INT $fiscal_year
     * @return json
    */
  	public function business_profile($limit,$start,$col,$dir, $org_file_no= NULL, $org_name = NULL, $reg_no = NULL,$contact_no = NULL)
    {  
        $this->db->select('
                *'
            )->from('land_owner_profile_basic');

        
       if(!empty($org_file_no)){
            $this->db->where('file_no', $org_file_no);
        }
         if(!empty($org_name)){
            $this->db->where('land_owner_name_np', $org_name);
        }
        if(!empty($reg_no)){
            $this->db->where('lo_czn_no', $reg_no);
        }
        if(!empty($contact_no)){
            $this->db->where('land_owner_contact_no', $contact_no);
        }
        $this->db->where('form_type', 1);
        if($this->session->userdata('PRJ_USER_ID') != 1 ) {
            $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
        }
        $this->db->limit($limit, $start);
        $this->db->order_by($col,$dir);
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
    public function business_profile_count($org_file_no= NULL, $org_name = NULL, $reg_no = NULL,$contact_no = NULL)
    {
        $this->db->select('*')->from('land_owner_profile_basic');
        if(!empty($org_file_no)){
            $this->db->where('file_no', $org_file_no);
        }
         if(!empty($org_name)){
            $this->db->where('land_owner_name_np', $org_name);
        }
        if(!empty($reg_no)){
            $this->db->where('lo_czn_no', $reg_no);
        }
        $this->db->where('form_type', 1);
        if(!empty($contact_no)){
            $this->db->where('land_owner_contact_no', $contact_no);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

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
        * This function create business profile.
        * @param array $post_data
        * @return bool
    */
    public function saveProfileDetails($post_data) {
        $this->db->trans_start();
        $this->db->insert('land_owner_profile_basic',$post_data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:$this->db->insert_id();
    }

    /**
        * This function update business profile.
        * @param array $post_data,int $id
        * @return bool
    */
    public function updateProfileDetails($basic_info, $id) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('land_owner_profile_basic',$basic_info);
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
        * @param NULL
        * @return array
    */
    public function GetBusinessLandDetails($limit,$start,$col,$dir, $file_no = NULL,$kitta_no= NULL)
    {  
        if(empty($file_no)) {
            return null;
        } else{
            $this->db->select('t1.*,t1.id as land_id,t2.road_name as rm,t3.land_area_type as lat, t4.category');
            $this->db->from('land_description_details as t1');
            $this->db->join('settings_road as t2','t2.id = t1.road_name','left');
            $this->db->join('settings_land_area_type as t3','t3.id = t1.land_area_type','left');
            $this->db->join('land_category as t4','t4.id = t1.land_category','left');
            $this->db->where('t1.ld_file_no', $file_no);
            if(!empty($kitta_no)){
                $this->db->where('k_number', $kitta_no);
            }
            if(!empty($user) && $user != 1) {
                $this->db->where('t1.added_by', $user);
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
        
    }

    /**
        * This function get sanrachan land and sanrachana.
        * @param NULL
        * @return array
    */
    public function BusinessLandDescriptionCount($file_no = NULL,$kitta_no= NULL)
    {
        if(empty($file_no)) {
            return null;
        } else{
            $this->db->select('*')->from('land_description_details');
            if(!empty($kitta_no)){
                $this->db->where('k_number', $kitta_no);
            }
            $this->db->where('ld_file_no', $file_no);
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
        if($result->num_rows > 0 ) {
            return $result->row_array();
        } else {
            return false;
        }
    }

    /**
        * This function get land details with id reference.
        * @param array $condition
        * @return row array
    */
    public function GetProfileRow($condition) {
        $this->db->where($condition);
        $result = $this->db->get('land_owner_profile_basic');
        if($result->num_rows() > 0 ) {
            return $result->row_array();
        } else {
            return false;
        }
    }

}//end of class

?>
