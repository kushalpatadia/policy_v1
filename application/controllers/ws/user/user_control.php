<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_control extends CI_Controller
{	
    function __construct()
    {
		parent::__construct();
		$this->load->model('ws/user_model');
		$this->load->model('common_function_model');
		
		$this->obj = $this->user_model;
		$this->viewName = $this->router->uri->segments[2];
		$this->user_type = 'admin';
    }
	

   function index()
	{	
		echo "Welcome to Simkon App";
	}
	
	public function register()
    {
		$match = array('email'=>$_GET['email']);
        $result = $this->obj->select_records('user_management','',$match,'','=');
		if(count($result) > 0)
		{
			$arr['success']='0';
			$arr['message'] = 'email id already exist';
		}
		else
		{
			$data['name'] = $_GET['name'];
			$data['phone'] = $_GET['phone'];
			$data['email'] = $_GET['email'];
			$data['age'] = $_GET['age'];
			$data['city'] = $_GET['city'];
			$data['gender'] = $_GET['gender'];
			$data['is_admin'] = '0'; 
			$data['created_date'] = date('Y-m-d H:i:s');		
			$data['status'] = '1'; 
			$data['password'] = md5($_GET['password']);
			$repeat_password = md5($_GET['repeat_password']);
			if($data['password'] != $repeat_password)
			{
				$arr['success']='0';
				$arr['message']="password does not match";
			}
			else
			{ 
				$created_midified_id = $this->obj->insert_record('user_management',$data);
				if($created_midified_id)	
				{
					$arr['success']='1';
					$arr['data'] = $data;   
				}
			}
		}
		echo json_encode($arr);
		
	}
	
	
	public function admin_register()
    {
		$match = array('email'=>$_GET['email']);
        $result = $this->obj->select_records('user_management','',$match,'','=');
		if(count($result) > 0)
		{
			$arr['success']='0';
			$arr['message'] = 'email id already exist';
		}
		else
		{
			$data['name'] = $_GET['username'];
			$data['email'] = $_GET['email'];
			$data['is_admin'] = '1'; 
			$data['created_date'] = date('Y-m-d H:i:s');		
			$data['status'] = '1'; 
			$data['password'] = md5($_GET['password']);
			$repeat_password = md5($_GET['repeat_password']);
			if($data['password'] != $repeat_password)
			{
				$arr['success']='0';
				$arr['message']="password does not match";
			}
			else
			{ 
				$created_midified_id = $this->obj->insert_record('user_management',$data);
				if($created_midified_id)	
				{
					$arr['success']='1';
					$arr['data'] = $data;   
				}
			}
		}
		echo json_encode($arr);
	}
	
	public function login()
	{
		$username = $_GET['username'];
		$password = md5($_GET['password']);
		$match = array('email'=>$username,'password'=>$password,'status'=>1);
        $result = $this->obj->select_records('user_management','',$match,'','=');
		if(empty($result))
		{
			$arr['success']='0';
			$arr['message']="No user found";
		}
		else
		{
			if($result[0]['is_admin'] == 1)
			{
				$arr['is_admin']='1';
			}
			else
			{
				$arr['is_admin']='0';
			}
			$arr['success']='1';
			$arr['data'] = $result[0];  
		}
		echo json_encode($arr);
		
	}
	
	public function add_category()
	{
		$data['name'] = $_GET['category_name'];
		$data['status'] = '1';
		$created_midified_id = $this->obj->insert_record('category',$data);
		
		$arr['success']='1';
		$arr['category_id'] = $created_midified_id; 
		echo json_encode($arr);
		
	}
	
	public function get_product_by_catgory()
	{
		$category_id = $_GET['category_id'];
		$match = array('category_id'=>$category_id,'status'=>1);
		$result = $this->obj->select_records('product','',$match,'','=');
		if(empty($result))
		{
			$arr['success']='0';
			$arr['message']="No product found found";
		}
		else
		{
			
			$arr['success']='1';
			$arr['data'] = $result;  
		}
		echo json_encode($arr);
	}
	
	public function add_product_favourite()
	{
		$user_id = $_GET['user_id'];
		$product_id = $_GET['product_id'];
		$match = array('user_id'=>$user_id,'product_id'=>$product_id,'status'=>1);
		$result = $this->obj->select_records('product_favourite','',$match,'','=');
		if(empty($result))
		{
			$data['user_id'] = $_GET['user_id'];
			$data['product_id'] = $_GET['product_id'];
			$data['status'] = '1';
			$created_midified_id = $this->obj->insert_record('product_favourite',$data);
			$arr['success']='1';   
		}
		else
		{
			$arr['success']='0';
			$arr['message']="Product already added";
		}
		echo json_encode($arr);
	}
	
	public function remove_product_favourite()
	{
		$user_id = $_GET['user_id'];
		$product_id = $_GET['product_id'];
		$match = array('user_id'=>$user_id,'product_id'=>$product_id,'status'=>1);
		$result = $this->obj->select_records('product_favourite','',$match,'','=');
		if(empty($result))
		{
			$arr['success']='0';
			$arr['message']="Product not found";
		}
		else
		{
			$result = $this->obj->delete_record('product_favourite',$user_id,$product_id);
			$arr['success']='1';
			$arr['message']="Product removed from favourite";
		}
		echo json_encode($arr);
	}
	
	
	
    public function getuser()
    {
	//echo 1;exit;
		$post_data = $_REQUEST;
		//pr($post_data);exit;
		$match='';
		if(isset($post_data['name']) && !empty($post_data['name']))
		{
			 $match = array("CONCAT(first_name,' ',last_name)"=>$post_data['name']);
		}
		if(!empty($post_data))
		{	
			$data = $this->obj->select_records('',$match,'','like','','', '','id','desc');  
		}
		else
		{
			$data = $this->obj->select_records('','','','','','', '','id','desc');
		}
		if(!empty($data))
		{
			$arr['MESSAGE']='SUCCESS';
			$arr['FLAG']=true;
			$arr['data']=$data;
		}
		else
		{
			$arr['MESSAGE']='FAIL';
			$arr['FLAG']=false;
			
		}
		echo json_encode($arr); 
    }


    public function insert_data()
    {
		$match = array('email_address'=>$this->input->get('email_address'));
        $result = $this->obj->select_records('',$match,'','=');
		if(count($result) > 0)
		{
			$this->session->set_userdata('email_exist','Email already exist');
		}
		else
		{
			$cdata['created_by'] = 1;
			$cdata['first_name'] = $this->input->get('first_name');
			$cdata['last_name'] = $this->input->get('last_name');
			$cdata['email_address'] = $this->input->get('email_address');
			$password = $this->randr(8);
			$cdata['password'] = $this->common_function_model->encrypt_script($password);
			$cdata['mobile_no'] = $this->input->get('mobile_no');
			$cdata['user_type'] = $this->input->get('user_type');
			$cdata['created_date'] = date('Y-m-d H:i:s');		
			$cdata['status'] = 1;
			 pr($cdata);exit;
			$name = $cdata['first_name']." ".$cdata['last_name'];
			$created_midified_id = $this->obj->insert_record($cdata);	
			// $this->email($cdata['email_address'],$name,$password);
			$msg = $this->lang->line('common_add_success_msg');
			$newdata = array('msg'  => $msg);
			$this->session->set_userdata('message_session', $newdata);	
		}
        redirect('admin/'.$this->viewName);				
		//redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_add_success_msg'));
    }
    
    
    public function update_data()
    {
	
		$cdata['id'] = $this->input->post('id');
		$match = array('email_address'=>$this->input->post('email_address'));
        $result = $this->obj->select_records('',$match,'','=');
		if(count($result) > 0 && $result[0]['id']!=$cdata['id'])
		{
			$this->session->set_userdata('email_exist','Email already exist');
		}
		else
		{
			$cdata['id'] = $this->input->post('id');
			$cdata['first_name'] = $this->input->post('first_name');
			$cdata['last_name'] = $this->input->post('last_name');
			$cdata['email_address'] = $this->input->post('email_address');
			$pass = $this->input->post('password');
			if(!empty($pass))
			{	
				$cdata['password'] =  $this->common_function_model->encrypt_script($this->input->post('password'));
			}
			
			$cdata['mobile_no'] = $this->input->post('mobile_no');
			$cdata['user_type'] = $this->input->post('user_type');
   
			$cdata['modified_date'] = date('Y-m-d H:i:s');		
			$cdata['status'] = 1;
    
			$this->obj->update_record($cdata);			
			
			// Update Player Name in Team Management
			$result = $this->player_model->select_player_trans($this->input->post('id'));
			if(count($result) > 0)
			{
				$traData['player_id'] 	= $result[0]['player_id'];
				$traData['player_name'] = $cdata['first_name']." ".$cdata['last_name'];
				$this->obj->update_player_trans($traData);	
			}
			
			// Update Player1 Name OR Player2 Name in championship_team_trans table
			$match_id =array('is_completed'=>'0');
			$get_championship_id = $this->championship_model->select_records('',$match_id,'','=');
			
			if(count($get_championship_id) > 0)
			{
				$champtra['championship_id'] = $get_championship_id[0]['id'];
				$champtra['player1_id'] = $this->input->post('id');
				$champtra['player2_id'] = $this->input->post('id');
				$get_championship_trans_id = $this->selected_team_model->select_champ_records($champtra);
				//pr($get_championship_trans_id);exit;
				if(!empty($get_championship_trans_id))
				{
					$champtraData['championship_id'] = $get_championship_id[0]['id'];
					if($get_championship_trans_id[0]['player1_id'] == $champtra['player1_id'])
					{
						$champtraData['player1_id'] = $cdata['id'];
						$champtraData['player1_name'] = $cdata['first_name']." ".$cdata['last_name'];
						$this->selected_team_model->update_player1_record($champtraData);	
					}
					else
					{					
						$champtraData['player2_id'] = $cdata['id'];
						$champtraData['player2_name'] = $cdata['first_name']." ".$cdata['last_name'];
						$this->selected_team_model->update_player1_record($champtraData);	
					}
				}
			}// END
			$msg = $this->lang->line('common_edit_success_msg');
			$newdata = array('msg'  => $msg);
			$this->session->set_userdata('message_session', $newdata);	
		}
		$player_id = $this->input->post('id');
		$pagingid = $this->obj->getplayerpagingid($player_id);
		//echo $pagingid;exit;
		redirect('admin/'.$this->viewName.'/'.$pagingid);
		//redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_edit_success_msg'));
        
    }
   
    function delete_record()
    {
        $id = $this->uri->segment(4);
		$returnmsg = $this->obj->delete_record($id);
		redirect('admin/'.$this->viewName);
        //redirect('admin/'.$this->viewName.'/msg/'.$this->lang->line('common_delete_success_msg'));
    }
}
