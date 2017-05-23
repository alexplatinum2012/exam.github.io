<?php
		$thisPromo1 = (isset($mainPromo[0]) && $mainPromo[0] != '') ? $mainPromo[0] : false;
		if($thisPromo1) {
			$promoLine1 = $thisPromo1['promo_title1'];
			$promoLine2 = $thisPromo1['promo_title2'];
			$about = $thisPromo1['about'];
			$link = "product.php?pid=".$thisPromo1['pr_id'];
		} ?>
	  <div class="promo">
        <p class="promo-first-line"><?php echo $promoLine1; ?></p>
        <p class="promo-second-line"><?php echo $promoLine2; ?></p>
        <p class="promo-third-line"><?php echo $about; ?></p>
        <div class="promo-look">
          <button type="button" name="button"><a class="button" href="<?php echo $link; ?>">Посмотреть  +</a></button>
        </div>
      </div>
