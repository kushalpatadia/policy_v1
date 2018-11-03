<?php 
 
if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script language="javascript">
$.blockUI({ message: '<?='<img src="'.base_url('images').'/ajaxloader.gif" border="0" align="absmiddle"/>'?> Please Wait...'});
$(document).ready(function(){
	$.unblockUI();
});
</script>
<?php
$head_title = "admin";

$viewname = $this->router->uri->segments[2];
$admin_session = $this->session->userdata('admin_session');
?>
 <div id="content">
  <div id="content-header">
   <h1><?="Manage ".ucwords($head_title)?></h1>
  </div>
  <div id="content-container">
   <div class="row">
    <div class="col-md-12">
     <div class="portlet">
      <div class="portlet-header">
       <h3> <i class="fa fa-table"></i></h3>
      </div>
      <!-- /.portlet-header -->
      
      <div class="portlet-content">
      
        <div role="grid" class="dataTables_wrapper" id="DataTables_Table_0_wrapper">
         <div class="row dt-rt">
		   <div class="col-lg-1 col-md-2 col-xs-12 pull-left">
           <div id="DataTables_Table_0_length" class="dataTables_length row mrg">
            <label class="pull-left">
             <select name="DataTables_Table_0_length" size="1" aria-controls="DataTables_Table_0" onchange="changepages();" id="perpage">
             <option value="">Rows</option>
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
             </select>
            </label>
           </div>
          </div>
          <div class="col-lg-2 col-md-2 col-xs-12">
		   <div id="DataTables_Table_0_length" class="dataTables_length row mrg">
		   
		  	<select name="DataTables_Table_0_length" size="1" aria-controls="DataTables_Table_0" id="delete_all">
				 <option value="">Select</option>
				 <option  value="delete">Delete</option>
				 <option  value="publish">Publish</option>
				 <option  value="unpublish">Unpublish</option>
            </select>
		  </div></div>
          <div class="col-lg-2 col-md-2 col-xs-12">
		   <button class="btn btn-danger howler" id="allcheck" data-type="danger">Submit</button>
		  </div>
           
          <div class="col-lg-4 col-md-4 col-xs-12">
           <div class="dataTables_filter" id="DataTables_Table_0_filter">
            <label class="flt">
            	<input type="text" class="searchinput" name="searchtext" id="searchtext" aria-controls="DataTables_Table_0" placeholder="Search...">
            </label>
           </div>
          </div>
          <div class="col-lg-2 col-md-2 col-xs-12 flt">
         <a class="btn btn-success howler flt" href="<?=base_url('admin/'.$viewname.'/add_record');?>">Add <?=ucwords($head_title)?></a>
          </div>
         </div>
          <div class="table-responsive">
       <div class="table-in-responsive">
         <div id="common_div">
 <?=$this->load->view('admin/'.$viewname.'/ajax_list')?>
         </div>
        </div>
        </div>
       </div>
       <!-- /.table-responsive --> 
       
      </div>
      <!-- /.portlet-content --> 
      
     </div>
    </div>
   </div>
  </div>
  <!-- #content-header --> 
  
  <!-- /#content-container --> 
  
 </div>
 <!-- #content --> 
<!--<script type="text/javascript" src="<?=$this->config->item('js_path')?>script.js"></script> -->





