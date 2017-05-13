<section class="checkout-body">
  <div class="new-user">
    <form id="new-user" name="new-user" action="" method="post">
      <?php
        //foreach ($_POST as $key => $value) {
          //if($key == 'page-num') $value = 2;
        ?>
        <input type="hidden" name="page-num" value="2" />
          <!--input type="hidden" name="<?php //echo $key; ?>" value="<?php //echo $value; ?>"-->
        <?php //} ?>
    </form>
    <p class="title-form">Для новых покупателей</p>
    <p class="pre-input">Контактное лицо (ФИО):</p>
    <input form="new-user" type="text" name="fio" value="<?php if(isset($u_ss['fio'])) echo $u_ss['fio']; else echo ''; ?>">
    <p class="pre-input">Контактный телефон:</p>
    <input form="new-user" type="text" name="userPhone" value="<?php if(isset($u_ss['userPhone'])) echo $u_ss['userPhone']; else echo ''; ?>">
    <p class="pre-input">E-mail:</p>
    <input form="new-user" type="email" name="userEmail" value="<?php if(isset($u_ss['userEmail'])) echo $u_ss['userEmail']; else echo ''; ?>">
    <button form="new-user" type="submit">Продолжить</button>
  </div>
  <div class="quick-enter">
    <form id="quick-enter" name="quick-enter" action="script/login.php" method="post"></form>
    <p class="title-form">Быстрый вход</p>
    <p class="pre-input">Ваш e-mail:</p>
    <input form="quick-enter" type="email" name="email" value="">
    <p class="pre-input">пароль:</p>
    <input form="quick-enter" type="password" name="password" value="">
    <button form="quick-enter" type="submit">Войти</button>
    <a href="#">Восстановить пароль</a>
  </div>
  <div class="clearfix"></div>
</section>
<?php if(isset($_GET['e']) && !isset($_GET['p'])) { ?>
        <script type="text/javascript">
          var inpEmail = document.querySelector("input[type='email'][form='quick-enter']");
          inpEmail.value = "<?php echo $_GET['e']; ?>";
          inpEmail.style.backgroundColor = "rgba(255, 0, 0, 0.47)";
          setTimeout(function(){inpEmail.style.backgroundColor = "#e9e9e9";}, 3000);
          var div = document.createElement('div');
          var boundEmail = inpEmail.getBoundingClientRect();
          div.setAttribute('style','position: relative; top: '+boundEmail.top+'px; left: '+(boundEmail.right + 10)+'px; z-index: 1111; width: 217px; background-color: #ffffff; text-align: center; font-size: 24px; box-shadow: 0px 0px 15px red; border-radius: 10px;');
          div.innerHTML = 'Пользователь с таким e-mail не зарегистрирован!';
          div = document.body.appendChild(div);
          setTimeout(function(){document.body.removeChild(div);}, 3000);
      </script>
<?php } elseif(isset($_GET['err'])) {
          if($_GET['err'] == 0) { ?>
            <script type="text/javascript">

            var inpEmail = document.querySelector("input[type='email'][form='quick-enter']");
            setTimeout(function(){inpEmail.style.backgroundColor = "#e9e9e9";}, 3000);
            var div = document.createElement('div');
            div.setAttribute('style','position: fixed; top: 50%; left: 40%; z-index: 1111; width: 217px; background-color: #ffffff; text-align: center; font-size: 24px; box-shadow: 0px 0px 15px red; border-radius: 10px;');
            div.innerHTML = 'Извините, произошла непредвиденная ошибка!<br />Попробуйте еще раз.';
            div = document.body.appendChild(div);
            setTimeout(function(){document.body.removeChild(div);}, 3000);
          </script>
  <?php }
} elseif(isset($_GET['e']) && isset($_GET['p'])) {
      ?>
      <script type="text/javascript">
        var inpEmail = document.querySelector("input[type='email'][form='quick-enter']");
        inpEmail.value = "<?php echo $_GET['e']; ?>";
        inpEmail = document.querySelector("input[type='password'][form='quick-enter']");
        inpEmail.style.backgroundColor = "rgba(255, 0, 0, 0.47)";
        setTimeout(function(){inpEmail.style.backgroundColor = "#e9e9e9";}, 3000);
        var div = document.createElement('div');
        var boundEmail = inpEmail.getBoundingClientRect();
        div.setAttribute('style','position: fixed; top:'+boundEmail.top+'px; left: '+(boundEmail.right + 10)+'px; z-index: 1111; width: 217px; background-color: #ffffff; text-align: center; font-size: 24px; box-shadow: 0px 0px 15px red; border-radius: 10px;');
        div.innerHTML = 'Пароль неверен!';
        div = document.body.appendChild(div);
        setTimeout(function(){document.body.removeChild(div);}, 3000);
      </script>
      <?php } ?>
