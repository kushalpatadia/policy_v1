<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script language="javascript">
$.blockUI({ message: '<?='<img src="'.base_url('images').'/ajaxloader.gif" border="0" align="absmiddle"/>'?> Please Wait...'});
$(document).ready(function(){
	$.unblockUI();
});
</script>
<?php
$viewname = $this->router->uri->segments[2];
$admin_session = $this->session->userdata('admin_session');
$head_title = 'Sale Management';
?>

<div id="content">
  <div id="content-header">
    <h1>
      <?=$head_title?>
    </h1>
  </div>
  <div id="content-container">
    <div class="row">
      <div class="col-md-12">
        <div class="portlet">
          <div class="portlet-header">
            <h3> <i class="fa fa-table"></i>
              <?=$head_title?>
            </h3>
          </div>
          <!-- /.portlet-header -->
          
          <div class="portlet-content">
            <div class="table-responsive">
              <div role="grid" class="dataTables_wrapper" id="DataTables_Table_0_wrapper">
                <div class="row dt-rt">
                  <div class="col-sm-1">
                    <div id="DataTables_Table_0_length" class="dataTables_length row">
                      <label>
                        <select name="DataTables_Table_0_length" size="1" aria-controls="DataTables_Table_0" onchange="changepages();" id="perpage">
                          <option value="">Rows</option>
                          <option <?php if(!empty($perpage) && $perpage == 10){ echo 'selected="selected"';}?> value="10">10</option>
                          <option <?php if(!empty($perpage) && $perpage == 25){ echo 'selected="selected"';}?> value="25">25</option>
                          <option <?php if(!empty($perpage) && $perpage == 50){ echo 'selected="selected"';}?> value="50">50</option>
                          <option <?php if(!empty($perpage) && $perpage == 100){ echo 'selected="selected"';}?> value="100">100</option>
                        </select>
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-11">
                    <div class="dataTables_filter" id="DataTables_Table_0_filter">
                      <label>
                        <input class="" type="hidden" name="uri_segment" id="uri_segment" value="<?=!empty($uri_segment)?$uri_segment:'0'?>">
                        <input type="text" name="searchtext" id="searchtext" aria-controls="DataTables_Table_0" placeholder="Search..." value="<?=!empty($searchtext)?$searchtext:''?>">
                        <button onclick="contact_search('changesearch')" class="btn btn-success howler"  title="Search">Search </button>
                        <button class="btn btn-success howler flt " onclick="clearfilter_contact()" title="Reset">view All</button>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row dt-rt">
                  <div class="col-sm-6">
                    <button class="btn btn-danger howler" data-type="danger" onclick="deletepopup1();">Delete
                    <?=$head_title?>
                    </button>
                  </div>
                  <div class="col-sm-6"> <a class="btn  pull-right btn-success howler" href="<?=base_url('admin/'.$viewname.'/add_record');?>">Add New
                    <?=$head_title?>
                    </a> </div>
                </div>
                <div id="common_div">
                  <?=$this->load->view('admin/'.$viewname.'/ajax_list')?>
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
<!--<script type="text/javascript" src="<?=$this->config->item('js_path')?>script.js"></script> --><script>
	
	
	function contact_search(allflag)
		{
			 var uri_segment = $("#uri_segment").val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/sale_management/"+uri_segment,
				data: {
				result_type:'ajax',searchreport:$("#searchreport").val(),perpage:$("#perpage").val(),searchtext:$("#searchtext").val(),sortfield:$("#sortfield").val(),sortby:$("#sortby").val(),allflag:allflag
			},
			beforeSend: function() {
						$('#common_div').block({ message: 'Loading...' }); 
					  },
				success: function(html){
				 	$("#common_div").html(html);
					$('#common_div').unblock(); 
				}
			});
			return false;
		}
		
		 $(document).ready(function(){
		  $('#searchtext').keyup(function(event) 
		  {
			  /*if($("#searchtext").val().trim() != '')
				{
					contact_search();
				
				}
				else
				{
					clearfilternoresponse();	
				}*/
				
				if (event.keyCode == 13) {
						contact_search('changesearch');
				}
			//return false;
			});
			});
	
		function clearfilter_contact()
		{
			$("#searchtext").val("");
			contact_search('all');
		}
		
		function changepages()
		{
			contact_search('');	
		}
		
	  	function applysortfilte_contact(sortfilter,sorttype)
		{
			$("#sortfield").val(sortfilter);
			$("#sortby").val(sorttype);
			contact_search('changesorting');
		}
			
         $("#common_tb a.paginclass_A").click(function() {
		    $.ajax({
                type: "POST",
                url: $(this).attr('href'),
				data: {
                result_type:'ajax',searchreport:$("#searchreport").val(),perpage:$("#perpage").val(),searchtext:$("#searchtext").val(),sortfield:$("#sortfield").val(),sortby:$("#sortby").val()
            },
			beforeSend: function() {
						$.blockUI({ message: '<?='<img src="'.base_url('images').'/ajaxloader.gif" border="0" align="absmiddle"/>'?> Please Wait...'});
					  },
                success: function(html){
                   
                    $("#common_div").html(html);
					$.unblockUI();
                }
            });
            return false;

        });
		$('#selecctall').on('click',function(event) {  //on click
		 if(this.checked) { // check select status
			 $('.checkbox1').each(function() { //loop through each checkbox
					this.checked = true;  //select all checkboxes with class "checkbox1"              
				});
			}else{
				$('.checkbox1').each(function() { //loop through each checkbox
					this.checked = false; //deselect all checkboxes with class "checkbox1"                      
				});        
			}
		});
		
		
		function deletepopup1(id,name)
	{      

			var boxes = $('input[name="check[]"]:checked');
			if(boxes.length == '0' && id== '0')
			{
				$.confirm({'title': 'Alert','message': " <strong> Please select record(s) to delete. "+"<strong></strong>",'buttons': {'ok'	: {'class'	: 'btn_center alert_ok'}}});
				$('#selecctall').focus();
				return false;
				
			}
			if(id == '0')
			{
				var msg = 'Are you sure want to delete Record(s)';
			}
			else
			{
				var msg = 'Are you sure want to delete '+name+'?';
			}
				$.confirm({'title': 'CONFIRM','message': " <strong> "+msg+" "+"<strong></strong>",'buttons': {'Yes': {'class': '',
	   'action': function(){
							delete_all(id);
						}},'No'	: {'class'	: 'special'}}});
	} 
		
	function delete_all(id)
		{
			var myarray = new Array;
			var i=0;
			var boxes = $('input[name="check[]"]:checked');
			$(boxes).each(function(){
  				  myarray[i]=this.value;
				  i++;
			});
			if(id != '0')
			{
				var single_remove_id = id;
			}
			$.ajax({
			type: "POST",
			url: "<?php echo $this->config->item('admin_base_url').$viewname.'/ajax_delete_all';?>",
			dataType: 'json',
			async: false,
			data: {'myarray':myarray,'single_remove_id':id},
			success: function(data){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>admin/sale_management/"+data,
					data: {
					result_type:'ajax',searchreport:$("#searchreport").val(),perpage:$("#perpage").val(),searchtext:$("#searchtext").val(),sortfield:$("#sortfield").val(),sortby:$("#sortby").val(),allflag:''
				},
				beforeSend: function() {
							$('#common_div').block({ message: 'Loading...' });  
						  },
					success: function(html){
						$("#common_div").html(html);
						$('#common_div').unblock(); 
					}
				});
				return false;
			}
		});
	}	
	
	
	function pubunpub_data(count1,id)
{
	
	if(count1 == 1)
	{
		url = "<?php echo  $this->config->item('admin_base_url').$viewname; ?>/publish_record/"+id;
		html = '<a onclick="pubunpub_data(0,'+id+');" href="javascript:void(0);" class="btn btn-xs btn-success"><i class="fa fa-check-circle"></i></a> &nbsp;';
		html1 = 'Active';
	}
	else
	{
		url = "<?php echo  $this->config->item('admin_base_url').$viewname; ?>/unpublish_record/"+id;
		html = '<a onclick="pubunpub_data(1,'+id+');" href="javascript:void(0);" class="btn btn-xs btn-primary"><i class="fa fa-times-circle"></i></a> &nbsp;';
		html1 = 'Inactive';
	}
	$.ajax({
			type: "POST",
			url :url,
			async: false,
			success: function(data){
			
				$(".pubunpub_span_"+id).html(html);
				$(".status_span_"+id).html(html1);
			
			}
	});
}

		
         </script>