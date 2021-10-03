<?php 

class SetTitleModel extends CI_Model {

	/*
        * this funcrtion get all main topic list 
        @param null
        @ return array main topic list.
    */
	public function getMainTopic() {
		return $this->db->select('*')
					->from('main_topic')
					->get()
					->result_array();	
	}

	/*
        * this function get sub topic list with ref to parent id(main topic)
        @parent int parentid
        @return array subtopic details.
    */
	public function getSubTopicTitle($parentid) {
		return $this->db->select('*')
						->from('topic')
						->where('parent_id',$parentid)
						->get()
						->result_array();
	}


    /*
        * this function insert sub topic detials
        @param array post_data
        retrun on success  true
               on fail  false;
    */
	public function saveTitleDetails($post_data) {
    	$this->db->trans_start();
    	$this->db->insert_batch('sub_topic',$post_data);
    	$this->db->trans_complete();        
    	return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }


    /*
        * this function save topic detials
        @param array post data
        @return on success true
                on fail false
    */
    public function saveNagadiTitle($post_data) {
    	$this->db->trans_start();
    	$this->db->insert_batch('topic',$post_data);
    	$this->db->trans_complete();        
    	return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }


    //save nagadi settings with rate
    public function saveNagadiSetting($post_array) {
        $this->db->trans_start();
        $this->db->insert_batch('sub_topic',$post_array);
        $this->db->trans_complete();        
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }
    //select parent id 
    public function getMaxTopicID() {
    	return $this->db->select_max('id')
                        ->get('topic')
                        ->row()->id;
    }

    //get sub topic
    //get sub topic
    public function getSubTopicList($parentid) {
        return $this->db->select('*')
                        ->from('topic')
                        ->where('main_topic',$parentid)
                        ->get()
                        ->result_array();
    }

    /*
        * this function get sub topic details by id
        @param int id
        @retrun row_array.
    */
    public function getSubtopicDetailsByID($id) {
        return $this->db->select('*')
                        ->from('topic')
                        ->where('id',$id)
                        ->get()
                        ->row_array();
    }

    /*
        * this function get topic rate
        @ param int sub topic
        return result array
    */
    public function getTopicRate($id) {
        $this->db->select('t1.*, t2.sub_topic as subt, t3.topic_name');
        $this->db->from('sub_topic as t1');
        $this->db->join('topic as t2', 't2.id = t1.sub_topic','left');
        $this->db->join('main_topic as t3', 't3.id = t1.parent_id','left');
        $this->db->where('t1.sub_topic', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    //update rate details
    public function updateRateDetails($id, $update_array) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('sub_topic',$update_array);
        $this->db->trans_complete();
        // was there any update or error?
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            // any trans error?
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            return true;
        }
    }
}