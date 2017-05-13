<?php
  include_once "script/DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT id, name
            FROM prod_category
            ORDER BY name";
  $tmp = $el->query($query);
  $dbAnswer = $el->fetch($tmp);
  $el->close();
?>

<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/categories/categories.php"; ?>
    </div>
  </div>
</div>
