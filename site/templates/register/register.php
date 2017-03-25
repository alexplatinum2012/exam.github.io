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
    <input form="register" type="password" name="re-password" value="" required="yes" onchange="check(this)" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$">
  </div>
  <div class="clearfix"></div>
</section>

<!-- work with errors by _GET massive after reg.php (err=0 - pas; err=1 - name; err=2 - email)!!!!!!! -->
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
