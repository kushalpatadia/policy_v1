
<?php 
$viewname = $this->router->uri->segments[2];
$formAction = !empty($editRecord)?'update_data':'insert_data'; 
$path = $viewname.'/'.$formAction;
$head_title = 'Admin Management';
?>

<div id="content">
  <div id="content-header">
    <h1>Add New <?=$head_title?></h1>
  </div>
  <div id="content-container">
    <div class="row">
      <div class="col-md-12">
        <div class="portlet">
          <div class="portlet-header">
            <h3> <i class="fa fa-tasks"></i> New  <?=$head_title?></h3>
            	<a class="btn btn-primary pull-right" onclick="history.go(-1)" href="javascript:void(0)">Back</a> 
          </div>
          <!-- /.portlet-header -->
          
          <div class="portlet-content">
            <div class="col-sm-8">
              <form class="form parsley-form" enctype="multipart/form-data" name="<?php echo $viewname;?>" id="<?php echo $viewname;?>" method="post" accept-charset="utf-8" action="<?= $this->config->item('admin_base_url')?><?php echo $path?>" >
                
				<div class="form-group">
                  <label for="select-multi-input"><?=$this->lang->line('common_label_name')?><span style="color:#F00">*</span></label>
                  <input id="name" name="name" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['name'])?$editRecord[0]['name']:'';?>" data-required="true">
                </div>
				
                <div class="form-group">
                  <label for="select-multi-input"><?=$this->lang->line('common_label_email')?></label>
                  <input id="email" class="form-control parsley-validated" type="text"  name="email" value="<?= !empty($editRecord[0]['email'])?$editRecord[0]['email']:'';?>">
                </div>
				
				<?php
					if(empty($editRecord[0]['name']))
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
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.portlet-content --> 
          
        </div>
      </div>
    </div>
  </div>
  <!-- #content-header --> 
  
  <!-- /#content-container --> 
  
</div>
<!-- #content --> <script type="text/javascript">
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}
</script>