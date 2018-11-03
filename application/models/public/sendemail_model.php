<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sendemail_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function sendContactUsEmail($contact_id,$include_enquiry='no')
    {
        define('LOGO','http://localhost/policy_v1/images/logo.jpg');
        define('SMTP_EMAIL','katto.kp@gmail.com');
        define('SMTP_PASS','kushalkatto1');
        define('TO_EMAIL','kushalpatadia@gmail.com');

        $this->db->select('subject, template', FALSE);
        $this->db->from('template');
        $this->db->where('id', 1);
        $emaildata = $this->db->get();
        if($emaildata->num_rows() > 0)
        {
            if($include_enquiry=='yes'){
                $this->db->join('tbl_enquiry as e','e.contact_id=c.id');
            }
            $contact_data = $this->db->get_where('contact_us as c',array('id'=>$contact_id));

            if ($contact_data->num_rows() > 0 ) {
                $contact_data = $contact_data->row_array();

                $emailarr = $emaildata->row_array();
                $message = $emailarr["template"];
                $message = str_ireplace("{LOGO}", "<img src='".LOGO."' style='width:200px;height:100px;'>", $message);
                $message = str_ireplace("{CUSTOMER_NAME}", $contact_data['name'], $message); 
                $message = str_ireplace("{CUSTOMER_EMAIL}", $contact_data['email_id'], $message); 
                $message = str_ireplace("{CUSTOMER_PHONE}", $contact_data['telephone_number'], $message);
                $message = str_ireplace("{CUSTOMER_CONTACT_TIME}", $contact_data['call_time'], $message);
                $message = str_ireplace("{MESSAGE}", $c_message, $message);
                
                $finalmsg = '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr style="background:#000000;"><td valign="top" align="left" style="font-family:verdana;font-size:16px;line-height:1.3em;text-align:left;padding:15px"><table  width="100%"><tr style="background:#FFF;border-radius:5px;"><td style="font-family:verdana;font-size:13px;line-height:1.3em;text-align:left;padding:15px;">';
                $finalmsg .= $message;
                $finalmsg .= '</td></tr></table></td></tr></tbody></table>';
    
                if ($_SERVER['HTTP_HOST']=='localhost') {
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => SMTP_EMAIL, // change it to yours
                        'smtp_pass' => SMTP_PASS, // change it to yours
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => TRUE
                    );
                }
                else
                {
                    $config = Array(
                        'mailtype'  => 'html', 
                        'charset'   => 'iso-8859-1'
                    );
                }
    echo $finalmsg;
    die();
                $this->load->library('email',$config);
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $this->email->from("noreply@contractor.com", "Contractor Mortgages");
                $this->email->to(TO_EMAIL);
                $this->email->subject("User Query");
                $this->email->message($finalmsg);
                $final = $this->email->send();
                return $final;
            }
        }
    }
}