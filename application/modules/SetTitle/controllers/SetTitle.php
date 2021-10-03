<?php

/**
 * Created by PhpStorm.
 * User: root
 */
class SetTitle extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model('SetTitleModel');
        $this->module_code = 'SET-TITLE';
        $this->fy = current_fiscal_year();
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /*
        *This function list all the land minimun rate
        @param 
        return array of all land_minimum rate

     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
           // $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['main_topic'] = $this->SetTitleModel->getMainTopic();
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /* 
        * This function display all topic detials with rate and related parent topic and subtopic
        @ param nul
        return add topic details form
    */
    public function add() {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $data['page'] = 'add_new_details';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year' => current_fiscal_year()));
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function saveTopic() {
        if($this->input->post('Submit')) {
            $parent_id     = $this->input->post('parent_title');
            $topic_title   = $this->input->post('topic_name');
            $topic_no      = $this->input->post('topic_number');
            $rate          = $this->input->post('rate');
            $is_percent    = !empty($this->input->post('is_percent')) ? $this->input->post('is_percent'): 0 ;
            $fiscal_year   = $this->input->post('fiscal_year');
            $added_by      = $this->session->userdata('PRJ_USER_ID');
            $added_on      = date('Y-m-d h:i:s');
            $topic_details = array();
            foreach ($parent_id as $key => $indexv) {
                $topic_details[] = array(
                    'parent_id'     => $parent_id[$key],
                    'topic_title'   => $topic_title[$key],
                    'topic_no'      => '', 
                    'is_percent'    => isset($is_percent[$key]) ? $is_percent[$key] :'',
                    'fiscal_year'   => $fiscal_year[$key],
                    'rate'          => $rate[$key],
                    'added_by'      => $this->session->userdata('PRJ_USER_ID'),
                    'added_on'      => date('Y-m-d h:i:s'),
                );
            };
            $result = $this->SetTitleModel->saveTitleDetails($topic_details);
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', "सफलतापूर्वक अपडेट गरियो");
                redirect('SetTitle');
            }
        }
    }

    /*
     **
      This function show list of all related subtopic details with ref to main topic
      @param int parent id
      return array subtopic list.
    */
    public function viewDetails($parentid) {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page']           = 'list_sub_topic';
            $data['fiscal_year']    = $this->CommonModel->getData('fiscal_year','DESC');
            $data['main_topic']     = $this->CommonModel->getDataByID('main_topic', $parentid);
            $data['sub_topic']      = $this->SetTitleModel->getSubTopicTitle($parentid);
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    //edit subtopic details
    public function EditSubTopicDetails($id = null) {

        $id = $this->input->post('id');
        $data['pageTitle'] = "मुख्य शिर्षक";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'DESC');
        $data['main_topic']  = $this->CommonModel->getData('main_topic','DESC');
        $data['row'] = $this->SetTitleModel->getSubtopicDetailsByID($id);
        $this->load->view('edit_sub_topic',$data);
    }

    //update
    public function updateSubTopicTitle() {
        $id = $this->input->post('id');
        $parent = $this->input->post('main_topic');

        $post_data = array(
            'main_topic'    => $this->input->post('main_topic'),
            'parent_id'     => $this->input->post('main_topic'),
            'sub_topic'     => $this->input->post('topic_name'),
            'topic_no'      => $this->input->post('topic_no'),
        );
        $result = $this->CommonModel->updateData('topic', $id,$post_data);

        if($result) {
        $response = array(
            'status'      => 'success',
            'data'         => "<div class='alert alert-success'>सफलतापूर्वक सम्मिलित गरियो</div>",
            'message'     => 'success'
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
        }
    }

    //delete
    public function deleteSubTopic($id) {
        $data['row'] = $this->CommonModel->getDataByID('sub_topic',$id);
        $result = $this->CommonModel->deleteData('sub_topic',$id);
        if($result) {
            $this->session->set_flashdata('MSG_SUCCESS','सफलतापूर्वक हटाइयो');
            redirect('SetTitle/viewDetails/'.$data['row']['parent_id']);
        }
    }


    /*----------------------------------------------------------------------------------
    मुख्य शिर्षक ------------------------------------------------------------------------*/
    public function addMainTopic() {
        $data['pageTitle'] = "मुख्य शिर्षक";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'DESC');
        $this->load->view('add_main_topic',$data);
    }

    //save main title
    public function saveMainTitle() {
        if($this->input->is_ajax_request()) {
            $post_data = array(
                'fiscal_year' => $this->input->post('fiscal_year'),
                'topic_no'  => $this->input->post('topic_no'),
                'topic_name' => $this->input->post('topic_name')
            );
            $result = $this->CommonModel->insertData('main_topic', $post_data);
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "<div class='alert alert-success'>सफलतापूर्वक सम्मिलित गरियो</div>",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
        }
    }

    public function editMainTitle() {
        $id = $this->input->post('id');
        $data['pageTitle'] = "मुख्य शिर्षक";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year', 'DESC');
        $data['row']  = $this->CommonModel->getDataByID('main_topic', $id);
        $this->load->view('edit_main_topic',$data);
    }

    //update
    public function updateMainTopic() {
        $id = $this->input->post('id');
        $topic_no = $this->input->post('topic_no');
        $topic_name = $this->input->post('topic_name');
        $fiscal_year = $this->input->post('fiscal_year');
        $post_data = array(
            'fiscal_year' => $this->input->post('fiscal_year'),
            'topic_no'  => $this->input->post('topic_no'),
            'topic_name' => $this->input->post('topic_name')
        );
        $result = $this->CommonModel->updateData('main_topic',$id, $post_data);
        if($result) {
            $response = array(
                'status'      => 'success',
                'data'         => "<div class='alert alert-success'>सफलतापूर्वक सम्मिलित गरियो</div>",
                'message'     => 'success'
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
    }

    //add topic
    public function addTopicDetails() {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $data['page'] = 'add_new_topics';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic', array('fiscal_year'=> $this->fy));
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function saveNewTopicDetails() {
        $topic_no = $this->input->post('topic_no');
        $topic_name = $this->input->post('topic_name');
        $fiscal_year = $this->input->post('fiscal_year');
        $main_topic = $this->input->post('main_topic');
        $max_id = $this->SetTitleModel->getMaxTopicID('topic');
        $parent_id = $max_id+1;
        $sub_topic = $this->input->post('sub_topic');
        if(!empty($sub_topic)) {
            $post_arary = array();
            foreach($sub_topic as $key => $index) {
                $post_array[] = array(
                    'parent_id'     => $main_topic,
                    'topic_no'      => '',
                    'main_topic'    => $main_topic,
                    'sub_topic'     => $sub_topic[$key],
                    'fiscal_year'   => $this->input->post('fiscal_year')
                );
            }
           $result = $this->SetTitleModel->saveNagadiTitle($post_array);
           if($result) {
            redirect('SetTitle');
           }
        }
    }

     //get sub topic list
    public function getSubTopic() {
        $main_topic = $this->input->post('main_topic');
        $sub_topic  = $this->SetTitleModel->getSubTopicList($main_topic);
        $option = "";
        $option .= "<option value='' selected>सहायक शीर्षक छनौट गर्नुहोस्</option>";
        if(!empty($sub_topic)) {
            foreach ($sub_topic as $key => $value) {
                $option .= "<option value='".$value['id']."'>".$value['sub_topic']."</option>";
            }
        } 
        $response = array(
            'status' => 'success',
            'data'   => $option,
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
    }

    

    /*-------------------------------------------------------------------
    topic rate----------------------------------------------------------*/
    public function topicRate($sub_topic = NULL) {
        $sub_topic = $this->uri->segment(3);
        if(empty($sub_topic)) {
            exit('invalid parameter');
        } else {
            if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
                $data['page'] = 'list_topic_rate';
                $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
                $topic = $this->CommonModel->getDataByID('topic', $sub_topic);
                $data['main_topic'] = $this->CommonModel->getDataByID('main_topic', $topic['parent_id']);
                $data['s_topic'] = $this->CommonModel->getDataByID('topic', $sub_topic);
                $data['sub_topic'] = $this->SetTitleModel->getTopicRate($sub_topic);
                $this->load->view('main', $data);
            } else {
                $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
                redirect('Dashboard');
            }
        }
    }


    //save new kar details
    public function saveNewKarDetails() {
        if($this->input->post('Submit')) {
            $topic_no = $this->input->post('topic_no');
            $fiscal_year = $this->input->post('fiscal_year');
            $parent_title = $this->input->post('parent_title');
            $sub_topic = $this->input->post('sub_topic');
            $topic_name = $this->input->post('topic_name');
            $rate = $this->input->post('rate');
            $is_percent = $this->input->post('is_percent');
            $post_array = array();
            foreach ($parent_title as $key => $index ) {
                $post_array[] = array(
                    'topic_no' => $topic_no[$key],
                    'fiscal_year'    => $fiscal_year[$key],
                    'parent_id'         => $parent_title[$key],
                    'sub_topic'      => $sub_topic[$key],
                    'topic_title'     => $topic_name[$key],
                    'rate'           => $rate[$key],
                    'is_percent'     => $is_percent[$key],
                    'status'         => 1,
                    'added_by'       => $this->session->userdata('PRJ_USER_ID'),
                    'added_on'        => convertDate(date('Y-m-d')),
                    'modified_by'    => '',
                    'modified_on'   => '',
                );
            }
            $result = $this->SetTitleModel->saveNagadiSetting($post_array);
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', MSG_SUCCESS);
                redirect('SetTitle');
            } else {
                $this->session->set_flashdata('MSG_SUCCESS', MSG_INSERT_ERR);
                redirect('SetTitle');
            }
        }
    }
    //edit details
    public function editSubTopicRate($id = NULL ) {
        $id = $this->uri->segment(3);
        if(empty($id)) {
            show_404();
        } else {
            if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
                $data['page'] = 'edit_topic_rate';
                $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
                //$topic = $this->CommonModel->getDataByID('sub_topic', $id);
                $data['topic_rate'] = $this->CommonModel->getDataByID('sub_topic', $id);
                $data['main_topic'] = $this->CommonModel->getData('main_topic', 'DESC');
                $data['s_topic'] = $this->CommonModel->getAllDataByField('topic','main_topic', $data['topic_rate']['parent_id']);
                //pp($data['topic_rate']);
                $this->load->view('main', $data);
            } else {
                $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
                redirect('Dashboard');
            }
        }
    }

     //save new kar details
    public function saveUpdateKarRateDetails() {
        if($this->input->post('Submit')) {
            $id                     = $this->input->post('id');
            $fiscal_year            = $this->input->post('fiscal_year');
            $parent_title           = $this->input->post('parent_title');
            $sub_topic              = $this->input->post('sub_topic');
            $topic_name             = $this->input->post('topic_name');
            $rate                   = $this->input->post('rate');
            $is_percent             = $this->input->post('is_percent');
            $post_array = array(
                'fiscal_year'    => $fiscal_year,
                'parent_id'      => $parent_title,
                'sub_topic'      => $sub_topic,
                'topic_title'    => $topic_name,
                'rate'           => $rate,
                'is_percent'     => $is_percent,
                'status'         => 1,
                'modified_by'    => $this->session->userdata('PRJ_USER_ID'),
                'modified_on'    => convertDate(date('Y-m-d')),
            );
            $result = $this->SetTitleModel->updateRateDetails($id, $post_array);
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', MSG_SUCCESS);
                redirect('SetTitle/topicRate/'.$sub_topic);
            } else {
                $this->session->set_flashdata('MSG_SUCCESS', MSG_INSERT_ERR);
                redirect('SetTitle/topicRate/'.$sub_topic);
            }
        }
    }
}