<form name="product" id="product" action="index.html" method="post">
  <input type="hidden" name="productID" value="<?php echo $productID; ?>">

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
        <select form="product" class="options" name="">
          <?php
            $i = 1;
            foreach ($types as $key => $value) {
              if($value['count'] > 0) { ?>
              <option value="<?php echo $i++; ?>"><?php echo $value['var']; ?></option>
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
      <p class="old-price">9 990</p>
      <p class="current-price"><?php echo $product[0]['cost']; ?></p>
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
        <li class="info-options-list-item-delivery">
          <div class="img-holder">
            <img src="img/delivery.png" alt="">
          </div>
          <div class="p-holder">
            <p>БЕСПЛАТНАЯ ДОСТАВКА</p>
            <p>по всей России</p>
          </div>
        </li>
        <li class="info-options-list-item-hotline">
          <div class="img-holder">
            <img src="img/hot_line.png" alt="">
          </div>
          <div class="p-holder">
            <p>ГОРЯЧАЯ ЛИНИЯ</p>
            <p><a href="tel: 880000000">880000000</a></p>
          </div>
        </li>
        <li class="info-options-list-item-gift">
          <div class="img-holder">
            <img src="img/gift.png" alt="">
          </div>
          <div class="p-holder">
            <p>ПОДАРКИ</p>
            <p>каждому покупателю</p>
          </div>
        </li>
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
