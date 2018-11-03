<?php
$admin = $this->session->userdata('admin_session'); 
if($this->uri->segment(2)!= 'admin_management')
{
	$this->session->unset_userdata('admin_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'contact_us')
{
	$this->session->unset_userdata('contact_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'product_management')
{
	$this->session->unset_userdata('product_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'category_management')
{
	$this->session->unset_userdata('category_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'slider_management')
{
	$this->session->unset_userdata('slider_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'shop_management')
{
	$this->session->unset_userdata('shop_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'sale_management')
{
	$this->session->unset_userdata('sale_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'subcategory_management')
{
	$this->session->unset_userdata('subcategory_sortsearchpage_data');
}
?>

<div id="sidebar-wrapper" class="collapse sidebar-collapse">
  <div id="search"> 
    <!--
   <form>
    <input class="form-control input-sm" name="search" placeholder="Search..." type="text">
    <button type="submit" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
   </form>--> 
  </div>
  <!-- #search -->
  
  <nav id="sidebar">
    <ul id="main-nav" class="open-active">
  <li<?php if($this->uri->segment(2)=='dashboard'){?> class="active" <?php } ?>><a href="<?=base_url('admin/dashboard');?>"> <i class="fa fa-dashboard"></i> Dashboard </a> </li>
	   <li<?php if($this->uri->segment(2)=='admin_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/admin_management');?>"> <i class="fa fa-user"></i>App Admin Management</a> </li>
	   <li<?php if($this->uri->segment(2)=='site_settings'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/site_settings');?>"> <i class="fa fa-user"></i>Manage Site Settings</a> </li>
	   <li<?php if($this->uri->segment(2)=='slider_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/slider_management');?>"> <i class="fa fa-group"></i>Manage Slider</a> </li>
	   <li<?php if($this->uri->segment(2)=='contact_us'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/contact_us');?>"> <i class="fa fa-user"></i>Manage Contact Us</a> </li>
	   <!-- <li<?php if($this->uri->segment(2)=='product_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/product_management');?>"> <i class="fa fa-list-alt"></i>Product Management</a> </li> -->
	    <li<?php if($this->uri->segment(2)=='category_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/category_management');?>"> <i class="fa fa-group"></i>Category Management</a> </li>
	    <li<?php if($this->uri->segment(2)=='subcategory_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/subcategory_management');?>"> <i class="fa fa-group"></i>Subcategory Management</a> </li>
		 <li<?php if($this->uri->segment(2)=='shop_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/shop_management');?>"> <i class="fa fa-plus-square"></i>Shop Management</a> </li>
		  <li<?php if($this->uri->segment(2)=='sale_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/sale_management');?>"> <i class="fa fa-tasks"></i>Sale Management</a> </li>
	   
      <!-- Drop Down List -->
     <?php /*?><li class="<?php if($this->uri->segment(2)=='court' || $this->uri->segment(2)=='game_type'){?> active <?php } ?>dropdown"><a href="javascript:;"> <i class="fa fa-file-text"></i>Master Modules<span class="caret"></span> </a>
      	<ul class="sub-nav">
          <li <?php if($this->uri->segment(2)=='court'){?> class="active" <?php } ?>><a href="<?=base_url('admin/court');?>"><i class="fa fa-list-alt"></i>Court Management</a> </li>
          <li <?php if($this->uri->segment(2)=='game_type'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/game_type');?>"><i class="fa fa-list-alt"></i> Game Type Management </a> </li>
        </ul>
     </li><?php */?>
   <!-- <li <?php if($this->uri->segment(2)=='admin_user'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/admin_user');?>"><i class="fa fa-list-alt"></i>Admin Management</a> </li>-->
      <li <?php if($this->uri->segment(2)=='change_password'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/change_password');?>"><i class="fa fa-wrench"></i>Change Password</a> </li>

      <li class="dropdown"><a href="javascript:void(0);" onclick="logout();"><i class="fa fa-power-off"></i><span>Logout</span></a>
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
	
	function open_pdf()
	{
		window.open("<?=base_url()?>uploads/file/BocceFest_Rules_v1.2014.pdf")
	}
 </script>