<?php
if(isset($_POST['logo_title'])) {
  include "DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "UPDATE prod_category_settings
            SET logo_title = '".$_POST['logo_title']."',
                logo_description = '".$_POST['logo_description']."',
                promo_pr_id = '".(($_POST['promo_pr_id'] != '') ? $_POST['promo_pr_id'] :  0)."',
                promo_title1 = '".$_POST['promo_title1']."',
                promo_title2 = '".$_POST['promo_title2']."'
                WHERE cat_id = '".$_POST['catID']."'";
  $el->query($query);
  $el->close();
}
header("Refresh:0; url=../categories.php?")
?>
