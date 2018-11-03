<?php

$to = "info@contractormortgagesdirect.co.uk";
$subject = "New Mortgage Enquiry - ".$_REQUEST['name'];

$contentt=' Dear Team Member <br/> <br/> Please reach out to '.$_REQUEST['name'].' <br/> <br/> Wants a call back '.$_REQUEST['choosetime'].' <br/> <br/> Details of enquiry below, Please do your best, all enquiries need a follow up as soon as possible, all ways best to ensure you read the details below prior to calling. <br/><br/> ';
$contentt.=' <br/> Name : '.$_REQUEST['name'].' <br/><br/> Email :  '.$_REQUEST['eemail'].' <br/><br/> Telephone Number : '.$_REQUEST['telephone'].' <br/><br/> ';
if($_REQUEST['etype']!="Select Option"){
	$contentt.=' <strong>Additional Details: </strong>  <br/><br/> ';
	$contentt.='Enquiry Type : '.$_REQUEST['etype'].' <br/><br/>';
	if($_REQUEST['etype'] == "Life Insurance" || $_REQUEST['etype'] == "Mortgage Protection" || $_REQUEST['etype'] == "Income Protection" || $_REQUEST['etype'] == "RLP" || $_REQUEST['etype'] == "Family Income Benefit"){
		if($_REQUEST['covertype']!=""){
			$contentt.='Type of cover : '.$_REQUEST['covertype'].' <br/><br/>';
		}
		if($_REQUEST['criticali']!=""){
			$contentt.='With Critical Illness : '.$_REQUEST['criticali'].' <br/><br/>';
		}
		if($_REQUEST['premium']!=""){
			$contentt.='Premium : '.$_REQUEST['premium'].' <br/><br/>';
		}
		if($_REQUEST['coveramount']!=""){
			$contentt.='Amount of cover required : '.$_REQUEST['coveramount'].' <br/><br/>';
		}
		if($_REQUEST['noofyears']!=""){
			$contentt.='Number of years : '.$_REQUEST['noofyears'].' <br/><br/>';
		}
		if($_REQUEST['budget']!=""){
			$contentt.='Budget : '.$_REQUEST['budget'].' <br/><br/>';
		}
	}else{
		if($_REQUEST['crate']!=""){
			$contentt.='Contract Rate : '.$_REQUEST['crate'].' <br/><br/>';
		}
		if($_REQUEST['cratetype']!=""){
			$contentt.='Contract Rate Type : '.$_REQUEST['cratetype'].' <br/><br/>';
		}
		if($_REQUEST['clength']!=""){
			$contentt.='Length of Time Contracting : '.$_REQUEST['clength'].' <br/><br/>';
		}
		if($_REQUEST['gapsinOneYear']!=""){
			$contentt.='Any Gaps in last 12 months? : '.$_REQUEST['gapsinOneYear'].' <br/><br/>';
			if($_REQUEST['gapsinOneYear']=='yes'){
				$contentt.='How Long and When : '.$_REQUEST['howlong'].' <br/><br/>';
			}
		}
		if($_REQUEST['TimeLeft']!=""){
			$contentt.='Time Left in Current Contract : '.$_REQUEST['TimeLeft'].' <br/><br/>';
		}
		if($_REQUEST['industryworked']!=""){
			$contentt.='What industry do you work in? : '.$_REQUEST['industryworked'].' <br/><br/>';
		}
		if($_REQUEST['cThrough']!=""){
			$contentt.='Contracting through : '.$_REQUEST['cThrough'].' <br/><br/>';
		}
		if($_REQUEST['pprice']!=""){
			$contentt.='Purchase price : '.$_REQUEST['pprice'].' <br/><br/>';
		}
		if($_REQUEST['loanamount']!=""){
			$contentt.='Loan Amount : '.$_REQUEST['loanamount'].' <br/><br/>';
		}
		if($_REQUEST['clender']!=""){
			$contentt.='Current Lender : '.$_REQUEST['clender'].' <br/><br/>';
		}
		if($_REQUEST['outsbal']!=""){
			$contentt.='Outstanding Balance : '.$_REQUEST['outsbal'].' <br/><br/>';
		}
		if($_REQUEST['hLongIRF']!=""){
			$contentt.='Term of mortgage you would prefer? : '.$_REQUEST['hLongIRF'].' <br/><br/>';
		}
		if($_REQUEST['creditHistory']!=""){
			$contentt.='Credit Rating : '.$_REQUEST['creditHistory'].' <br/><br/>';
		}
		if($_REQUEST['whyPoor']!=""){
			$contentt.='Reason for Poor Rating : '.$_REQUEST['whyPoor'].' <br/><br/>';
		}
		if($_REQUEST['foundProperty']!=""){
			$contentt.='Have you found a property? : '.$_REQUEST['foundProperty'].' <br/><br/>';
		}
		
		if($_REQUEST['va-broker']!=""){
			$contentt.='Visited another broker? : '.$_REQUEST['va-broker'].' <br/><br/>';
			if($_REQUEST['va-broker']=='yes'){
				$contentt.='Why did you not proceed? : '.$_REQUEST['abReason'].' <br/><br/>';
			}
		}
		if($_REQUEST['hopingFromUs']!=""){
			$contentt.='What are you hoping for from us? : '.$_REQUEST['hopingFromUs'].' <br/><br/>';
		}
		if($_REQUEST['ForTM']!=""){
			$contentt.='Would you like a Fixed / Tracker mortgage? : '.$_REQUEST['ForTM'].' <br/><br/>';
		}
		if($_REQUEST['inirateFixed']!=""){
			$contentt.='How long do you want the initial rate to be fixed? : '.$_REQUEST['inirateFixed'].' <br/><br/>';
		}
		if($_REQUEST['impFeatures']!="") {
			$aDoor = $_REQUEST['impFeatures'];
			$N = count($aDoor);
			$contentt.='What Features are important to you?<br/>';
			for($i=0; $i < $N; $i++)
			{
			  $contentt.=$aDoor[$i].' <br/>';
			}
		}
	}
	if($_REQUEST['commentFinal']!=""){
		$contentt.='<br/>comments : '.$_REQUEST['commentFinal'].' <br/><br/>';
	}
	if($_REQUEST['choosetime']!=""){
		$contentt.='Choose a time to call : '.$_REQUEST['choosetime'].' <br/><br/>';
	}
}

$message='<html><head><title>Contractor Mortgages Direct</title></head><body><table border="0" cellpadding="0" cellspacing="0" align="center" style="width:100%;float:left;">  <tbody>    <tr>      <td style="background-color:#1d0d44;padding:10px;vertical-align:middle;text-align:center"><div style="float:left"><a href="http://www.contractormortgagesdirect.co.uk/index.html" target="_blank"><img align="left" src="http://www.contractormortgagesdirect.co.uk/images/cmd_logo.png"  width="200"  height="48"  style="max-width:200px;height:48px;width:200px;vertical-align:middle;padding-right:5px;" border="0"></a></div>        <div style="margin:0 10px;float:left;font-family:Arial;font-size:17px;float:left;margin-right:5px;" align="left"><a href="http://www.contractormortgagesdirect.co.uk/index.html" style="text-decoration:none;color:#ffffff;font-weight:bold;font-size:17px;" align="left" target="_blank"></a></div></td>    </tr><tr><td colspan="0" bgcolor="#ffffff" style="font-family:Arial,Helvetica,sans-serif;border-bottom:1px solid #cccccc;border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-top:1px solid #cccccc;font-size:12px;padding:10px" valign="top"> '.$contentt.' <br/> <td></tr><tr><td> <br/> Regards, <br/> Contractor Mortgages Direct. </td></tr> </tbody></table><body></html>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: <'.$_REQUEST['eemail'].'>' . "\r\n";
mail($to,$subject,$message,$headers); 

$sub2="Thank You For Your Enquiry - ".$_REQUEST['name'];
$contentt2=' Dear '.$_REQUEST['name'].' <br/> <br/> Thank you for your enquiry, We have received this and will call you as requested '.$_REQUEST['choosetime'].' . <br/> <br/> If you wish to speak to us sooner then please call us on 01923 927361. Details of your enquiry are below. <br/> <br/> We look forward to speaking with you really soon. <br/>';
$contentt2.=' <br/> Name : '.$_REQUEST['name'].' <br/><br/> Email :  '.$_REQUEST['eemail'].' <br/><br/> Telephone Number : '.$_REQUEST['telephone'].' <br/><br/> ';
if($_REQUEST['etype']!="Select Option"){
	$contentt2.=' <strong>Additional Details: </strong>  <br/><br/> ';
	$contentt2.='Enquiry Type : '.$_REQUEST['etype'].' <br/><br/>';
	if($_REQUEST['etype'] == "Life Insurance" || $_REQUEST['etype'] == "Mortgage Protection" || $_REQUEST['etype'] == "Income Protection" || $_REQUEST['etype'] == "RLP" || $_REQUEST['etype'] == "Family Income Benefit"){
		if($_REQUEST['covertype']!=""){
			$contentt2.='Type of cover : '.$_REQUEST['covertype'].' <br/><br/>';
		}
		if($_REQUEST['criticali']!=""){
			$contentt2.='With Critical Illness : '.$_REQUEST['criticali'].' <br/><br/>';
		}
		if($_REQUEST['premium']!=""){
			$contentt2.='Premium : '.$_REQUEST['premium'].' <br/><br/>';
		}
		if($_REQUEST['coveramount']!=""){
			$contentt2.='Amount of cover required : '.$_REQUEST['coveramount'].' <br/><br/>';
		}
		if($_REQUEST['noofyears']!=""){
			$contentt2.='Number of years : '.$_REQUEST['noofyears'].' <br/><br/>';
		}
		if($_REQUEST['budget']!=""){
			$contentt2.='Budget : '.$_REQUEST['budget'].' <br/><br/>';
		}
	}else{
		if($_REQUEST['crate']!=""){
			$contentt2.='Contract Rate : '.$_REQUEST['crate'].' <br/><br/>';
		}
		if($_REQUEST['cratetype']!=""){
			$contentt2.='Contract Rate Type : '.$_REQUEST['cratetype'].' <br/><br/>';
		}
		if($_REQUEST['clength']!=""){
			$contentt2.='Length of Time Contracting : '.$_REQUEST['clength'].' <br/><br/>';
		}
		if($_REQUEST['gapsinOneYear']!=""){
			$contentt2.='Any Gaps in last 12 months? : '.$_REQUEST['gapsinOneYear'].' <br/><br/>';
			if($_REQUEST['gapsinOneYear']=='yes'){
				$contentt2.='How Long and When : '.$_REQUEST['howlong'].' <br/><br/>';
			}
		}
		if($_REQUEST['TimeLeft']!=""){
			$contentt2.='Time Left in Current Contract : '.$_REQUEST['TimeLeft'].' <br/><br/>';
		}
		if($_REQUEST['industryworked']!=""){
			$contentt2.='What industry do you work in? : '.$_REQUEST['industryworked'].' <br/><br/>';
		}
		if($_REQUEST['cThrough']!=""){
			$contentt2.='Contracting through : '.$_REQUEST['cThrough'].' <br/><br/>';
		}
		if($_REQUEST['pprice']!=""){
			$contentt2.='Purchase Price : '.$_REQUEST['pprice'].' <br/><br/>';
		}
		if($_REQUEST['loanamount']!=""){
			$contentt2.='Loan Amount : '.$_REQUEST['loanamount'].' <br/><br/>';
		}
		if($_REQUEST['clender']!=""){
			$contentt2.='Current Lender : '.$_REQUEST['clender'].' <br/><br/>';
		}
		if($_REQUEST['outsbal']!=""){
			$contentt2.='Outstanding Balance : '.$_REQUEST['outsbal'].' <br/><br/>';
		}		
		if($_REQUEST['hLongIRF']!=""){
			$contentt2.='Term of mortgage you would prefer? : '.$_REQUEST['hLongIRF'].' <br/><br/>';
		}
		
		if($_REQUEST['creditHistory']!=""){
			$contentt2.='Credit Rating : '.$_REQUEST['creditHistory'].' <br/><br/>';
		}
		if($_REQUEST['whyPoor']!=""){
			$contentt2.='Reason for Poor Rating : '.$_REQUEST['whyPoor'].' <br/><br/>';
		}
		if($_REQUEST['foundProperty']!=""){
			$contentt2.='Have you found a property? : '.$_REQUEST['foundProperty'].' <br/><br/>';
		}
		if($_REQUEST['va-broker']!=""){
			$contentt2.='Visited another broker? : '.$_REQUEST['va-broker'].' <br/><br/>';
			if($_REQUEST['va-broker']=='yes'){
				$contentt2.='Why did you not proceed? : '.$_REQUEST['abReason'].' <br/><br/>';
			}
		}
		if($_REQUEST['hopingFromUs']!=""){
			$contentt2.='What are you hoping for from us? : '.$_REQUEST['hopingFromUs'].' <br/><br/>';
		}
		if($_REQUEST['ForTM']!=""){
			$contentt2.='Would you like a Fixed / Tracker mortgage? : '.$_REQUEST['ForTM'].' <br/><br/>';
		}
		if($_REQUEST['inirateFixed']!=""){
			$contentt2.='How long do you want the initial rate to be fixed? : '.$_REQUEST['inirateFixed'].' <br/><br/>';
		}
		if($_REQUEST['impFeatures']!="") {
			$aDoor = $_REQUEST['impFeatures'];
			$N = count($aDoor);
			$contentt2.='What Features are important to you?<br/>';
			for($i=0; $i < $N; $i++)
			{
			  $contentt2.=$aDoor[$i].' <br/>';
			}
		}
	}
	if($_REQUEST['commentFinal']!=""){
		$contentt2.='<br/>comments : '.$_REQUEST['commentFinal'].' <br/><br/>';
	}
	if($_REQUEST['choosetime']!=""){
		$contentt2.='Choose a time to call : '.$_REQUEST['choosetime'].' <br/><br/>';
	}
}
$msg2='<html><head><title>Contractor Mortgages Direct</title></head><body><table border="0" cellpadding="0" cellspacing="0" align="center" style="width:100%;float:left;">  <tbody>    <tr>      <td style="background-color:#1d0d44;padding:10px;vertical-align:middle;text-align:center"><div style="float:left"><a href="http://www.contractormortgagesdirect.co.uk/index.html" target="_blank"><img align="left" src="http://www.contractormortgagesdirect.co.uk/images/cmd_logo.png" width="200"  height="48" style="height:48px;width:200px;max-width:200px;vertical-align:middle;padding-right:5px;" border="0"></a></div>        <div style="margin:0 10px;float:left;font-family:Arial;font-size:17px;float:left;margin-right:5px;" align="left"><a href="http://www.contractormortgagesdirect.co.uk/index.html" style="text-decoration:none;color:#ffffff;font-weight:bold;font-size:17px;" align="left" target="_blank"></a></div></td>    </tr><tr><td colspan="0" bgcolor="#ffffff" style="font-family:Arial,Helvetica,sans-serif;border-bottom:1px solid #cccccc;border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-top:1px solid #cccccc;font-size:12px;padding:10px" valign="top"> '.$contentt2.' <br/> <td></tr><tr><td> <br/> Best Regards, <br/> <span style="font-size: 16px;font-weight: bold;font-family: calligraphy;"> Contractor Mortgages Direct.</span>  </td></tr> </tbody></table><body></html>';
$headers2 = "MIME-Version: 1.0" . "\r\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers2 .= 'From: <info@contractormortgagesdirect.co.uk>' . "\r\n";
mail($_REQUEST['eemail'],$sub2,$msg2,$headers2);
header("Location: http://www.contractormortgagesdirect.co.uk/thankyou.html"); /* Redirect browser */
exit();
?>