<?php 

	
if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$viewname = $this->router->uri->segments[2];
$admin_session = $this->session->userdata('admin_session');
$session_data = $this->session->userdata('email_exist');
?>
 <?php if(isset($sortby) && $sortby == 'asc'){ $sorttypepass = 'desc';}else{$sorttypepass = 'asc';}?>
 							<?php if(isset($session_data)) { ?>
							 	<div class="col-sm-12 text-center" id="div_msg">
									<span style="color:#F00; font-size:15;">	<?php echo $session_data; 
									 $this->session->unset_userdata('email_exist');
									?></span>
								</div>
							<?php } ?>
<table class="table table-striped table-bordered table-hover table-highlight table-checkable dataTable-helper dataTable datatable-columnfilter" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
          <thead>
           <tr role="row">
           <th class="sorting_disabled text-center" role="columnheader" rowspan="1" colspan="1" aria-label="">
             <div class="">
              <input type="checkbox" class="selecctall" id="selecctall">
             </div>
            </th>
			
            <th data-direction="desc" data-sortable="true" data-filterable="true" <?php if(isset($sortfield) && $sortfield == 'name'){if($sortby == 'asc'){echo "class = 'sorting_desc'";}else{echo "class = 'sorting_asc'";}} ?> role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="descending" aria-label="Rendering engine: activate to sort column ascending"><a href="javascript:void(0);" onclick="applysortfilte_contact('name','<?php echo $sorttypepass;?>')">Name</a></th>
            <th class="hidden-xs hidden-sm" data-filterable="false" <?php if(isset($sortfield) && $sortfield == 'email'){if($sortby == 'asc'){echo "class = 'sorting_desc'";}else{echo "class = 'sorting_asc'";}} ?> role="columnheader" rowspan="1" colspan="1" aria-label="Engine version"><a href="javascript:void(0);" onclick="applysortfilte_contact('email','<?php echo $sorttypepass;?>')">Email</a></th>
			<th class="hidden-xs hidden-sm sorting_disabled" data-filterable="true" role="columnheader" rowspan="1" colspan="1" aria-label="CSS grade"><?php echo $this->lang->line('common_label_action')?></th>
           </tr>
           </thead>
          <tbody role="alert" aria-live="polite" aria-relevant="all">
           
           <?php
								if(!empty($datalist) && count($datalist)>0){
								
	                             $i=!empty($this->router->uri->segments[4])?$this->router->uri->segments[4]+1:1;
                                        foreach($datalist as $row){?>
										
										<tr <? if($i%2==1){ ?>class="bgtitle" <? }?> > 
										<td class="text-center">
                                         <div class="" style="position: relative;">
										 
                                          <input type="checkbox" class="checkbox1" name="check[]"  value="<?php echo  $row['id'] ?>">
                                         </div>
                                        </td>
										<td class="hidden-xs hidden-sm "><?php echo  $row['name'] ?></td>
										<td class="hidden-xs hidden-sm "><?php echo  $row['email'] ?></td>
										<td class="hidden-xs hidden-sm text-center">
										<?php if(!empty($row['status']) && $row['status']==1){ ?>
                                         <a href="<?php echo  $this->config->item('admin_base_url').$viewname; ?>/unpublish_record/<?php echo  $row['id'] ?>">
<img title="Unpublish record" src="<?php echo $this->config->item('image_path');?>publish_icon.png" width="22"  />
</a> <? }else{ ?>

<a href="<?php echo  $this->config->item('admin_base_url').$viewname; ?>/publish_record/<?php echo  $row['id'] ?>">
<img title="Publish record" src="<?php echo $this->config->item('image_path');?>unpublish_icon.png" width="22"  />
</a>
<? } ?>
			 &nbsp;							<a class="btn btn-xs btn-success" href="<?= $this->config->item('admin_base_url').$viewname; ?>/edit_record/<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> &nbsp; <button class="btn btn-xs btn-primary" onClick="deletepopup('<?=addslashes($row['name'])?>','','<?php echo $this->config->item('admin_base_url').$viewname;?>/delete_record/<?php echo  $row['id'] ?>');">
<i class="fa fa-times"></i>
</button>
			<input type="hidden" id="sortfield" name="sortfield" value="<?php if(isset($sortfield)) echo $sortfield;?>" />
            <input type="hidden" id="sortby" name="sortby" value="<?php if(isset($sortby)) echo $sortby;?>" />
</td>
                            </tr>
                            <?php } }?>
          </tbody>
         </table>
         <div class="row dt-rb">
		  <div class="col-sm-6">
		  </div>
          <div class="col-sm-6">
           <div class="dataTables_paginate paging_bootstrap float-right" id="common_tb">
            <!--<ul class="pagination">
             <li class="prev disabled"><a href="#">← Previous</a></li>
             <li class="active"><a href="#">1</a></li>
             <li><a href="#">2</a></li>
             <li class="next"><a href="#">Next → </a></li>
            </ul>-->
             <?php 
			 
			if(isset($this->pagination))
			{
				 echo $this->pagination->create_links();
			}
		  	?>
           </div>
          </div>
         </div>
 <script>
  $(document).ready(function(){
	 $("#div_msg").fadeOut(4000); 
    });
 </script>

		  <script>
		 //function for search data
		 function delete_record()
		 {
		 	/*$.confirm({
			'title': 'Logout','message': " <strong> Are you sure you want to logout?",'buttons': {'Yes': {'class': 'special',
			'action': function(){
					$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/contact/",
				data: {
				result_type:'ajax',searchreport:$("#searchreport").val(),perpage:$("#perpage").val(),searchtext:$("#searchtext").val(),sortfield:$("#sortfield").val(),sortby:$("#sortby").val()
			},
			beforeSend: function() {
						$('#common_div').block({ message: 'Loading...' }); 
					  },
				success: function(html){
				 	$("#common_div").html(html);
					$('#common_div').unblock(); 
				}
			});
			}},'No'	: {'class'	: ''}}});*/	 
		 }
		function clearfilter_contact()
		{
			$("#searchtext").val("");
			contact_search();
		}
		function changepages()
		{
			contact_search();	
		}
	  	function applysortfilte_contact(sortfilter,sorttype)
		{
			$("#sortfield").val(sortfilter);
			$("#sortby").val(sorttype);
			contact_search();
		}
		function contact_search()
		{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/admin_user/",
				data: {
				result_type:'ajax',searchreport:$("#searchreport").val(),perpage:$("#perpage").val(),searchtext:$("#searchtext").val(),sortfield:$("#sortfield").val(),sortby:$("#sortby").val()
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
			  //if($("#searchtext").val().trim() != '')
				//{
					if (event.keyCode == 13) {
						contact_search();
				}
				
				//}
				//else
				//{
					//clearfilternoresponse();	
				//}
				
				/*if (event.keyCode == 13) {
				if($("#searchtext").val().trim() != '')
				{
					contact_search();
				
				}
				else
				{
					clearfilternoresponse();	
				}
			}*/
			//return false;
			});
			
			});
        $('body').on('click','#common_tb a.paginclass_A',function(e){
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
		$('body').on('click','#selecctall',function(e){  //on click
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
		$('#allcheck').click(function(){
 		var val=$('#delete_all').val();
		deletepopup1(val);
		
		});
		function delete_all(val)
		{
		
			var myarray = new Array;
			var i=0;
			var boxes = $('input[name="check[]"]:checked');
			$(boxes).each(function(){
  				  myarray[i]=this.value;
				  i++;
			});
			if(val == 'delete')
			{
			var url = "<?php echo $this->config->item('admin_base_url').$viewname.'/ajax_delete_all';?>";
			}
			if(val == 'publish')
			{
			var url = "<?php echo $this->config->item('admin_base_url').$viewname.'/ajax_publish_all';?>";
			}
			if(val == 'unpublish')
			{
			var url = "<?php echo $this->config->item('admin_base_url').$viewname.'/ajax_unpublish_all';?>";
			}
			$.ajax({
			
			type: "POST",
			url: url,
			dataType: 'json',
			async: false,
			data: {'myarray':myarray},
			success: function(data){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>admin/admin_user/",
					data: {
					result_type:'ajax',searchreport:$("#searchreport").val(),perpage:$("#perpage").val(),searchtext:$("#searchtext").val(),sortfield:$("#sortfield").val(),sortby:$("#sortby").val()
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
	function deletepopup1(val)
	{      
			var boxes = $('input[name="check[]"]:checked');
			if(boxes.length == '0')
			{
					$.confirm({'title': 'Alert','message': " <strong> Please Select atleast one Checkbox "+"<strong></strong>",'buttons': {'ok'	: {'class'	: 'btn_center'}}});
			}
	   		else
			
				$.confirm({'title': 'CONFIRM','message': " <strong> Are you sure want to "+val+" Record(s) "+"<strong>?</strong>",'buttons': {'Yes': {'class': 'special',
	'action': function(){
							delete_all(val);
						}},'No'	: {'class'	: ''}}});
	} 
         </script>