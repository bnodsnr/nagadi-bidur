<?php
class Userpermissionmodel extends CI_Model
{
    public function __construct()
    {
        $this->table = "user_permission";
    }
    /**
    *Queries all the data
    *@params void
    *@returns results
    *@created by Sarju
    *@modified by
    */
    public function ListAll()
    {
        $this->db->select('a.*,  e.name as employee');
        $this->db->from('user_permission a');
        $this->db->join('users e', 'e.userid = a.userid', 'join');
        $this->db->group_by('a.userid');
        return $this->db->get();
    }
    /**
    *Insert data into database
    *@params data array
    *@returns void
    *@created by Sarju
    *@modified by
    */
    public function Add($data)
    {
			$getUsers = $this->db->where('userid', $data['userid'])->get('user_permission');
			if($getUsers->num_rows()==0){
        $query = $this->db->insert('user_permission', $data);
				return true;
    	}else{
				return false;
			}
		}
    /**
    *Query Data by Id
    *@params single id or value
    *@returns results
    *@created by Sarju
    *@modified by
    */
    public function Details($id)
    {
        $this->db->select('a.*,  e.name as employee');
        $this->db->from('user_permission a');
        $this->db->join('users e', 'e.userid = a.userid', 'join');
        $this->db->where('a.userid', $id);
        return $query = $this->db->get();
        //echo $this->db->last_query();
        //echo "<pre>";var_dump($query->result());die();
    }
    /**
    *Modifies the data inserted into the database
    *@params (2) id , array of data
    *@returns null
    *@created by Sarju
    *@modified by
    */
    public function Update($id, $data, $leaveid)
    {
        $this->db->where('userid', $id);
        $this->db->where('LeaveID', $leaveid);
        $this->db->update($this->table, $data);
        //echo $this->db->last_query();die();
    }
    /**
    *Deletes data from database
    *@params id
    *@returns null
    *@created by Sarju
    *@modified by
    */
    public function Delete($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete($this->table);
				$this->db->query("SET  @num := 0");
				$this->db->query("UPDATE user_permission SET ID = @num := (@num+1)");
				$this->db->query("ALTER TABLE user_permission AUTO_INCREMENT =1");
    }

    public function getDataByTable($table)
    {
        $this->db->select('userid, name');
        $this->db->from($table);
        if ($table=='users') {
            $this->db->where('status', '1');
        }
        $this->db->order_by('name', 'asc');
        return $this->db->get();
    }
    public function ListAlldata()
    {
        return $this->db->get($this->table);
    }
    public function ListData($table, $empids = array())
    {
        if ($table=='users') {
            $this->db->where('status', '1');
            $this->db->where('userid != 1');
        }
        return $this->db->get($table);
    }
    public function AssignedEmployeed()
    {
        $this->db->select('userid');
        $this->db->from($this->table);
        $this->db->group_by('userid');
        $query = $this->db->get();
        $returnArray = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row):
                array_push($returnArray, $row->userid);
            endforeach;
            $query->free_result();
        }
        return $returnArray;
    }
}
