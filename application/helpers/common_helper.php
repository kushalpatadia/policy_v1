<?php
/*
    @Description: Function for send email
    @Author: Jayesh Rojasara
    @Input: - 
    @Output: - send email
    @Date: 06-05-14
    */
    function send_email($name='',$email_temp_title,$from,$to,$subject,$date='',$confirm_link='',$total='',$link='',$password='',$exdate='',$membername='',$img='',$username='',$code='')
    {   
        $CI = get_instance();
        $CI->load->model('emailtemplates_model');
        $fields = array('id','name','content');
        $arr = array('name'=>$email_temp_title);
        
        $email_templates = $CI->emailtemplates_model->getemailtemplates($fields,$arr,'','=','','','');
        
        if($email_templates)    
        {
         $content = $email_templates[0]['content'];
         $temp_name = $email_templates[0]['name'];

            switch($temp_name)
            {
              case 'registration_link':
                        $get_name = array ('/{username}/', '/{link}/','/{adminname}/'); 
                        $set_name = array ($name, $link, 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
            case 'registrationby_admin_link':
                $get_name = array ('/{username}/','/{userid}/','/{password}/', '/{link}/','/{adminname}/'); 
                $set_name = array ($name,$to,$password, $link, 'Tops Tech'); 
                $msg = preg_replace ($get_name, $set_name, $content);
                break;
               case 'appointment_email':
                       $d= explode(" ",$date);
                         $get_name = array ('/{username}/', '/{date}/','/{time}/','/{adminname}/','{link}'); 
                        $set_name = array ($name, date('d-m-Y',strtotime($d[0])), date("H:i a",strtotime($d[1])),'Tops Tech',$confirm_link); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                        break;
               case 'payment_reminder':
                        $get_name = array ('/{username}/', '/{total}/','/{adminname}/'); 
                        $set_name = array ($name, $total, 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                        break;
              case 'payment_confirmation':
                        $get_name = array ('/{username}/', '/{total}/','/code/','/{adminname}/'); 
                        $set_name = array ($name, $total,$code, 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                        break;
              case 'forgot_password':
                        
                        $get_name = array ('/{username}/', '/{password}/','/{adminname}/'); 
                        $set_name = array ($name, $password, 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                        break; 
              case 'appointment_confirm':
                         $d= explode(" ",$date);
                        $get_name = array ('/{username}/', '/{date}/','/{time}/','/{link}/','/{adminname}/'); 
                        $set_name = array ($name,date('d-m-Y',strtotime($d[0])), date("H:i a",strtotime($d[1])), $link, 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
             case 'create_membership':
                        $get_name = array ('/{username}/', '/{date}/','/{adminname}/'); 
                        $set_name = array ($name,$date, 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
             case 'membership_payment':
                        $get_name = array ('/{username}/', '/{date}/','/{date1}/','/{adminname}/'); 
                        $set_name = array ($name,$date,$exdate,'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
             case 'membership_payment':
                        $get_name = array ('/{username}/','/{membershipname}/', '/{date}/','/{date1}/','/{adminname}/'); 
                        $set_name = array ($name,$membername,$date,$exdate,'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
             case 'app_confirm':
                         $d= explode(" ",$date);
                        $get_name = array ('/{username}/', '/{date}/','/{time}/','/{adminname}/'); 
                        $set_name = array ($name,date('d-m-Y',strtotime($d[0])), date("H:i a",strtotime($d[1])), 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
             case 'app_cancel':
                         $d= explode(" ",$date);
                        $get_name = array ('/{username}/', '/{date}/','/{time}/','/{adminname}/'); 
                        $set_name = array ($name,date('d-m-Y',strtotime($d[0])), date("H:i a",strtotime($d[1])), 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
                 case 'birthday_wish':
                         $get_name = array ('/{username}/','/{src}/','/{adminname}/'); 
                        $set_name = array ($name,$img, 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
                  case 'birthday_wish1':
                         $get_name = array ('/{manager}/','/{username}/','/{adminname}/'); 
                        $set_name = array ($name,$username, 'Tops Tech'); 
                        $msg = preg_replace ($get_name, $set_name, $content);
                    break;
               default :
                   break;
            }           
            $config['protocol'] = 'sendemail';
            $config['mailpath'] = '/var/spool/mqueue';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = FALSE;
            $config['protocol'] = 'sendemail';
            $config['smtp_port'] = '10000';
            $config['smtp_host'] = 'webmin@stratus.agentleadspro.com';
            $config['smtp_user'] = 'topsint';  
            $config['smtp_pass'] = 'aditya';  
            $config['mailtype']='html';
            $config['newline']="\r\n";
            $CI->load->library('email', $config);
            
            $CI->email->initialize($config);
            $CI->email->from($from,'Admin');
            $CI->email->to($to);
            $CI->email->subject($subject);
            $CI->email->message($msg);	
            if($CI->email->send())
            {   
                
                return $CI->lang->line('general_email_successsending');
            }
            else
                return $CI->lang->line('general_email_errorsending');
        }
        else
            return $CI->lang->line('general_email_errorsending');
    }
	
	
	function check_admin_login(){
		$CI = & get_instance();  //get instance, access the CI superobject
  		$adminLogin = $CI->session->userdata('admin_session');
        (!empty($adminLogin['id']))?'':redirect('admin/login');  	
	}
	
	function check_user_login(){
		$CI = & get_instance();  //get instance, access the CI superobject
  		$userLogin = $CI->session->userdata('user_session');
        (!empty($userLogin['id']))?'':redirect('front/login');  	
	}
	
	/*
    @Description: Function for print array
    @Author: Niral Patel
    @Input: - 
    @Output: - sort
    @Date: 2-2-2014
    */
	function pr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
	/*
    @Description: Function for date format
    @Author: Niral Patel
    @Input: - 
    @Output: - date
    @Date: 2-2-2014
    */
    function currentdatetime(){
        return date('Y-m-d h:i:s');
    }
	function dateformat($date)
    {
        //echo date("m/d/Y", strtotime($date));
		return date("m/d/Y", strtotime($date));
    }
	function databasedateformat($date)
    {
        return date("Y-m-d", strtotime($date));
    }
     
    
?>
