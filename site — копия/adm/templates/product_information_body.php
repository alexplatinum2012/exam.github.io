<?php
  include 'script/DB_operations.php';
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $product = "SELECT * FROM products WHERE id = '".$_GET['pid']."'";
  $prodPhoto = "SELECT * FROM prod_photo WHERE pr_id = '".$_GET['pid']."'";
  $prodVar = "SELECT * FROM prod_types WHERE pr_id = '".$_GET['pid']."'";
  $product = $el->query($product);
  $product = $el->fetch($product);
  $prodPhoto = $el->query($prodPhoto);
  $prodPhoto = $el->fetch($prodPhoto);
  $prodVar = $el->query($prodVar);
  $prodVar = $el->fetch($prodVar);
  $el->close();
?>







<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php"; ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/products/product_information.php"; ?>
    </div>
  </div>
</div>
