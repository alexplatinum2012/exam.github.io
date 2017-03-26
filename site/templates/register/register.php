<section class="register-body">
  <div class="fio-mail">
    <form id="register" name="register" action="script/reg.php" method="post"></form>
	  <p class="pre-input">Контактное лицо (ФИО):</p>
    <input form="register" type="text" name="fio" value="" required="yes">
    <p class="pre-input">E-mail адрес:</p>
    <input form="register" type="email" name="e-mail" value="" required="yes">
	  <button form="" type="submit" name="user-data-change" onclick="checkPass()">Зарегистрироваться</button>
  </div>
  <div class="pass">
    <p class="pre-input">Пароль:</p>
    <input form="register" type="password" name="password" value="" required="yes" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$">
    <p class="pre-input">Повторите пароль:</p>
    <input form="register" type="password" name="re-password" value="" required="yes" onchange="check(this)" disabled="true" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$">
  </div>
  <div class="clearfix"></div>
</section>
<iframe name="ifrEmail" id="ifrEmail"></iframe>
<form id="checkForDuplicate" name="checkForDuplicate" action="script/check_for_duplicate.php" target="ifrEmail" method="post"></form>

<!-- work with errors by _GET massive after reg.php (err=0 - pas; err=1 - name; err=2 - email)!!!!!!! -->
<?php
  if(isset($_GET['err'])) {
    if($_GET['err'] == 0) { ?>
      <script type="text/javascript">
        alert('Пароли не совпадают!');
        var pas = document.querySelector("input[name='password']");
        var rPas = document.querySelector("input[name='re-password']");
        pas.style.backgroundColor = "rgba(255, 0, 0, 0.47)";
        rPas.style.backgroundColor = "rgba(255, 0, 0, 0.47)";
        setTimeout(function(){
          pas.style.backgroundColor = "#e9e9e9";
          rPas.style.backgroundColor = "#e9e9e9";
        }, 1000);
      </script>
  <?php } elseif($_GET['err'] == 1) { ?>
            <script type="text/javascript">
              alert('Пользователь с таким e-mail уже существует!');
              var email = document.querySelector("input[name='e-mail']");
              email.style.backgroundColor = "rgba(255, 0, 0, 0.47)";
              setTimeout(function(){email.style.backgroundColor = "#e9e9e9";}, 1000);
            </script>
  <?php }
} elseif(isset($_GET['e'])) { ?>
   <script type="text/javascript">
     var email = document.querySelector("input[name='e-mail']");
     email.value = <?php echo $_GET['e']; ?> ;
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
      div.setAttribute('style','position: fixed; top: 55%; left: 80%; z-index: 1111; width: 217px; background-color: #ffffff; text-align: center; font-size: 24px; box-shadow: 0px 0px 15px red; border-radius: 10px;');
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
      div.innerHTML = 'E-mail уже используется!';
      div = document.body.appendChild(div);
      setTimeout(function(){document.body.removeChild(div);}, 3000);
    }
    else  inpEmail.setAttribute('form', 'register');
  }
</script>
