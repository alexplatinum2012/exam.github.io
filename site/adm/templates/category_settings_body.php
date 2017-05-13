<?php
  if(isset($_GET['cid']) && $_GET['cid'] != "") {
    include "script/DB_operations.php";
    $el = new db;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "SELECT *
              FROM prod_category_settings"
              WHERE id = '".$_GET['cid']."';
    $tmp = $el->query($query);
    $dbAnswer = $el->fetch($tmp)[0];
    //$categoryName = $dbAnswer['name'];
    if($dbAnswer) {
      $categoryLogoImg = $dbAnswer['logo_img'];

    }

  }
?>

<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/categories/categories_settings.php"; ?>
    </div>
  </div>
</div>
