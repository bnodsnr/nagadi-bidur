<?php 
class Passwordmodel extends CI_Model
{
	public function UpdatePassword($data,$ID)
	{
		$this->db->where('userid', $ID);
        $this->db->update('users', $data);
        return true;
	}
}