<?php

 
$head_title = "admin"; 
$head_action = !empty($editRecord)?"Edit":"Add";


$admin_type = $this->router->uri->segments[1];
$viewname = $this->router->uri->segments[2];
$formAction = !empty($editRecord)?'update_data':'insert_data'; 
$path = $viewname.'/'.$formAction;
?>
<div id="content">
  <div id="content-header">
   <h1><?=ucwords($head_action." ".$head_title);?></h1>
  </div>
  <div id="content-container">
   <div class="row">
    <div class="col-md-12">
     <div class="portlet">
						<div class="portlet-header">
							<h3> <i class="fa fa-tasks"></i><?=ucwords($head_action." ".$head_title);?></h3>
							<a class="btn btn-primary pull-right" onclick="history.go(-1)" href="javascript:void(0)">Back</a>
						</div> <!-- /.portlet-header -->

						<div class="portlet-content">
                        <div class="col-sm-8">

							 <form class="form parsley-form" enctype="multipart/form-data" name="<?php echo $viewname;?>" id="<?php echo $viewname;?>" method="post" accept-charset="utf-8" action="<?= $this->config->item('admin_base_url')?><?php echo $path?>" >
								 <div class="form-group">
									<label for="select-multi-input">Name<span style="color:#F00">*</span></label>
									<input data-required="true" type="text" name="name" id="name" class="form-control parsley-validated" type="text" value="<?=isset($editRecord) ? $editRecord[0]['name'] : ''?>" />
								</div>
								 <div class="form-group">
									<label for="select-multi-input">Email<span style="color:#F00">*</span></label>
									<input data-trigger="change" data-required="true" type="text" name="email" data-type="email" id="email" class="form-control parsley-validated" type="text" value="<?=isset($editRecord) ? $editRecord[0]['email'] : ''?>" />
								</div>
								<?php if(!isset($editRecord)) { ?>
                                <div class="form-group">
									<label for="select-multi-input">Password<span style="color:#F00">*</span></label>
									<input data-minlength="6" type="password" name="password" id="password" class="form-control parsley-validated" type="text" data-required="true" data-equalto="#password" />
								</div>
                               <div class="form-group">
									<label for="select-multi-input">Confirm Password<span style="color:#F00">*</span></label>
									<input type="password" name="cpassword" id="cpassword" class="form-control parsley-validated" type="text" data-required="true" data-equalto="#password" />
								</div>
								<?php } ?>
								<div class="form-group">
                                <input type="hidden" name="id" value="<?= !empty($editRecord[0]['id'])?$editRecord[0]['id']:'';?>" />
									<button type="submit" class="btn btn-primary" >Save</button>
								</div>

							</form>
</div>
						</div> <!-- /.portlet-content -->

					</div>
    </div>
   </div>
  </div>
  <!-- #content-header --> 
  
  <!-- /#content-container --> 
  
 </div>
 
 <!-- #content --> 
 
<script type="text/javascript">

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}


</script>