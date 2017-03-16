<form name="product" id="product" action="index.html" method="post">
  <input type="hidden" name="productID" value="<?php echo $productID; ?>">

</form>
<div class="product-block">
  <div class="photo">
    <iframe id="photo-view"></iframe>
    <div class="photo-list">

        <div class="arrow-left">
          <
        </div>
        <div class="carousel">
          <ul class="carousel-list">

            <li class="carousel-list-item">1</li>
            <li class="carousel-list-item">2</li>
            <li class="carousel-list-item">3</li>
            <li class="carousel-list-item">4</li>
            <li class="carousel-list-item">5</li>
            <li class="carousel-list-item">6</li>
            <?php

            ?>
          </ul>
        </div>
        <div class="arrow-right">
          >
        </div>
    </div>
  </div>

  <div class="description">
    <div class="product-name">
      <p>Название товара</p>
    </div>
    <p class="product-description">Описание товара</p>
    <div class="select">
      <p>Выберите вариант:</p>
      <div class="select-holder">
        <select form="product" class="options" name="">
          <option value="1">Размер 1</option>
          <option value="2">Размер 2</option>
          <option value="3">Размер 3</option>
          <option value="4">Размер 4</option>
          <option value="5">Размер 5</option>
          <option value="6">Размер 6</option>
          <option value="7">Размер 7</option>
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
      <p class="current-price"> 4 650</p>
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
