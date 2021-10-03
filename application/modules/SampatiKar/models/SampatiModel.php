<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class SampatiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function allposts($limit,$start,$col,$dir, $fiscal_year= NULL, $from = NULL, $to = NULL, $type=NULL)
    {  
        $this->db->select('
               *')->from('sampati_kar_rate');
       
        if(!empty($fiscal_year)){
            $this->db->where('fiscal_year', $fiscal_year);
        }
        if(!empty($from)){
            $this->db->where('from_rate', $from);
        }
        if(!empty($to)){
            $this->db->where('to_rate', $to);
        }
        if(!empty($type)){
            $this->db->where('type', $type);
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

    public function allposts_count($fiscal_year= NULL, $from = NULL, $to = NULL)
    {
        $this->db->select('*')->from('settings_road');
        if(!empty($fiscal_year)){
            $this->db->where('fiscal_year', $fiscal_year);
        }
        if(!empty($from)){
            $this->db->where('from_rate', $from);
        }
        if(!empty($to)){
            $this->db->where('to_rate', $to);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
}