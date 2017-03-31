<?php
session_start();
include_once "script/DB_operations.php";
$el = new dba;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$query = "SELECT id, name FROM prod_category ORDER BY name";
$query = $el->query($query);
$dbAnswer = $el->fetch($query);
$el->close();
?>

<header class="header">
  <div class="header-logo">
    <p class="logo-first-line">SUPER</p>
    <p class="logo-second-line">SHOP</p>
    <a href="index.php"></a>
  </div>
  <div class="header-menu">
    <ul class="inline-list">
    <?php
      foreach ($dbAnswer as $key => $value) {?>
        <li class="inline-list-item"><a href="category.php?cid=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <div class="header-right">
    <div class="right-user">
      <div class="user-icon">
        <img src="img/header_user_icon.png" alt="user_icon">
      </div>
      <ul class="inline-list">
        <?php if(isset($_SESSION['id']) && $_SESSION['id'] != "") {
                $el = new dba;
                $el->connect();
                if($el->database === false) echo "ERROR conect to DB";
                $query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
                $query = $el->query($query);
                $user = $el->fetch($query);
                $fio = explode(' ', $user[0]['fio']);
                echo "<li><a href='account.php?uid=".$user[0]['id']."'>".$fio[1]."</a></li>";
                echo "<li><a id='logout' href='script/logout.php'>Выйти</a></li>";
              }  else
                  echo "<li><a href='login.php'>Войти</a></li>
                        <li><a href='register.php'>Регистрация</a></li>";
        ?>
      </ul>
    </div>
    <div class="right-cart">
      <div class="cart-price">
        <p class="sum-price">46 900</p><p class="sum-curr">руб.</p>
        <p class="count-products">2 предмета</p>
      </div>
      <div class="cart-icon">
        <img src="img/cart_icon.png" alt="cart_icon">
      </div>
    </div>

  </div>
</header>
