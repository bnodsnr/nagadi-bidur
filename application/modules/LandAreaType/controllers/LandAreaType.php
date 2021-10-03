<?php

class LandAreaType extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }

        $this->load->model("CommonModel");
        $this->load->model("LandAreaTypeModel");
        $this->module_code = 'LAND-AREA-TYPE';
        $this->fy = current_fiscal_year();
        
    }

    /**
        * This function list all the land minimun rate
        * @param NULL
        * @return void
     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['landareatype'] = $this->CommonModel->getAllDataByField('settings_land_area_type','fiscal_year', $this->fy);
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /**
        * This function on ajaxcall load add form in modal**
        * @param NULL
        * @return void
     */
    public function add() {
        if($this->input->is_ajax_request()) {
            $data['pageTitle'] = 'जग्गाको क्षेत्रगत किसिम थप्नुहोस';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['land_category'] = $this->CommonModel->getData('land_category','DESC');
            $this->load->view('add', $data);
        } else {
            exit('No direct script allowed!');
        }
        
    }

    /**
        * This function on ajaxcall submit land area type data
     */ 
    public function SaveAreaWiseLandType() {
        if($this->input->is_ajax_request()) {
            $fiscal_year = $this->input->post('fiscal_year');
            $land_type = $this->input->post('land_area_type');
            $land_category = $this->input->post('land_category');
            $post_data = array(
                'fiscal_year' => $fiscal_year,
                'land_area_type'=>$land_type,
            );
            $result = $this->CommonModel->insertData('settings_land_area_type',$post_data);
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'success'
                );
                 header("Content-type: application/json");
                 echo json_encode($response);
                 exit;
            } else {
                
            }
        }
    }

    /**
        * This function on ajaxcall load add form in modal**
        * @param $id int
        * @return void
     */
    public function edit() {
        if($this->input->is_ajax_request()) {
            $post_id = $this->input->post('id');
            $data['pageTitle'] = 'जग्गाको क्षेत्रगत किसिम थप्नुहोस';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['lcategory'] = $this->CommonModel->getData('land_category','DESC');
            $data['landareatype'] = $this->CommonModel->getDataByID('settings_land_area_type',$post_id);
            $this->load->view('edit', $data);
        } else {
            exit('No direct script allowed!');
        }
    }

    /**
        * This function on ajaxcall update land area type data
     */
    public function UpdateAreaWiseLandType() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $fiscal_year = $this->input->post('fiscal_year');
            $land_type = $this->input->post('land_area_type');
            $land_category = $this->input->post('land_category');
            $post_data = array(
                'fiscal_year' => $fiscal_year,
                'land_area_type'=>$land_type,
            );
            $result = $this->CommonModel->UpdateData('settings_land_area_type',$id,$post_data);
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
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
        }
    }

    /**
        * This function delete data from database.
        * check proper id is in format of not.
        * @param $id int pk
        * @return boolean.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $result = $this->LandAreaTypeModel->remove($id);
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

    // public function LastFYDetails() {
    //     if($this->input->is_ajax_request()){
    //         $last_fy = recently_closed_fy();
    //        //  $data['page'] = 'last_fy';
    //        $data['landareatype'] = $this->CommonModel->getAllDataByField('settings_land_area_type','fiscal_year', $last_fy);

    //         if(!empty($data['landareatype'])) :
    //             foreach($data['landareatype'] as $key => $landarea) : 
    //                 $post_data = array(
    //                     'fiscal_year' => $landarea[''],
    //                     'land_area_type'=>$land_type,
    //                 );
    //                 print_r($landarea);
    //             endforeach;
    //         endif;
    //     }else{
    //         exit('invalid request');
    //     }
    // }
}