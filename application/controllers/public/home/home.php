<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->viewName = $this->router->fetch_class();
    }

    public function index() 
    {
    	$data['main_content'] = "public/home/".$this->viewName;
    	$this->load->view('public/include/template', $data);
    }

    public function submitContactus(){

        $this->load->model('public/sendemail_model');
        $this->sendemail_model->sendContactUsEmail(6,'no');
    	$this->form_validation->set_rules('name','Name','required|alpha|trim');
    	$this->form_validation->set_rules('telephone','Telephone Number','required|numeric|trim');
    	$this->form_validation->set_rules('email','Email Address','required|valid_email|trim');
        // pr($_POST);
        // exit;

    	if($this->form_validation->run() ){//if validation passes
    		//Success

    		$objContactUs = new stdClass();

    		$objContactUs->name=$this->input->post('name');
    		$objContactUs->telephone_number=$this->input->post('telephone');
    		$objContactUs->email_id=$this->input->post('email');
    		$objContactUs->call_time=$this->input->post('call_time');
    		$objContactUs->created_date=currentdatetime();

            //for enquiry details
            $objEnquiry = new stdClass();
            $objEnquiry->important_feature=implode(',',$this->input->post('impFeatures'));
            $objEnquiry->enquiry_type=$this->input->post('etype');
            $objEnquiry->covertype=$this->input->post('covertype');
            $objEnquiry->critical_illness=$this->input->post('criticali');
            $objEnquiry->premium=$this->input->post('premium');
            $objEnquiry->coveramount=$this->input->post('coveramount');
            $objEnquiry->noofyears=$this->input->post('noofyears');
            $objEnquiry->budget=$this->input->post('budget');
            $objEnquiry->contract_rate=$this->input->post('crate');
            $objEnquiry->contract_type=$this->input->post('cratetype');
            $objEnquiry->contract_length=$this->input->post('clength');
            $objEnquiry->gapsinOneYear=$this->input->post('gapsinOneYear');
            $objEnquiry->time_left=$this->input->post('TimeLeft');
            $objEnquiry->industryworked=$this->input->post('industryworked');
            $objEnquiry->contracting_through=$this->input->post('cThrough');
            $objEnquiry->purchase_price=$this->input->post('pprice');
            $objEnquiry->loan_amount=$this->input->post('loanamount');
            $objEnquiry->current_lender=$this->input->post('clender');
            $objEnquiry->outstanding_balance=$this->input->post('outsbal');
            $objEnquiry->rent_acheivable=$this->input->post('rentAcble');
            $objEnquiry->term_of_mortage=$this->input->post('term_of_mortage');
            $objEnquiry->credit_rating=$this->input->post('credit_rating');
            $objEnquiry->poor_reason=$this->input->post('whyPoor');
            $objEnquiry->visited_broker=$this->input->post('va-broker');
            $objEnquiry->visited_broker_reason=$this->input->post('visited_broker_reason');
            $objEnquiry->hopingFromUs=$this->input->post('hopingFromUs');
            $objEnquiry->mortage_type=$this->input->post('mortage_type');
            $objEnquiry->length_initial_rate_fixed=$this->input->post('inirateFixed');
            $objEnquiry->comment=$this->input->post('comment');

    		$contactUsArr = (array) $objContactUs;
    		$this->load->model('public/home_model','contact_us');
            $lastContactId = $this->contact_us->insert_record('contact_us',$contactUsArr);
            $include_enquiry = 'no';
            
            if(!empty($objEnquiry->enquiry_type) && isset($objEnquiry->enquiry_type)){
                $objEnquiry->contact_id = $lastContactId;
                $objEnquiryArr = (array) $objEnquiry;
                $lastenquiryId = $this->contact_us->insert_record('tbl_enquiry',$objEnquiryArr);
                $include_enquiry = 'yes';
            }
            $this->sendemail_model->sendContactUsEmail($lastContactId,$include_enquiry);
    		if($lastContactId){
    			 redirect('thankyou/');
    		}

		}else{
			//Fail
			$data['main_content'] = "public/home/".$this->viewName;
			$this->load->view('public/include/template',$data);
		}
    }
    
}
