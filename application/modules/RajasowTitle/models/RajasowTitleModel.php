<?php 

class RajasowTitleModel extends CI_Model {

	/**
        ** this funcrtion get all main topic list 
        ** @param null
        ** @return array main topic list.
    **/
	public function getRajasowTitle() {
        $this->db->select('*');
        $this->db->from('rajasow_report_title');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRates($topic_no) {
        $this->db->select('t1.id as rate_id,t1.topic_title, t1.topic_no as sub_topic_no, t1.parent_id,t1.rate, t2.topic_name as main_topic_name, t3.sub_topic as subtitle');
        $this->db->from('sub_topic t1');
        $this->db->join('main_topic t2','t2.id = t1.parent_id','left');
        $this->db->join('topic t3','t3.id = t1.sub_topic','left');
       // $this->db->where('topic_no', $topic_no);
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function updateRates($post_array, $ids) {
    //     $this->db->where_in("id", $ids);
    //     $this->db->update("sub_topic",$post_array);
    //     if($this->db->affected_rows() > 1 ){
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function updateRates($post_array, $ids) {
        $this->db->where_in("id", $ids);
        $this->db->update("sub_topic",$post_array);
        if($this->db->affected_rows() > 1 ){
            return true;
        } else {
            return false;
        }
    }
}