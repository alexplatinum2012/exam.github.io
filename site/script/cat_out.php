<?php
  $catId =  (isset($_GET['cid']) && $_GET['cid'] != "") ? $_GET['cid'] : false;
  if(!$catId) {
    // something to do
    exit();
  } else {
    function confirm_count($arr) {
      $el = new dba;
      $el->connect();
      if($el->database === false) echo "ERROR conect to DB";
      $mas = array();
      for ($i=0; $i < count($arr); $i++) {
        $query = "SELECT SUM(count)
                  FROM prod_types
                  WHERE pr_id = '".$arr[$i]['prodid']."'";
        $query = $el->query($query);
        $query = $el->fetch($query);
        if($query[0]['sum'] == 0) $mas[] = $i;
      }
      foreach ($mas as $key => $value) {
        unset($arr[$value]);
      }
      return $arr;
    }
    $page = (isset($_GET['page']) && $_GET['page'] != "") ? $_GET['page'] : 1;
    $limit = (isset($_GET['l']) && $_GET['l'] != "") ? $_GET['l'] : 17;
    $offset = ($page * $limit) - $limit;
    include_once "DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "SELECT name, about FROM prod_category WHERE id = '".$catId."'";
    $query = $el->query($query);
    $categoryInfo = $el->fetch($query);
    $catName = $categoryInfo[0]['name'];
    $catAbout = $categoryInfo[0]['about'];

    $query = "SELECT id as prodid
              FROM products
              WHERE cat_id = '".$catId."'";
    $query = $el->query($query);
    $products = $el->fetch($query);
    $products = confirm_count($products);
    $countOfProducts = count($products);

    $query = "SELECT t1.id AS prodId,
                     t1.name AS prodName,
                     t1.about AS prodAbout,
                     t1.cost AS prodCost,
                     t1.corner AS prodCorner,
                     t2.name AS prodPhoto
              FROM products AS t1,
                   prod_photo AS t2
              WHERE t1.cat_id = '".$catId."' AND
                    t2.id in (SELECT DISTINCT pr_id FROM prod_photo WHERE pr_id = t1.id) AND
                    (SELECT SUM(count) FROM prod_types WHERE pr_id = t1.id) > 0
              ORDER BY t1.id
              LIMIT '".$limit."'
              OFFSET '".$offset."'";
      $query = $el->query($query);
      $result = $el->fetch($query);
      //$result = confirm_count($result);
      $el->close();
    }?>

    <div class="category-title">
        <p class="category-title-text"><?php echo $catName; ?></p>
        <p class="products-count"><?php echo "Показано ".($offset + 1)." - ".(($page * $limit > $countOfProducts) ? $countOfProducts : $page*$limit)." из ".$countOfProducts." товаров"; ?></p>
    </div>

    <div id="section-holder">
      <?php include "../templates/product_preview/product_preview.php"; ?>
  </div>
