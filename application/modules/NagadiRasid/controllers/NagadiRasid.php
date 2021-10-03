<?php
/**
 * Created by PhpStorm.
 * User: root
 */
class NagadiRasid extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("NagadiRasidModel");
        $this->module_code = 'NAGADI-RASID';
        $this->table = 'nagadi_rasid';
        $this->fy = current_fiscal_year();
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /*
        *This function list all the itland minimun rate
        @param 
        return array of all land_minimum rate

     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")) {
            // $number = $this->convertlib->convert(5050000.50);
            // pp($number);
            $data['page'] = 'list_all';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['rasaidDetails'] = $this->NagadiRasidModel->getNagadiRasidList();
            $data['user'] = $this->session->userdata("PRJ_USER_ID");
            $data['group'] = $this->session->userdata("PRJ_USER_GROUP");
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function addBill() {
        if($this->authlibrary->HasModulePermission($this->module_code,'ADD')) {
            $data['page'] = 'add_bill';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['current_fy'] = $this->CommonModel->getCurrentFiscalYear();
            $data['bill_no'] = $this->NagadiRasidModel->getBillNo();
            $data['provinces']    = $this->CommonModel->getData('provinces', 'DESC');
            $data['districts']    = getDistricts();

            $data['main_topic'] = $this->CommonModel->getWhereAll('main_topic',array('fiscal_year'=>$this->fy));

            $data['gapana'] = $this->CommonModel->getGapaNapa();

            $data['wards'] = $this->CommonModel->getData('settings_ward', 'DESC');

            $data['userdetails'] = $this->NagadiRasidModel->getUserDetails();

            /*-------------------set bill no ------------------------------------*/
            
            $data['set_bill']           = $this->NagadiRasidModel->checkBill();
            $data['bill_no']            = $this->NagadiRasidModel->getActiveBill();
            // if($this->session->userdata('PRJ_USER_WARD') ==  5) {
            //     pp($data['bill_no']);
            // }
            $data['inactive_bill']       = $this->NagadiRasidModel->getInactiveBills();
        
            if(!empty($data[inactive_bill])) {
                if(!empty($data['set_bill']['bill_no'])) {
                if($data['set_bill']['bill_no'] == $data['inactive_bill']['bill_to']) {
                    //$this->session->set_flashdata('MSG_WARNING','दिएको सबै रसिद प्रोयोग भएको हुनाले रसिद काट्न मिल्दैन [कृपया रसिद माग गर्नुहोस]');
                    $data['bill'] = $data['bill_no']['bill_from'];
                } else {
                    $data['bill'] = $data['set_bill']['bill_no'] + 1;
                }
                } else {
                    $data['bill'] = $data['bill_no']['bill_from'];
                }
                } else {
                   if(!empty($data['set_bill']['bill_no'])) {
                    if($data['set_bill']['bill_no'] == $data['bill_no']['bill_to']) {
                        //$this->session->set_flashdata('MSG_WARNING','दिएको सबै रसिद प्रोयोग भएको हुनाले रसिद काट्न मिल्दैन [कृपया रसिद माग गर्नुहोस]');
                        $data['bill'] = '';
                    } else {
                        $data['bill'] = $data['set_bill']['bill_no'] + 1;
                    }
                } else {
                    $data['bill'] = $data['bill_no']['bill_from'];
                } 
            }
        
        
            // $data['set_bill']  = $this->NagadiRasidModel->checkBill();
           
            // $data['bill_no']   = $this->NagadiRasidModel->getActiveBill();
            // if(empty($data['bill_no'])) {
            //     $this->session->set_flashdata('MSG_WARNING','दिएको सबै रसिद प्रोयोग भएको हुनाले रसिद काट्न मिल्दैन [कृपया रसिद माग गर्नुहोस]');
            //     redirect('NagadiRasid');
            // } else {
            //     if(!empty($data['set_bill']['bill_no'])) {
            //         if($data['set_bill']['bill_no'] == $data['bill_no']['bill_to']) {
            //             $this->session->set_flashdata('MSG_WARNING','दिएको सबै रसिद प्रोयोग भएको हुनाले रसिद काट्न मिल्दैन [कृपया रसिद माग गर्नुहोस]');
            //             $data['bill'] = '';
            //             //redirect('NagadiRasid/addBill');
            //         } else {
            //             $data['bill'] = $data['set_bill']['bill_no'] + 1;
            //         }
            //     } else {
            //         $data['bill'] = $data['bill_no']['bill_from'];
            //     }
            // }
            // if(!empty($data['set_bill']['bill_no'])) {
            //     if($data['set_bill']['bill_no'] == $data['bill_no']['bill_to']) {
            //         $this->session->set_flashdata('MSG_WARNING','दिएको सबै रसिद प्रोयोग भएको हुनाले रसिद काट्न मिल्दैन [कृपया रसिद माग गर्नुहोस]');
            //         //$data['bill'] ='';
            //         redirect('NagadiRasid/addBill');
                    
            //     } else {
            //         $data['bill'] = $data['set_bill']['bill_no'] + 1;
            //     }
            // } else {
            //     $data['bill'] = $data['bill_no']['bill_from'];
            // }

            //pp($data['bill']);
            //pp($data['set_bill']);
        //     $data['bill_range'] = $this->NagadiRasidModel->getBillRange();
        //     $data['bill_range_1'] = $this->NagadiRasidModel->getBillRangeLast();
        //     if($data['set_bill']['bill_no'] == $data['bill_range']['bill_to']) {
        //     if(empty($data['set_bill']['bill_no'])) {
        //         $data['bill']  = $data['bill_range_1']['bill_from'];
        //     } else {
        //         if($data['set_bill']['bill_no'] == $data['bill_range']['bill_to']) {
        //             $data['bill']  = $data['bill_range_1']['bill_from'];
        //         } else {
        //             $data['bill'] = $data['set_bill']['bill_no']+1;
        //         }
        //     }
        // } else {
        //     if(empty($data['set_bill']['bill_no'])) {
        //         $data['bill']  = $data['bill_range']['bill_from'];
        //     } else {
        //         $data['bill'] = $data['set_bill']['bill_no']+1;
        //     }
        // }
            
            /*-------------------------------------------------------------------*/
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    //get sub topic list
    public function getSubTopic() {
        $main_topic = $this->input->post('main_topic');
        $sub_topic  = $this->NagadiRasidModel->getSubTopicByMainTopic($main_topic);
        //$option = "";
        $option = "<option value=''>सहायक शीर्षक छनौट गर्नुहोस्</option>";
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

     //get sub topic list
    public function getTopicRate() {
        $subtopic = $this->input->post('subtopic');
        $sub_topic  = $this->NagadiRasidModel->getTopicRate($subtopic);
        $option = "";
        $option .= "<option value='' selected> शीर्षक छनौट गर्नुहोस्</option>";
        
        if(!empty($sub_topic)) {
            foreach ($sub_topic as $key => $value) {
                $option .= "<option value='".$value['id']."'>".$value['topic_title']."</option>";
            }
        } 
        $option .="<option value ='others'>अन्य शीर्षक</option>";
       
        $response = array(
            'status' => 'success',
            'data'   => $option,
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
    }

    public function getTopicRateDetails() {
        $topic = $this->input->post('topic_rate');
        //if($topic == )
        $option  = $this->NagadiRasidModel->getTopicRateDetailsByID($topic);
        $response = array(
            'status' => 'success',
            'data'   => $option,
        );
        header("Content-type: application/json");
        echo json_encode($response);
        exit;
    }

    //get sub topic by id
    public function getSubTopicByID() {
        $sub_topic = $this->input->post('sub_topic');
        $sub_top   = $this->NagadiRasidModel->getSubTopicByID($sub_topic);
        $response = array(
            'status' => 'success',
            'data'   => $sub_top
        );
        header("Content-type:application/json");
        echo json_encode($response);
        exit;
    }

    public function saveNagadiRasid() {
        if($this->input->is_ajax_request()) {
            //validation
            $this->form_validation->set_rules('bill_no', 'Bill No is required', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->flashdata('MSG_ERR',"Please Enter bill no");
                redirect('NagadiRasid/addBill');
            } else  {
                $userid                 = $this->session->userdata('PRJ_USER_ID');
                $added_ward             = $this->session->userdata('PRJ_USER_WARD');
                $post                   = $this->input->post();
                $fiscal_year            = $post['fiscal_year'];
                $date                   = $post['date'];
                $customer_name          = $post['customer_name'];
                $pan_no                 = isset($post['pan_no']) ? $post['pan_no'] :'';
                $bill_no                = $post['bill_no'];
                $provience              = $post['pradesh'];
                $district               = $post['district'];
                $gapa_napa              = $post['gaunpalika_nagarpalika'];
                $ward                   = $post['ward_no'];
                $t_total                = $post['t_total'];
                $recieved_amount        = $post['recieved_amount'];
                $return_amount          = $post['return_amount'];
                $s_fiscal_year          = str_replace("/","-",$fiscal_year);
                $guid                   = $s_fiscal_year.'-'.$userid.'-'.$added_ward.'-'.uniqid();
                $payment_mode           = $this->input->post('payment_mode');
                $post_array             = array(
                    'fiscal_year'       => $fiscal_year,
                    'date'              => $date,
                    'customer_name'     => $customer_name,
                    'pan_no'            => $pan_no,
                    'bill_no'           => $bill_no,
                    'provience'         => $provience,
                    'district'          => $district,
                    'gapa_napa'         => $gapa_napa,
                    'ward'              => $ward,
                    't_total'           => $t_total,
                    'fiscal_year'       => $fiscal_year,
                    'recieved_amount'   => $recieved_amount,
                    'payment_mode'      => $payment_mode,
                    'guid'              => $guid,
                    'added_by'          => $userid,
                    'added_on'          => convertDate(date('Y-m-d')).' '.date("H:i:s"),
                    'added_ward'        => $this->session->userdata('PRJ_USER_WARD'),
                    'status'            => 1,
                    'modified_by'       => '',
                    'modified_on'       => '',
                    'print_count'       => '0',
                    'added_ip'      => $this->input->ip_address(),
                );
                $main_topic             = $post['main_topic'];
                $sub_topic              = $post['sub_topic'];
                $main_title             = $this->input->post('main_title');
                $topic_qty              = $post['qty'];
                $rate                   = $post['rate'];
                $total_rate             = $post['rates'];
                $other_title            = $post['other_title'];
                $discount_amount        = $post['discount_amount'];
                $topic_details          = array();
                if(!empty($main_topic)) {
                    foreach ($main_topic as $key => $indexv) {
                        $topic_details[]    = array(
                            'main_topic'    => $main_topic[$key],
                            'sub_topic'     => $sub_topic[$key],
                            'topic'         => $main_title[$key],
                            'topic_qty'     => $topic_qty[$key],
                            'rate'          => $rate[$key],
                            't_rates'       => $total_rate[$key],
                            'guid'          => $guid,
                            'others_topic'  => isset($other_title) ? $other_title[$key] : '',
                            'discount_amount' =>isset($discount_amount) ? $discount_amount[$key]:'',
                            'ward'          => $this->session->userdata('PRJ_USER_WARD'),
                            'added'         => convertDate(date('Y-m-d')),
                            'fiscal_year'   => $fiscal_year,
                            'bill_no'       => $bill_no,
                            'added_by'      => $userid,
                            'added_ward'        => $this->session->userdata('PRJ_USER_WARD'),
                        );
                    }
                }
                $checkBill = $this->NagadiRasidModel->bill_exists($bill_no);
                if($checkBill == 1){
                     $response = array(
                    'status'      => 'error',
                    'message'     => 'बिल नं दोहोरिएको हुनाले सफलहुन सकेन!!',
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
                    // $this->session->set_flashdata('MSG_ERR','Duplicate Bill no');
                    // redirect('NagadiRasid/addBill');
                }

                if($this->form_validation->run() == false) {
                    $response = array(
                        'status'      => 'validation_error',
                        'message'     => '<div class="alert alert-danger">'.validation_errors().'</div>',
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                }
                $result = $this->NagadiRasidModel->insertBillDetails($post_array);
                if($result) {
                    $this->NagadiRasidModel->saveNagadiAmountDetails($topic_details);
                    $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                        'message'     => 'redirect',
                        'redirect_url'    => base_url().'NagadiRasid/view/'.$result
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;

                    //$this->NagadiRasidModel->saveNagadiAmountDetails($topic_details);
                    //redirect('NagadiRasid/view/'.$result);
                } else {
                    exit('invalid parameter');
                }
            }
        }
    }

    //-------------------------------------------------------------------//
    //edit details
    public function edit($id = NULL) {
        $id = $this->uri->segment(3);
        if(empty($id)) {
            show_404();
        }
        if($this->authlibrary->HasModulePermission($this->module_code,'ADD')) {
            $data['page'] = 'edit_bill';
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $data['current_fy'] = $this->CommonModel->getCurrentFiscalYear();
            $data['bill_no'] = $this->NagadiRasidModel->getBillNo();
            $data['main_topic'] = $this->CommonModel->getData('main_topic','DESC');
            $data['gapana'] = $this->CommonModel->getGapaNapa();
            $data['ward'] = $this->CommonModel->getData('settings_ward', 'DESC');
            $data['userdetails'] = $this->NagadiRasidModel->getUserDetails();

            $data['provinces']    = $this->CommonModel->getData('provinces', 'DESC');
            $data['districts']    = getDistricts();
            //$data['gapana'] = $this->CommonModel->getGapaNapa();

            /*-------------------set bill no ------------------------------------*/
            $data['set_bill']  = $this->NagadiRasidModel->checkBill();
            $data['bill_range'] = $this->NagadiRasidModel->getBillRange();
            $data['erow'] = $this->NagadiRasidModel->getViewBillDetails($id);
            $data['nagadi_detials'] = $this->NagadiRasidModel->getNagadiMainDetails($data['erow']['guid']);
        // pp($data['nagadi_detials']);
           // pp($data['nagadi_detials']);

            if(empty($data['set_bill']['bill_no'])) {
               $data['bill']  = $data['bill_range']['bill_from'];
            } else {
                $data['bill'] = $data['set_bill']['bill_no']+1;
            }
            /*-------------------------------------------------------------------*/
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }


    //edit bill details
    public function editNagadiRasid() {
        if($this->input->post('Submit')) {
            //validation
            $this->form_validation->set_rules('bill_no', 'Bill No is required', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->flashdata('MSG_ERR',"Please Enter bill no");
                redirect('NagadiRasid/addBill');
            } else  {
                $userid                 = $this->session->userdata('PRJ_USER_ID');
                $post                   = $this->input->post();
                $fiscal_year            = $post['fiscal_year'];
                $date                   = $post['date'];
                $customer_name          = $post['customer_name'];
                $bill_no                = $post['bill_no'];
                $provience              = $post['pradesh'];
                $district               = $post['district'];
                $gapa_napa              = $post['gaunpalika_nagarpalika'];
                $ward                   = $post['ward_no'];
                $t_total                = $post['t_total'];
                $recieved_amount        = $post['recieved_amount'];
                $return_amount          = $post['return_amount'];
                $s_fiscal_year          = str_replace("/","-",$fiscal_year);
                $guid                   = $post['guid'];
                $id                     = $post['id'];
                $payment_mode           = $this->input->post('payment_mode');
                $post_array             = array(
                    'fiscal_year'       => $fiscal_year,
                    'date'              => $date,
                    'customer_name'     => $customer_name,
                    'bill_no'           => $bill_no,
                    'provience'         => $provience,
                    'district'          => $district,
                    'gapa_napa'         => $gapa_napa,
                    'ward'              => $ward,
                    't_total'           => $t_total,
                    'fiscal_year'       => $fiscal_year,
                    'recieved_amount'   => $recieved_amount,
                    'status'            => 1,
                    'modified_by'       => $userid,
                    'modified_on'       => convertDate(date('Y-m-d')).' '.date("H:i:s"),
                    'payment_mode'      => $payment_mode,
                    'added_ip'      => $this->input->ip_address(),
                );
                //update bill details
                $main_topic             = $post['main_topic'];
                $sub_topic              = $post['sub_topic'];
                $main_title             = $this->input->post('main_title');
                $topic_qty              = $post['qty'];
                $rate                   = $post['rate'];
                $total_rate             = $post['rates'];
                $bid                    = $post['bid'];
                $discount_amount        = $post['discount_amount'];
                $topic_details          = array();
                foreach ($bid as $key => $indexv) {
                    $topic_details[]    = array(
                        'id'            => $bid[$key],
                        'main_topic'    => $main_topic[$key],
                        'sub_topic'     => $sub_topic[$key],
                        'topic'         => $main_title[$key],
                        'topic_qty'     => $topic_qty[$key],
                        'rate'          => $rate[$key],
                        't_rates'       => $total_rate[$key],
                        'discount_amount' =>isset($discount_amount) ? $discount_amount[$key]:'',
                    );
                };
                $add_new_topic = array();
                if(!empty($post['main_topic_new'])) {
                    $main_topic_new             = $post['main_topic_new'];
                    $sub_topic_new              = $post['sub_topic_new'];
                    $main_title_new             = $this->input->post('main_title_new');
                    $topic_qty_new              = $post['qty_new'];
                    $rate_new                   = $post['rate_new'];
                    $total_rate_new             = $post['rates_new'];
                    $discount_amount_new            = $post['discount_amount_new'];
                    $other_title            = $post['other_title'];

                    foreach ($main_topic_new as $key => $indexv) {
                        $add_new_topic[]    = array(
                            'main_topic'        => $main_topic_new[$key],
                            'sub_topic'         => $sub_topic_new[$key],
                            'topic'             => $main_title_new[$key],
                            'topic_qty'         => $topic_qty_new[$key],
                            'rate'              => $rate_new[$key],
                            't_rates'           => $total_rate_new[$key],
                            'others_topic'      => isset($other_title) ? $other_title[$key] : '',
                            'guid'              => $guid,
                            'discount_amount'   =>isset($discount_amount_new) ? $discount_amount_new[$key]:'',
                        );
                    };
                    $this->NagadiRasidModel->saveNagadiAmountDetails($add_new_topic);
                }

                $result = $this->NagadiRasidModel->updateNagadiDetails($id,$post_array);
                if($result) {
                    $this->NagadiRasidModel->updateBillingDetails($bid,$topic_details);
                    redirect('NagadiRasid/view/'.$id);
                } else {
                    exit('invalid parameter');
                }
            }
        }
    }

    // ----------------------------------------------------------------------------------------------------//
    public function view($id = NULL) {
        if($this->authlibrary->HasModulePermission($this->module_code,'VIEW')) {
            if(empty($id)) {
                show_404();
            }
            $data['page'] = 'view_bill';
            $data['bill_details'] = $this->NagadiRasidModel->getViewBillDetails($id);
            //pp($data['bill_details']);
            $data['states'] = $this->CommonModel->getDataByID('provinces',$data['bill_details']['provience']);
            $data['district'] = $this->CommonModel->getDataByID('settings_district',$data['bill_details']['district']);
            $data['gapas'] = $this->CommonModel->getDataByID('settings_vdc_municipality',$data['bill_details']['gapa_napa']);
            $data['nagadi_detials'] = $this->NagadiRasidModel->getNagadiMainDetails($data['bill_details']['guid']);
           // pp($data['nagadi_detials']);
            $data['user'] = $this->NagadiRasidModel->getUserDetails($data['bill_details']['added_by']);
           // pp($data['user']);
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function generateBill($guid = NULL) {
        $guid = $this->uri->segment(3);
        $data['bill_details'] = $this->NagadiRasidModel->getViewBillDetailsByGuid($guid);

        if($data['bill_details']['status'] == 2){
            $data['cancel_reason'] = $this->CommonModel->getDataBySelectedFields('nagadi_cancle_reason','bill_no', $data['bill_details']['bill_no']);
        }
        $print_count = $data['bill_details']['print_count']+1;
        $data['nagadi_detials'] = $this->NagadiRasidModel->getNagadiMainDetails($guid);
        $data['states'] = $this->CommonModel->getDataByID('provinces',$data['bill_details']['provience']);
        $data['district'] = $this->CommonModel->getDataByID('settings_district',$data['bill_details']['district']);
        $data['gapas'] = $this->CommonModel->getDataByID('settings_vdc_municipality',$data['bill_details']['gapa_napa']);
        $data['user'] = $this->NagadiRasidModel->getUserDetails($data['bill_details']['added_by']);
        $print_count = array(
            'print_count' =>$print_count
        );
        $data['total_count'] = $this->NagadiRasidModel->getCountNagadiMainDetails($data['bill_details']['guid']);
        $this->CommonModel->updateDataByField('nagadi_rasid', 'guid', $guid, $print_count);
        $this->load->view('sample_bill',$data);
    }

    public function cancleNagadiBill() {
        $id = $this->input->post('id');
        $data['bill_details'] = $this->CommonModel->getDataByID('nagadi_rasid',$id);
        $this->load->view('reason',$data);
    }
    //delete bill 
    public function DeleteBill() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $date = $this->input->post('date');
            $bill_no = $this->input->post('bill_no');
            $reason = $this->input->post('reason');
            $post_data = array(
                'trans_id'  => $id,
                'date'      => $date,
                'bill_no'   => $bill_no,
                'reason'    => $reason,
                'added_by'  => $this->session->userdata('PRJ_USER_ID')
            );
            $result = $this->CommonModel->insertData('nagadi_cancle_reason', $post_data);
            if($result) {
                $data = array(
                    'status' => 2,
                );
                $update_array = array('initial_flag' => 1);
                $this->CommonModel->UpdateData('nagadi_rasid',$id, $data);
                $this->CommonModel->updateDataByField('nagadi_amount_details','bill_no',$bill_no, $update_array);
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
        // $id = $this->uri->segment(3);
        // if(empty($id)) {
        //     show_404();
        // }
        // $data = array(
        //     'status' => 2,
        // );
        // $result = $this->CommonModel->UpdateData('nagadi_rasid',$id, $data);
        // if($result) {
        //     $this->session->set_flashdata('MSG_SUCCESS', MSG_SUCCESS);
        //     redirect('NagadiRasid');
        // }
    }

    //check if rasid exit on current fiscal year
    public function checkBillExits($fileNo) {
        
    }

    public function viewBills() {
        $data['page'] = 'view_all_bill';
        $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
        $this->load->view('main', $data);
    }


    public function GetBills() 
    {
      if($this->input->is_ajax_request()) {
        $columns = array( 
            0   => 'id', 
          
        );

        $limit                  = $this->input->post('length');
        $start                  = $this->input->post('start');
        $name                   = $this->input->post('name');
        $bill_no                = $this->input->post('bill_no');
        $from_date              = $this->input->post('from_date');
        $status                 = $this->input->post('status');
        $fiscal_year            = $this->input->post('fiscal_year');
        $order                  = $columns[$this->input->post('order')[0]['column']];
        $dir                    = $this->input->post('order')[0]['dir'];
        $totalData              = $this->NagadiRasidModel->CountBills($name,$bill_no,$from_date,$status, $fiscal_year);
        $totalFiltered          = $totalData;
        $posts                  = $this->NagadiRasidModel->GetAllBills($limit,$start,$order,$dir, $name,$bill_no,$from_date,$status, $fiscal_year);
          $data           = array();
          if(!empty($posts))
          {
              $i = 1;
              foreach ($posts as $post)
              {
                    $nestedData['sn']               = $this->mylibrary->convertedcit($i++);
                    $nestedData['id']               = $post->id;
                    $nestedData['date']             = $this->mylibrary->convertedcit($post->date);
                    $nestedData['guid']             = $post->guid;
                    $nestedData['name']             = $this->mylibrary->convertedcit($post->customer_name);
                    $nestedData['bill_number']      = $this->mylibrary->convertedcit($post->bill_no);
                    $nestedData['total']            = $this->mylibrary->convertedcit(round($post->t_total));
                  if($post->status == 1) {
                    $nestedData['status'] = 'सदर';
                  } else {
                    $nestedData['status'] = 'बदर';
                  }
                   $nestedData['user_name'] = $post->user_name;
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

    public function viewCancelReason() {
        if($this->input->is_ajax_request()) {
            $bill_no = $this->input->post('id');

            $data['reason'] = $this->NagadiRasidModel->getReason($bill_no);
            $this->load->view('view_reason', $data);
        }
    }

    //view nagadi cancel bills
    public function viewCancelBills() {
        $data['page'] = 'view_cancel_bill';
        $data['lists'] = $this->NagadiRasidModel->getAllCancelBills();
        $this->load->view('main', $data);
    }

    //delete item
    public function deleteItem($itemid) {
        if(empty($itemid)){
          redirect('Dashboard');
        } else {
            $nagadi_details = $this->CommonModel->getDataByID('nagadi_amount_details', $itemid);
            $total_amount = $this->CommonModel->getDataBySelectedFields('nagadi_rasid', 'guid', $nagadi_details['guid']);
            $amount_minus = $total_amount['t_total'] - $nagadi_details['t_rates'];
            $result = $this->NagadiRasidModel->updateTotalRates($amount_minus, $total_amount['guid']);
            if($result) {
                $this->CommonModel->deleteData('nagadi_amount_details', $itemid);
                redirect('NagadiRasid');
            } else {
                redirect('NagadiRasid/');
            }
        }

    }
}
