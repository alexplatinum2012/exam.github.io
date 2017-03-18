<section class="checkout-body">
  <div class="destination-addr">
    <form id="destination-addr" name="destination-addr" action="index.html" method="post"></form>
    <p class="title-form">Адрес доставки</p>
    <p class="pre-input">Город:</p>
    <input form="destination-addr" type="text" name="fio" value="">
    <p class="pre-input">Улица:</p>
    <input form="destination-addr" type="text" name="userPhone" value="">
	<div class="house-apart">
	  <div class="house">
        <p class="pre-input">Дом:</p>
        <input form="destination-addr" type="text" name="userEmail" value="">
	  </div>
	  <div class="apart">
	    <p class="pre-input">Квартира:</p>
	    <input form="destination-addr" type="text" name="userEmail" value="">
	  </div>	
	</div>
	<div class="clearfix"></div>
    <button form="new-user" type="submit" name="continue">Продолжить</button>
  </div>
  <div class="delivery-type">
	<p class="title-form">Адрес доставки</p>
	<label>
	  <input form="destination-addr" class="radio" type="radio" name="deliveryType" checked="checked" value="1">
	  <span class="radio-custom"></span>
      <span class="label">Курьерская доставка с оплатой при получении</span>
	</label>
	<label>
	  <input form="destination-addr" class="radio" type="radio" name="deliveryType" value="1">
	  <span class="radio-custom"></span>
      <span class="label">Почта Росссии с наложенным платежем</span>
	</label>
	<label>
	  <input form="destination-addr" class="radio" type="radio" name="deliveryType" value="1">
	  <span class="radio-custom"></span>
      <span class="label">Доставка через терминалы QIWI Post</span>
	</label>
  </div>
  <div class="comment">
    <p class="title-form">Комментарий к заказу</p>
	<p class="pre-input">Введите Ваш комментарий:</p>
	<textarea form="destination-addr" name="comment" placeholder="Текст комментария"></textarea>
  
  </div>

  <div class="clearfix"></div>
</section>
