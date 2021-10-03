<?php
if (!defined('BASEPATH'))     exit('No direct script access allowed');

class CommonModel extends CI_Model {
    
    public function getCurrentUser($userid){
        return $this->db->select('*')->from('users')
                        ->where('userid', $userid)
                        ->get()
                        ->row_array();
    }
	/**
        * This function get land details with id reference.
        * @param string $table , table name
        * @param array $data, post data
        * @return row array
    */
	public function insertData($table,$data)
	{
		$this->db->insert($table, $data);
		return TRUE;
	}
	
    /**
        * This fetch entries from given table
        * @param string $table , table name
        * @param string $order_by, order
        * @param string $order_by_field, order column
        * @return array
    */
	public function getData($table,$order_by=null, $order_by_field=NULL)
	{
		if(!empty($order_by) && !empty($order_by_field)) {
            $this->db->order_by($order_by_field,$order_by);
        }
        $query = $this->db->get($table);
        $result = $query->result_array();
        return !empty($result)?$result:false;
	}
   
   /**
        * This fetch row from given table
        * @param string $table , table name
        * @param string $fieldName, column
        * @param string $fieldData, where condition.aaa
        * @return result array
    */
	public function getAllDataByField($table,$FieldName,$FieldData)
	{
		$this->db->where($FieldName,$FieldData);
        $query = $this->db->get($table);
        $result = $query->result_array();
        return !empty($result)?$result:false;
	}

    /**
        * This fetch row from given table
        * @param string $table , table name
        * @param int $id
        * @return row array
    */
	//get data by id
	public function getDataByID($table,$ID)
	{
		$query = $this->db->query("SELECT * FROM $table  WHERE `id` = '$ID'");
        return $query->row_array();
	}

    /**
        * This fetch row by selected fields
        * @param string $table , table name
        * @param string $fieldName, column
        * @param string $fieldData, where condition.aaa
        * @return row array
    */
	public function getDataBySelectedFields($table,$fieldName,$field)
	{
		$this->db->select('*')->from($table);
		$this->db->where($fieldName,$field);
		$query = $this->db->get();
		$result = $query->row_array();
        return !empty($result)?$result:false;
	}

    /**
        * This fetch row by selected fields
        * @param string $table , table name
        * @param string $fieldName, column
        * @param string $fieldData, where condition.aaa
        * @return row array
    */
	public function getAllDataBySelectedFields($table,$fieldName,$field)
	{
		$this->db->select('*')->from($table);
		$this->db->where($fieldName,$field);
		$query = $this->db->get();
		$result = $query->result_array();
        return !empty($result)?$result:false;
	}
	//update Data
	public function UpdateData($table,$ID,$data)
	{
		$this->db->where('id', $ID);
        $this->db->update($table, $data);
        return true;
	}

	public function updateDataByField($table,$fieldName,$fieldData,$data)
	{
		$this->db->where($fieldName, $fieldData);
        $this->db->update($table, $data);
        return true;
	}
	public function updataMultipleData($table,$fieldName,$fieldData,$data)
	{
		$this->db->where_in($fieldName, $fieldData);
        $this->db->update($table, $data);
        return true;
	}

    public function deleteMultipleData($table,$fieldName,$fieldData)
    {
        $this->db->where_in($fieldName, $fieldData);
        $this->db->delete($table);
        return true;
    }

	//remove data
	public function deleteData($table,$ID)
	{
		$query = $this->db->query("DELETE FROM $table  WHERE `id` = '$ID'");
        return $this->db->affected_rows();
	}

	public function deleteDataBySelectedFields($table,$fieldName,$fieldData)
	{
		$this->db->where($fieldName, $fieldData);
        $this->db->delete($table);
        return true;
	}
	//select max id
	// public function GetMaxID($table, $invoice)
	// {
	// 	$maxid = 0;
	// 	$row = $this->db->query("SELECT MAX(id) AS `maxid` FROM $table WHERE `sales_by` = '$invoice'")->row();
	// 	return $row;
	// }

	public function checkAreadyExits($table,$fieldName,$fieldData)
    {
        $this->db->where($fieldName,$fieldData,$table);
        $query = $this->db->get($table);
        return $query->row_array();
    }

   
    //get current fiscal year
    public function getCurrentFiscalYear() {
        return $this->db->select('year')
                    ->from('fiscal_year')
                    ->where('is_current',1)
                    ->get()
                    ->row_array();
    }

    //get gapana
    public function getGapaNapa() {
        return $this->db->select('*')
                    ->from('settings_vdc_municipality')
                    ->where('district', DISTRICT)
                    ->get()
                    ->result_array();
    }

    //get districts
    public function getDistrictsByState($state) {
        return $this->db->select('*')
                        ->from('settings_district')
                        ->where('state', $state)
                        ->get()
                        ->result_array();
    }

    //get districts
    public function getDistrictsByID($ID) {
        return $this->db->select('*')
                        ->from('settings_district')
                        ->where('id', $ID)
                        ->get()
                        ->row_array();
    }


    public function getGapanaByDistrict($district) {
        return $this->db->select('*')
                        ->from('settings_vdc_municipality')
                        ->where('district_id', $district)
                        ->get()
                        ->result_array();
    }

    //get old fiscal year
    public function getDepFiscalYear() {
        $current_fy = current_fiscal_year();
        $this->db->select('*')->from('fiscal_year');
        $this->db->where('year !=', $current_fy['year']);
        $sql = $this->db->get();
        return $sql->result_array();
    }
    public function trans_log($data_array) {

    }

    public function getBFiscalYear() {
        $current_fiscal_year = current_fiscal_year();
        $year = $current_fiscal_year['year'];
        $this->db->select('*')->from('fiscal_year');
        $this->db->where('year !=', $year);
        $query = $this->db->get();
        return $query->result_array();
    }

    //update fiscal year
    public function updateFiscalYear($post_data, $id) {
        $this->db->where('id !=', $id);
        $this->db->update('fiscal_year', $post_data);
    }


    public function remove($id, $table) {
        $this->db->where('id', $id);
        $del=$this->db->delete($table);
        if($del) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function bulkDelete($data,$table, $condition) {
        $this->db->trans_start();
        $this->db->where($condition);
        $this->db->delete($table);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

    /**
        * This function get land details with id reference.
        * @param int $id
        * @return row array
    */
    public function GetLandOwnerRowByFileNo($file_no) {

        $this->db->select('t1.*,t2.name,t2.district,t2.district,t3.title');
        $this->db->from('land_owner_profile_basic t1');
        $this->db->join('settings_vdc_municipality t2', 't2.id = t1.lo_gapa_napa','left');
        $this->db->join('provinces t3', 't3.id = t1.lo_state','left');
        $this->db->where('t1.file_no', $file_no);

        $result = $this->db->get();
        return !empty($result)?$result->row_array():false;
        
    }

    /**
        * This function get land details with id reference.
        * @param int $id
        * @return row array
    */
    public function GetRoadDetailsByID($id) {
        $condition = array(
            't1.id' => $id,
            't1.fiscal_year' => get_current_fiscal_year(),
        );
        $this->db->select('t1.*, t2.id as land_area_type_id,t2.land_area_type, t3.id as land_category_id, t3.category')->from('settings_road t1');
        $this->db->join('settings_land_area_type t2', 't2.id = t1.land_area_type');
        $this->db->join('land_category t3', 't3.id = t1.road_type');//road type = land category
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
        * This function distinct old ward name
        * @param null
        * @return result array
    */
    public function addressOld(){
        $sql = 'select DISTINCT old_name from settings_old_and_present';
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    /**
        * This function distinct old ward name
        * @param null
        * @return result array
    */
    public function oldWard(){
        $sql = 'select DISTINCT old_ward from settings_old_and_present';
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    /**
        * This function get land details with id reference.
        * @param int $id
        * @return row array
    */
    public function GetLandDetailsByID($id) {
        $this->db->select('t1.*,t1.id as land_id,t1.road_name as road_type,t2.road_name as road,t3.id,t3.land_area_type as lyt, t4.category');
        $this->db->from('land_description_details as t1');
        $this->db->join('settings_road as t2','t2.id = t1.road_name','left');
        $this->db->join('settings_land_area_type as t3','t3.id = t1.land_area_type','left');
        $this->db->join('land_category as t4','t4.id = t1.land_category','left');
        $this->db->where('t1.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
        * This function get land details with id reference.
        * @param int $alpha
        * @return row
    */
    public function getNameCount($alpha) {
        $this->db->select('count(id) as third_sn');
        $this->db->from('land_owner_profile_basic');
        $this->db->where('SUBSTRING(land_owner_name_en, 1, 1)=',$alpha);
        $query = $this->db->get();
        //pp($this->db->last_query());
        return $query->row();
    }

    public function getWhereAll($table, $array) {
        $this->db->select('*')->from($table);
        $this->db->where($array);
         $query = $this->db->get();
        return $query->result_array();
    }

    public function getWhere($table, $array) {
        $this->db->select('*')->from($table);
        $this->db->where($array);
         $query = $this->db->get();
        return $query->row_array();
    }
    
    /**
        * This function get land details with id reference.
        * @param string $ld_file_no
        * @param int $road_name
        * @param int $n_number
        * @param int $k_number
        * @return row array
    */
    public function checkDuplicateLandEntry($ld_file_no, $road_name, $nn_number, $k_number) {
        $this->db->select('t1.ld_file_no, t1.road_name, t1.nn_number, t1.k_number');
        $this->db->from('land_description_details as t1');
        $this->db->where('t1.ld_file_no', $ld_file_no);
        $this->db->where('t1.road_name', $road_name);
        $this->db->where('t1.nn_number', $nn_number);
        $this->db->where('t1.k_number', $k_number);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function getUniqueOldWard() {
        $sql = 'SELECT DISTINCT(old_name) FROM settings_old_and_present';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}