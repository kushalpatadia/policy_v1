<?php
$to = "mani.busyfriends@gmail.com";
$subject = "Enquiry : Contractor Mortgages Direct";
print "<pre>";print_r($_REQUEST);exit;
$contentt=' tbm';
$message='<html><head><title>Contractor Mortgages Direct</title></head><body><table border="0" cellpadding="0" cellspacing="0" align="center" style="width:100%;float:left;">  <tbody>    <tr>      <td style="background-color:#1d0d44;padding:10px;vertical-align:middle;text-align:center"><div style="float:left"><a href="http://www.contractormortgagesdirect.co.uk/index.html" target="_blank"><img align="left" src="http://www.contractormortgagesdirect.co.uk/images/cmd_logo.png" style="max-width:200px;vertical-align:middle;padding-right:5px;" border="0"></a></div>        <div style="margin:0 10px;float:left;font-family:Arial;font-size:17px;float:left;margin-right:5px;" align="left"><a href="http://www.contractormortgagesdirect.co.uk/index.html" style="text-decoration:none;color:#ffffff;font-weight:bold;font-size:17px;" align="left" target="_blank"></a></div></td>    </tr><tr><td colspan="0" bgcolor="#ffffff" style="font-family:Arial,Helvetica,sans-serif;border-bottom:1px solid #cccccc;border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-top:1px solid #cccccc;font-size:12px;padding:10px" valign="top"> '.$contentt.' <br/> <td></tr> </tbody></table><body></html>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: <mani.busyfriends@gmail.com>' . "\r\n";
mail($to,$subject,$message,$headers); 
?>
<script type="text/javascript">
 alert("Thank you for your interest and we will get back to you soon");
 window.location.href="http://www.contractormortgagesdirect.co.uk/index.html";
</script>