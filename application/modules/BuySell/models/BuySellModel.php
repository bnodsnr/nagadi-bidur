<?php



/**

 * Created by PhpStorm.

 * User: root

 */

class BuySellModel extends CI_Model

{

    public function __construct()

    {

        parent::__construct();

    }



    /*

     *This function get all profile details

     *param null

     *retrun array

    */

    public function getProfile() {

        $this->db->select('file_no, land_owner_name_np')->from('land_owner_profile_basic');
        $this->db->where('added_ward', $this->session->userdata('PRJ_USER_WARD'));
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

    public function saveBuySellDetails($post_data) {
        $this->db->trans_start();
        $this->db->insert_batch('buy_sell',$post_data);
        $this->db->trans_complete(); 
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }


    /*

     *This function get all land description by file no

     *param str $kittaNo kittaNo

     *retrun array

    */

    public function getLandDetails($kittaNo, $fileNo) {
        return  $this->db->select('*')
                ->from('land_description_details')
                ->where('k_number', $kittaNo)
                ->where('ld_file_no', $fileNo)
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

    public function updateLandDetails($postData, $file_no,$kno) {
        $this->db->trans_start();
        $this->db->where('ld_file_no', $file_no);
        $this->db->where('k_number', $kno);
        $this->db->update('land_description_details',$postData);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
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

        $this->db->insert('buy_sell',$post_array);

        $this->db->trans_complete();        

        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;

    }

    public function insertBuySellLandDetails($post_array) {

        $this->db->trans_start();

        $this->db->insert('land_area_after_buy_sell',$post_array);

        $this->db->trans_complete();        

        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;

    }



    //get list

    public function getList(){

        $this->db->select('t1.*,t2.land_owner_name_np as seller_name, t3.land_owner_name_np as buyer_name');

        $this->db->from('buy_sell t1');

        $this->db->join('land_owner_profile_basic t2','t2.file_no = t1.seller_file_no','left');

        $this->db->join('land_owner_profile_basic t3','t3.file_no = t1.buyer_file_no','left');

        $query = $this->db->get();

        return $query->result_array();

    }



    public function getSelectedList( $id ){

        $this->db->select('t1.*,t2.land_owner_name_np as seller_name,t2.lo_ward,t2.lo_gapa_napa,t2.lo_district,t2.lo_state, t3.land_owner_name_np as buyer_name,t3.lo_ward as bward,t3.lo_gapa_napa as bgana,t3.lo_district as bdis,t3.lo_state as bstatte, t4.present_ward,t4.land_area_type,t5.land_area_type,t6. sanrachana_prakar,t6.sanrachana_banot_kisim,t7.architect_type as prakar,t8.structure_type as kisim');

        $this->db->from('buy_sell t1');

        $this->db->join('land_owner_profile_basic t2','t2.file_no = t1.seller_file_no','left');

        $this->db->join('land_owner_profile_basic t3','t3.file_no = t1.buyer_file_no','left');

        $this->db->join('land_description_details t4','t4.k_number = t1.new_kitta_no','left');

        $this->db->join('settings_land_area_type t5','t5.id = t4.land_area_type','left');

        $this->db->join('sanrachana_details t6','t6.id = t1.s_sanrachana','left');

        $this->db->join('settings_architect_type t7','t7.id = t6.sanrachana_prakar','left');

        $this->db->join('settings_architect_structure t8','t8.id = t6.sanrachana_banot_kisim','left');

        $this->db->where('t1.id', $id);

        $query = $this->db->get();

        return $query->result_array(); 

    }



}