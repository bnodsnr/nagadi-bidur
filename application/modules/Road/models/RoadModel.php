<?php



/**

 * Created by PhpStorm.

 * User: root

 */

class RoadModel extends CI_Model

{

    public function __construct()

    {

        parent::__construct();

        $this->fy = current_fiscal_year();

    }



    function allposts($limit,$start,$col,$dir, $road_type = NULL, $road_name=NULL, $ward_no =NULL)
    {  

        $this->db->select('

                t1.*,t1.id as road_id, t1.fiscal_year as fy, t2.*

            , t2.road_type as rot')->from('settings_road t1');

        $this->db->join('settings_road_type t2' ,'t2.id = t1.road_type','left');

        $this->db->where('t1.fiscal_year', $this->fy);

        if(!empty($road_type)){

            $this->db->where('t1.road_type', $road_type);

        }

        if(!empty($road_name)){

            $road_name = trim($road_name);

            $this->db->like('t1.road_name', $road_name);

        }

        if(!empty($ward_no )) {
            $this->db->where('t1.ward', $ward_no);

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



    public function allposts_count($fiscal_year= NULL,$road_type = NULL, $road_name=NULL)

    {

        $this->db->select('*')->from('settings_road');

        $this->db->where('fiscal_year', $this->fy);

        

        if(!empty($road_type)){

            $this->db->where('road_type', $road_type);

        }

        if(!empty($road_name)){

            $this->db->where('road_name', $road_name);

        }

        $query = $this->db->get();

        return $query->num_rows();

    }



    public function getLandCategory($land_area_type) {



        $this->db->select('t1.id as ids,t2.category as lc,t2.id as categoryid')->from('settings_land_area_type t1');

        $this->db->join('land_category t2', 't2.id = t1.land_category','left');

        $this->db->where('t1.id',$land_area_type);

        $query = $this->db->get();

        return $query->row_array();

        // $this->db->where('land_area_type', $land_area_type);

        // $result = $this->db->get('land_category');

        // return $result->row_array();

    }

}