
<?php 
$viewname = $this->router->uri->segments[2];
$formAction = !empty($editRecord)?'update_data':'insert_data'; 
$path = $viewname.'/'.$formAction;
$head_title = 'Shop Management';
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
                  <label for="select-multi-input">Shop Name<span style="color:#F00">*</span></label>
                  <input id="shop_name" name="shop_name" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['shop_name'])?$editRecord[0]['shop_name']:'';?>">
                </div>
				
				
				<div class="form-group">
                  <label for="select-multi-input">Category<span style="color:#F00">*</span></label>
                  
				  <div class="custom-select">
                  <select name="category_name" id="category_name" onchange="get_subcategory()" class="form-control parsley-validated"  data-required="required">
                    <option value="">--Select Category--</option>
                    <?php foreach($category as $ct) { ?>
					<option value="<?= $ct['id'] ?>-<?= $ct['name'] ?>" <?php if(!empty($editRecord)) { if($ct['id'] == $editRecord[0]['category_id']) { echo "selected"; }  } ?>  ><?= ucfirst($ct['name']) ?></option>
					<?php } ?>
                  </select>
                   </div>
				  </div>

          <div class="form-group">
                  <label for="select-multi-input">Subcategory<span style="color:#F00">*</span></label>

          <div class="custom-select form-group">
                  <select name="subcategory_name" id="subcategory_name" class="form-control parsley-validated" data-required="required">
                    <option value="">--Select Subcategory--</option>
                   <?php 
           if(!empty($editRecord)) { 
           foreach($subcategory as $sh) { ?>
          <option value="<?= $sh['id'] ?>" <?php if(!empty($editRecord)) {if($sh['id'] == $editRecord[0]['subcategory_id']) { echo "selected"; } }  ?>><?= $sh['name']?></option>
          <?php } } ?>
                  </select>
                  </div>
                   </div>
				  
				  <div class="form-group">
                  <label for="select-multi-input">Phone<span style="color:#F00">*</span></label>
                  <input id="phone" name="phone" onkeypress="return isNumberKey(event)" maxlength="15" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['phone'])?$editRecord[0]['phone']:'';?>">
                </div>
				
				<div class="form-group">
                  <label for="select-multi-input">Fax<span style="color:#F00">*</span></label>
                  <input id="fax" name="fax" onkeypress="return isNumberKey(event)" maxlength="15" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['fax'])?$editRecord[0]['fax']:'';?>">
                </div>
				
				<div class="form-group">
                  <label for="select-multi-input">Email<span style="color:#F00">*</span></label>
                  <input id="email" name="email" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['email'])?$editRecord[0]['email']:'';?>">
                </div>
				
				<div class="form-group">
                  <label for="select-multi-input">Site<span style="color:#F00">*</span></label>
                  <input id="site" name="site" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['site'])?$editRecord[0]['site']:'';?>">
                </div>
				
				
				<div class="form-group">
                  <label for="select-multi-input">About us<span style="color:#F00">*</span></label>
                  <input id="about_us" name="about_us" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['about_us'])?$editRecord[0]['about_us']:'';?>">
                </div>
				
				<div class="form-group">
                  <label for="select-multi-input">Days / Hours<span style="color:#F00">*</span></label>
                  <input id="days_hours" name="days_hours" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['days_hours'])?$editRecord[0]['days_hours']:'';?>">
                </div>
				
				<div class="form-group">
                  <label for="select-multi-input">Location<span style="color:#F00">*</span></label>
                  <input id="location" name="location" class="form-control parsley-validated" type="text" data-required="required" value="<?= !empty($editRecord[0]['location'])?$editRecord[0]['location']:'';?>">
                </div>
				
				
                
                <div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Photo 1 <span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage(this.value);" name="photo1" id="image1" class="file_input_hidden"/>
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
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview1" class="noimage" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['photo1']))
                        {?>
                <img id="uploadPreview1" src="<?=base_url($this->config->item('photo_small_img_path')).'/'.(!empty($editRecord[0]['photo1'])?$editRecord[0]['photo1']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview1" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
				
                <? } ?>
                <? }?>
				
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
			  
            </div>
          </div>
		  
		  		
		  
		  		<!--photo 2-->
		  
		   		<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Photo 2 <span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage2(this.value);" name="photo2" id="image2" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile2" id="hiddenFile2" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview2" class="noimage2" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['photo2']))
                        {?>
                <img id="uploadPreview2" src="<?=base_url($this->config->item('photo_small_img_path')).'/'.(!empty($editRecord[0]['photo2'])?$editRecord[0]['photo2']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview2" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		<!--photo 3-->
		  
		   		<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Photo 3 <span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage3(this.value,this.alt);" name="photo3" id="image3" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile3" id="hiddenFile3" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview3" class="noimage3" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['photo3']))
                        {?>
                <img id="uploadPreview3" src="<?=base_url($this->config->item('photo_small_img_path')).'/'.(!empty($editRecord[0]['photo3'])?$editRecord[0]['photo3']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview3" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  	
				<!--photo 4-->
		  
		   		<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Photo 4 <span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage4(this.value);" name="photo4" id="image4" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile4" id="hiddenFile4" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview4" class="noimage4" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['photo4']))
                        {?>
                <img id="uploadPreview4" src="<?=base_url($this->config->item('photo_small_img_path')).'/'.(!empty($editRecord[0]['photo4'])?$editRecord[0]['photo4']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview4" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  	
				<!--photo 5 -->
		  
		   		<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Photo 5 <span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage5(this.value);" name="photo5" id="image5" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile5" id="hiddenFile5" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview5" class="noimage5" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['photo5']))
                        {?>
                <img id="uploadPreview5" src="<?=base_url($this->config->item('photo_small_img_path')).'/'.(!empty($editRecord[0]['photo5'])?$editRecord[0]['photo5']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview5" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		
		  <!--Product 1-->
		  
		  
				
				<div class="">
                  <label for="select-multi-input">Product 1 Name</label>
                  <input id="product_name1" name="product_name1" class="form-control" type="text"  value="<?= !empty($editRecord[0]['pro1_name'])?$editRecord[0]['pro1_name']:'';?>">
                </div>
				
				<div class="">
                  <label for="select-multi-input">Product 1 Price</label>
                  <input id="product_price1" name="product_price1" class="form-control " type="text"  value="<?= !empty($editRecord[0]['pro1_price'])?$editRecord[0]['pro1_price']:'';?>">
                </div>
				
				<br />
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Product 1 Photo<span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage_pro1(this.value);" name="product1" id="product1" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile_pro1" id="hiddenFile_pro1" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview_pro1" class="noimage_pro1" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['pro1_image']))
                        {?>
                <img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro1_image'])?$editRecord[0]['pro1_image']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview_pro1" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  <!--Product 2-->
				
				<div class="">
                  <label for="select-multi-input">Product 2 Name</label>
                  <input id="product_name2" name="product_name2" class="form-control" type="text" value="<?= !empty($editRecord[0]['pro2_name'])?$editRecord[0]['pro2_name']:'';?>">
                </div>
				
				<div class="">
                  <label for="select-multi-input">Product 2 Price</label>
                  <input id="product_price2" name="product_price2" class="form-control " type="text" value="<?= !empty($editRecord[0]['pro2_price'])?$editRecord[0]['pro2_price']:'';?>">
                </div>
				
				<br />
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Product 2 Photo<span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage_pro2(this.value);" name="product2" id="product2" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile_pro2" id="hiddenFile_pro2" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview_pro2" class="noimage_pro2" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['pro2_image']))
                        {?>
                <img id="uploadPreview_pro2" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro2_image'])?$editRecord[0]['pro2_image']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview_pro2" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		<!--Product 3-->
				
				<div class="">
                  <label for="select-multi-input">Product 3 Name</label>
                  <input id="product_name3" name="product_name3" class="form-control" type="text" value="<?= !empty($editRecord[0]['pro3_name'])?$editRecord[0]['pro3_name']:'';?>">
                </div>
				
				<div class="">
                  <label for="select-multi-input">Product 3 Price</label>
                  <input id="product_price3" name="product_price3" class="form-control" type="text" value="<?= !empty($editRecord[0]['pro3_price'])?$editRecord[0]['pro3_price']:'';?>">
                </div>
				<br />
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Product 3 Photo<span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage_pro3(this.value);" name="product3" id="product3" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile_pro3" id="hiddenFile_pro3" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview_pro3" class="noimage_pro3" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['pro3_image'])) 
                        {?>
                <img id="uploadPreview_pro3" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro3_image'])?$editRecord[0]['pro3_image']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview_pro3" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		<!--Product 4-->
				
				<div class="">
                  <label for="select-multi-input">Product 4 Name</label>
                  <input id="product_name4" name="product_name4" class="form-control" type="text" value="<?= !empty($editRecord[0]['pro4_name'])?$editRecord[0]['pro4_name']:'';?>">
                </div>
				
				<div class="">
                  <label for="select-multi-input">Product 4 Price</label>
                  <input id="product_price4" name="product_price4" class="form-control" type="text" value="<?= !empty($editRecord[0]['pro4_price'])?$editRecord[0]['pro4_price']:'';?>">
                </div>
				
				<br />
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Product 4 Photo<span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage_pro4(this.value);" name="product4" id="product4" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile_pro4" id="hiddenFile_pro4" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview_pro4" class="noimage_pro4" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['pro4_image'])) 
                        {?>
                <img id="uploadPreview_pro4" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro4_image'])?$editRecord[0]['pro4_image']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview_pro4" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
                <? } ?>
                <? }?>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
		  
		  		<!--Product 5-->
				
				<div class="">
                  <label for="select-multi-input">Product 5 Name</label>
                  <input id="product_name5" name="product_name5" class="form-control" type="text"  value="<?= !empty($editRecord[0]['pro5_name'])?$editRecord[0]['pro5_name']:'';?>">
                </div>
				
				<div class="">
                  <label for="select-multi-input">Product 5 Price</label>
                  <input id="product_price5" name="product_price5" class="form-control" type="text"  value="<?= !empty($editRecord[0]['pro5_price'])?$editRecord[0]['pro5_price']:'';?>">
                </div>
				
				<br />
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label">Product 5 Photo<span>:</span> </label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn">
                <div class="file_input_div">
                  <input type="button" value="Browse" class="file_input_button" />
                  <input type="file" alt="1" onchange="PreviewImage_pro5(this.value);" name="product5" id="product5" class="file_input_hidden"/>
                  <input class="image_upload" type="text"  data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile_pro5" id="hiddenFile_pro5" value="" />
				 
                </div>
                <!-- <input type="text" class="file_input_textbox" readonly value='No File Selected'>--> 
              </div>
            </div>
          </div>
				
				<div class="form-group">
            <label for="firstname" class="col-lg-5 col-md-12 control-label"></label>
            <div class="col-lg-7 col-md-12">
              <div class="browse_btn"> 
			  <br />
                <? 
			if($this->uri->segments[2] =='add_record'){ ?>
                <img id="uploadPreview_pro5" class="noimage5" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" height="100" />
                <? } else {?>
                <?php if(!empty($editRecord[0]['pro5_image'])) 
                        {?>
                <img id="uploadPreview_pro5" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($editRecord[0]['pro5_image'])?$editRecord[0]['pro5_image']:'');?>"  width="100"  height="100" />
                <? } else{?>
                <img id="uploadPreview_pro5" src="<?php echo base_url('images/no_image.jpg'); ?>" alt="No Image selected" title="Image" width="100" />
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
function PreviewImage(str) {
	 	$('.noimage').show();
	
	$('#hiddenFile').val(str);
	 b = "uploadPreview1";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("image1").files[0]);
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
		
};
function PreviewImage2(str) {
	$('.noimage2').show();
	
	$('#hiddenFile2').val(str);
	 b = "uploadPreview2";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("image2").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage2').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};
function PreviewImage3(str) {
	 	$('.noimage3').show();
	
	$('#hiddenFile3').val(str);
	 b = "uploadPreview3";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("image3").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage3').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};
function PreviewImage4(str) {
	 	$('.noimage4').show();
	
	$('#hiddenFile4').val(str);
	 b = "uploadPreview4";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("image4").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage4').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};
function PreviewImage5(str) {
	 	$('.noimage5').show();
	
	$('#hiddenFile5').val(str);
	 b = "uploadPreview5";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("image5").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage5').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};



function PreviewImage_pro1(str) {
	 	$('.noimage_pro1').show();
	
	$('#hiddenFile_pro1').val(str);
	 b = "uploadPreview_pro1";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("product1").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage_pro1').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};
function PreviewImage_pro2(str) {
	 	$('.noimage_pro2').show();
	
	$('#hiddenFile_pro2').val(str);
	 b = "uploadPreview_pro2";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("product2").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage_pro2').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};

function PreviewImage_pro3(str) {
	 	$('.noimage_pro3').show();
	
	$('#hiddenFile_pro3').val(str);
	 b = "uploadPreview_pro3";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("product3").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage_pro3').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};

function PreviewImage_pro4(str) {
	 	$('.noimage_pro4').show();
	
	$('#hiddenFile_pro4').val(str);
	 b = "uploadPreview_pro4";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("product4").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage_pro4').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};

function PreviewImage_pro5(str) {
	 	$('.noimage_pro5').show();
	
	$('#hiddenFile_pro5').val(str);
	 b = "uploadPreview_pro5";
	 var oFReader = new FileReader();
		
	oFReader.readAsDataURL(document.getElementById("product5").files[0]);
	oFReader.onload = function (oFREvent) {
		//alert(oFREvent.target.result);
		var myString=oFREvent.target.result;
		var myArray = myString.split(';');
		if (myArray[0].indexOf('image') > -1) {
			//alert('hi');
		 document.getElementById(b).src = oFREvent.target.result;
		} else {$('.noimage_pro5').hide();}
		document.getElementById(b).height="100";
			document.getElementById(b).width="100";
		 };
		
};

function get_subcategory()
{
  var cid = $('#category_name').val();
  $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>admin/shop_management/get_subcategory_list",
        data: {
        cid:cid
      },
      beforeSend: function() {
            $('#common_div').block({ message: 'Loading...' }); 
            },
        success: function(html){
          $('#subcategory_name').html(html);
          $('#common_div').unblock(); 
        }
      });
}

</script>