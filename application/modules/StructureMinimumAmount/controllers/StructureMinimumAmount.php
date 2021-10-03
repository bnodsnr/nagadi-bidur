<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 9:57 PM
 */
class StructureMinimumAmount extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("StructureMinAmountModel");
        $this->module_code = 'STRUCUTRE-MIN-AMOUNT';
        $this->fy = current_fiscal_year();
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /**
        ** This function list all the land minimun rate
        * @param NULL
        * @return void

     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
         $data['page'] = 'list_all';
         $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year');
         $data['struct_type'] = $this->CommonModel->getData('settings_architect_type');
         $data['arcet_type'] = $this->CommonModel->getData('settings_architect_structure');
         $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }


    /**
        ** This function load add sanrachana form
        * @param NULL
        * @return void

     */
    public function addSanrachanaRate($id = NULL) {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $id = $this->uri->segment(3);
            $data['page'] = 'add_sanrachan_rate';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['settings_architect_type'] = $this->CommonModel->getWhereAll('settings_architect_type' ,array('fiscal_year' => $this->fy));
            $data['settings_architect_structure'] = $this->CommonModel->getWhereAll('settings_architect_structure' ,array('fiscal_year' => $this->fy));
            if(!empty($id)) {
                $data['row'] = $this->CommonModel->getDataByID('settings_structure_minimum_amount',$id);
            }
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /**
        ** This save sanrachana rate
        * @param NULL
        * @return json

     */
    public function SaveSanrachanaRate() {
        if($this->input->post('Submit')) {
            $id = $this->input->post('id');
            $sanrachana_banaotko_kisim      = $this->input->post('sanrachana_banaotko_kisim');
            $sanrachanako_prakar            = $this->input->post('sanrachanako_prakar');
            $min_amount                     = $this->input->post('min_amount');
            $fiscal_year                    = $this->input->post('fiscal_year');
            $post_data                      = array(
                'structure_id'              => $sanrachanako_prakar,
                'structure_type_id'         => $sanrachana_banaotko_kisim,
                'minimum_amount'            => $min_amount,
                'fiscal_year'               => $fiscal_year
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('settings_structure_minimum_amount',$post_data);
            } else{
                $result = $this->CommonModel->UpdateData('settings_structure_minimum_amount',$id, $post_data);
            }
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', "सफलतापूर्वक अपडेट गरियो");
                redirect('StructureMinimumAmount');
            }
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
                                0   => 'id', 
                                1   => 'fiscal_year',
                                2   => 'structure_type',
                                3   => 'architect_type'
                            );

            $limit                  = $this->input->post('length');
            $start                  = $this->input->post('start');
            $fiscal_year            = $this->input->post('fiscal_year');
            $structure_type         = $this->input->post('structure_type');
            $architect_type         = $this->input->post('architect_type');
            $order                  = $columns[$this->input->post('order')[0]['column']];
            $dir                    = $this->input->post('order')[0]['dir'];
            $totalData              = $this->StructureMinAmountModel->allposts_count($fiscal_year,$structure_type,$architect_type);
            $totalFiltered          = $totalData;
            $posts                  = $this->StructureMinAmountModel->allposts($limit,$start,$order,$dir, $fiscal_year,$structure_type,$architect_type);
            $data           = array();
            if(!empty($posts))
            {
                $i = 1;
                foreach ($posts as $post)
                {

                    $nestedData['sn']               = $this->mylibrary->convertedcit($i++);
                    $nestedData['id']               = $post->main_id;
                    $nestedData['fiscal_year']      = $this->mylibrary->convertedcit($post->fy);
                    $nestedData['structure_type']   = $post->structure_type;
                    $nestedData['architect_type']   = $post->architect_type;
                    $nestedData['minimum_amount']   = $this->mylibrary->convertedcit($post->minimum_amount);
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
        * This function delete data the id.
        * check proper id is in format of not.
        * @param $id int pk
        * @return json.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $result = $this->CommonModel->remove($id,'settings_structure_minimum_amount');
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