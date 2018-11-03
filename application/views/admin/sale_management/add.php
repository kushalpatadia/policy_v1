<?php 
$viewname = $this->router->uri->segments[2];
$formAction = !empty($editRecord)?'update_data':'insert_data'; 
$path = $viewname.'/'.$formAction;
$head_title = 'Sale Management';
?>
<script src="<?=$this->config->item('js_path')?>parsley.js"></script> 
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
              
			   <div class="custom-select form-group">
                  <select name="category_name" id="category_name" class="form-control parsley-validated" onchange="get_shop()"  data-required="required">
                    <option value="">--Select Category--</option>
                    <?php foreach($category as $ct) { ?>
					<option value="<?= $ct['id'] ?>"<?php if(!empty($editRecord)) {if($ct['id'] == $editRecord[0]['category_id']) { echo "selected"; } }  ?>><?= $ct['name']?></option>
					<?php } ?>
                  </select>
                  </div>
				 
				  <br />
				  
				  <div class="custom-select form-group">
                  <select name="shop_name" id="shop_name" class="form-control parsley-validated" onchange="get_product();"   data-required="required">
                    <option value="">--Select Shop--</option>
                   <?php 
				   if(!empty($editRecord)) { 
				   foreach($shops as $sh) { ?>
					<option value="<?= $sh['id'] ?>" <?php if(!empty($editRecord)) {if($sh['id'] == $editRecord[0]['shop_id']) { echo "selected"; } }  ?>><?= $sh['shop_name']?></option>
					<?php } } ?>
                  </select>
                  </div>
				  
				  <br />
				  
				  
				 <div id="product_name">
				 
				 <?php if(!empty($editRecord[0]['pro1_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro1_image'])?$editRecord[0]['pro1_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

<?php if(!empty($editRecord[0]['pro2_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro2_image'])?$editRecord[0]['pro2_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

<?php if(!empty($editRecord[0]['pro3_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro3_image'])?$editRecord[0]['pro3_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

<?php if(!empty($editRecord[0]['pro4_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro4_image'])?$editRecord[0]['pro4_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

<?php if(!empty($editRecord[0]['pro5_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro5_image'])?$editRecord[0]['pro5_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

				 
				 </div>
				  
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
<!-- #content --> 
<script type="text/javascript">
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}
function get_shop()
{
	var cid = $('#category_name').val();
	$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/sale_management/get_shop_list",
				data: {
				cid:cid
			},
			beforeSend: function() {
						$('#common_div').block({ message: 'Loading...' }); 
					  },
				success: function(html){
				 	$('#shop_name').html(html);
					$('#product_name').html('');
					$('#common_div').unblock(); 
				}
			});
}
function get_product()
{
	var sid = $('#shop_name').val();
	$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/sale_management/get_product_list",
				data: {
				sid:sid
			},
			beforeSend: function() {
						$('#common_div').block({ message: 'Loading...' }); 
					  },
				success: function(html){
				
				 	$('#product_name').html(html);
					$('#common_div').unblock(); 
				}
			});
}

</script>

<script>
function PreviewImage(str,filealt) {
	 	$('.noimage').show();
	 var a = filealt;
	// a=parseInt(a) + 1;
	// document.getElementById('imageCount').value=a;
	$('#hiddenFile').val(str);
	 b = "uploadPreview"+a;
	 
 	if(a>10)
	{	
		alert("Sorry maximum 10 image is Upload");
	}
	else
	{
			
        var oFReader = new FileReader();
		
        oFReader.readAsDataURL(document.getElementById("image"+a).files[0]);
        oFReader.onload = function (oFREvent) {
			//alert(oFREvent.target.result);
			var myString=oFREvent.target.result;
			var myArray = myString.split(';');
			if (myArray[0].indexOf('image') > -1) {
				//alert('hi');
			 document.getElementById(b).src = oFREvent.target.result;
			} else {$('.noimage').hide();}
        	document.getElementById(b).height="100";
				document.getElementById(b).width="100";
			 };
		}
};
</script>