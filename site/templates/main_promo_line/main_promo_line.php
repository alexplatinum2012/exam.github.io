<?php
    $thisPromoArr = Array();
    $assocArr = Array('first', 'second', 'third');
		if(count($mainPromo) > 1) {
      for ($i = 1; $i < count($mainPromo); $i++) {
        $thisPromoArr[] = $mainPromo[$i];
      }
    }

    ?>
      <section class="promo-line">
        <?php
          foreach ($thisPromoArr as $key => $value) { ?>
            <div class="<?php echo $assocArr[$key]; ?>-promo">
              <a class="feeling" href="<?php echo 'product.php?pid='.$value['pr_id']; ?>"></a>
              <img src="<?php echo './img/main_promo_img/'.$value['link']; ?>" alt="promo_line_<?php echo $assocArr[$key]; ?>">
              <div class="promo-title">
                <p class="first-line"><?php echo $value['promo_title1']; ?></p>
                <p class="second-line"><?php echo $value['promo_title2']; ?></p>
              </div>
            </div>
            <?php } ?>

        <!-- <div class="second-promo">
          <img src="img/promo_line_second.jpg" alt="promo_line_second">
          <div class="promo-title">
            <p class="first-line">ЗАГОЛОВОК</p>
            <p class="second-line">ПРОМО-ТОВАРА</p>
          </div>
        </div>
        <div class="third-promo">
          <img src="img/promo_line_third.jpg" alt="promo_line_third">
          <div class="promo-title">
            <p class="first-line">ЗАГОЛОВОК</p>
            <p class="second-line">ПРОМО-ТОВАРА</p>
          </div>
        </div> -->
      </section>
