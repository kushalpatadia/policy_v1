 <div id="product_name">
 
<?php if(!empty($products[0]['pro1_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($products[0]['pro1_image'])?$products[0]['pro1_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

<?php if(!empty($products[0]['pro2_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($products[0]['pro2_image'])?$products[0]['pro2_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

<?php if(!empty($products[0]['pro3_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($products[0]['pro3_image'])?$products[0]['pro3_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

<?php if(!empty($products[0]['pro4_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($products[0]['pro4_image'])?$products[0]['pro4_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>

<?php if(!empty($products[0]['pro5_image'])) { ?>
<div class="form-group">
<label for="firstname" class="col-lg-5 control-label"></label>
<div class="">
<br />
<img id="uploadPreview_pro1" src="<?=base_url($this->config->item('product_small_img_path')).'/'.(!empty($products[0]['pro5_image'])?$products[0]['pro5_image']:'');?>"  width="100"  height="100" />
</div>
</div>
<?php } ?>


</div>