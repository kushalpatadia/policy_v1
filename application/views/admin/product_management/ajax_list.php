<?php 

	
if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$viewname = $this->router->uri->segments[2];
$admin_session = $this->session->userdata('admin_session');
?>
<?php if(isset($sortby) && $sortby == 'asc'){ $sorttypepass = 'desc';}else{$sorttypepass = 'asc';}?>

<table class="table table-striped table-bordered table-hover table-highlight table-checkable dataTable-helper dataTable datatable-columnfilter" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
  <thead>
    <tr role="row">
      <th class="sorting_disabled text-center" role="columnheader" rowspan="1" colspan="1" aria-label=""> <div class="">
          <input type="checkbox" class="selecctall" id="selecctall">
        </div>
      </th>
      <th data-direction="desc" data-sortable="true" data-filterable="true" <?php if(isset($sortfield) && $sortfield == 'category_name'){if($sortby == 'asc'){echo "class = 'sorting_desc'";}else{echo "class = 'sorting_asc'";}} ?> role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="descending" aria-label="Rendering engine: activate to sort column ascending"><a href="javascript:void(0);" onclick="applysortfilte_contact('category_name','<?php echo $sorttypepass;?>')">
       Category Name
        </a></th>
      <th class="hidden-xs hidden-sm <?php if(isset($sortfield) && $sortfield == 'namme'){if($sortby == 'asc'){echo "sorting_desc";}else{echo "sorting_asc";}} ?> " data-filterable="false" role="columnheader" rowspan="1" colspan="1" aria-label="Engine version"><a href="javascript:void(0);" onclick="applysortfilte_contact('name','<?php echo $sorttypepass;?>')">
        Product Name
        </a></th>
      <th class="hidden-xs hidden-sm <?php if(isset($sortfield) && $sortfield == 'image'){if($sortby == 'asc'){echo "sorting_desc";}else{echo "sorting_asc";}} ?>" data-filterable="true" role="columnheader" rowspan="1" colspan="1" aria-label="CSS grade"><a href="javascript:void(0);" onclick="applysortfilte_contact('image','<?php echo $sorttypepass;?>')">
        Product Image
        </a></th>
      <th class="hidden-xs hidden-sm sorting_disabled" data-filterable="true" role="columnheader" rowspan="1" colspan="1" aria-label="CSS grade"><?php echo $this->lang->line('common_label_action')?></th>
    </tr>
  </thead>
  <tbody role="alert" aria-live="polite" aria-relevant="all">
    <?php
	//pr($datalist);	
								if(!empty($datalist) && count($datalist)>0){
								
	                             $i=!empty($this->router->uri->segments[4])?$this->router->uri->segments[4]+1:1;
                                        foreach($datalist as $row){?>
    <tr <? if($i%2==1){ ?>class="bgtitle" <? }?> >
      <td class="text-center"><div class="" style="position: relative;">
          <input type="checkbox" class="checkbox1" name="check[]" value="<?php echo  $row['id'] ?>">
        </div></td>
      <td class="hidden-xs hidden-sm ">
	  <?php
	  $match=array('id'=>$row['category_id']);
	  $catlist = $this->product_management_model->select_records_dynamic('category','',$match,'','='); 
	  echo $catlist[0]['name'];
	  ?></td>
      <td class="hidden-xs hidden-sm "><?php echo  $row['name'] ?></td>
      <td class="hidden-xs hidden-sm "><?php echo  $row['image'] ?></td>
      <td class="hidden-xs hidden-sm text-center"><?php if(!empty($row['status']) && $row['status']==1){ ?>
        <a href="<?php echo  $this->config->item('admin_base_url').$viewname; ?>/unpublish_record/<?php echo  $row['id'] ?>"> <img title="Add Archive" src="<?php echo $this->config->item('image_path');?>publish_icon.png" width="22"  /> </a>
        <? }else{ ?>
        <a href="<?php echo  $this->config->item('admin_base_url').$viewname; ?>/publish_record/<?php echo  $row['id'] ?>"> <img title="Publish record" src="<?php echo $this->config->item('image_path');?>unpublish_icon.png" width="22"  /> </a>
        <? } ?>
        &nbsp; <a class="btn btn-xs btn-success" href="<?= $this->config->item('admin_base_url').$viewname; ?>/edit_record/<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> &nbsp;
        <button class="btn btn-xs btn-primary"  onclick="deletepopup1('<?php echo  $row['id'] ?>','<?php echo $row['name'] ?>');"> <i class="fa fa-times"></i> </button>
        <input type="hidden" id="sortfield" name="sortfield" value="<?php if(isset($sortfield)) echo $sortfield;?>" />
        <input type="hidden" id="sortby" name="sortby" value="<?php if(isset($sortby)) echo $sortby;?>" /></td>
    </tr>
    <?php } }?>
  </tbody>
</table>
<div class="row dt-rb">
  <div class="col-sm-6"> </div>
  <div class="col-sm-6">
    <div class="dataTables_paginate paging_bootstrap float-right" id="common_tb">
      <?php 
			 
			if(isset($pagination))
			{
				echo $pagination;
			}
		  	?>
    </div>
  </div>
</div>
