<section class="checkout-body">
  <div class="destination-addr">
    <form id="create-order" name="destination-addr" action="" method="post">
      <?php
        foreach ($_POST as $key => $value) {
          if($key == 'page-num') $value = 3; ?>
          <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php } ?>
    </form>
    <p class="title-form">Адрес доставки</p>
    <p class="pre-input">Город:</p>
    <input form="create-order" type="text" name="city" value="<?php echo $city; ?>">
    <p class="pre-input">Улица:</p>
    <input form="create-order" type="text" name="street" value="<?php echo $street; ?>">
	<div class="house-apart">
	  <div class="house">
        <p class="pre-input">Дом:</p>
        <input form="create-order" type="text" name="house" value="<?php echo $house; ?>">
	  </div>
	  <div class="apart">
	    <p class="pre-input">Квартира:</p>
	    <input form="create-order" type="text" name="apart" value="<?php echo $apart; ?>">
	  </div>
	</div>
	<div class="clearfix"></div>
    <button form="create-order" type="submit">Продолжить</button>
  </div>
  <div class="delivery-type">
	<p class="title-form">Способ доставки</p>
	<label>
	  <input form="create-order" class="radio" type="radio" name="delivery" checked="checked" value="1">
	  <span class="radio-custom"></span>
      <span class="label">Курьерская доставка с оплатой при получении</span>
	</label>
	<label>
	  <input form="create-order" class="radio" type="radio" name="delivery" value="2">
	  <span class="radio-custom"></span>
      <span class="label">Почта Росссии с наложенным платежем</span>
	</label>
	<label>
	  <input form="create-order" class="radio" type="radio" name="delivery" value="3">
	  <span class="radio-custom"></span>
      <span class="label">Доставка через терминалы QIWI Post</span>
	</label>
  </div>
  <div class="comment">
    <p class="title-form">Комментарий к заказу</p>
	<p class="pre-input">Введите Ваш комментарий:</p>
	<textarea form="create-order" name="comment" placeholder="Текст комментария"></textarea>

  </div>

  <div class="clearfix"></div>
</section>
