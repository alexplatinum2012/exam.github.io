


<div class="wrapper">
  <?php include "templates/header/header.php" ?>

  <div class="category-title">
      <p class="category-title-text">ВХОД</p>
  </div>

  <div class="login-holder">
    <?php include "templates/login/login.php"; ?>
  </div>
  <?php if(isset($_GET['e'])) { ?>
          <script type="text/javascript">
            var inpEmail = document.querySelector("input[type='email']");
            inpEmail.value = "<?php echo $_GET['e']; ?>";
            inpEmail.style.backgroundColor = "rgba(255, 0, 0, 0.47)";
            setTimeout(function(){inpEmail.style.backgroundColor = "#e9e9e9";}, 3000);
            var div = document.createElement('div');
            div.setAttribute('style','position: fixed; top: 50%; left: 40%; z-index: 1111; width: 217px; background-color: #ffffff; text-align: center; font-size: 24px; box-shadow: 0px 0px 15px red; border-radius: 10px;');
            div.innerHTML = 'Пользователь с таким e-mail не зарегистрирован!';
            div = document.body.appendChild(div);
            setTimeout(function(){document.body.removeChild(div);}, 3000);
        </script>
  <?php } elseif(isset($_GET['err'])) {
            if($_GET['err'] == 0) { ?>
              <script type="text/javascript">

              var inpEmail = document.querySelector("input[type='email']");
              setTimeout(function(){inpEmail.style.backgroundColor = "#e9e9e9";}, 3000);
              var div = document.createElement('div');
              div.setAttribute('style','position: fixed; top: 50%; left: 40%; z-index: 1111; width: 217px; background-color: #ffffff; text-align: center; font-size: 24px; box-shadow: 0px 0px 15px red; border-radius: 10px;');
              div.innerHTML = 'Извените, произошла непредвиденная ошибка!<br />Попробуйте еще раз.';
              div = document.body.appendChild(div);
              setTimeout(function(){document.body.removeChild(div);}, 3000);
            </script>
    <?php }
        } ?>


<?php include "templates/footer/footer.php" ?>
</div>
