<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class BhumiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function allposts($limit,$start,$col,$dir, $fiscal_year= NULL, $land_area_type = NULL, $road_type = NULL)
    {  
        $this->db->select('
            t1.*,
            t1.id as ids, 
            t1.fiscal_year as fy,
            t2.*,
            t2.land_area_type as lat,
            t3.*, 
            t3.road_name as lt'
        );
       
        $this->db->from('bhumikar t1');
        $this->db->join('settings_land_area_type t2' ,'t2.id = t1.land_area_type','left');
        $this->db->join('settings_road t3' ,'t3.id = t1.land_category','left');
         if(!empty($fiscal_year)){
            $this->db->where('t1.fiscal_year', $fiscal_year);
        }
        if(!empty($land_area_type)){
            $this->db->where('t1.land_area_type', $land_area_type);
        }
        if(!empty($land_category)){
            $this->db->where('t1.land_category', $land_category);
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

    public function allposts_count($fiscal_year= NULL, $land_area_type = NULL, $land_category = NULL)
    {
        $this->db->select('*')->from('bhumikar');
        if(!empty($fiscal_year)){
            $this->db->where('fiscal_year', $fiscal_year);
        }
        if(!empty($land_area_type)){
            $this->db->where('land_area_type', $land_area_type);
        }
        if(!empty($land_category)){
            $this->db->where('land_category', $land_category);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
}