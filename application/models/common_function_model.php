<?php



class Common_function_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = '';
    }
	
	

	public function randr($j = 8)
    {
        $string = "";
        for($i=0;$i < $j;$i++)
        {
            srand((double)microtime()*1234567);
            $x = mt_rand(0,2);
            switch($x)
            {
                case 0:$string.= chr(mt_rand(97,122));break;
                case 1:$string.= chr(mt_rand(65,90));break;
                case 2:$string.= chr(mt_rand(48,57));break;
            }
        }
        return strtoupper($string);
    }
	
	
	
	function encrypt_script($string)
	{	
		$encrypted = base64_encode($string);
		
		return $encrypted;
	}
	
	
	
	function decrypt_script($string)
	{	
		$decrypted = base64_decode($string);
		
		return $decrypted;
	}
	
	
	function send_email($to='',$subject='',$message='',$from='',$cc='')
	{
		unset($config);
			   
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['protocol'] = 'smtp';
		$config['smtp_port'] = '26';
		$config['smtp_host'] = 'mail.simcom.co.il';
		$config['smtp_user'] = 'test@simcom.co.il';  
		$config['smtp_pass'] = 'simcom123';  
		$config['mailtype']='html';
		$config['newline']="\r\n";
		$this->load->library('email', $config);

		$this->email->initialize($config);
		$this->email->from($from,$this->config->item('sitename')." Administrator");	
		
		$this->email->to($to);                
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}

	function modal($modal_html,$button_name,$unique_id){
		$modal = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal_'.$unique_id.'">'.$button_name.'</button>
		<div id="myModal_'.$unique_id.'" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Modal Header</h4>
		</div>
		<div class="modal-body">
		'.$modal_html.'
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
		</div>';
		return $modal;
	}
}