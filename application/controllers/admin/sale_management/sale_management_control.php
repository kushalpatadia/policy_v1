<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sale_management_control extends CI_Controller
{	
    function __construct()
    {
        parent::__construct();
		
        $this->admin_session = $this->session->userdata('admin_session');
       	$this->message_session = $this->session->userdata('message_session');
        check_admin_login();
		$this->load->model('sale_management_model');
		$this->load->model('imageupload_model');
		$this->obj = $this->sale_management_model;
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
            $this->session->unset_userdata('sale_sortsearchpage_data');
        }
        $data['sortfield']		= 'id';
        $data['sortby']			= 'desc';
        $searchsort_session = $this->session->userdata('sale_sortsearchpage_data');
	
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
		$config['base_url'] = site_url($this->user_type.'/'."sale_management/");
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
			$match=array('category_name'=>$searchtext,'shop_name'=>$searchtext);
			$data['datalist'] = $this->obj->select_records('sale','',$match,'','like','',$config['per_page'],$uri_segment,$sortfield,$sortby);
			$config['total_rows'] = count($this->obj->select_records('sale','',$match,'','like',''));
		}
		else
		{
			$data['datalist'] = $this->obj->select_records('sale','','','','','',$config['per_page'],$uri_segment,$sortfield,$sortby);	
			$config['total_rows']= count($this->obj->select_records('sale'));
		}
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['msg'] = $this->message_session['msg'];

		$sale_sortsearchpage_data = array(
            'sortfield'  => $data['sortfield'],
            'sortby' =>$data['sortby'],
            'searchtext' =>$data['searchtext'],
          	'perpage' => trim($data['perpage']),
            'uri_segment' => $uri_segment,
            'total_rows' => $config['total_rows']);
        $this->session->set_userdata('sale_sortsearchpage_data', $sale_sortsearchpage_data);
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
		$cdata['category_id'] = $this->input->post('category_name');
		
		$match=array('id'=>$cdata['category_id']);
		$category_data = $this->obj->select_records('category','',$match,'','=');
		$cdata['category_name'] = $category_data[0]['name'];
		
		$cdata['shop_id'] = $this->input->post('shop_name');
		
		$match=array('id'=>$cdata['shop_id']);
		$shop_data = $this->obj->select_records('shop','',$match,'','=');
		$cdata['shop_name'] = $shop_data[0]['shop_name'];
		
		if(!empty($shop_data[0]['pro1_name']))
		{
			$cdata['pro1_name'] = $shop_data[0]['pro1_name'];
			$cdata['pro1_price'] = $shop_data[0]['pro1_price'];
			$cdata['pro1_image'] = $shop_data[0]['pro1_image'];
		}
		
		if(!empty($shop_data[0]['pro2_name']))
		{
			$cdata['pro2_name'] = $shop_data[0]['pro2_name'];
			$cdata['pro2_price'] = $shop_data[0]['pro2_price'];
			$cdata['pro2_image'] = $shop_data[0]['pro2_image'];
		}
		
		if(!empty($shop_data[0]['pro3_name']))
		{
			$cdata['pro3_name'] = $shop_data[0]['pro3_name'];
			$cdata['pro3_price'] = $shop_data[0]['pro3_price'];
			$cdata['pro3_image'] = $shop_data[0]['pro3_image'];
		}
		
		if(!empty($shop_data[0]['pro4_name']))
		{
			$cdata['pro4_name'] = $shop_data[0]['pro4_name'];
			$cdata['pro4_price'] = $shop_data[0]['pro4_price'];
			$cdata['pro4_image'] = $shop_data[0]['pro4_image'];
		}
		
		if(!empty($shop_data[0]['pro5_name']))
		{
			$cdata['pro5_name'] = $shop_data[0]['pro5_name'];
			$cdata['pro5_price'] = $shop_data[0]['pro5_price'];
			$cdata['pro5_image'] = $shop_data[0]['pro5_image'];
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
		
		$match=array('id'=>$id);
		$sale = $this->obj->select_records('sale','',$match,'','=');
		
		$data['category'] = $this->obj->select_records('category','','','','');
		
		$match=array('category_id'=>$sale[0]['category_id']);
		$data['shops'] = $this->obj->select_records('shop','',$match,'','=');
		
		
		
        $data['smenu_title']=$this->lang->line('admin_left_menu15');
        $data['submodule']=$this->lang->line('admin_left_ssclient');
        $fields = array('id,name');
        $match = array('id'=>$id);
        $result = $this->obj->select_records('sale','',$match,'','=');
        $data['editRecord'] = $result;
		$data['main_content'] = "admin/".$this->viewName."/add";       
	   	$this->load->view("admin/include/template",$data);
    }

    
    public function update_data()
    {
        $cdata['id'] = $this->input->post('id');
		
		$cdata['category_id'] = $this->input->post('category_name');
		
		$match=array('id'=>$cdata['category_id']);
		$category_data = $this->obj->select_records('category','',$match,'','=');
		$cdata['category_name'] = $category_data[0]['name'];
		
		$cdata['shop_id'] = $this->input->post('shop_name');
		
		$match=array('id'=>$cdata['shop_id']);
		$shop_data = $this->obj->select_records('shop','',$match,'','=');
		$cdata['shop_name'] = $shop_data[0]['shop_name'];
		
		if(!empty($shop_data[0]['pro1_name']))
		{
			$cdata['pro1_name'] = $shop_data[0]['pro1_name'];
			$cdata['pro1_price'] = $shop_data[0]['pro1_price'];
			$cdata['pro1_image'] = $shop_data[0]['pro1_image'];
		}
		
		if(!empty($shop_data[0]['pro2_name']))
		{
			$cdata['pro2_name'] = $shop_data[0]['pro2_name'];
			$cdata['pro2_price'] = $shop_data[0]['pro2_price'];
			$cdata['pro2_image'] = $shop_data[0]['pro2_image'];
		}
		
		if(!empty($shop_data[0]['pro3_name']))
		{
			$cdata['pro3_name'] = $shop_data[0]['pro3_name'];
			$cdata['pro3_price'] = $shop_data[0]['pro3_price'];
			$cdata['pro3_image'] = $shop_data[0]['pro3_image'];
		}
		
		if(!empty($shop_data[0]['pro4_name']))
		{
			$cdata['pro4_name'] = $shop_data[0]['pro4_name'];
			$cdata['pro4_price'] = $shop_data[0]['pro4_price'];
			$cdata['pro4_image'] = $shop_data[0]['pro4_image'];
		}
		
		if(!empty($shop_data[0]['pro5_name']))
		{
			$cdata['pro5_name'] = $shop_data[0]['pro5_name'];
			$cdata['pro5_price'] = $shop_data[0]['pro5_price'];
			$cdata['pro5_image'] = $shop_data[0]['pro5_image'];
		}
		$cdata['created_date'] = date('Y-m-d H:i:s');		
		$cdata['status'] = '1';
		
		
		
		$this->obj->update_record($cdata);
		
		$msg = $this->lang->line('common_edit_success_msg');
        $newdata = array('msg'  => $msg);
        $this->session->set_userdata('message_session', $newdata);	
		$searchsort_session = $this->session->userdata('sale_sortsearchpage_data');
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
                $searchsort_session = $this->session->userdata('sale_sortsearchpage_data');
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
	
	function get_shop_list()
    {
		$cid = $this->input->post('cid');
		$match=array('category_id'=>$cid);
		$data['shops'] = $this->obj->select_records('shop','',$match,'','=');
		$this->load->view('admin/sale_management/shop_list',$data);
	}
	
	function get_product_list()
    {
		$sid = $this->input->post('sid');
		$match=array('id'=>$sid);
		$data['products'] = $this->obj->select_records('shop','',$match,'','=');
		//pr($data['products']); exit;
		$this->load->view('admin/sale_management/product_list',$data);
	}
	
}
