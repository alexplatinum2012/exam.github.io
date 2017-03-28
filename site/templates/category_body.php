<?php
  if(isset($_GET['cid']) && $_GET['cid'] != "") {
    $catId = $_GET['cid'];
    include_once "script/DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "SELECT name, about FROM prod_category WHERE id = '".$catId."'";
    $query = $el->query($query);
    $categoryInfo = $el->fetch($query);
    $catName = $categoryInfo[0]['name'];
    $catAbout = $categoryInfo[0]['about'];

    $query = "SELECT id
              FROM products
              WHERE cat_id = '".$catId."'";
    $query = $el->query($query);
    $products = $el->fetch($query);
    $countOfProducts = count($products);
    $limit = 17;
    $offset = 0;
    $page = 1;

    $query = "select t1.id as prodId,
                     t1.name as prodName,
                     t1.about as prodAbout,
                     t1.cost as prodCost,
                     t1. corner as prodCorner,
                     t2.name as prodPhoto
              from products as t1,
                   prod_photo as t2
              where t1.cat_id = '".$catId."' and
                    t2.id in (select distinct pr_id from prod_photo where pr_id = t1.id)
              order by t1.id
              limit '".$limit."'
              offset '".$offset."'";
      $query = $el->query($query);
      $result = $el->fetch($query);
      $el->close();

  }


?>
<!--Wrapper-->
<div class="wrapper">
  <?php include "templates/header/header.php" ?>

  <iframe id="ifr-cat" name="ifr-cat"></iframe>
  <div id="cat">
    <div class="category-title">
  	    <p class="category-title-text"><?php echo $catName; ?></p>
  	    <p class="products-count"><?php echo "Показано ".($offset + 1)." - ".(($page * $limit > $countOfProducts) ? $countOfProducts : $page*$limit)." из ".$countOfProducts." товаров"; ?></p>
    </div>

    <div id="section-holder">
      <?php include "templates/product_preview/product_preview.php"; ?>
  </div>

</div>

  <?php include "templates/footer/footer.php" ?>
</div>
<script type="text/javascript">
  var frame = document.getElementById('ifr-cat');
  var cat = document.getElementById('cat');
  frame.onload = function(e){
    if(frame.contentDocument.body.innerHTML == "") return;
    cat.innerHTML = this.contentDocument.body.innerHTML;
  }
</script>
    <!--End wrapper-->
