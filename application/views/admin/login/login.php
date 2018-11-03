<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html xmlns="http://www.w3.org/1999/xhtml" class="ie ie6"> <![endif]-->
<!--[if IE 7 ]>    <html xmlns="http://www.w3.org/1999/xhtml" class="ie ie7"> <![endif]-->
<!--[if IE 8 ]>    <html xmlns="http://www.w3.org/1999/xhtml" class="ie ie8"> <![endif]-->
<!--[if IE 9 ]>    <html xmlns="http://www.w3.org/1999/xhtml" class="ie ie9"> <![endif]-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="keyword"/>
<meta name="Description" content="discription"/>
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery-1.9.1.js"></script>
<script src="<?=$this->config->item('js_path')?>jquery.blockUI.js" type="text/javascript"></script>
<!--confirm box css-->
<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery.confirm.js"></script> 
<script type="text/javascript" src="<?=$this->config->item('js_path')?>common.js"></script>
<script src="<?=$this->config->item('js_path')?>bootstrap.js"></script> 
<script src="<?=$this->config->item('js_path')?>App.js"></script> 
<script src="<?=$this->config->item('js_path')?>parsley.js"></script> 
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>css.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>runtime.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>font-awesome.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>bootstrap.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>App.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>buttons.css" type="text/css">

<?php

if(isset($_COOKIE['adminsiteAuth']))
{
$StringArray = explode( '&', $_COOKIE['adminsiteAuth'] );

$usernamestring = $StringArray[0];
$passwordstring = $StringArray[1];

$usernamefinal = explode( '=', $usernamestring );
$username = $usernamefinal[1];
 
$passwordfinal = explode( '=', $passwordstring );
$password = $passwordfinal[1];

}
else{$username='';$password='';}
?>
</head>

<body class="login">


<div id="wrapper">
 <div id="login-container">
  <div id="login">
   <div id="logo"> <img alt="Simcom App" style="margin-left: -12px;
    margin-top: -21px;
    width: 164px;" src="<?php echo $this->config->item('base_url')?>images/logo.jpg"> </div>
   <h3>Welcome to Simcom App Admin.</h3>
   <h5>Please sign in to get access.</h5>
   
   <?php if(!empty($msg)){?>
					<div class="col-sm-12 text-center" id="div_msg"><?php echo '<label class="error-list-color">'.urldecode ($msg).'</label>';
					$newdata = array('msg'  => '');
					$this->session->set_userdata('message_session', $newdata);?> </div><?php } ?>

   
   <!-- /.row --> 
   
   <!--<span class="text-muted">OR, SIGN IN BELOW</span>-->
   
   <form class="form parsley-form" id="login-form" method="post" action="" novalidate>
    <div class="form-group">
     <label for="login-username">Username</label>
     <!--<input type="text" placeholder="Username" id="login-username" class="form-control">-->
	 <input id="email" value="<?php if(isset($username)){  echo $username; }?>"  placeholder="Username" autofocus type="email" name="email" class="form-control parsley-validated" data-required="true">
    </div>
    <div class="form-group">
     <label for="login-password">Password</label>
     <!--<input type="password" placeholder="Password" id="login-password" class="form-control">-->
	 <input id="password" value="<?php if(isset($password)){  echo $password; }?>"  placeholder="Password" data-bvalidator="required"  type="password" name="password" class="form-control" data-required="true">
    </div>
    <div class="form-group">
     <button class="btn btn-primary btn-block" id="login-btn" type="submit">Sign in &nbsp; <i class="fa fa-play-circle"></i></button>
    </div>
   </form>
   
   
   
   <!-- <a class="btn btn-default" href="javascript:;" onClick="hide_show();">Forgot Password?</a> </div> -->
  <!-- /#login-form --> 
  
   </div>
  
  <div id="login-container" class="forgot" style="display:none;">
  <div id="login">
   <div id="logo"> <h1>Admin<h1> </div>
   <h3>Forgot Password?</h3>
  <form class="form parsley-form" id="login-form12" method="post" action="" novalidate >
    <div class="form-group text-left">
    <input id="email" value="<?php if(isset($email)){  echo $email; }?>"  placeholder="Email" autofocus type="email" name="forgot_email" class="form-control parsley-validated" data-required="true">
    </div>
    <div class="form-group">
     <button class="btn btn-primary btn-block" id="login-btn" type="submit">Submit &nbsp; <i class="fa fa-play-circle"></i></button>
	 
    </div>
	
   </form>
   <a class="btn btn-default" href="javascript:;" onClick="show();">Back To Login</a> </div>
  
</div>

</body>
</html>
<script>
	function hide_show()
    {
		$('#login-container').hide(); 
        $('.forgot').show();        
    }
	function show()
    {
		$('#login-container').show();  
        $('.forgot').hide();       
    }
	
    $(document).ready(function(){
	 $("#div_msg").fadeOut(4000); 
    });

</script>