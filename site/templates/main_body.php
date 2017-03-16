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
      $headerTitle = "Новые продукты";
      $curr = "руб.";
      $mas['product_status'] = 'new';
      $mas['product_image'] = "products/Вейкборды/1_1.jpg";
      $mas['product_name'] = "СНОУБОРД BURTON GENIE (13-14)";
      $mas['product_price'] = "15 980";
	  $mas['product_old_price'] = "";
      $db_answer[] = $mas;
      $mas['product_status'] = 'sale';
      $db_answer[] = $mas;
      $mas['product_status'] = 'hot';
      $db_answer[] = $mas;
      $mas['product_status'] = 'hot';
      $db_answer[] = $mas;
	  $db_answer[] = $mas;
      $mas['product_status'] = 'sale';
      $db_answer[] = $mas;
      $mas['product_status'] = 'hot';
	  $mas['product_old_price'] = "20 000";
      $db_answer[] = $mas;
      $mas['product_status'] = 'hot';
      $db_answer[] = $mas;
      include "templates/product_preview/product_preview.php"
      ?>

<?php include "templates/main_promo_line/main_promo_line.php"; ?>

	  <?php      
	  $headerTitle = "Популярные товары";
      $curr = "руб.";
      include "templates/product_preview/product_preview.php";
	  ?>
      
<?php include "templates/main_about/main_about.php"; ?>


  <?php include "templates/footer/footer.php" ?>
</div>
    <!--End wrapper-->