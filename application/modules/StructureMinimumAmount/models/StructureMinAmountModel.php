<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class StructureMinAmountModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function allposts($limit,$start,$col,$dir, $fiscal_year= NULL, $structure_type = NULL, $architect_type = NULL)
    {  
        $get_current_fiscal_year = get_current_fiscal_year();
        $this->db->select('
                t1.*,t1.id as main_id, 
                t1.fiscal_year as fy,
                t2.*, 
                t2.structure_type as rot,
                t3.*, 
                t3.architect_type as lt'
            )->from('settings_structure_minimum_amount t1');

        $this->db->join('settings_architect_structure t2' ,'t2.id = t1.structure_type_id','left');

        $this->db->join('settings_architect_type t3' ,'t3.id = t1.structure_id','left');
        if(!empty($fiscal_year)){
            $this->db->where('t1.fiscal_year', $fiscal_year);
        }
        if(!empty($structure_type)){
            $this->db->where('t1.structure_type_id', $structure_type);
        }
        if(!empty($architect_type)){
            $this->db->where('t1.structure_id', $architect_type);
        }
        if(empty($fiscal_year)) {
            $this->db->where('t1.fiscal_year', $get_current_fiscal_year);
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

    public function allposts_count($fiscal_year= NULL, $structure_type = NULL, $architect_type = NULL)
    {
        $get_current_fiscal_year = get_current_fiscal_year();
        $this->db->select('*')->from('settings_structure_minimum_amount');
        if(!empty($fiscal_year)){
            $this->db->where('fiscal_year', $fiscal_year);
        }
         if(!empty($structure_type)){
            $this->db->where('structure_type_id', $structure_type);
        }
        if(!empty($architect_type)){
            $this->db->where('structure_id', $architect_type);
        }
        if(empty($fiscal_year)) {
            $this->db->where('fiscal_year', $get_current_fiscal_year);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
}