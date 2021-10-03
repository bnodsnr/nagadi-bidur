<?php

class LandDetailsModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->fy = current_fiscal_year();
        $this->recently_closed_fy = recently_closed_fy();
    }
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
        $fiscal_year = current_fiscal_year();
        $this->db->where('fiscal_year', $fiscal_year);
        $this->db->where('ld_file_no', $file_no);
        if($this->fy == $this->recently_closed_fy) {
            $this->db->where('initial_flag !=',1);
        } else {
            $this->db->where('current_flag', 1);
        }
        $query = $this->db->get('land_description_details');
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

    public function checkHasBillByKitta($kitta_no,$file_no) {

        $fiscal_year = get_current_fiscal_year();

        $this->db->where('fiscal_year', $fiscal_year);

        $this->db->where('ld_file_no', $file_no);

        $this->db->where('k_number',$kitta_no);

        if($this->fy == $this->recently_closed_fy) {
            $this->db->where('initial_flag !=',1);
        } else {
            $this->db->where('current_flag', 1);
        }

        $query = $this->db->get('land_description_details');

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

        * @param NULL

        * @return array

    */

    public function GetLandDetails($file_no)

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
            $this->db->where('status !=',2);

            // if(!empty($kitta_no)){

            //     $this->db->where('k_number', $kitta_no);

            // }

            // if(!empty($user) && $user != 1) {

            //     $this->db->where('t1.added_by', $user);

            // }

            //$this->db->limit($limit, $start);

            $this->db->order_by('id', 'DESC');

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

    public function CountLand($file_no = NULL,$kitta_no= NULL)

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

        !empty($result)?$result->row_array:false;

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



    public function remove($id) {

        $this->db->where('id', $id);

        $del=$this->db->delete('land_description_details');

        if($del) {

            return TRUE;

        } else {

            return FALSE;

        }

    }



    public function HasSanrachana($kitta_no) {

        $this->db->where('k_no', $kitta_no);

        $query = $this->db->get('sanrachana_details');

        if ($query->num_rows() > 0){

            return true;

        }

        else{

            return false;

        }

    }



    public function RemoveSanrachanaDetails($kno) {

        $this->db->where('k_no', $kno);

        $del=$this->db->delete('sanrachana_details');

        if($del) {

            return TRUE;

        } else {

            return FALSE;

        }

    }





    public function updateSanrachana($basic_info, $k_no) {

        $this->db->trans_start();

        $this->db->where('k_no', $k_no);

        $this->db->update_batch('sanrachana_details',$basic_info,'k_no');

        $this->db->trans_complete();        

        return ($this->db->trans_status() === FALSE)? FALSE:$this->db->insert_id();

    }



    //public function updateSanrachana($kitta_no, $data) {

        // $this->db->where('k_no', $kitta_no);

        // $this->db->update('sanrachana_details', $data);

        // return true;

    //}



    public function addressOld(){

        $sql = 'select DISTINCT old_name from settings_old_and_present';

        $result = $this->db->query($sql);

        return $result->result_array();

    }



    public function oldWard($old_name){

           $query = $this->db->select('old_ward')

                            ->distinct('old_ward')

                            ->from('settings_old_and_present')

                            ->where('old_name',$old_name)

                            ->order_by('old_ward', 'ASC')

                            ->get(); 

             return $query->result_array();



        // $sql = 'select DISTINCT old_ward from settings_old_and_present where old_name = $old_ward order by old_ward ASC';



        // $result = $this->db->query($sql);



        // return $result->result_array();

    }



    public function getNewAddressDetails($gapanapa, $ward) {

        $condition = array(

            'old_name' => $gapanapa,

            'old_ward' => $ward

        );

        $this->db->select('*')->from('settings_old_and_present');

        $this->db->where($condition);

        $query = $this->db->get();

        return $query->result_array();

    }



  



    public function getRoadDetails($ward =NULL) {

        $this->db->select('*')->from('settings_road');

        if(!empty($ward)) {

            $this->db->where('ward', $ward);

        }
        $this->db->where('fiscal_year',$this->fy);
        $query = $this->db->get();

        return $query->result_array();

    }



    public function getLandCost($road_name =NULL,$land_area_type=NULL,$ward=NULL) {

        //$fiscal_year = get_current_fiscal_year();

        $this->db->from('settings_area_minimal_cost');

        if(!empty($road_name)) {

            $this->db->where('road_name', $road_name);

        }

        if(!empty($land_area_type)) {

            $this->db->where('land_area_type', $land_area_type);

        }

        $this->db->where('fiscal_year',$this->fy);

        $query = $this->db->get();

        return $query->row_array();

        // $condition = array(

        //     'id' => $road_name,

        //     't1.fiscal_year' => get_current_fiscal_year(),

        // );

        // $this->db->select('t1.*, t2.*')->from('settings_road t1');

        // $this->db->join('settings_land_area_type t2', 't2.id = t1.land_area_type');

        // $this->db->where($condition);

        // $query = $this->db->get();

        // return $query->row_array();

        // return $this->db->select('*')

        //              ->from('settings_road')

        //              ->where($condition)

        //              ->get()

        //              ->row_array();

    }

}//end of class



?>