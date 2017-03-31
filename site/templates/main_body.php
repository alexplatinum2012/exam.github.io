<!--motobyker-->
    <div class="img-wrapper">
      <img src="img/home_header.jpg" alt="motobyker">
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
      $headerTitle = "Популярные продукты";
      $curr = "руб.";
      //include_once "script/DB_operations.php";
      $el = new dba;
      $el->connect();
      if($el->database === false) echo "ERROR conect to DB";
      $query = "SELECT t1.id as prodId,
                       t1.name as prodName,
                       t1.about as prodAbout,
                       t1.cost as prodCost,
                       t1.corner as prodCorner,
                       t2.name as prodPhoto
                FROM products as t1,
                     prod_photo as t2
                WHERE t1.corner <> '1' AND
                      t2.id in (SELECT DISTINCT pr_id
                                FROM prod_photo
                                WHERE pr_id = t1.id)
                ORDER BY t1.id";
        $query = $el->query($query);
        $result = $el->fetch($query);

        $width = getKoeff(4, 2, count($result), 1170);
        //exit();
      include "templates/product_preview/product_preview.php"
      ?>

<?php include "templates/main_promo_line/main_promo_line.php"; ?>
<?php
  $headerTitle = "Новые продукты";
  $curr = "руб.";
  include_once "script/DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT t1.id as prodId,
                   t1.name as prodName,
                   t1.about as prodAbout,
                   t1.cost as prodCost,
                   t1.corner as prodCorner,
                   t2.name as prodPhoto
            FROM products as t1,
                 prod_photo as t2
            WHERE t1.corner = '2' AND
                  t2.id in (SELECT DISTINCT pr_id
                            FROM prod_photo
                            WHERE pr_id = t1.id)
            ORDER BY t1.id";
  $query = $el->query($query);
  $result = $el->fetch($query);
  $el->close();
  $width = getKoeff(4, 2, count($result), 1170);
  include "templates/product_preview/product_preview.php";
?>

<?php include "templates/main_about/main_about.php"; ?>


  <?php include "templates/footer/footer.php" ?>
</div>
    <!--End wrapper-->
