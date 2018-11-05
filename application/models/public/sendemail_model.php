<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sendemail_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function sendContactUsEmail($contact_id,$include_enquiry='no')
    {
        $this->db->select('subject, template', FALSE);
        $this->db->from('template');
        $this->db->where('id', 1);
        $emaildata = $this->db->get();
        if($emaildata->num_rows() > 0)
        {
            if($include_enquiry=='yes'){
                $this->db->join('tbl_enquiry as e','e.contact_id=c.id');
            }
            $contact_data = $this->db->get_where('contact_us as c',array('c.id'=>$contact_id));

            if ($contact_data->num_rows() > 0 ) {
                $contact_data = $contact_data->row_array();

                $emailarr = $emaildata->row_array();
                $message = $emailarr["template"];
                $message = str_ireplace("{LOGO}", "<img src='".LOGO."' style='width:200px;height:100px;'>", $message);
                $message = str_ireplace("{CUSTOMER_NAME}", $contact_data['name'], $message); 
                $message = str_ireplace("{CUSTOMER_EMAIL}", $contact_data['email_id'], $message); 
                $message = str_ireplace("{CUSTOMER_PHONE}", $contact_data['telephone_number'], $message);
                $message = str_ireplace("{CUSTOMER_CONTACT_TIME}", $contact_data['call_time'], $message);
                $message = str_ireplace("{CUSTOMER_REQUEST_TIME}", $contact_data['created_date'], $message);
                $message = str_ireplace("{MESSAGE}", $c_message, $message);


                $enquiry_table='';
                if (isset($contact_data['enquiry_type']) && $contact_data['enquiry_type']!='') {
                    switch ($contact_data['enquiry_type']) {
                        case '1':
                            $enquiry_title="First Time Buyer";
                            $display_case='1';
                            break;
                        case '2':
                            $enquiry_title="Next Time Buyer";
                            $display_case='1';
                            break;
                        case '3':
                            $enquiry_title="Home Mover";
                            $display_case='1';
                            break;
                        case '4':
                            $enquiry_title="Help to Buy";
                            $display_case='1';
                            break;
                        case '5':
                            $enquiry_title="Re-mortgage";
                            $display_case='2';
                            break;
                        case '6':
                            $enquiry_title="Buy To Let";
                            $display_case='3';
                            break;
                        case '7':
                            $enquiry_title="Life Insurance";
                            $display_case='4';
                            break;
                        case '8':
                            $enquiry_title="Mortgage Protection";
                            $display_case='4';
                            break;
                        case '9':
                            $enquiry_title="Income Protection";
                            $display_case='4';
                            break;
                        case '10':
                            $enquiry_title="RLP";
                            $display_case='4';
                            break;
                        case '11':
                            $enquiry_title="Family Income Benefit";
                            $display_case='4';
                            break;
                        
                        default:
                            $enquiry_title="-";
                            $display_case='1';
                            break;
                    }
    
                    $enquiry_table .= '<table style="width: 100%; font-family:verdana;font-size:13px;line-height:1.3em;text-align:left;"><tr style="text-align: center;"><td colspan="2" style="padding-bottom: 20px; font-size: 20px"><b>Enquiry Details</b></td></tr>';

                    $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Enquiry Type</th><td style="padding:5px;">'.$enquiry_title.'</td></tr>';

                    if (in_array($display_case,array('1','2','3','4','5','6'))) {
                        $contract_rate = (isset($contact_data['contract_rate']) && $contact_data['contract_rate']!='' && $contact_data['contract_rate']!=null) ? $contact_data['contract_rate'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Contract Rate</th><td style="padding:5px;">&#8356; '.$contract_rate.'</td></tr>';

                        $contract_type = (isset($contact_data['contract_type']) && $contact_data['contract_type']!='' && $contact_data['contract_type']!=null) ? $contact_data['contract_type'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Contract Type</th><td style="padding:5px;">'.$contract_type.'</td></tr>';

                        
                        $contract_length = (isset($contact_data['contract_length']) && $contact_data['contract_length']!='' && $contact_data['contract_length']!=null) ? $contact_data['contract_length'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Length of Time Contracting</th><td style="padding:5px;">'.$contract_length.'</td></tr>';

                        
                        $gapsinOneYear = (isset($contact_data['gapsinOneYear']) && $contact_data['gapsinOneYear']!='' && $contact_data['gapsinOneYear']!=null) ? $contact_data['gapsinOneYear'] : 'No';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Any Gaps in last 12 months? </th><td style="padding:5px;">'.$gapsinOneYear.'</td></tr>';
                        
                        if ($gapsinOneYear='Yes') {
                            $gapsDetails = (isset($contact_data['gapsDetails']) && $contact_data['gapsDetails']!='' && $contact_data['gapsDetails']!=null) ? $contact_data['gapsDetails'] : '-';
                            $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">How Long and When</th><td style="padding:5px;">'.$gapsDetails.'</td></tr>';
                        }
                        
                        $time_left = (isset($contact_data['time_left']) && $contact_data['time_left']!='' && $contact_data['time_left']!=null) ? $contact_data['time_left'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Time Left in Current Contract</th><td style="padding:5px;">'.$time_left.'</td></tr>';
                        
                        $industryworked = (isset($contact_data['industryworked']) && $contact_data['industryworked']!='' && $contact_data['industryworked']!=null) ? $contact_data['industryworked'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">What industry do you work in?</th><td style="padding:5px;">'.$industryworked.'</td></tr>';
                        
                        $contracting_through = (isset($contact_data['contracting_through']) && $contact_data['contracting_through']!='' && $contact_data['contracting_through']!=null) ? $contact_data['contracting_through'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Contracting through</th><td style="padding:5px;">'.$contracting_through.'</td></tr>';
                        
                        $purchase_price = (isset($contact_data['purchase_price']) && $contact_data['purchase_price']!='' && $contact_data['purchase_price']!=null) ? $contact_data['purchase_price'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">'.($contact_data['enquiry_type']=='5' ? "Property Price" : "Purchase Price").'</th><td style="padding:5px;">'.$purchase_price.'</td></tr>';
                        
                        $loan_amount = (isset($contact_data['loan_amount']) && $contact_data['loan_amount']!='' && $contact_data['loan_amount']!=null) ? $contact_data['loan_amount'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Loan Amount</th><td style="padding:5px;">&#8356; '.$loan_amount.'</td></tr>';
                        
                        $allowed_array = array('5','6');
                        if (in_array($display_case,$allowed_array)) {
                            $current_lender = (isset($contact_data['current_lender']) && $contact_data['current_lender']!='' && $contact_data['current_lender']!=null) ? $contact_data['current_lender'] : '-';
                            $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Current Lender</th><td style="padding:5px;">'.$current_lender.'</td></tr>';
                            
                            $outstanding_balance = (isset($contact_data['outstanding_balance']) && $contact_data['outstanding_balance']!='' && $contact_data['outstanding_balance']!=null) ? $contact_data['outstanding_balance'] : '-';
                            $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Outstanding Balance</th><td style="padding:5px;">'.$outstanding_balance.'</td></tr>';
                            
                            if ($display_case=='6') {
                                $rent_acheivable = (isset($contact_data['rent_acheivable']) && $contact_data['rent_acheivable']!='' && $contact_data['rent_acheivable']!=null) ? $contact_data['rent_acheivable'] : '-';
                                $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Rent Acheivable</th><td style="padding:5px;">'.$rent_acheivable.'</td></tr>';
                            }
                        }
                        
                        $term_of_mortage = (isset($contact_data['term_of_mortage']) && $contact_data['term_of_mortage']!='' && $contact_data['term_of_mortage']!=null) ? $contact_data['term_of_mortage'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Term of mortgage you would prefer?</th><td style="padding:5px;">'.$term_of_mortage.'</td></tr>';
                        
                        $credit_rating = (isset($contact_data['credit_rating']) && $contact_data['credit_rating']!='' && $contact_data['credit_rating']!=null) ? $contact_data['credit_rating'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Credit Rating</th><td style="padding:5px;">'.$credit_rating.'</td></tr>';
                        
                        if ($credit_rating=='Poor') {
                            $poor_reason = (isset($contact_data['poor_reason']) && $contact_data['poor_reason']!='' && $contact_data['poor_reason']!=null) ? $contact_data['poor_reason'] : '-';
                            $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Why Poor Credit?</th><td style="padding:5px;">'.$poor_reason.'</td></tr>';
                        }
                        
                        $visited_broker = (isset($contact_data['visited_broker']) && $contact_data['visited_broker']!='' && $contact_data['visited_broker']!=null) ? $contact_data['visited_broker'] : 'No';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Visited another broker?</th><td style="padding:5px;">'.$visited_broker.'</td></tr>';
                        
                        if ($visited_broker=='Yes') {
                            $visited_broker_reason = (isset($contact_data['visited_broker_reason']) && $contact_data['visited_broker_reason']!='' && $contact_data['visited_broker_reason']!=null) ? $contact_data['visited_broker_reason'] : '-';
                            $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Why did you not proceed?</th><td style="padding:5px;">'.$visited_broker_reason.'</td></tr>';
                        }
                        
                        $hopingFromUs = (isset($contact_data['hopingFromUs']) && $contact_data['hopingFromUs']!='' && $contact_data['hopingFromUs']!=null) ? $contact_data['hopingFromUs'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">What are you hoping for from us?</th><td style="padding:5px;">'.$hopingFromUs.'</td></tr>';
                        
                        $mortage_type = (isset($contact_data['mortage_type']) && $contact_data['mortage_type']!='' && $contact_data['mortage_type']!=null) ? $contact_data['mortage_type'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Would you like a Fixed / Tracker mortgage?</th><td style="padding:5px;">'.$mortage_type.'</td></tr>';
                        
                        $length_initial_rate_fixed = (isset($contact_data['length_initial_rate_fixed']) && $contact_data['length_initial_rate_fixed']!='' && $contact_data['length_initial_rate_fixed']!=null) ? $contact_data['length_initial_rate_fixed'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">How long do you want the initial rate to be fixed?</th><td style="padding:5px;">'.$length_initial_rate_fixed.'</td></tr>';
                        
                        $important_feature = explode(',',$contact_data['important_feature']);
                        $important_feature_list='';
                        foreach ($important_feature as $key => $value) {
                            switch ($value) {
                                case '1':
                                    $important_feature_list .= '<li>Offset your savings against the Mortgage?</li>';
                                    break;
                                case '2':
                                    $important_feature_list .= '<li>No ERC overhang after the initial period</li>';
                                    break;
                                case '3':
                                    $important_feature_list .= '<li>No Early Repayment Charge</li>';
                                    break;
                                case '4':
                                    $important_feature_list .= '<li>Ability to Overpay</li>';
                                    break;
                                case '5':
                                    $important_feature_list .= '<li>Ability to Underpay</li>';
                                    break;
                                case '6':
                                    $important_feature_list .= '<li>Take repayment holidays</li>';
                                    break;
                                case '7':
                                    $important_feature_list .= '<li>Free legal’s</li>';
                                    break;
                                case '8':
                                    $important_feature_list .= '<li>Free Valuation</li>';
                                    break;
                                default:
                                    $important_feature_list .= '-';
                                    break;
                            }
                        }

                        if (!empty($important_feature)) {
                            $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">What Features are important to you?</th><td><ul>'.$important_feature_list.'</ul></td></tr>';
                        }
                    }
                    else
                    {
                        $covertype = (isset($contact_data['covertype']) && $contact_data['covertype']!='' && $contact_data['covertype']!=null) ? $contact_data['covertype'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Type of cover</th><td style="padding:5px;">'.$covertype.'</td></tr>';
                        
                        $critical_illness = (isset($contact_data['critical_illness']) && $contact_data['critical_illness']!='' && $contact_data['critical_illness']!=null) ? $contact_data['critical_illness'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">With Critical Illness</th><td style="padding:5px;">'.$critical_illness.'</td></tr>';
                        
                        $premium = (isset($contact_data['premium']) && $contact_data['premium']!='' && $contact_data['premium']!=null) ? $contact_data['premium'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Premium</th><td style="padding:5px;">'.$premium.'</td></tr>';
                        
                        $coveramount = (isset($contact_data['coveramount']) && $contact_data['coveramount']!='' && $contact_data['coveramount']!=null) ? $contact_data['coveramount'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Amount of cover required</th><td style="padding:5px;">'.$coveramount.'</td></tr>';
                        
                        $noofyears = (isset($contact_data['noofyears']) && $contact_data['noofyears']!='' && $contact_data['noofyears']!=null) ? $contact_data['noofyears'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">number of years</th><td style="padding:5px;">'.$noofyears.'</td></tr>';
                        
                        $budget = (isset($contact_data['budget']) && $contact_data['budget']!='' && $contact_data['budget']!=null) ? $contact_data['budget'] : '-';
                        $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Budget</th><td style="padding:5px;">'.$budget.'</td></tr>';
                    }

                    $comment = (isset($contact_data['comment']) && $contact_data['comment']!='' && $contact_data['comment']!=null) ? $contact_data['comment'] : '-';
                    $enquiry_table .= '<tr style="background: rgba(0,0,0,0.1);"><th style="padding:5px;width:50%;">Comments</th><td style="padding:5px;">'.$comment.'</td></tr>';

                    $enquiry_table .= '</table>';
                }

                $message = str_ireplace("{ENQUIRY_TABLE}", $enquiry_table, $message);

                $finalmsg = $message;
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
                // echo $finalmsg;
                // die();
                $this->load->library('email',$config);
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $this->email->from("noreply@contractor.com", "Contractor Mortgages");
                $this->email->to(ADMIN_EMAIL);
                $this->email->subject("User Query");
                $this->email->message($finalmsg);
                $final = $this->email->send();
                return $final;
            }
        }
    }
}