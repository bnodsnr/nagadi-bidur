<?php
class RoadType extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
        $this->load->model('RoadTypeModal');
        $this->module_code = 'ROAD-TYPE';
        $this->fy = current_fiscal_year();
    }

    /**
        * This fetch raod type list.
        * @param NULL
        * @return void load view.
     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['road_type'] = $this->CommonModel->getAllDataByField('settings_road_type','fiscal_year', $this->fy);
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /**
        * On ajax call load view
        * @param  NULL
        * @return void
     */
    public function add() {
        $data['pageTitle'] = "सडकको किसिम";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year');
        $this->load->view('add',$data);
    }

    /**
        * Call on ajax request
        * save fiscal year
        * @return NULL
     */
    public function save() {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('road_type', 'सडकको किसिम', 'required');
            if($this->form_validation->run() == false) {
                $response = array(
                    'status'      => 'validation_error',
                    'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            $post_data = array(
                'fiscal_year'    => $this->input->post('fiscal_year'),
                'road_type'     => $this->input->post('road_type'),
            );
            $result = $this->CommonModel->insertData('settings_road_type',$post_data);
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } 
        } else {
            exit('no direct script allowed');
        }
    }

    /**
        * On ajax call load view
        * @param  $id $_POST['id']
        * @return void
     */
    public function edit() {
        $id = $this->input->post('id');
        $data['pageTitle'] = "सडकको किसिम";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year');
        $data['row'] = $this->CommonModel->getDataByID('settings_road_type',$id);
        $this->load->view('edit',$data);
    }

    /**
        * This function on ajaxcall update land area type data
        * @param  $_POST
        * @return json response
     */
    public function Update() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $this->form_validation->set_rules('road_type', 'सडकको किसिम', 'required');
            if($this->form_validation->run() == false) {
                $response = array(
                    'status'      => 'validation_error',
                    'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            $post_data = array(
                'fiscal_year'    => $this->input->post('fiscal_year'),
                'road_type'     => $this->input->post('road_type'),
            );
            $result = $this->CommonModel->UpdateData('settings_road_type',$id,$post_data);
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } 
        } else {
                exit('no direct script allowed');
        }
    }

    /**
        * This function on ajaxcall load server side data into datatable
        * @param  NULL
        * @return json response
     */
    public function posts() 
    {
        if($this->input->is_ajax_request()) {
            $columns = array( 
                                0   =>'id', 
                                1   =>'fiscal_year',
                                2   => 'road_type',
                            );

            $limit          = $this->input->post('length');
            $start          = $this->input->post('start');
            $filter_1       = $this->input->post('filter_1');
            $filter_2       = $this->input->post('filter_2');
            $order          = $columns[$this->input->post('order')[0]['column']];
            $dir            = $this->input->post('order')[0]['dir'];
            $totalData      = $this->RoadTypeModal->allposts_count($filter_1,$filter_2);
            $totalFiltered  = $totalData;
            $posts          = $this->RoadTypeModal->allposts($limit,$start,$order,$dir, $filter_1, $filter_2);
            $data           = array();
            if(!empty($posts))
            {
                $i = 1;
                foreach ($posts as $post)
                {

                    $nestedData['sn'] = $this->mylibrary->convertedcit($i++);
                    $nestedData['id'] = $post->id;
                    $nestedData['fiscal_year'] = $this->mylibrary->convertedcit($post->fiscal_year);
                    $nestedData['road_type'] = $post->road_type;
                    $data[] = $nestedData;

                }
            }
              
            $json_data = array(
                        "draw"            => intval($this->input->post('draw')),  
                        "recordsTotal"    => intval($totalData),                    "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                        );
                
            echo json_encode($json_data);
        } else {
            exit('HTTPS!!');
        }
    }


     /**
        * This function delete data from database.
        * check proper id is in format of not.
        * @param $id int pk
        * @return json.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $result = $this->CommonModel->remove($id,'settings_road_type');
           
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक हटाइयो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } else {
                $response = array(
                    'status'      => 'error',
                    'data'         => "Oops something goes worng!!! Please try again",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
        } else {
            exit('no direct script allowed!!!');
        }
    }
}