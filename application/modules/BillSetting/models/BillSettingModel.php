<?php 



class BillSettingModel extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->fy = current_fiscal_year();
    }

	//get get user
	public function getUser() {
		return $this->db->select('userid,user_name,name,ward')
				->from('users')
				->where('userid !=', 1)
				->where('status !=',2)
				->order_by('ward', 'ASC')
				->get()
				->result_array();
	}

	public function getBillData($type) {
		$this->db->select('t1.*,t2.userid,t2.name,t2.ward');
		$this->db->from('settings_bill_setup t1');
		$this->db->join('users t2', 't2.userid = t1.user_id','left');
		$this->db->where('t1.bill_type', $type);
		$this->db->where('t1.fiscal_year', $this->fy);
		$this->db->order_by('ward', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function checkActiveBill($user_id, $bill_type) {
		return $this->db->select('*')
				->from('settings_bill_setup')
				->where('user_id', $user_id)
				->where('bill_type', $bill_type)
				->where('fiscal_year', $this->fy)
				->get()
				->row_array();
	}

	public function getReservedBills() {
		return $this->db->select('*')
				->from('reserve_bills')
				->where('fiscal_year', $this->fy)
				->get()
				->result_array();
	}

	//check from bill eixts on db
	public function isValidFromBill($bill_no, $type) {
		$sql = "SELECT * FROM settings_bill_setup WHERE $bill_no BETWEEN bill_from AND bill_to AND fiscal_year = '{$this->fy}' AND bill_type = '{$type}'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// public function isValidToBill($from_bill, $type) {
	// 	$sql = "SELECT * FROM settings_bill_setup WHERE $from_bill BETWEEN bill_from AND bill_to AND fiscal_year = '{$this->fy}' AND bill_type = '{$type}'";
	// 	$query = $this->db->query($sql);
	// 	return $query->result();
	// }

}