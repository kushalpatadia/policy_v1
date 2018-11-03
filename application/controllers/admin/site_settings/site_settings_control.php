<?php 


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class site_settings_control extends CI_Controller
{	
    function __construct()
    {	
        parent::__construct();
        $this->admin_session = $this->session->userdata('admin_session');
        $this->load->model('common_function_model');
		$this->load->model('site_settings_model');
		$this->obj = $this->site_settings_model;
		$this->load->model('imageupload_model');
		$this->viewName = $this->router->uri->segments[2];
    }
   
    public function index()
    {	
		
		//$data['msg'] = ($this->uri->segment(3) == 'msg') ? $this->uri->segment(4) : '';

    	$id = $this->uri->segment(4);
    	$data['smenu_title']=$this->lang->line('admin_left_menu15');
    	$data['submodule']=$this->lang->line('admin_left_ssclient');
    	$fields = array('id,name');
    	$match = array('id'=>'1');
    	$result = $this->obj->select_records('',$match,'','=');
    	$data['editRecord'] = $result;
		$data['main_content'] = "admin/".$this->viewName."/site_settings";
        $this->load->view('admin/include/template', $data);
    }
   
    public function update_data()
    {
        $cdata['id'] = $this->input->post('id');
		$cdata['site_name'] = $this->input->post('site_name');
		if(!empty($_FILES['image']['name']))
		{  
			$uploadFile = 'image';
			$bgImgPath = $this->config->item('site_logo_big_img_path');
			$smallImgPath = $this->config->item('site_logo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['site_logo'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
			$cdata['id'] = '1';
		}
		$this->obj->update_record($cdata);
		
		$msg = $this->lang->line('common_edit_success_msg');
        $newdata = array('msg'  => $msg);
        $this->session->set_userdata('message_session', $newdata);	
		$searchsort_session = $this->session->userdata('category_sortsearchpage_data');
		$pagingid = $searchsort_session['uri_segment'];
		redirect('admin/'.$this->viewName.'/'.$pagingid);
		//redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_edit_success_msg'));
        
    }
   
}