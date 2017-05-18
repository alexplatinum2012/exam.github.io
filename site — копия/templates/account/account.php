<section class="account-body">
  <div class="user-data">
    <form id="user-data" name="user-data" action="script/update_ui.php" method="post"></form>
    <input form="user-data" type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>" />
	<div class="personal-data">
	  <p class="title-form">Ваши данные</p>
	  <p class="pre-input">Контактное лицо (ФИО):</p>
      <input form="user-data" type="text" name="fio" value="<?php if(isset($user[0]['fio'])) echo $user[0]['fio']; else echo ''; ?>" / />
      <p class="pre-input">Контактный телефон:</p>
      <input form="user-data" type="text" name="phone" value="<?php if(isset($user[0]['phone'])) echo $user[0]['phone']; else echo ''; ?>" />
      <p class="pre-input">E-mail:</p>
      <input form="user-data" type="email" name="e-mail" value="<?php if(isset($login[0]['email'])) echo $login[0]['email']; else echo ''; ?>" />
    </div>
	<div class="delivery-addr">
	  <p class="title-form">Адрес доставки</p>
	  <p class="pre-input">город:</p>
      <input form="user-data" type="text" name="city" value="<?php if(isset($user[0]['city'])) echo $user[0]['city']; else echo ''; ?>" />
      <p class="pre-input">Улица:</p>
      <input form="user-data" type="text" name="street" value="<?php if(isset($addr[0]['street'])) echo $addr[0]['street']; else echo ''; ?>" />
	  <div class="house">
	    <p class="pre-input">Дом:</p>
        <input form="user-data" type="text" name="house" value="<?php if(isset($addr[0]['house'])) echo $addr[0]['house']; else echo ''; ?>" />
	  </div>
	  <div class="apart">
        <p class="pre-input">Квартира:</p>
        <input form="user-data" type="text" name="apart" value="<?php if(isset($addr[0]['apart'])) echo $addr[0]['apart']; else echo ''; ?>" />
	  </div>
	</div>
	<div class="pass-change">
	  <p class="title-form">Изменение пароля</p>
	  <p class="pre-input">Введите новый пароль:</p>
    <input form="user-data" type="password" name="password" value="" />
    <p class="pre-input">Повторите новый пароль:</p>
    <input form="user-data" type="password" name="re-password" value="" onchange="check(this)" disabled="true" />
	</div>
	<button form="user-data" type="submit" name="user-data-change">Сохранить</button>
  <iframe name="ifrEmail" id="ifrEmail"></iframe>
  <form id="checkForDuplicate" name="checkForDuplicate" action="script/check_for_duplicate.php" target="ifrEmail" method="post">
    <input type="hidden" name="u-id" value="<?php echo $_GET['uid']; ?>">
  </form>
  </div>

  <div class="user-orders">
    <p class="title-form">Ваши заказы</p>

	<table class="orders-list">
    <?php
    foreach ($allOrders as $key => $value) { ?>
      <tr>
        <td class="left-cell">
          <p class="num">№<?php echo $value['id']; ?></p>
        <div class="sum">
          <p class="s">(<?php echo number_format($value['sum'], 0, ',', ' '); ?></p>
          <p class="curr">руб.)</p>
        </div>
        <div class="clearfix"></div>
          <p class="data-time"><?php echo date("d.m.Y в H:i",strtotime($value['date'].' '.$value['time'])); ?></p>
        </td>
        <td class="right-cell">
          <p><?php echo $value['status']; ?></p>
        </td>
      </tr>
    <?php } ?>
	</table>

  </div>
  <div class="clearfix"></div>
</section>

<!-- work with errors by _GET massive after reg.php (err=0 - pas; err=1 - name; err=2 - email)!!!!!!! -->
  <?php if(isset($_GET['err']) && $_GET['err'] == 1) { ?>
            <script type="text/javascript">
              alert('Вы не можете оставить e-mail пустым, т.к. он нужен Вам для входа в учетную запись!');
              var email = document.querySelector("input[name='e-mail']");
              email.style.backgroundColor = "rgba(255, 0, 0, 0.47)";
              setTimeout(function(){email.style.backgroundColor = "#e9e9e9";}, 1000);
            </script>
  <?php } ?>



<script>
  function checkPass() {
    var pas = document.querySelector("input[name='password']");
    var rPas = document.querySelector("input[name='re-password']");
    if(pas.value === rPas.value && pas.vale != "") {
      var but = document.querySelector("button[name='user-data-change']");
      but.setAttribute('form', 'register');
    } else preventDefault();
  }
  function check(el) {
    var pas = document.querySelector("input[name='password']");
    if(pas.value !== el.value && pas.value != "") {
      el.style.backgroundColor = 'rgba(255, 0, 0, 0.47)';
      setTimeout(function(){el.style.backgroundColor = '#e9e9e9';}, 3000);
      var div = document.createElement('div');
      div.setAttribute('style','position: fixed; top: 55%; left: 40%; z-index: 1111; width: 217px; background-color: #ffffff; text-align: center; font-size: 24px; box-shadow: 0px 0px 15px red; border-radius: 10px;');
      div.innerHTML = 'Пароли не совпадают!';
      div = document.body.appendChild(div);
      setTimeout(function(){document.body.removeChild(div);}, 3000);
    } else {
      pas.style.backgroundColor = "rgba(0, 128, 0, 0.53)";
      el.style.backgroundColor = "rgba(0, 128, 0, 0.53)";
      setTimeout(function(){
        pas.style.backgroundColor = "#e9e9e9";
        el.style.backgroundColor = "#e9e9e9";
      }, 1000);
    }
  }

  ifrEmail = document.getElementById("ifrEmail");
  inpEmail = document.querySelector("input[name='e-mail']");
  inpPassw = document.querySelector("input[name='password']");


  inpPassw.onchange = function(e) {
    inpRePassw = document.querySelector("input[name='re-password']");
    inpRePassw.removeAttribute('disabled');
  }
  inpEmail.onchange = function(e) {
    inpEmail.setAttribute('form', 'checkForDuplicate');
    var form = document.getElementById('checkForDuplicate');
    form.submit();
  }
  ifrEmail.onload = function(e) {
    var info = ifrEmail.contentDocument.body.innerHTML;
    if(info != 'false') {
      inpEmail.style.backgroundColor = "rgba(255, 0, 0, 0.47)";
      setTimeout(function(){inpEmail.style.backgroundColor = "#e9e9e9";}, 3000);
      var div = document.createElement('div');
      div.setAttribute('style','position: fixed; top: 50%; left: 40%; z-index: 1111; width: 217px; background-color: #ffffff; text-align: center; font-size: 24px; box-shadow: 0px 0px 15px red; border-radius: 10px;');
      div.innerHTML = 'E-mail уже зарегистрирован!';
      div = document.body.appendChild(div);
      setTimeout(function(){document.body.removeChild(div);}, 3000);
    }
    else  inpEmail.setAttribute('form', 'user-data');
  }
</script>
