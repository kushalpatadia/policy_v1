<?php
?>
<?php 
$viewname = $this->router->uri->segments[2];
$formAction = !empty($editRecord)?'update_data':'insert_data'; 
$path = $viewname.'/'.$formAction;
?>
<div id="content">
<div id="content-header">
<h1>Add New <?=$this->lang->line('admin_short')?></h1>
</div>
<div id="content-container">
<div class="row">
<div class="col-md-12">
<div class="portlet">
<div class="portlet-header">
<h3> <i class="fa fa-tasks"></i> New  <?=$this->lang->line('admin_short')?></h3>
<a class="btn btn-primary pull-right" onclick="history.go(-1)" href="javascript:void(0)">Back</a> 
</div>
<div class="portlet-content">
<div class="col-sm-8">
<form class="form parsley-form" enctype="multipart/form-data" name="<?php echo $viewname;?>" id="<?php echo $viewname;?>" method="post" accept-charset="utf-8" action="<?= $this->config->item('admin_base_url')?><?php echo $path?>" >
<div class="form-group">
<label for="select-multi-input"><?=$this->lang->line('common_label_name')?><span style="color:#F00">*</span></label>
<input id="name" name="name" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['name'])?$editRecord[0]['name']:'';?>" data-required="true">
</div>
<div class="form-group">
<label for="select-multi-input"><?=$this->lang->line('common_label_email')?><span style="color:#F00">*</span></label>
<input id="email" class="form-control parsley-validated" type="email" data-required="required"  name="email" value="<?= !empty($editRecord[0]['email'])?$editRecord[0]['email']:'';?>" onchange="check_email(this.value,<?= !empty($editRecord[0]['id'])?$editRecord[0]['id']:'0';?>);">
</div>
<?php
if(empty($editRecord[0]['id']))
{
?>
<div class="form-group">
<label for="select-multi-input"><?=$this->lang->line('common_label_password')?><span style="color:#F00">*</span></label>
<input id="password" name="password" class="form-control parsley-validated" type="password" data-required="required" data-minlength="6" data-required="true">
</div>
<?php
}
?>
<div class="form-group">
<input type="hidden" name="id" value="<?= !empty($editRecord[0]['id'])?$editRecord[0]['id']:'';?>" />
<button type="submit" class="btn btn-primary" id="save">Save</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>  
</div>
<!-- #content --> <script type="text/javascript">
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}
function check_email(email,id)
{
	$.ajax({
				type: "POST",
				url: "<?php echo $this->config->item('admin_base_url').$viewname.'/check_user';?>",
				dataType: 'json',
				async: false,
				data: {'email':email,'id':id},
				success: function(data)
				{
				
				if(data == '1')
				{	
					$("#save").prop("disabled", true);
					$.confirm({'title': 'Alert','message': " <strong> This Email Already Existing ! Please Select other Email "+"<strong></strong>",'buttons': {'ok'	: {'class'	: 'btn_center alert_ok','action': function(){
						$('#email').val('');
						$('#email').focus();
						$("#save").prop("disabled", false);
							}}}});
				}
				if(data == '2')
				{	
					$("#save").prop("disabled", true);
					$.confirm({'title': 'Alert','message': " <strong> This Email Address is not valid ! Please Select Valid Email Address"+"<strong></strong>",'buttons': {'ok'	: {'class'	: 'btn_center alert_ok','action': function(){
							$('#email').val('');
							$('#email').focus();
							$("#save").prop("disabled", false);
					}}}});
				}
				
				}
			});
			return false;
					
}
</script>