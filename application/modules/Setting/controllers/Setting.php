<?php
/**
* created by php strom
  Name:Binod Sunar
  Date:2018/02/01:11:14 AM.
*/
class Setting extends MX_Controller
{	
	public function __construct()
	{
		parent:: __construct();
		$this->container='main';
        $this->load->model("CommonModel");
        $this->load->model("SettingModel");
	}

	public function Index()
	{
        $data['page'] = 'dashboard';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $num = $this->mylibrary->convertedcit('123');
        $this->load->view('main', $data);
	}

    /*--------------------------------------------------------
    sampati & bhumikar --------------------------------------*/
    //sampati kar bhumi kar
    public function sampatiBhumiKar() {
        $data['page'] = 'sampati_bhumi_kar';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['sampati_bhumi_kar'] = $this->CommonModel->getData('sampati_bhumi_kar_rate','DESC');
        $this->load->view('main',$data);
    }

    public function SetFiscalYear() {
        if ($this->input->is_ajax_request()) {
            $fiscal_year = $this->input->post('set_fiscal_year');
            $this->session->set_userdata('add_fiscal_year', $fiscal_year);
            if(!empty($fiscal_year)) {
                $data['fiscal_year'] = $fiscal_year;
                $view = $this->load->view('sampati_kar_view',$data, true);
                $response = array(
                    'status'        =>    'success',
                    'message'        =>   $view
                );
                
            } else {
                $response = array(
                    'status'        =>    'error',
                    'message'        =>   'Please Select Fiscal Year'
                );
            }
            header("Content-type: application/json");
            echo json_encode($response);exit;
        } else {
            exit("No direct script allowed!");
        }
    }

    public function SetFiscalYear() {
        if ($this->input->is_ajax_request()) {
            $fiscal_year = $this->input->post('id');
            $data = array('is_current' => 1 ); 
            if(!empty($fiscal_year)) {
                $data['fiscal_year'] = $fiscal_year;
                $view = $this->load->view('sampati_kar_view',$data, true);
                $response = array(
                    'status'        =>    'success',
                    'message'        =>   $view
                );
                
            } else {
                $response = array(
                    'status'        =>    'error',
                    'message'        =>   'Please Select Fiscal Year'
                );
            }
            header("Content-type: application/json");
            echo json_encode($response);exit;
        } else {
            exit("No direct script allowed!");
        }
    }


    public function AddNew($fiscal_year = '') {
        $data['page'] = 'add_sampati_bhumi_kar';
        $this->load->view('main',$data);
    }

    public function SaveSampatiBhumiKar() {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("from","देखि","trim|required",               
                array('required' => 'कृपया देखि रकम भर्नु होस्')
            );
            $this->form_validation->set_rules("to","देखि", "trim|required",
                array('required'=>'कृपया सम्म रकम भर्नु होस्','uni')
            );

            $this->form_validation->set_rules("sampati_kar","देखि", "trim|required",
                array('required'=>'कृपया सम्पतिकर भर्नु होस्')
            );

            $this->form_validation->set_rules("bhunmi_kar","देखि", "trim|required",
                array('required'=>'कृपया भूमिकर भर्नु होस् ')
            );
            if ($this->form_validation->run() === false) {
                    $form_errors = array();
                    foreach ($_POST as $key => $value) {
                        $errors[] = form_error($key);
                        $err = preg_replace('/[^A-Za-z0-9., -]/', '', $errors);
                        if (!empty($errors)) {
                            $form_errors[] = array(
                                'id' => strtoupper($key),
                                'message' => $err
                            );
                        }
                    }
                    $response = array(
                        'status'      => 'error',
                        'data'         => $form_errors,
                        'message'     => 'form_error'
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                } else {
                    $data = $this->input->post();
                    $isUnique = $this->SettingModel->checkUnique($data['from'],$data['to']);
                    if($isUnique->num_rows()>0) {
                        $error_message = "<div class='alert alert-success'>".$data['from'].'-'.$data['to']."पहिले नै दर्ता गरिएको छ" ."</div>";
                        $response = array(
                            'status'      => 'error',
                            'data'         => "<div class='alert alert-success'>सफलतापूर्वक सम्मिलित गरियो</div>",
                            'message'     => 'du_error'
                        );
                        header("Content-type: application/json");
                        echo json_encode($response);
                        exit;
                    } else {
                    $post_data = array(
                        'from_rate'=>$data['from'],
                        'to_rate'=>$data['to'],
                        'sampati_kar'=>$data['sampati_kar'],
                        'bhumi_kar'=>$data['bhunmi_kar'],
                        'fiscal_year' =>$data['fiscal_year']
                    );
                    $result = $this->CommonModel->insertData('sampati_bhumi_kar_rate',$post_data);
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
        }
    }
    public function editDetailsView() {
        $id = $this->input->post('updateID');
        $data['pageTitle'] = "EDIT DETAILS";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['editData'] = $this->CommonModel->getDataBySelectedFields('sampati_bhumi_kar_rate','id',$id);
        $this->load->view('edit_details',$data);
    }

    public function UpdateSampatiBhumiKar() {
        if($this->input->post('Submit')) {
            $data = $this->input->post();
            $id = $data['data_id'];
            $post_data = array(
                'from_rate'=>$data['from'],
                'to_rate'=>$data['to'],
                'sampati_kar'=>$data['sampati_kar'],
                'bhumi_kar'=>$data['bhunmi_kar'],
                'fiscal_year' =>$data['fiscal_year']
            );
            $result = $this->CommonModel->UpdateData('sampati_bhumi_kar_rate',$id,$post_data);
            if($result) {
                $this->session->flashdata('MSG_SUCCESS','सफलतापूर्वक अपडेट गरियो');
                redirect('Setting/sampatiBhumiKar');
            }
        }
    }

    /* ------------------------------------------------------------------
    sadak ko naam ----------------------------------------------*/
    public function SadakKoKisim() {
        $data['page'] = 'sadak_ko_kisim';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['sampati_bhumi_kar'] = $this->SettingModel->getSadakData();
        $this->load->view('main', $data);
    }

    public function addSadakKoKisim($id = NULL) {
        $id = $this->uri->segment(3);
        $data['page'] = 'add_sadak_ko_kisim';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['road_type'] = $this->CommonModel->getData('settings_road_type', 'DESC');
        if(!empty($id)) {
            $data['row'] = $this->CommonModel->getDataByID('settings_road',$id);
        }
        $this->load->view('main', $data);
    }

    public function SaveSadakKoKisim() {
        $id = $this->input->post('id');
        $road_type = $this->input->post('road_type');
        $tol = $this->input->post('tol');
        $ward = $this->input->post('ward_no');
        $road_name = $this->input->post('road_name');
        $fiscal_year = $this->input->post('fiscal_year');
        $post_data = array(
            'road_type'     => $road_type,
            'road_name'     => $road_name,
            'tole'          => $tol,
            'ward'          => $ward,
            'fiscal_year'   => $fiscal_year
        );
        if(empty($id)) {
            $result = $this->CommonModel->insertData('settings_road',$post_data);
        } else{
            $result = $this->CommonModel->UpdateData('settings_road',$id, $post_data);
        }
        if($result) {
            $this->session->set_flashdata('MSG_SUCCESS', "सफलतापूर्वक अपडेट गरियो");
            redirect('Setting/SadakKoKisim');
        }
    }

    public function addRoadType() {
        $data['pageTitle'] = "Add Road Type";
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $this->load->view('add_road_type', $data);
    }

    /*-------------------------------------------------------------------
    jagga ko rate--------------------------------------------------------
    */
    public function JaggaKoRate() {
        $data['page'] = 'jaaga_ko_rate';
        $data['jaagaKoRate'] = $this->SettingModel->getJaagaKoRate();
        $this->load->view('main', $data);
    }

    public function addJaagakoMinRate($id = NULL) {
        $id = $this->uri->segment(3);
        $data['page'] = 'add_jaagako_min_rate';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['settingsLandAreaType'] = $this->CommonModel->getData('settings_land_area_type','DESC');
        $data['road'] = $this->CommonModel->getData('settings_road', 'DESC');
        $data['settings_land_area_type'] = $this->CommonModel->getData('settings_land_area_type', 'DESC');
        if(!empty($id)) {
            $data['row'] = $this->CommonModel->getDataByID('settings_road',$id);
        }
        $this->load->view('main', $data);
    }

    //save 
    public function SaveJaagakoMinRate() {
        if($this->input->post('Submit')) {
            $id = $this->input->post('id');
            $ward = $this->input->post('ward_no');
            $road = $this->input->post('road');
            $land_type  = $this->input->post('land_type');
            $min_amount = $this->input->post('min_amount');
            $max_amount = $this->input->post('max_amount');
            $fiscal_year = $this->input->post('fiscal_year');
            $post_data = array(
                'ward' => $ward,
                'road_name' => $road,
                'land_area_type' => $land_type,
                'minimal_cost' =>$min_amount,
                'maximum_cost' => $max_amount,
                'fiscal_year' => $fiscal_year
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('settings_area_minimal_cost',$post_data);
            } else{
                $result = $this->CommonModel->UpdateData('settings_area_minimal_cost',$id, $post_data);
            }
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', "सफलतापूर्वक अपडेट गरियो");
                redirect('Setting/JaggaKoRate');
            }
        }
    }
    
    /*---------------------------------------------------
    areawise land type----------------------------------*/
    public function addAreaWiseLandType() {
        $data['pageTitle'] = 'जग्गाको क्षेत्रगत किसिम थप्नुहोस';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $this->load->view('add_area_wise_land_type', $data);
    }

    //save area wise land type minmun rate
    public function SaveAreaWiseLandType() {
        $id = $this->input->post('id');
        $fiscal_year = $this->input->post('fiscal_year');
        $land_type = $this->input->post('land_area_type');
        $post_data = array(
            'fiscal_year' => $fiscal_year,
            'land_area_type'=>$land_type
        );
        $result = $this->CommonModel->insertData('settings_land_area_type',$post_data);
        if($result) {
            redirect('Setting/addJaagakoMinRate');
        }
    }
    /*------------------------------------------------------------*/

    /*-------------------------------------------------------------
    sanrachana ---------------------------------------------------*/
    public function sanrachanaRate($id = NULL) {

        $data['page'] = 'sanrachana_list';
        $data['jaagaKoRate'] = $this->SettingModel->getJaagaKoRate();
        $data['settings_structure_minimum_amount'] = $this->SettingModel->getSettingStructureMinAmount();
        $this->load->view('main', $data);
    }

    public function addSanrachanaRate($id = NULL) {
        $id = $this->uri->segment(3);
        $data['page'] = 'add_sanrachan_rate';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $data['settings_architect_type'] = $this->CommonModel->getData('settings_architect_type','DESC');
        $data['settings_architect_structure'] = $this->CommonModel->getData('settings_architect_structure', 'DESC');
        if(!empty($id)) {
            $data['row'] = $this->CommonModel->getDataByID('settings_structure_minimum_amount',$id);
        }
        $this->load->view('main', $data);
    }


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
                'minimum_amount'            =>$min_amount,
                'fiscal_year'               => $fiscal_year
            );
            if(empty($id)) {
                $result = $this->CommonModel->insertData('settings_structure_minimum_amount',$post_data);
            } else{
                $result = $this->CommonModel->UpdateData('settings_structure_minimum_amount',$id, $post_data);
            }
            if($result) {
                $this->session->set_flashdata('MSG_SUCCESS', "सफलतापूर्वक अपडेट गरियो");
                redirect('Setting/sanrachanaRate');
            }
        }
    }

    /*------------------------------------------------
    sanrachna prakar--------------------------------------*/

    public function SanrachanaList() {
        $data['page'] = 'sarachana_type_list';
        $data['sanrachan_list'] = $this->CommonModel->getData('settings_architect_type', 'DESC');
        $this->load->view('main', $data);
    }
    //add sanrachana ko prakar
    public function addSanrachanType() {
        $data['pageTitle'] = 'संरचनाको प्रकार';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $this->load->view('add_sanrachan_type', $data);
    }

    //save sanrachan type
    public function saveSanrachanType() {
        if($this->input->post('Submit')) {
            $type = $this->input->post('sanrachana_type');
            $data = array(
                'architect_type'=> $type,
                'fiscal_year' => $this->session->userdata('add_fiscal_year')
            );
            $result = $this->CommonModel->insertData('settings_architect_type', $data);
            if($result) {
                redirect('Setting/addSanrachanaRate');
            }
        }
    }

   /*----------------------------------------------------------------
    sanrachna structure prakar--------------------------------------*/

    //list
    public function SanrachanaStructureList () {
        $data['page'] = 'sarachana_type_structure_list';
        $data['sanrachan_strucutre'] = $this->CommonModel->getData('settings_architect_structure', 'DESC');
        $this->load->view('main', $data);
    }
    public function addSanrachanaStructureType() {
        $data['pageTitle'] = 'संरचनाको बनौटको किसिम';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $this->load->view('add_sanrachan_structure', $data);
    }
     //save sanrachan type
    public function saveSanrachanStructureType() {
        if($this->input->post('Submit')) {
            $type = $this->input->post('sanrachana_structure_type');
            $data = array(
                'structure_type'=> $type,
                'fiscal_year' => !empty($this->session->userdata('add_fiscal_year')) ? $this->session->userdata('add_fiscal_year'):'',
            );
            $result = $this->CommonModel->insertData('settings_architect_structure', $data);
            if($result) {
                redirect('Setting/addSanrachanaRate');
            }
        }
    }
}