<section class="login-body">
  <div class="sign-in">
    <form id="sign-in" name="sign-in" action="script/login.php" method="post"></form>
	<p class="title-form">Зарегистрированный пользователь</p>
	<p class="pre-input">Ваш адрес:</p>
    <input form="sign-in" type="email" name="email" value="">
    <p class="pre-input">Пароль:</p>
    <input form="sign-in" type="password" name="password" value="">
	<button form="sign-in" type="submit" name="user-data-change">Войти</button>
	<a href="#">Забыли пароль?</a>
  </div>
  <div class="sign-up">
    <p class="title-form">Новый пользователь</p>
	<a class="button" href="<?php if(isset($_GET['e'])) echo 'register.php?e='.$_GET['e']; else echo 'register.php'; ?>">Зарегистрироваться</a>
  </div>
  <div class="clearfix"></div>
</section>
