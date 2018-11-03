<?php
$admin = $this->session->userdata('admin_session'); 
?>
<div id="sidebar-wrapper" class="collapse sidebar-collapse">
  <div id="search">
   <form>
    <input class="form-control input-sm" name="search" placeholder="Search..." type="text">
    <button type="submit" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
   </form>
  </div>
  <!-- #search -->
  
  <nav id="sidebar">
   <ul id="main-nav" class="open-active">
    <li> <a href="index.html"> <i class="fa fa-dashboard"></i> Dashboard </a> </li>
    <li class="dropdown"> <a href="javascript:;"> <i class="fa fa-file-text"></i><span class="caret"></span> </a>
     <ul class="sub-nav">
      <li> <a href="#"> <i class="fa fa-user"></i> Profile </a> </li>
      <li> <a href="#"> <i class="fa fa-money"></i> Invoice </a> </li>
      <li> <a href="#"> <i class="fa fa-dollar"></i> Pricing Plans </a> </li>
     </ul>
    </li>
    <li <?php if($this->uri->segment(2)=='team'){?> class="active" <?php } ?>><a href="<?=base_url('admin/team');?>"> <i class="fa fa-phone-square"></i>Team Management</a> </li>
	
    <li <?php if($this->uri->segment(2)=='contact'){?> class="active" <?php } ?>><a href="<?=base_url('admin/contact');?>"> <i class="fa fa-phone-square"></i>Contacts</a> </li>
    <li class="dropdown"><a href="dummy.html"> <i class="fa fa-table"></i>Calender </a> </li>
    <li> <a href="#"><i class="fa fa-list-alt"></i> Lead Capturing </a> </li>
    <li class="dropdown"><a href="#"> <i class="fa fa-file-text-o"></i>Task</a> </li>
    <li class="dropdown"><a href="#"> <i class="fa fa-file-text-o"></i>Transaction</a> </li>
    <li class="dropdown"><a href="#"> <i class="fa fa-file-text-o"></i>Marketing Master Library</a> </li>
    <li class="dropdown"><a href="#"> <i class="fa fa-file-text-o"></i>Social Media</a> </li>
    <li class="dropdown"><a href="javascript:void(0);" onclick="logout();"><i class="fa fa-file-text-o"></i><span>Logout</span></a>
   </ul>
  </nav>
  <!-- #sidebar --> 
  
 </div>
 <!-- /#sidebar-wrapper -->
 <script>
 function logout()
	{
		$.confirm({
		'title': 'Logout','message': " <strong> Are you sure want to logout?",'buttons': {'Yes': {'class': 'special',
		'action': function(){
		<? if(!empty($admin['id'])){ ?>
				window.location="<?= base_url('admin/logout') ?>";
				<? }?>
				
		}},'No'	: {'class'	: ''}}});
	}
 </script>