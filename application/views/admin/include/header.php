<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=""><!--<![endif]-->

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Contractor Mortages - Admin</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>css.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>runtime.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>font-awesome.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>bootstrap.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>jquery-ui-1.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>blue.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>select2.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>fullcalendar.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>App.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>buttons.css" type="text/css">
<link rel="stylesheet" href="<?=$this->config->item('css_path')?>jquery.datetimepicker.css" type="text/css">
<!-- Logout confirm -->
<link rel="stylesheet" type="text/css" href="<?=$this->config->item('css_path')?>jquery.confirm.css"/>

<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery.datetimepicker.js"></script>
<script src="<?=$this->config->item('js_path')?>jquery.blockUI.js" type="text/javascript"></script>
<!--confirm box css-->
<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery.confirm.js"></script> 
<script type="text/javascript" src="<?=$this->config->item('js_path')?>common.js"></script>
<script type="text/javascript" src="<?=$this->config->item('ck_editor_path')?>ckeditor.js"></script>
<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery.maskedinput.js"></script>

</head>

<body>
<div id="wrapper">
  <h1 id="site-logo">
		<img alt="Simcom App" style="height: 75px;
    margin-bottom: 16px;
    margin-left: 15px;
    margin-top: -21px;
    width: 200px;" src="<?php echo $this->config->item('base_url')?>images/logo.jpg">
	</h1>
 <header id="header"> <a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed"> <i class="fa fa-cog"></i> </a> <a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed"> <i class="fa fa-reorder"></i> </a> </header>
 <!-- header -->
 
 <nav id="top-bar" class="collapse top-bar-collapse">
  <ul class="nav navbar-nav pull-left">
   <li class="">  </li>
   <!--<li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"> Dropdown <span class="caret"></span> </a>
    <ul class="dropdown-menu" role="menu">
     <li><a href="javascript:;"><i class="fa fa-user"></i>&nbsp;&nbsp;Example #1</a></li>
     <li><a href="javascript:;"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Example #2</a></li>
     <li class="divider"></li>
     <li><a href="javascript:;"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Example #3</a></li>
    </ul>
   </li>-->
  </ul>
  <ul class="nav navbar-nav pull-right">
   <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"> <i class="fa fa-user"></i> 
   <?php
   $SessionData = $this->session->userdata('admin_session');

	//echo "<pre>"; print_r($SessionData); exit; 
	 if(!empty($SessionData['name'])){ 
	  $name=$SessionData['name'];
	  $email=$SessionData['useremail'];
	 echo $name; 
	//  echo $email;
	 }?> <span class="caret"></span> </a>
    <ul class="dropdown-menu" role="menu">
     <li><a href="javascript:void(0);" onClick="logout();"> <i class="fa fa-sign-out"></i> &nbsp;&nbsp;Logout </a> </li>
    </ul>
   </li>
  </ul>
 </nav>
 <!-- /#top-bar -->

