<?php
  include_once "./script/DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $q = "SELECT *
        FROM main_promo
        ORDER BY id";
  $q = $el->query($q);
  $mainPromo = $el->fetch($q);
  $iPath = "/exam/site/img/main_promo_img/";
?>




<!--motobyker-->
    <div class="img-wrapper">
      <!-- <img src="img/home_header.jpg" alt="motobyker"> -->
      <img src="<?php echo $iPath.$mainPromo[0]['link']; ?>" alt="motobyker">
    </div>
    <!--end motobyker-->

    <!--Wrapper-->
    <div class="wrapper">
<?php include "templates/header/header.php" ?>

<?php include "templates/main_promo/main_promo.php"; ?>

<?php
  function getKoeff($countElemInRow, $countOfRows, $countOfElements, $widthOfBlock) {
    $part = (($countOfElements % ($countElemInRow * $countOfRows)) >= ($countElemInRow * 2 - 1)) ? 1 : (1 / 4) * ceil($countOfElements % ($countElemInRow * $countOfRows) / 2);
    return $widthOfBlock * (floor($countOfElements / ($countElemInRow * $countOfRows)) + $part);
  }
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
  $headerTitle = "Популярные продукты";
  $curr = "руб.";
  //include_once "script/DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT t1.id as prodId,
                   t1.name as prodName,
                   t1.about as prodAbout,
                   t1.old_cost as old_cost,
                   t1.cost as prodCost,
                   t1.corner as prodCorner
            FROM products as t1
            WHERE t1.corner <> '1' AND
                  -- t2.id in (SELECT DISTINCT pr_id
                  --           FROM prod_photo
                  --           WHERE pr_id = t1.id) AND
                  (SELECT SUM(count) FROM prod_types WHERE pr_id = t1.id) > 0
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
  $width = getKoeff(4, 2, count($result), 1170);
  include "templates/product_preview/product_preview.php";
?>

<?php
  include "templates/main_promo_line/main_promo_line.php";

  $headerTitle = "Новые продукты";
  $curr = "руб.";
  include_once "script/DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT t1.id as prodId,
                   t1.name as prodName,
                   t1.about as prodAbout,
                   t1.old_cost as old_cost,
                   t1.cost as prodCost,
                   t1.corner as prodCorner
            FROM products as t1
            WHERE t1.corner = '2' AND
                  -- t2.id in (SELECT DISTINCT pr_id
                  --           FROM prod_photo
                  --           WHERE pr_id = t1.id) AND
                  (SELECT SUM(count) FROM prod_types WHERE pr_id = t1.id) > 0
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
  unset($el);
  $width = getKoeff(4, 2, count($result), 1170);

  include "templates/product_preview/product_preview.php";
  include "templates/main_about/main_about.php";
  include "templates/footer/footer.php"
?>
</div>
    <!--End wrapper-->
