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
            $important_feature = array();
            foreach ($this->input->post('impFeatures') as $key => $value) {
                switch ($value) {
                    case 'Offset your savings against the Mortgage?':
                        $important_feature[] = 1;
                        break;
                    case 'No ERC overhang after the initial period':
                        $important_feature[] = 2;
                        break;
                    case 'No Early Repayment Charge':
                        $important_feature[] = 3;
                        break;
                    case 'Ability to Overpay':
                        $important_feature[] = 4;
                        break;
                    case 'Ability to Underpay':
                        $important_feature[] = 5;
                        break;
                    case 'Take repayment holidays':
                        $important_feature[] = 6;
                        break;
                    case 'Free legal’s':
                        $important_feature[] = 7;
                        break;
                    case 'Free Valuation':
                        $important_feature[] = 8;
                        break;
                    default:
                        break;
                }
            }
            $important_feature = (!empty($important_feature)) ? implode(',',$important_feature) : NULL;
            switch ($this->input->post('etype')) {
                case 'First Time Buyer':
                    $enquiry_type = '1';
                    break;
                case 'Next Time Buyer':
                    $enquiry_type = '2';
                    break;
                case 'Home-mover':
                    $enquiry_type = '3';
                    break;
                case 'Help to Buy':
                    $enquiry_type = '4';
                    break;
                case 'Re-mortgage':
                    $enquiry_type = '5';
                    break;
                case 'Buy To Let':
                    $enquiry_type = '6';
                    break;
                case 'Life Insurance':
                    $enquiry_type = '7';
                    break;
                case 'Mortgage Protection':
                    $enquiry_type = '8';
                    break;
                case 'Income Protection':
                    $enquiry_type = '9';
                    break;
                case 'RLP':
                    $enquiry_type = '10';
                    break;
                case 'Family Income Benefit':
                    $enquiry_type = '11';
                    break;
                default:
                    $enquiry_type = NULL;
                    break;
            }
            $covertype=($this->input->post('covertype')!='' ? $this->input->post('covertype') : NULL);
            $critical_illness=($this->input->post('criticali')!=''? ($this->input->post('criticali')=='y' ? 'Yes':'No') : NULL);
            $premium=($this->input->post('premium')!='' ? $this->input->post('premium') : NULL);
            $coveramount=($this->input->post('coveramount')!='' ? $this->input->post('coveramount') : NULL);
            $noofyears=($this->input->post('noofyears')!='' ? $this->input->post('noofyears') : NULL);
            $budget=($this->input->post('budget')!='' ? $this->input->post('budget') : NULL);
            $contract_rate=($this->input->post('crate')!='' ? $this->input->post('crate') : NULL);
            $contract_type=($this->input->post('cratetype')!='' ? $this->input->post('cratetype') : NULL);
            $contract_length=($this->input->post('clength')!='' ? $this->input->post('clength') : NULL);
            $gapsinOneYear=($this->input->post('gapsinOneYear')!='' ? ($this->input->post('gapsinOneYear')=='y' ? 'Yes' : 'No') : NULL);
            $time_left=($this->input->post('TimeLeft')!='' ? $this->input->post('TimeLeft') : NULL);
            $industryworked=($this->input->post('industryworked')!='' ? $this->input->post('industryworked') : NULL);
            $contracting_through=($this->input->post('cThrough')!='' ? $this->input->post('cThrough') : NULL);
            $purchase_price=($this->input->post('pprice')!='' ? $this->input->post('pprice') : NULL);
            $loan_amount=($this->input->post('loanamount')!='' ? $this->input->post('loanamount') : NULL);
            $current_lender=($this->input->post('clender')!='' ? $this->input->post('clender') : NULL);
            $outstanding_balance=($this->input->post('outsbal')!='' ? $this->input->post('outsbal') : NULL);
            $rent_acheivable=($this->input->post('rentAcble')!='' ? $this->input->post('rentAcble') : NULL);
            $term_of_mortage=($this->input->post('term_of_mortage')!='' ? $this->input->post('term_of_mortage') : NULL);
            $credit_rating=($this->input->post('credit_rating')!='' ? $this->input->post('credit_rating') : NULL);
            $poor_reason=($this->input->post('whyPoor')!='' ? $this->input->post('whyPoor') : NULL);
            $visited_broker=($this->input->post('va-broker')!='' ? ($this->input->post('va-broker')=='y'?'Yes':'No') : NULL);
            $visited_broker_reason=($this->input->post('visited_broker_reason')!='' ? $this->input->post('visited_broker_reason') : NULL);
            $hopingFromUs=($this->input->post('hopingFromUs')!='' ? $this->input->post('hopingFromUs') : NULL);
            $mortage_type=($this->input->post('mortage_type')!='' ? $this->input->post('mortage_type') : NULL);
            $length_initial_rate_fixed=($this->input->post('inirateFixed')!='' ? $this->input->post('inirateFixed') : NULL);
            $comment=($this->input->post('comment')!='' ? $this->input->post('comment') : NULL);

            $enquiry_data_array = array(
                "important_feature"         =>  $important_feature,
                "enquiry_type"              =>  $enquiry_type,
                "covertype"                 =>  $covertype,
                "critical_illness"          =>  $critical_illness,
                "premium"                   =>  $premium,
                "coveramount"               =>  $coveramount,
                "noofyears"                 =>  $noofyears,
                "budget"                    =>  $budget,
                "contract_rate"             =>  $contract_rate,
                "contract_type"             =>  $contract_type,
                "contract_length"           =>  $contract_length,
                "gapsinOneYear"             =>  $gapsinOneYear,
                "time_left"                 =>  $time_left,
                "industryworked"            =>  $industryworked,
                "contracting_through"       =>  $contracting_through,
                "purchase_price"            =>  $purchase_price,
                "loan_amount"               =>  $loan_amount,
                "current_lender"            =>  $current_lender,
                "outstanding_balance"       =>  $outstanding_balance,
                "rent_acheivable"           =>  $rent_acheivable,
                "term_of_mortage"           =>  $term_of_mortage,
                "credit_rating"             =>  $credit_rating,
                "poor_reason"               =>  $poor_reason,
                "visited_broker"            =>  $visited_broker,
                "visited_broker_reason"     =>  $visited_broker_reason,
                "hopingFromUs"              =>  $hopingFromUs,
                "mortage_type"              =>  $mortage_type,
                "length_initial_rate_fixed" =>  $length_initial_rate_fixed,
                "comment"                   =>  $comment,
            );

    		$contactUsArr = (array) $objContactUs;
            $this->load->model('public/home_model','contact_us');
            $lastContactId = $this->contact_us->insert_record('contact_us',$contactUsArr);
            $include_enquiry = 'no';
            
            if($enquiry_type!='' && $enquiry_type!=NULL){
                $enquiry_data_array['contact_id'] = $lastContactId;
                $lastenquiryId = $this->contact_us->insert_record('tbl_enquiry',$enquiry_data_array);
                $include_enquiry = 'yes';
            }
            $this->load->model('public/sendemail_model');
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
