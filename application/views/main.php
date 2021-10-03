<?php
$this->load->view('set_header');
(isset($page))?$this->load->view($page):'';
$this->load->view('footer');
if(!empty($script)){
	$this->load->view($script);
} 