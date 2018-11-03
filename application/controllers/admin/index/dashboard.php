<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{ 
    function _construct()
    {
        echo "hello dashboard";exit;
		parent::__construct();
        $this->admin_session = $this->session->userdata('admin_session');
       
        check_admin_login();$this->load->model('dashboard_model'); 
		
	}

    public function index()
    {
		$doc_session_array = $this->session->userdata('admin_session');
        ($doc_session_array['active'] == true) ? $this->display_dashbord() : redirect('admin/login');
    }
	
    public function display_dashbord()
    {
		$this->load->model('dashboard_model'); 
        $data['msg'] = ($this->uri->segment(3) == 'msg') ? $this->uri->segment(4) : '';
		
		$data['main_content'] = "admin/home/dashboard";
		$this->load->view('admin/include/template',$data);
    }
}