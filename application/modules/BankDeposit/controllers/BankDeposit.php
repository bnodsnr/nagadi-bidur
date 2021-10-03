<?php

class BankDeposit extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->load->model("BankDepositModel");
        $this->module_code = 'BANK-DEPOSIT';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /**
        * This function list all the land minimun rate
        * @param 
        * @return void

     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page']               = 'list_all';
            $data['wards']              = $this->CommonModel->getData('wardwise_address','ASC','ward');
            $data['fiscal_year']        = $this->CommonModel->getData('fiscal_year','ASC');
            $data['banks']              = $this->CommonModel->getData('banks', 'ASC');
            $data['totalnagadi']        = $this->BankDepositModel->getTotalNagadi();
            $data['totalsampatikar']    = $this->BankDepositModel->getTotalsampatikar();
            $data['total_amount']       = $data['totalnagadi']->t_rates + $data['totalsampatikar']->net_total_amount;
            $data['total_deposit_amt']  = $this->BankDepositModel->getTotaldeposit();
            $data['total_due_amount']   = $data['total_amount'] - $data['total_deposit_amt']->deposit_amt;
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    //add
    public function Add($id = NULL) {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $id                         = $this->uri->segment(3);
            $data['page']               = 'add';
            $data['fiscal_year']        = get_current_fiscal_year();
            $data['banks']              = $this->CommonModel->getData('banks','asc');
            $data['totalnagadi']        = $this->BankDepositModel->getTotalNagadi();
            $data['totalsampatikar']    = $this->BankDepositModel->getTotalsampatikar();
            $data['total_amount']       = $data['totalnagadi']->t_rates + $data['totalsampatikar']->net_total_amount;
            $data['total_deposit_amt']  = $this->BankDepositModel->getTotaldeposit();
            $data['total_due_amount']   = $data['total_amount'] - $data['total_deposit_amt']->deposit_amt;
            if(!empty($id)) {
                $data['rows']           = $this->CommonModel->getDataByID('bank_dakhila',$id);
            }
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    public function getAccountNo() {
        if($this->input->is_ajax_request()) {
            $bank_name = $this->input->post('bank_name');
            $data = $this->CommonModel->getDataBySelectedFields('banks','name', $bank_name);
            if($data) {
                $response = array(
                    'status'        => 'success',
                    'data'          => $data['acc_no'],
                    'message'       => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
            exit; 
            } else {
                $response = array(
                    'status'        => 'success',
                    'data'          => '0',
                   
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            
        } else {
          exit('no direct script allowed');
        }
    }

    //save
    public function Save() {
        if($this->input->is_ajax_request()) {
            $id                 = $this->input->post('id');
            $dakhila_date       = $this->input->post('dakhila_date');
            $bank_name          = $this->input->post('bank_name');
            $acc_no             = $this->input->post('acc_no');
            $voucher_no         = $this->input->post('voucher_no');
            $total_collection   = $this->input->post('total_amount');
            $deposit_amount     = $this->input->post('deposit_amount');
            $due_amount         = $this->input->post('due_amount');
            $file               = $_FILES['userfile']['name'];
            if(!empty($file)) {
                $file =  preg_replace('/\s+/', '_', $file);
                $img=time().'-'.$file;
                $config = array(
                    'upload_path'=>APPPATH .'../assets/vouchers/',
                    'allowed_types'=> "jpg|png|JPEG|PDF|pdf",
                    'overwrite' => TRUE,
                    'file_name' => $img,
                    'max_size' => 1020*10,
                );
                $this->load->library('upload');
                $this->upload->initialize($config);
                if(!$this->upload->do_upload()) {
                    $error =  $this->upload->display_errors();
                    $response = array(
                        'status'      => 'error',
                        'message'        => 'बैंकको वौचेर मिलेन 
                        ',
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;

                } else{
                    $this->upload->do_upload();
                }
            } else {
                if(!empty($id)) {
                    $img = $this->input->post('old_image');
                } else {
                    $img = '';
                }
            }
            $this->form_validation->set_rules('dakhila_date', 'दाखिला मिति खाली हुन सक्दैन', 'required');
            $this->form_validation->set_rules('bank_name', 'बैंकको नाम खाली हुन सक्दैन', 'required');
            $this->form_validation->set_rules('acc_no',   'खाता नं हुन सक्दैन', 'required');
            $this->form_validation->set_rules('voucher_no', 'भौचर नं खाली हुन सक्दैन', 'required');
            $this->form_validation->set_rules('total_amount', 'जम्मा संकलन रकम खाली हुन सक्दैन', 'required');
            $this->form_validation->set_rules('deposit_amount', 'जम्मा गरेको रकम खाली हुन सक्दैन', 'required');
            $this->form_validation->set_rules('due_amount', 'बाकीं रकम हुन सक्दैन', 'required');
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
                'deposit_date'            => $dakhila_date,
                'bank_name'               => $bank_name,
                'acc_no'                  => $acc_no,
                'voucher_no'              => $voucher_no,
                'deposit_amt'             => $deposit_amount,
                'total_amount'            => $total_collection,
                'voucher_image'           => $img,
                'due_amount'              => $due_amount,
                'added_ward'              => $this->session->userdata('PRJ_USER_WARD'),
                'fiscal_year'             => get_current_fiscal_year(),
            );
            if(empty($id)) {
                $user_details = array(
                    'added_date'              => date('Y-m-d H:i:s'),
                    'added_ip'                => $this->input->ip_address(),
                    'added_by'                => $this->session->userdata('PRJ_USER_ID'),
                );
            } else {
                $user_details = array(
                    'modified_date'              => date('Y-m-d H:i:s'),
                    'modified_ip'                => $this->input->ip_address(),
                    'modified_by'                => $this->session->userdata('PRJ_USER_ID'),
                );
            }
            $insert_data = array_merge($post_data, $user_details);
            if(empty($id)) {
                $result = $this->CommonModel->insertData('bank_dakhila',$insert_data);
                if($result) {
                    $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                        'message'     => 'redirect',
                        'redirect_url'    => base_url().'BankDeposit'
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                }   
            } else {
                $result = $this->CommonModel->UpdateData('bank_dakhila',$id, $insert_data);
                if($result) {
                    $response = array(
                        'status'      => 'success',
                        'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                        'message'     => 'redirect',
                        'redirect_url'    => base_url().'BankDeposit'
                    );
                    header("Content-type: application/json");
                    echo json_encode($response);
                    exit;
                }   
            }
        } else {
            exit('no direct script allowed');
        }
    }

    /**
        * This function on ajaxcall load server side data into datatable
        * @param  NULL
        * @return json 
    */
    public function GetList() {
        if($this->input->is_ajax_request()) {
            $columns = array( 
                0   => 'id',
            );
            $limit                    = $this->input->post('length');
            $start                    = $this->input->post('start');
            $sn                       = $start+1;
            $ward                     = $this->input->post('ward_no');
            // echo $ward;
            $bank_name                = $this->input->post('bank_name');
            $voucher_no               = $this->input->post('voucher_no');
            $fiscal_year               = $this->input->post('fiscal_year');

            $order                    = '';
            $dir                      = $this->input->post('order')[0]['dir'];
            $totalData                = $this->BankDepositModel->CountAllList($ward,$bank_name,$voucher_no,$fiscal_year);
            $totalFiltered            = $totalData;
            $posts                    = $this->BankDepositModel->GetDepositList($limit,$start,$order,$dir,$ward,$bank_name,$voucher_no,$fiscal_year);
            //pp($posts);
            $data                     = array();
            if(!empty($posts))
            {
                $i = 1;
                foreach ($posts as $post)
                {
                    $nestedData['sn']                 = $this->mylibrary->convertedcit($sn++);
                    $nestedData['id']                 = $post->id;
                    $nestedData['deposit_date']       = $this->mylibrary->convertedcit($post->deposit_date);
                    $nestedData['bank_name']          = $this->mylibrary->convertedcit($post->bank_name);
                    $nestedData['acc_no']             = $this->mylibrary->convertedcit($post->acc_no);
                    $nestedData['voucher_no']         = $this->mylibrary->convertedcit($post->voucher_no);
                    $nestedData['voucher_image']      = $post->voucher_image;
                    $nestedData['deposit_amt']        = $this->mylibrary->convertedcit($post->deposit_amt);
                    $nestedData['due_amount']         = $this->mylibrary->convertedcit($post->due_amount);
                    if($post->added_ward == '0') {
                        $nestedData['added_ward']     = "पालिका";
                    } else {
                        $nestedData['added_ward']     = $this->mylibrary->convertedcit($post->added_ward);
                    }
                    $nestedData['username']           = $post->username;
                    $data[] = $nestedData;
                }
            }
            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );
            echo json_encode($json_data);
        } else {
          exit('HTTPS!!');
        }
    }

    //edit form
    public function edit() {
        if($this->authlibrary->HasModulePermission($this->module_code, "ADD")){
            $id                         = $this->uri->segment(3);
            $data['page']               = 'edit';
            $data['fiscal_year']        = get_current_fiscal_year();
            $data['banks']              = $this->CommonModel->getData('banks','asc');
            $data['totalnagadi']        = $this->BankDepositModel->getTotalNagadi();
            $data['totalsampatikar']    = $this->BankDepositModel->getTotalsampatikar();
            $data['total_amount']       = $data['totalnagadi']->t_rates + $data['totalsampatikar']->net_total_amount;
            $data['total_deposit_amt']  = $this->BankDepositModel->getTotaldeposit();
            $data['total_due_amount']   = $data['total_amount'] - $data['total_deposit_amt']->deposit_amt;
            if(!empty($id)) {
                $data['rows']           = $this->CommonModel->getDataByID('bank_dakhila',$id);
            }
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }
    
    public function getTotal() {
        if($this->input->is_ajax_request()) {
            $fiscal_year = $this->input->post('fiscal_year');
            $bank_name = $this->input->post('bank_name');
            $voucher_no = $this->input->post('voucher_no');
            $ward_no = $this->input->post('ward_no');
            $data['totalnagadi']        = $this->BankDepositModel->getTotalNagadiSearch($fiscal_year,$ward_no);
            $data['totalsampatikar']    = $this->BankDepositModel->getTotalsampatikarSearch($fiscal_year,$ward_no);
            $data['total_amount']       = $this->mylibrary->convertedcit($data['totalnagadi']->t_rates + $data['totalsampatikar']->net_total_amount);
            
            $data['total_deposit_amt']  = $this->BankDepositModel->getTotaldepositSearch($fiscal_year,$ward_no);
            $data['total_due_amount']   = $this->mylibrary->convertedcit(round($data['total_amount'] - $data['total_deposit_amt']->deposit_amt));

            $total_deposit_amt = $this->mylibrary->convertedcit(round($data['total_deposit_amt']->deposit_amt));

            $total_amt = $data['totalnagadi']->t_rates + $data['totalsampatikar']->net_total_amount;
            //pp($due_amount);
            $due_amount = $this->mylibrary->convertedcit($total_amt - $data['total_deposit_amt']->deposit_amt);
            $message = '<div class="alert alert-info"><h2>जम्मा संकलन गरिएको रकम:-'.$data['total_amount'].' | जम्मा  गरिएको रकम:- '.$total_deposit_amt.'बाकीं रकम:-'.$due_amount.'</h2></div>';
            $response = array(
                'status'      => 'success',
                'message'     => $message
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;

        }
    }
    
    //delete 
    public function delete() {
        $id = $this->uri->segment(3);
        $result = $this->CommonModel->deleteData('bank_dakhila',$id);
        if($result) {
            $this->session->set_flashdata('MSG_SUCCESS',' Successfully Removed');
            redirect('BankDeposit');
        }
        // if($this->CommonModel->deleteData('bank_dakhila',$id)) {
        //     $this->session->set_flashdata('MSG_SUCCESS',' Successfully Removed');
        //     redirect('BankDeposit','location');
        // }
    }
}