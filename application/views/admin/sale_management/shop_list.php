
<option value="">--Select Shop--</option>
<?php foreach($shops as $sh) { ?>
<option value="<?= $sh['id'] ?>"><?= $sh['shop_name']?></option>
<?php } ?>
