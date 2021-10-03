<?php
class ProfileModel extends CI_Model{


	public function getLandOwnerDetails() {
		$user = $this->session->userdata('PRJ_USER_ID');
		$this->db->select('*')->from('land_owner_profile_basic');
		if(!empty($user) && $user != 1) {
			$this->db->where('added_by', $user);
		}
		$query = $this->db->get();
		return $query->result_array();

	}
        
        

    public function getProfileDetails($file_no) {
        $this->db->select('*')->from('land_owner_profile_basic');
        $this->db->where('file_no', $file_no);
        $query = $this->db->get();
        return $query->row_array();
    }
    /** 
     * This function on ajax call get list of land owner profile
     * This function is used for datatables for server side uses
     * @param INT $limit, INT $start, INT $col, INT $fiscal, INT $fiscal_year
     * @return json
    */
  	public function GetProfile($limit,$start,$col,$dir, $org_file_no= NULL, $org_name = NULL, $reg_no = NULL,$contact_no = NULL,$paid_status)
    {  

        $this->db->select('
                *'
            )->from('land_owner_profile_basic');

        
       if(!empty($org_file_no)){
            $this->db->where('file_no', $org_file_no);
        }
         if(!empty($org_name)){
            $this->db->like('land_owner_name_np', $org_name);
        }
        if(!empty($reg_no)){
            $this->db->where('lo_czn_no', $reg_no);
        }
        if(!empty($contact_no)){
            $this->db->where('land_owner_contact_no', $contact_no);
        }
        $this->db->where('form_type', '2');
        
        $user = $this->session->userdata('PRJ_USER_ID');
        if($user != 1) {
            $this->db->where('added_by', $user);
        }
        if(!empty($paid_status)){
            if($paid_status == 2){
             $this->db->where('current_flag',0);
            } else {
                $this->db->where('current_flag',1);
            }
        }
        $this->db->where('status', 1);
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
    public function CountProfile($org_file_no= NULL, $org_name = NULL, $reg_no = NULL,$contact_no = NULL, $paid_status = NULL)
    {
        $this->db->select('*')->from('land_owner_profile_basic');
        if(!empty($org_file_no)){
            $this->db->where('file_no', $org_file_no);
        }
         if(!empty($org_name)){
            $this->db->like('land_owner_name_np', $org_name);
        }
        if(!empty($reg_no)){
            $this->db->where('lo_czn_no', $reg_no);
        }
        if(!empty($contact_no)){
            $this->db->where('land_owner_contact_no', $contact_no);
        }
        $this->db->where('form_type', '2');
         if(MODULE == 1){
            $user = $this->session->userdata('PRJ_USER_ID');
            if($user != 1) {
                $this->db->where('added_by', $user);
            }
        }

        if(!empty($paid_status)){
            if($paid_status == 2){
             $this->db->where('current_flag',0);
            } else {
                $this->db->where('current_flag',1);
            }
        }
        // if(!empty($paid_status)){
        //      $this->db->where('initial_flag',  $paid_status);
        // }
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
   
	//save profile
	public function saveProfileDetails($post_data) {
		$this->db->trans_start();
    	$this->db->insert('land_owner_profile_basic',$post_data);
    	$this->db->trans_complete();        
    	return ($this->db->trans_status() === FALSE)? FALSE:$this->db->insert_id();
	}

	public function updateProfileDetails($basic_info, $id) {
		$this->db->trans_start();
		$this->db->where('id', $id);
    	$this->db->update('land_owner_profile_basic',$basic_info);
    	$this->db->trans_complete();        
    	return ($this->db->trans_status() === FALSE)? FALSE:$this->db->insert_id();
	}
	//save profile details
	public function saveFamilyDetails($data) {
		$this->db->trans_start();
    	$this->db->insert_batch('land_owner_family_details',$data);
    	$this->db->trans_complete();        
    	return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
	}

	public function updateFamilyDetails($id, $post_array) {
        $this->db->trans_start();
        $this->db->update_batch('land_owner_family_details',$post_array,'id');
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

    //save profile details
    public function deleteProfile($id) {
        $this->db->trans_start();
        $data = array('status' => 2);
        $this->db->where('file_no', $id);
        $this->db->update('land_owner_profile_basic', $data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }
    public function deleteFamilyDetails($data) {
        $this->db->trans_start();
        $this->db->delete('land_owner_profile_basic',$data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

    public function bulkDeleteLand($data) {
        $this->db->trans_start();
        $this->db->delete('land_owner_profile_basic',$data);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

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
                WHERE p.ld_file_no = '$file_no'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // public function deleteProfile($id) {
    //     $this->db->trans_start();
    //     $data = array('status' => 2);
    //     $this->db->where('file_no', $id);
    //     $this->db->update('land_owner_profile_basic', $data);
    //     $this->db->trans_complete();        
    //     return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    // }

    // public function deleteProfile($id) {
    //     $this->db->trans_start();
    //     $data = array('status' => 2);
    //     $this->db->where('file_no', $id);
    //     $this->db->update('land_owner_profile_basic', $data);
    //     $this->db->trans_complete();        
    //     return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    // }

    public function getTaxPaidProfile() {
        $dql = 'SELECT * 
            FROM land_owner_profile_basic
            WHERE EXISTS 
            (SELECT * 
                FROM sampati_kar_bhumi_kar_bill_details 
                WHERE land_owner_profile_basic.file_no = sampati_kar_bhumi_kar_bill_details.nb_file_no)';
    }


    /** 
     * This function on ajax call get list of land owner profile
     * This function is used for datatables for server side uses
     * @param INT $limit, INT $start, INT $col, INT $fiscal, INT $fiscal_year
     * @return json
    */
    public function GetPaidProfile($limit,$start,$col,$dir, $org_file_no= NULL, $org_name = NULL, $reg_no = NULL,$contact_no = NULL)
    {  
        $this->db->select('
                *'
            )->from('land_owner_profile_basic');

        
       if(!empty($org_file_no)){
            $this->db->where('file_no', $org_file_no);
        }
         if(!empty($org_name)){
            $this->db->like('land_owner_name_np', $org_name);
        }
        if(!empty($reg_no)){
            $this->db->where('lo_czn_no', $reg_no);
        }
        if(!empty($contact_no)){
            $this->db->where('land_owner_contact_no', $contact_no);
        }
        $this->db->where('form_type', '2');
        $user = $this->session->userdata('PRJ_USER_ID');
        if($user != 1) {
            $this->db->where('added_by', $user);
        }
        $this->db->where('status', 1);
        $this->db->where('initial_flag',1);
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
    public function CountPaidProfile($org_file_no= NULL, $org_name = NULL, $reg_no = NULL,$contact_no = NULL)
    {
        $this->db->select('*')->from('land_owner_profile_basic');
        if(!empty($org_file_no)){
            $this->db->where('file_no', $org_file_no);
        }
         if(!empty($org_name)){
            $this->db->like('land_owner_name_np', $org_name);
        }
        if(!empty($reg_no)){
            $this->db->where('lo_czn_no', $reg_no);
        }
        if(!empty($contact_no)){
            $this->db->where('land_owner_contact_no', $contact_no);
        }
        $this->db->where('form_type', '2');
        if(MODULE == 1){
        $user = $this->session->userdata('PRJ_USER_ID');
        if($user != 1) {
            $this->db->where('added_by', $user);
        }
        }
        $this->db->where('initial_flag',1);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }


     /** 
     * This function on ajax call get list of land owner profile
     * This function is used for datatables for server side uses
     * @param INT $limit, INT $start, INT $col, INT $fiscal, INT $fiscal_year
     * @return json
    */
    public function GetUnPaidProfile($limit,$start,$col,$dir, $org_file_no= NULL, $org_name = NULL, $reg_no = NULL,$contact_no = NULL)
    {  
        $this->db->select('
                *'
            )->from('land_owner_profile_basic');

        
       if(!empty($org_file_no)){
            $this->db->where('file_no', $org_file_no);
        }
         if(!empty($org_name)){
            $this->db->like('land_owner_name_np', $org_name);
        }
        if(!empty($reg_no)){
            $this->db->where('lo_czn_no', $reg_no);
        }
        if(!empty($contact_no)){
            $this->db->where('land_owner_contact_no', $contact_no);
        }
        $this->db->where('form_type', '2');
        
        $user = $this->session->userdata('PRJ_USER_ID');
        if($user != 1) {
            $this->db->where('added_by', $user);
        }
      
        $this->db->where('status', 1);
        $this->db->where('initial_flag!=',1);
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
    public function CountUnPaidProfile($org_file_no= NULL, $org_name = NULL, $reg_no = NULL,$contact_no = NULL)
    {
        $this->db->select('*')->from('land_owner_profile_basic');
        if(!empty($org_file_no)){
            $this->db->where('file_no', $org_file_no);
        }
         if(!empty($org_name)){
            $this->db->like('land_owner_name_np', $org_name);
        }
        if(!empty($reg_no)){
            $this->db->where('lo_czn_no', $reg_no);
        }
        if(!empty($contact_no)){
            $this->db->where('land_owner_contact_no', $contact_no);
        }
        $this->db->where('form_type', '2');
         if(MODULE == 1){
            $user = $this->session->userdata('PRJ_USER_ID');
            if($user != 1) {
                $this->db->where('added_by', $user);
            }
        }
        $this->db->where('initial_flag!=',1);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function ACountPaidProfile($ward) {
        $this->db->select('*')->from('land_owner_profile_basic');
        $this->db->where('form_type', '2');
        $this->db->where('added_ward', $ward);
        $this->db->where('initial_flag=',1);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function ACountUnPaidProfile($ward) {
        $this->db->select('*')->from('land_owner_profile_basic');
        $this->db->where('form_type', '2');
        $this->db->where('added_ward', $ward);
        $this->db->where('initial_flag!=',1);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
}//end of class
// update land_owner_profile_basic A
// INNER JOIN sampati_kar_bhumi_kar_bill_details B on A.file_no = B.nb_file_no
// set A.initial_flag = 1 where
// exists (select * from sampati_kar_bhumi_kar_bill_details)

// UPDATE land_owner_profile_basic JOIN users 
//     ON land_owner_profile_basic.added_by = users.userid
// SET land_owner_profile_basic.added_ward = users.ward,
// WHERE
//     land_owner_profile_basic.added_by = users.userid


//UPDATE A INNER JOIN B 
//     ON A.name = B.name
// SET A.x = 1
// WHERE A.x <> B.x
// update land_description_details A INNER JOIN sampati_kar_bhumi_kar_bill_details B on A.ld_file_no = B.nb_file_no set A.initial_flag = 1 where exists (select * from sampati_kar_bhumi_kar_bill_details)
?>
