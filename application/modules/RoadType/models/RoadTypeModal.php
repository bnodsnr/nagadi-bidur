<?php 

class RoadTypeModal extends CI_Model {

	function __construct() {
        parent::__construct(); 
        
    }

    public function allposts_count($filter_1= NULL, $filter_2 = NULL)
    { 
        $this->db->select('*')->from('settings_road_type');
        if(!empty($filter_1)){
            $this->db->where('fiscal_year', $filter_1);
        }
        if(!empty($filter_2)){
            $this->db->where('road_type', $filter_2);
        }
        $query = $this->db->get();
        return $query->num_rows();  

    }
    
    public function allposts($limit,$start,$col,$dir, $filter_1= NULL, $filter_2 = NULL)
    { 
        $this->db->select('*')->from('settings_road_type');
        if(!empty($filter_1)){
            $this->db->where('fiscal_year', $filter_1);
        }
        if(!empty($filter_2)){
            $this->db->where('road_type', $filter_2);
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
   
    function posts_search($limit,$start,$search_1 = NULL,$serach_2 = NULL,$col,$dir)
    {
        $this->db->select('*')->from('settings_road_type');
        if(!empty($search_1)){
            $this->db->where('fiscal_year', $search_1);
        }
        if(!empty($search_2)){
            $this->db->where('road_type', $search_2);
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

    function posts_search_count($search_1,$search_2)
    {
        $this->db->select('*')->from('settings_road_type');
        if(!empty($search_1) && !empty($search_2)){
            $this->db->where('fiscal_year', $search_1);
        }
        if(!empty($search_2)){
            $this->db->where('road_type', $search_2);
        }
        $query = $this->db->get();
        // $query = $this
        //         ->db
        //         ->like('fiscal_year',$search)
        //         ->or_like('road_type',$search)
        //         ->get('settings_road_type');
        return $query->num_rows();
    } 
}