<form name="product" id="product" target="cart-frame" action="script/header_cart.php" method="post">
  <input form="product" type="hidden" name="pid" value="<?php echo $product[0]['id']; ?>"
</form>
<div class="product-block">
  <div class="photo">
    <div class="photo-view">
      <img src="img/prod_photo/<?php echo $product[0]['photo']; ?>" />
    </div>
    <div class="photo-list">

        <div class="arrow-left">
          <
        </div>
        <div class="carousel">
          <ul class="carousel-list">
            <?php
              foreach ($product as $key => $value) { ?>
                <li class="carousel-list-item"><img src="img/prod_photo/<?php echo $value['photo']; ?>" onclick="ptff(this)" /></li>
              <?php } ?>
          </ul>
        </div>
        <div class="arrow-right">
          >
        </div>
    </div>
  </div>


  <div class="description">
    <div class="product-name">
      <p><?php echo $product[0]['name']; ?></p>
    </div>
    <p class="product-description"><?php echo $product[0]['about']; ?></p>
    <div class="select">
      <p>Выберите вариант:</p>
      <div class="select-holder">
        <select form="product" class="options" name="varId">
          <?php
            foreach ($types as $key => $value) {
              if($value['count'] > 0) { ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['var']; ?></option>
              <?php }
            }
          ?>
        </select>
        <div class="down-arrow">
          <img src="img/down_arrow.png" alt="down_arrow">
        </div>
      </div>
    </div>
  </div>
  <div class="price-delivery">
    <div class="product-price-area">
      <p class="old-price"><?php echo number_format($product[0]['old_cost'], 0, ',', ' ').$siteSettings['curr']; ?></p>
      <p class="current-price"><?php echo number_format($product[0]['cost'], 0, ',', ' ').$siteSettings['curr']; ?></p>
      <div class="product-status-block">
        <img src="img/in_stock.png" alt="in_stock">
        <p class="product-status">Есть в наличии</p>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="product-buy-area">
      <button form="product" type="submit" name="buy">
        <img src="img/buy.png" alt="buy"/>
        КУПИТЬ
      </button>
    </div>
    <div class="info">
      <ul class="info-options-list">
        <?php
          if(isset($productBlocks) && $productBlocks[0] != '') {
            foreach ($productBlocks as $key => $value) { ?>
              <li class="info-options-list-item">
                <div class="img-holder">
                  <img src="<?php echo $iPath.$value['link']; ?>" alt="block<?php echo $value['id']; ?>">
                </div>
                <div class="p-holder">
                  <p><?php echo $value['line1']; ?></p>
                  <p><?php echo $value['line2']; ?></p>
                </div>
              </li>
        <?php
            }
          }
        ?>
      </ul>
    </div>
  </div>
</div>
<script type="text/javascript">
   var div = document.querySelector('div.photo-view');

   function ptff(el) {
     var src = el.getAttribute('src');
     div.innerHTML = "<img src='" + src + "' />";
   }

</script>
