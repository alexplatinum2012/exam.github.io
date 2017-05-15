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
  <script type="text/javascript">
    var ul = document.querySelector("ul.carousel-list");
    ul.style.width = "<?php if(isset($width)) echo $width.'px'; else echo '300px'; ?>";
    var leftArrowDiv = document.querySelector(".photo-list div.arrow-left");
    var rightArrowDiv = document.querySelector(".photo-list div.arrow-right");
    if(parseInt(ul.style.width) > 300) {
      rightArrowDiv.style.color = '#000000';
      rightArrowDiv.style.cursor = 'pointer';
    }

    leftArrowDiv.onclick = function(e) {
      if(e.target.tagName === "DIV") {
        photoMoover(1);
      }
    }
    rightArrowDiv.onclick = function(e) {
      if(e.target.tagName === "DIV") {
        photoMoover(-1);
      }
    }
    function photoMoover(direction) {
      var width = parseFloat(ul.style.width);
      var mLeft = (ul.style.marginLeft == "") ? 0 : parseFloat(ul.style.marginLeft);
      var maxMLeft = width - ((width >= 300) ? 300 : width);
      if(maxMLeft == 0) return;
      var minMLeft = 0;
      var step = 225;

      var newMLeft = mLeft + (step * direction);
      if(newMLeft >= 0) {
        newMLeft = 0;
        rightArrowDiv.style.color = '#000000';
        rightArrowDiv.style.cursor = 'pointer';
        leftArrowDiv.style.color = '#cccccc';
        leftArrowDiv.style.cursor = 'default';
      }
      if(newMLeft < 0 && (newMLeft * -1) < maxMLeft) {
        rightArrowDiv.style.color = '#000000';
        rightArrowDiv.style.cursor = 'pointer';
        leftArrowDiv.style.color = '#000000';
        leftArrowDiv.style.cursor = 'pointer';
      }
      if((newMLeft * -1) >= maxMLeft) {
        newMLeft = maxMLeft * -1;
        rightArrowDiv.style.color = '#cccccc';
        rightArrowDiv.style.cursor = 'default';
        leftArrowDiv.style.color = '#000000';
        leftArrowDiv.style.cursor = 'pointer';
      }
      ul.style.marginLeft = newMLeft + "px";
    }
  </script>

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
      <p class="old-price">9 990</p>
      <p class="current-price"><?php echo number_format($product[0]['cost'], 0, ',', ' '); ?></p>
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
        <li class="info-options-list-item">
          <div class="img-holder">
            <img src="img/delivery.png" alt="">
          </div>
          <div class="p-holder">
            <p>БЕСПЛАТНАЯ ДОСТАВКА</p>
            <p>по всей России</p>
          </div>
        </li>
        <li class="info-options-list-item">
          <div class="img-holder">
            <img src="img/hot_line.png" alt="">
          </div>
          <div class="p-holder">
            <p>ГОРЯЧАЯ ЛИНИЯ</p>
            <p><a href="tel: 880000000">880000000</a></p>
          </div>
        </li>
        <li class="info-options-list-item">
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
