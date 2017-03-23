<?php

if(isset($_GET['cd']) && isset($_GET['cn'])) {
  include "script/DB_operations.php";
  $catName = $_GET['cn'];
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $prod = "SELECT id, name, cost from products where cat_id = '".$_GET['cd']."'";
  $tmp = $el->query($prod);
  $dbAnswer = $el->fetch($tmp);
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
