
<?php 
$viewname = $this->router->uri->segments[2];
$formAction = !empty($editRecord)?'update_data':'insert_data'; 
$path = $viewname.'/'.$formAction;
$head_title = 'User Management';
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
                  <label for="select-multi-input"><?=$this->lang->line('common_label_first_name')?><span style="color:#F00">*</span></label>
                  <input id="first_name" name="first_name" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['first_name'])?$editRecord[0]['first_name']:'';?>" data-required="true">
                </div>
                <div class="form-group">
                  <label for="select-multi-input"><?=$this->lang->line('common_label_last_name')?><span style="color:#F00">*</label>
                  <input id="last_name" name="last_name" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['last_name'])?$editRecord[0]['last_name']:'';?>" data-required="true">
                </div>
                <div class="form-group">
                  <label for="select-multi-input"><?=$this->lang->line('common_label_email')?></label>
                  <input id="email" class="form-control parsley-validated" type="text"  name="email" value="<?= !empty($editRecord[0]['email'])?$editRecord[0]['email']:'';?>">
                </div>
               <div class="form-group">
                  <label for="select-multi-input"><?=$this->lang->line('common_label_address')?> </label>
                  <textarea name="address" id="address" ><?=!empty($editRecord[0]['address'])?$editRecord[0]['address']:'';?>
</textarea>
                  <script type="text/javascript">
												CKEDITOR.replace('address',
												 {
													fullPage : false,
													
													toolbar:[['Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'],[ 'NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ],[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],[ 'Find','Replace','-','SelectAll','-' ],[ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar' ],[ 'TextColor','BGColor' ],[ 'Maximize', 'ShowBlocks'],[ 'Font','FontSize'],[ 'Link','Unlink','Anchor' ],['Source']],
													
													baseHref : '<?=$this->config->item('ck_editor_path')?>',
													filebrowserUploadUrl : '<?=$this->config->item('ck_editor_path')?>ckupload.php',
													filebrowserImageUploadUrl : '<?=$this->config->item('ck_editor_path')?>ckupload.php'
												}, {width: 200});														
											</script> 
                </div>
                <div class="form-group">
                  <label for="select-multi-input"><?=$this->lang->line('common_label_phone')?></label>
                  <input id="phone_no" class="form-control parsley-validated" type="text" name="phone_no" value="<?= !empty($editRecord[0]['phone_no'])?$editRecord[0]['phone_no']:'';?>" maxlength="10" onkeypress="return isNumberKey(event)" >
                </div>
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