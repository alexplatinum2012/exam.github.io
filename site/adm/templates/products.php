<?php
  include "script/DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $prod = "SELECT id,
                  name, 
                  cost 
           FROM products 
           ORDER BY name";
  $tmp = $el->query($prod);
  $dbAnswer = $el->fetch($tmp);
  $el->close();
?>




<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/products/products.php"; ?>
    </div>
  </div>
</div>
