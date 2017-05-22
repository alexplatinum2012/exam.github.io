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

  <script type="text/javascript">
    var ul = document.querySelector("ul.carousel-list");
    ul.style.width = "<?php if(isset($width)) echo $width.'px'; else echo '300px'; ?>";
    var leftArrowDiv = document.querySelector(".photo-list div.arrow-left");
    var rightArrowDiv = document.querySelector(".photo-list div.arrow-right");
    if(parseInt(ul.style.width) > 300) {
      rightArrowDiv.style.color = '#000000';
      rightArrowDiv.style.cursor = 'pointer';
    }

    leftArrowDiv.onclick = function(e) {
      if(e.target.tagName === "DIV") {
        photoMoover(1);
      }
    }
    rightArrowDiv.onclick = function(e) {
      if(e.target.tagName === "DIV") {
        photoMoover(-1);
      }
    }
    function photoMoover(direction) {
      var width = parseFloat(ul.style.width);
      var mLeft = (ul.style.marginLeft == "") ? 0 : parseFloat(ul.style.marginLeft);
      var maxMLeft = width - ((width >= 300) ? 300 : width);
      if(maxMLeft == 0) return;
      var minMLeft = 0;
      var step = 225;

      var newMLeft = mLeft + (step * direction);
      if(newMLeft >= 0) {
        newMLeft = 0;
        rightArrowDiv.style.color = '#000000';
        rightArrowDiv.style.cursor = 'pointer';
        leftArrowDiv.style.color = '#cccccc';
        leftArrowDiv.style.cursor = 'default';
      }
      if(newMLeft < 0 && (newMLeft * -1) < maxMLeft) {
        rightArrowDiv.style.color = '#000000';
        rightArrowDiv.style.cursor = 'pointer';
        leftArrowDiv.style.color = '#000000';
        leftArrowDiv.style.cursor = 'pointer';
      }
      if((newMLeft * -1) >= maxMLeft) {
        newMLeft = maxMLeft * -1;
        rightArrowDiv.style.color = '#cccccc';
        rightArrowDiv.style.cursor = 'default';
        leftArrowDiv.style.color = '#000000';
        leftArrowDiv.style.cursor = 'pointer';
      }
      ul.style.marginLeft = newMLeft + "px";
    }
  </script>
