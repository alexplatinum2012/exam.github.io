<?php
  $name = $_POST['name'];
  $count = $_POST['count'];
  $counter = $_POST['counter'];
?>

<div id="<?php echo 'var-line-'.$counter; ?>" class="var-line">
  <div class="var-l"><input form="form_productADD" type="text" name="<?php echo 'var'.$counter.'[]'; ?>" value="<?php echo $name; ?>" /></div>
  <div class="var-c"><input form="form_productADD" type="number" min="1" step="1" name="<?php echo 'var'.$counter."[]"; ?>" value="<?php echo $count; ?>"></div>
  <a class="not-link" onclick="delParent(this)">Удалить</a>
</div>
