<section class="account-body">
  <div class="user-data">
    <form id="user-data" name="user-data" action="" method="post"></form>
	<div class="personal-data">
	  <p class="title-form">Ваши данные</p>
	  <p class="pre-input">Контактное лицо (ФИО):</p>
      <input form="user-data" type="text" name="fio" value="<?php (isset($user[0]['fio'])) ? echo $user[0]['fio'] : ''; ?>">
      <p class="pre-input">Контактный телефон:</p>
      <input form="user-data" type="text" name="userPhone" value="<?php (isset($user[0]['phone'])) ? echo $user[0]['phone'] : ''; ?>">
      <p class="pre-input">E-mail:</p>
      <input form="user-data" type="email" name="userEmail" value="<?php (isset($login[0]['email'])) ? echo $login[0]['email'] : ''; ?>">
    </div>
	<div class="delivery-addr">
	  <p class="title-form">Адрес доставки</p>
	  <p class="pre-input">город:</p>
      <input form="user-data" type="text" name="fio" value="<?php (isset($addr[0]['city'])) ? echo $addr[0]['city'] : ''; ?>">
      <p class="pre-input">Улица:</p>
      <input form="user-data" type="text" name="userPhone" value="<?php (isset($addr[0]['street'])) ? echo $addr[0]['street'] : ''; ?>">
	  <div class="house">
	    <p class="pre-input">Дом:</p>
        <input form="user-data" type="text" name="fio" value="<?php (isset($addr[0]['house'])) ? echo $addr[0]['house'] : ''; ?>">
	  </div>
	  <div class="apart">
        <p class="pre-input">Квартира:</p>
        <input form="user-data" type="text" name="userPhone" value="<?php (isset($addr[0]['apart'])) ? echo $addr[0]['apart'] : ''; ?>">
	  </div>
	</div>
	<div class="pass-change">
	  <p class="title-form">Изменение пароля</p>
	  <p class="pre-input">Введите новый пароль:</p>
      <input form="user-data" type="password" name="fio" value="">
      <p class="pre-input">Повторите новый пароль:</p>
      <input form="user-data" type="re-password" name="userPhone" value="" onchange="check(this)">
	</div>
	<button form="" type="submit" name="user-data-change" onclick="chekPass()">Сохранить</button>
  </div>

  <div class="user-orders">
    <p class="title-form">Ваши заказы</p>

	<table class="orders-list">
	  	  <tr>
	    <td class="left-cell">
		  <p class="num">№4655</p>
		  <div class="sum">
		    <p class="s">(45 468</p>
			<p class="curr">руб.)</p>
		  </div>
		  <div class="clearfix"></div>
		  <p class="data-time">01.03.2015 в 17:54</p>
		</td>
		<td class="right-cell">
		  <p>Ожидает доставки</p>
		</td>
	  </tr>
	  	  	  <tr>
	    <td class="left-cell">
		  <p class="num">№4655</p>
		  <div class="sum">
		    <p class="s">(45 468</p>
			<p class="curr">руб.)</p>
		  </div>
		  <div class="clearfix"></div>
		  <p class="data-time">01.03.2015 в 17:54</p>
		</td>
		<td class="right-cell">
		  <p>Доставлен</p>
		</td>
	  </tr>
	  	  <tr>
	    <td class="left-cell">
		  <p class="num">№4655</p>
		  <div class="sum">
		    <p class="s">(45 468</p>
			<p class="curr">руб.)</p>
		  </div>
		  <div class="clearfix"></div>
		  <p class="data-time">01.03.2015 в 17:54</p>
		</td>
		<td class="right-cell">
		  <p>Доставлен</p>
		</td>
	  </tr>
	</table>

  </div>
  <div class="clearfix"></div>
</section>
<script type="text/javascript">
function checkPass() {
  var pas = document.querySelector("input[name='password']");
  var rPas = document.querySelector("input[name='re-password']");
  if(pas.value === rPas.value && pas.vale != "") {
    var but = document.querySelector("button[name='user-data-change']");
    but.setAttribute('form', 'user-data');
  } else preventDefault();
}
function check(el) {
  var pas = document.querySelector("input[name='password']");
  if(pas.value !== el.value || pas.value == "") {
    el.style.backgroundColor = 'red';
  } else {
    pas.style.backgroundColor = "green";
    el.style.backgroundColor = "green";
    setTimeout(function(){
      pas.style.backgroundColor = "#e9e9e9";
      el.style.backgroundColor = "#e9e9e9";
    }, 1000);
  }
}
</script>
