
<?php 
$viewname = $this->router->uri->segments[2];
$formAction = !empty($editRecord)?'update_data':'insert_data'; 
$path = $viewname.'/'.$formAction;
$head_title = 'Subcategory Management';
//pr($category); exit;
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


                <div class="form-group">
                  <label for="select-multi-input">Category<span style="color:#F00">*</span></label>
                  
          <div class="custom-select">
                  <select name="category_name" id="category_name" class="form-control parsley-validated"  data-required="required">
                    <option value="">--Select Category--</option>
                    <?php foreach($category as $ct) { ?>
          <option value="<?= $ct['id'] ?>-<?= $ct['name'] ?>" <?php if(!empty($editRecord)) { if($ct['id'] == $editRecord[0]['category_id']) { echo "selected"; }  } ?>  ><?= ucfirst($ct['name']) ?></option>
          <?php } ?>
                  </select>
                   </div>
          </div>

                <div class="form-group">
                  <label for="select-multi-input">Name<span style="color:#F00">*</span></label>
                  <input id="name" name="name" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['name'])?$editRecord[0]['name']:'';?>">
                </div>
                
                <div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Subcategory Image <span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage(this.value,this.alt);" name="image" id="image1" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile" id="hiddenFile" value="" />
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  	<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
                <? 
				
			
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview1" class="noimage" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['image']))
                        {?>
                <img id="uploadPreview1" src="<?=base_url($this->config->item('subcategory_small_img_path')).'/'.(!empty($editRecord[0]['image'])?$editRecord[0]['image']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview1" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
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
			//console.log(myArray); return false;
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
