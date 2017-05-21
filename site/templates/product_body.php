<!--Wrapper-->
<div class="wrapper">
<?php include "templates/header/header.php" ?>

<div class="category-title">
    <p class="category-title-text">Продукт</p>
    <p class="products-count"><a>Вернуться в каталог</a></p>
</div>
<?php
  function getKoeff($countElemInRow, $countOfRows, $countOfElements, $widthOfBlock) {
    if($countOfRows == 1) {
      $part = (($countOfElements % ($countElemInRow * $countOfRows)) >= ($countElemInRow)) ? 1 : (1 / 4) * ($countOfElements % ($countElemInRow * $countOfRows));
    } else {
        $part = (($countOfElements % ($countElemInRow * $countOfRows)) >= ($countElemInRow * 2 - 1)) ? 1 : (1 / 4) * ceil($countOfElements % ($countElemInRow * $countOfRows) / 2);
      }
    return $widthOfBlock * (floor($countOfElements / ($countElemInRow * $countOfRows)) + $part);
  }

  include_once "script/DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT t1.*,
                   t2.name as photo
            FROM products as t1,
                 prod_photo as t2
            WHERE t2.pr_id = t1.id AND
                  t1.id = '".$_GET['pid']."'";
  $query = $el->query($query);
  $product = $el->fetch($query);
  $catID = $product[0]['cat_id'];
  $width = getKoeff(4, 1, count($product), 300);

  $query = "SELECT id, var, count
            FROM prod_types
            WHERE pr_id = '".$_GET['pid']."'";
  $query = $el->query($query);
  $types = $el->fetch($query);

  include "templates/product_block/product_block.php";
?>
<div class="frame">
<?php

  $headerTitle = "";
  $curr = "руб.";
  include_once "script/DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT t1.id as prodId,
                   t1.name as prodName,
                   t1.about as prodAbout,
                   t1.cost as prodCost,
                   t1.corner as prodCorner
            FROM products as t1
            WHERE t1.cat_id = '".$catID."' AND
                  t1.id <> '".$_GET['pid']."' AND
                  (SELECT SUM(count)
                   FROM prod_types
                   WHERE pr_id = t1.id) > 0
            ORDER BY t1.id";
  $query = $el->query($query);
  $result = $el->fetch($query);
  foreach ($result as $key => $value) {
    $q = "SELECT name FROM prod_photo WHERE pr_id = '".$value['prodid']."'";
    $q = $el->query($q);
    $q = $el->fetch($q)[0];
    $result[$key]['prodphoto'] = $q['name'];
  }




  //$result = confirm_count($result);
  $el->close();
  $width = getKoeff(4, 1, count($result), 1170);
  include "templates/product_preview/product_preview.php";
?>
</div>

<?php include "templates/footer/footer.php" ?>
</div>

  <!--End wrapper-->
