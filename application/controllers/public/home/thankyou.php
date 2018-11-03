<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Thankyou extends CI_Controller
{

    function __construct() 
    {
        parent::__construct();
        $this->viewName = $this->router->fetch_class();
    }

    public function index() 
    {
    	$data['main_content'] = "public/home/".$this->viewName;
    	$this->load->view('public/include/template', $data);
    }
}
