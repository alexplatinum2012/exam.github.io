<?php
// function delDbl ($mas) {
//   $arrToDelIndex = Array();
//   for ($i = 0; $i < count($mas); $i++) {
//     $mas[$i]['toDel'] = 0;
//   }
//   for ($i = 0; $i < count($mas); $i++) {
//     if($mas[$i]['toDel'] === 0) {
//       for ($j = $i + 1; $j < count($mas); $j++) {
//         if($mas[$j]['prodid'] == $mas[$i]['prodid']) $mas[$j]['toDel'] = 1;
//       }
//     }
//   }
//   for ($i = 0; $i < count($mas); $i++) {
//     if($mas[$i]['toDel'] === 1) {
//       unset($mas[$i]);
//     }
//     else {
//       unset($mas[$i]['toDel']);
//     }
//   }
//   return array_merge($mas);
// }
  if(isset($_GET['cid']) && $_GET['cid'] != "") {
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
    $catId = $_GET['cid'];
    include_once "script/DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "SELECT name, about
              FROM prod_category
              WHERE id = '".$catId."'";
    $query = $el->query($query);
    $categoryInfo = $el->fetch($query);
    $catName = $categoryInfo[0]['name'];
    $catAbout = $categoryInfo[0]['about'];

    $query = "SELECT type, link
              FROM prod_category_settings
              WHERE cat_id = '".$_GET['cid']."'";
    $query = $el->query($query);
    $catImg = $el->fetch($query);
    $path = "/exam/site/img/cat_img/";
    $catLogo = '';
    $catPromo = '';
    foreach ($catImg as $key => $value) {
      if($value['type'] == 'logo')  $catLogo = $path.$value['link'];
      if($value['type'] == 'promo')  $catPromo = $path.$value['link'];
    }

    $query = "SELECT id as prodid
              FROM products
              WHERE cat_id = '".$catId."'";
    $query = $el->query($query);
    $products = $el->fetch($query);
    $products = confirm_count($products);
    $countOfProducts = count($products);
    $limit = 17;
    $offset = 0;
    $page = 1;

    $query = "SELECT t1.id AS prodId,
                     t1.name AS prodName,
                     t1.about AS prodAbout,
                     t1.cost AS prodCost,
                     t1. corner AS prodCorner
              FROM products AS t1
              WHERE t1.cat_id = '".$catId."' AND
                    (SELECT SUM(count) FROM prod_types WHERE pr_id = t1.id) > 0
              ORDER BY t1.id
              LIMIT '".$limit."'
              OFFSET '".$offset."'";
      $query = $el->query($query);
      $result = $el->fetch($query);
      foreach ($result as $key => $value) {
        $q = "SELECT name FROM prod_photo WHERE pr_id = '".$value['prodid']."'";
        $q = $el->query($q);
        $q = $el->fetch($q)[0];
        $result[$key]['prodphoto'] = $q['name'];
      }
      $el->close();


        // function prnt($q) {
        //   if(is_array($q)) {
        //     echo "<br />----------------------------<br />";
        //     foreach ($q as $key => $value) {
        //       echo "$key";
        //       prnt($value);
        //       echo "<br />";
        //     }
        //   } else {
        //     echo " = ".$q."<br />";
        //   }
        // }
        // prnt($result);
        // exit();

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
