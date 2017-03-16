<div class="wrapper">
  <?php include "templates/header/header.php" ?>

  <div class="category-title">
      <p class="category-title-text">ОФОРМЛЕНИЕ ЗАКАЗА</p>
  </div>

  <div class="checkout-holder">
    <?php
      if($xxx == 1) { ?>
        <header class="checkout-header">
          <p><?php echo $xxx; ?>.</p> <p class="inf">Контактная информация</p>
        </header>
      <?php } elseif ($xxx == 2) { ?>
        <div class="one">
        <p>1.</p> <p class="inf">Контактная информация</p>
        </div>
        <header class="checkout-header">
          <p><?php echo $xxx; ?>.</p> <p class="inf">Информация о доставке</p>
        </header>
      <?php } elseif ($xxx == 3) { ?>
        <div class="one">
        <p>1.</p> <p class="inf">Контактная информация</p>
        </div>
        <div class="two">
          <p>2.</p> <p class="inf">Информация о доставке</p>
        </div>
        <header class="checkout-header">
          <p><?php echo $xxx; ?>.</p> <p class="inf">Подтверждение заказа</p>
        </header>
      <?php } else { ?>
        <header class="checkout-header">
          <p>1.</p> <p class="inf">Контактная информация</p>
        </header>
      <?php }  ?>

    <?php include "templates/checkout/checkout".$xxx.".php"; ?>
<div class="clearfix"></div>

    <?php
      if($xxx == 1) { ?>
        <div class="two">
          <p>2.</p> <p class="inf">Информация о доставке</p>
        </div>
        <div class="three">
          <p>3.</p> <p class="inf">Подтверждение заказа</p>
        </div>
        <div class="clearfix"></div>
      <?php } elseif ($xxx == 2) { ?>
        <div class="three">
          <p>3.</p> <p class="inf">Подтверждение заказа</p>
        </div>
        <div class="clearfix"></div>
      <?php } elseif ($xxx == 3) {?>
        <div class="clearfix"></div>
      <?php } else { ?>
        <div class="two">
          <p>2.</p> <p class="inf">Информация о доставке</p>
        </div>
        <div class="three">
          <p>3.</p> <p class="inf">Подтверждение заказа</p>
        </div>
        <div class="clearfix"></div>
      <?php }  ?>

  </div>


<?php include "templates/footer/footer.php" ?>
</div>
