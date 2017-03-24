<?php

if(isset($_GET['cd'])) {
  include "script/DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $prod = "SELECT id, name, cost from products where cat_id = '".$_GET['cd']."' order by name";
  $cat = "SELECT name from prod_category where id = '".$_GET['cd']."'";
  $tmp = $el->query($prod);
  $dbAnswer = $el->fetch($tmp);
  $tmp = $el->query($cat);
  $cat = $el->fetch($tmp);
  $catName = $cat[0]['name'];
  $el->close();
}
?>




<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/products/products_in_category.php"; ?>
    </div>
  </div>
</div>
