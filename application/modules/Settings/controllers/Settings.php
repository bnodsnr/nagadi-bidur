<?php

class Settings extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /**
        * This function list all the land minimun rate
        * @param NULL
        * @return void
     */
    public function Index()
    {}

    /**
        * This function on ajaxcall load add form in modal**
        * @param NULL
        * @return void
     */
    public function MenuSetup() {
        $data['page'] = 'menu_setup';
        $data['menus'] = $this->SettingModel->GetMenu();
        $this->load->view('main', $data);
    }
}