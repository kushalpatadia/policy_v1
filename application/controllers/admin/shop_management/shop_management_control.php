<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shop_management_control extends CI_Controller
{	
    function __construct()
    {
        parent::__construct();
		
        $this->admin_session = $this->session->userdata('admin_session');
       	$this->message_session = $this->session->userdata('message_session');
        check_admin_login();
		$this->load->model('shop_management_model');
		$this->load->model('imageupload_model');
		$this->obj = $this->shop_management_model;
		$this->viewName = $this->router->uri->segments[2];
		$this->user_type = 'admin';
    }
	

   
    public function index()
    {	
		//echo "ppp"; exit;
		$searchopt='';$searchtext='';$date1='';$date2='';$searchoption='';$perpage='';
		$searchtext = $this->input->post('searchtext');
		$sortfield = $this->input->post('sortfield');
		$sortby = $this->input->post('sortby');
		$searchopt = $this->input->post('searchopt');
		$perpage = $this->input->post('perpage');
		$allflag = $this->input->post('allflag');
		 
		if(!empty($allflag) && ($allflag == 'all' || $allflag == 'changesorting' || $allflag == 'changesearch')) {
            $this->session->unset_userdata('shop_sortsearchpage_data');
        }
        $data['sortfield']		= 'id';
        $data['sortby']			= 'desc';
        $searchsort_session = $this->session->userdata('shop_sortsearchpage_data');
	
		if(!empty($sortfield) && !empty($sortby))
		{
                    //$sortfield = $this->input->post('sortfield');
                    $data['sortfield'] = $sortfield;
                    //$sortby = $this->input->post('sortby');
                    $data['sortby'] = $sortby;
		}
		else
		{		
			if(!empty($searchsort_session['sortfield'])) {
				if(!empty($searchsort_session['sortby'])) {
					$data['sortfield'] = $searchsort_session['sortfield'];
					$data['sortby'] = $searchsort_session['sortby'];
					$sortfield = $searchsort_session['sortfield'];
					$sortby = $searchsort_session['sortby'];
					
		}
				} else {
					$sortfield = 'id';
					$sortby = 'desc';
				}
		}
		if(!empty($searchtext))
		{
			//$searchtext = $this->input->post('searchtext');
			$data['searchtext'] = $searchtext;
		} else {
                    if(empty($allflag))
                    {
                        if(!empty($searchsort_session['searchtext'])) {
                            $data['searchtext'] = $searchsort_session['searchtext'];
                            $searchtext =  $data['searchtext'];
                        }
						else
						{
							$data['searchtext'] = '';
						}
                    }
					else
					{
						$data['searchtext'] = '';
					}
                }
		if(!empty($searchopt))
		{
			//$searchopt = $this->input->post('searchopt');
			$data['searchopt'] = $searchopt;
		}
		if(!empty($date1) && !empty($date2))
		{
                    $date1 = $this->input->post('date1');
                    $date2 = $this->input->post('date2');
                    $data['date1'] = $date1;
                    $data['date2'] = $date2;	
		}
		if(!empty($perpage) && $perpage != 'null')
		{
                    //$perpage = $this->input->post('perpage');
                    $data['perpage'] = $perpage;
                    $config['per_page'] = $perpage;	
		}
        else
		{
			if(!empty($searchsort_session['perpage'])) {
				$data['perpage'] = trim($searchsort_session['perpage']);
				$config['per_page'] = trim($searchsort_session['perpage']);
			} else {
				$config['per_page'] = '10';
				$data['perpage'] = '10';
			}
		}
		$config['base_url'] = site_url($this->user_type.'/'."shop_management/");
        $config['is_ajax_paging'] = TRUE; // default FALSE
        $config['paging_function'] = 'ajax_paging'; // Your jQuery paging
		//$config['uri_segment'] = 3;
		//$uri_segment = $this->uri->segment(3);
		 if(!empty($allflag) && ($allflag == 'all' || $allflag == 'changesorting' || $allflag == 'changesearch')) {
            $config['uri_segment'] = 0;
            $uri_segment = 0;
        } else {
            $config['uri_segment'] = 3;
            $uri_segment = $this->uri->segment(3);
        }
		if(!empty($searchtext))
		{
		
			
			$match=array('shop_name'=>$searchtext,'category_name'=>$searchtext,'email'=>$searchtext);
			$data['datalist'] = $this->obj->select_records('shop','',$match,'','like','',$config['per_page'],$uri_segment,$sortfield,$sortby);
			$config['total_rows'] = count($this->obj->select_records('shop','',$match,'','like',''));
		
		}
		else
		{	
			$data['datalist'] = $this->obj->select_records('shop','','','','','',$config['per_page'],$uri_segment,$sortfield,$sortby);	
			$config['total_rows']= count($this->obj->select_records('shop'));
		}
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['msg'] = $this->message_session['msg'];

		$shop_sortsearchpage_data = array(
            'sortfield'  => $data['sortfield'],
            'sortby' =>$data['sortby'],
            'searchtext' =>$data['searchtext'],
          	'perpage' => trim($data['perpage']),
            'uri_segment' => $uri_segment,
            'total_rows' => $config['total_rows']);
        $this->session->set_userdata('shop_sortsearchpage_data', $shop_sortsearchpage_data);
        $data['uri_segment'] = $uri_segment;
		if($this->input->post('result_type') == 'ajax')
		{
			$this->load->view($this->user_type.'/'.$this->viewName.'/ajax_list',$data);
		}
		else
		{
			$data['main_content'] =  $this->user_type.'/'.$this->viewName."/list";
			$this->load->view('admin/include/template',$data);
		}
    }

    
    public function add_record()
    {
	
		$data['category'] = $this->obj->select_records('category','','','','');
		$fields = array('id,name');     

		$data['main_content'] = "admin/".$this->viewName."/add";
        $this->load->view('admin/include/template', $data);
    }

   
    public function insert_data()
    {
		//pr($_POST);exit;
		$cdata['shop_name'] = $this->input->post('shop_name');
		$ct = explode("-",$this->input->post('category_name'));
		$cdata['category_id'] = $ct[0];
		$cdata['category_name'] = $ct[1];
		$cdata['subcategory_id'] = $this->input->post('subcategory_name');
		$cdata['phone'] = $this->input->post('phone');
		$cdata['fax'] = $this->input->post('fax');
		$cdata['email'] = $this->input->post('email');
		$cdata['site'] = $this->input->post('site');
		$cdata['about_us'] = $this->input->post('about_us');
		$cdata['days_hours'] = $this->input->post('days_hours');
		$cdata['location'] = $this->input->post('location');
		
		$address = $cdata['location']; // Google HQ
		$prepAddr = str_replace(' ','+',$address);
		
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		
		$output= json_decode($geocode);
		
		$cdata['latitude'] = $output->results[0]->geometry->location->lat;
		$cdata['longitude'] = $output->results[0]->geometry->location->lng;
		
		if(!empty($_FILES['photo1']['name']))
		{  
			$uploadFile = 'photo1';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo1'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['photo2']['name']))
		{  
			$uploadFile = 'photo2';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo2'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['photo3']['name']))
		{  
			$uploadFile = 'photo3';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo3'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['photo4']['name']))
		{  
			$uploadFile = 'photo4';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo4'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['photo5']['name']))
		{  
			$uploadFile = 'photo5';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo5'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		
		$cdata['pro1_name'] = $this->input->post('product_name1');
		$cdata['pro1_price'] = $this->input->post('product_price1');
		
		$cdata['pro2_name'] = $this->input->post('product_name2');
		$cdata['pro2_price'] = $this->input->post('product_price2');
		
		$cdata['pro3_name'] = $this->input->post('product_name3');
		$cdata['pro3_price'] = $this->input->post('product_price3');
		
		$cdata['pro4_name'] = $this->input->post('product_name4');
		$cdata['pro4_price'] = $this->input->post('product_price4');
		
		$cdata['pro5_name'] = $this->input->post('product_name5');
		$cdata['pro5_price'] = $this->input->post('product_price5');
		
		if(!empty($_FILES['product1']['name']))
		{  
			$uploadFile = 'product1';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro1_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['product2']['name']))
		{  
			$uploadFile = 'product2';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro2_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['product3']['name']))
		{  
			$uploadFile = 'product3';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro3_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['product4']['name']))
		{  
			$uploadFile = 'product4';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro4_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['product5']['name']))
		{  
			$uploadFile = 'product5';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro5_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		$cdata['created_date'] = date('Y-m-d H:i:s');		
		$cdata['status'] = '1';
            
		$this->obj->insert_record($cdata);	
		$msg = $this->lang->line('common_add_success_msg');
        $newdata = array('msg'  => $msg);
        $this->session->set_userdata('message_session', $newdata);	
        redirect('admin/'.$this->viewName);				
		//redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_add_success_msg'));
    }
    
    public function edit_record()
    {
        $id = $this->uri->segment(4);
		$data['category'] = $this->obj->select_records('category','','','','');
		$data['subcategory'] = $this->obj->select_records('subcategory','','','','');
        $data['smenu_title']=$this->lang->line('admin_left_menu15');
        $data['submodule']=$this->lang->line('admin_left_ssclient');
        $fields = array('id,name');
        $match = array('id'=>$id);
        $result = $this->obj->select_records('shop','',$match,'','=');
        $data['editRecord'] = $result;
		$data['main_content'] = "admin/".$this->viewName."/add";       
	   	$this->load->view("admin/include/template",$data);
    }

    
    public function update_data()
    {
        $cdata['id'] = $this->input->post('id');
		
		
		$cdata['shop_name'] = $this->input->post('shop_name');
		$ct = explode("-",$this->input->post('category_name'));
		$cdata['category_id'] = $ct[0];
		$cdata['category_name'] = $ct[1];
		$cdata['subcategory_id'] = $this->input->post('subcategory_name');
		$cdata['phone'] = $this->input->post('phone');
		$cdata['fax'] = $this->input->post('fax');
		$cdata['email'] = $this->input->post('email');
		$cdata['site'] = $this->input->post('site');
		$cdata['about_us'] = $this->input->post('about_us');
		$cdata['days_hours'] = $this->input->post('days_hours');
		$cdata['location'] = $this->input->post('location');
		
		if(!empty($_FILES['photo1']['name']))
		{  
			$uploadFile = 'photo1';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo1'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['photo2']['name']))
		{  
			$uploadFile = 'photo2';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo2'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['photo3']['name']))
		{  
			$uploadFile = 'photo3';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo3'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['photo4']['name']))
		{  
			$uploadFile = 'photo4';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo4'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['photo5']['name']))
		{  
			$uploadFile = 'photo5';
			$bgImgPath = $this->config->item('photo_big_img_path');
			$smallImgPath = $this->config->item('photo_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['photo5'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		
		$cdata['pro1_name'] = $this->input->post('product_name1');
		$cdata['pro1_price'] = $this->input->post('product_price1');
		
		$cdata['pro2_name'] = $this->input->post('product_name2');
		$cdata['pro2_price'] = $this->input->post('product_price2');
		
		$cdata['pro3_name'] = $this->input->post('product_name3');
		$cdata['pro3_price'] = $this->input->post('product_price3');
		
		$cdata['pro4_name'] = $this->input->post('product_name4');
		$cdata['pro4_price'] = $this->input->post('product_price4');
		
		$cdata['pro5_name'] = $this->input->post('product_name5');
		$cdata['pro5_price'] = $this->input->post('product_price5');
		
		if(!empty($_FILES['product1']['name']))
		{  
			$uploadFile = 'product1';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro1_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['product2']['name']))
		{  
			$uploadFile = 'product2';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro2_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['product3']['name']))
		{  
			$uploadFile = 'product3';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro3_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['product4']['name']))
		{  
			$uploadFile = 'product4';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro4_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		if(!empty($_FILES['product5']['name']))
		{  
			$uploadFile = 'product5';
			$bgImgPath = $this->config->item('product_big_img_path');
			$smallImgPath = $this->config->item('product_small_img_path');
			$thumb = "thumb";
			$hiddenImage = '';
			$cdata['pro5_image'] = $this->imageupload_model->uploadBigImage($uploadFile,$bgImgPath,$smallImgPath,$thumb,$hiddenImage);
		}
		$cdata['created_date'] = date('Y-m-d H:i:s');		
		$cdata['status'] = '1';
		$this->obj->update_record($cdata);
		
		$msg = $this->lang->line('common_edit_success_msg');
        $newdata = array('msg'  => $msg);
        $this->session->set_userdata('message_session', $newdata);	
		$searchsort_session = $this->session->userdata('shop_sortsearchpage_data');
		$pagingid = $searchsort_session['uri_segment'];
		redirect('admin/'.$this->viewName.'/'.$pagingid);
		//redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_edit_success_msg'));
        
    }
    
    function delete_record()
    {
        $id = $this->uri->segment(4);
        $this->obj->delete_record($id);
		$msg = $this->lang->line('common_delete_success_msg');
       	$newdata = array('msg'  => $msg);
       	$this->session->set_userdata('message_session', $newdata);	
        redirect('admin/'.$this->viewName);
        //redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_delete_success_msg'));
    }
	
	
    function unpublish_record()
    {
        $id = $this->uri->segment(4);
		
		$cdata['id'] = $id;
		$cdata['status'] = '0';
		$this->obj->update_record($cdata);
		$msg = $this->lang->line('common_unpublish_msg');
        $newdata = array('msg'  => $msg);
        $this->session->set_userdata('message_session', $newdata);
		$user_id =  $id;
		$pagingid = $this->obj->getuserpagingid($user_id);
		redirect('admin/'.$this->viewName.'/'.$pagingid);	
        //redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_unpublish_msg'));
    }
	
	
	function publish_record()
    {
        $id = $this->uri->segment(4);
				
		$cdata['id'] = $id;
		$cdata['status'] = '1';
		$this->obj->update_record($cdata);
		$msg = $this->lang->line('common_publish_msg');
        $newdata = array('msg'  => $msg);
        $this->session->set_userdata('message_session', $newdata);	
		
		$user_id =  $id;
		$pagingid = $this->obj->getuserpagingid($user_id);
		redirect('admin/'.$this->viewName.'/'.$pagingid);

        //redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_publish_msg'));
    }
	
	public function ajax_delete_all()
	{		
	
		$id=$this->input->post('single_remove_id');
		if(!empty($id))
		{
			$this->obj->delete_record($id);
			unset($id);
		}
		
		
		$array_data=$this->input->post('myarray');
                $delete_all_flag = 0;$cnt = 0;
		for($i=0;$i<count($array_data);$i++)
		{
			$this->obj->delete_record($array_data[$i]);
                        $delete_all_flag = 1;
                        $cnt++;
		}
				//pagingation
                $searchsort_session = $this->session->userdata('shop_sortsearchpage_data');
                if(!empty($searchsort_session['uri_segment']))
                    $pagingid = $searchsort_session['uri_segment'];
                else
                    $pagingid = 0;
                $perpage = !empty($searchsort_session['perpage'])?$searchsort_session['perpage']:'10';
                $total_rows = $searchsort_session['total_rows'];
                if($delete_all_flag == 1)
                {
                    $total_rows -= $cnt;
                    if($pagingid*$perpage > $total_rows) {
                        if($total_rows % $perpage == 0)
                        {
                            $pagingid -= $perpage;
                        }
                    }
                } else {
                    if($total_rows % $perpage == 1)
                        $pagingid -= $perpage;
                }
                
                if($pagingid < 0)
                    $pagingid = 0;
		//echo 1;
                echo $pagingid;
		
	}

	function get_subcategory_list()
    {
		$cdid = explode('-',$this->input->post('cid'));
		$cid = $cdid[0];
		$match=array('category_id'=>$cid);
		$data['subcategory'] = $this->obj->select_records('subcategory','',$match,'','=');
		$this->load->view('admin/shop_management/subcategory_list',$data);
	}
	
}
