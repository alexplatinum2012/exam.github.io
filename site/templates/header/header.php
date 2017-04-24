<?php
@@session_start();
function delCartByTime ($uid) {
  @@include_once "script/DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "DELETE
            FROM cart
            WHERE u_id = '".$uid."'";
  $query = $el->query($query);
}
define('SESSION_LIFE_TIME', '1800');
date_default_timezone_set('Europe/Moscow');

/*if(isset($_SESSION['tmpLim'])) {
  $now = date("dHis");
  $targ = $_SESSION['tmpLim'];
  if($now > $targ) {
    delCartByTime($_SESSION['tmp']);
    unset($_SESSION['tmpLim']);
    unset($_SESSION['tmp']);
    header("refresh:0;url=login.php");
    exit();
  } else {
    $_SESSION['tmpLim'] = date('dHis', time() + SESSION_LIFE_TIME);

  }
}
if(isset($_SESSION['idLim'])) {
  $now = date("dHis");
  $targ = $_SESSION['idLim'];
  if($now > $targ) {
    delCartByTime($_SESSION['id']);
    unset($_SESSION['idLim']);
    unset($_SESSION['id']);
    header("refresh:0;url=login.php");
    exit();
  } else {
    $_SESSION['idLim'] = date('dHis', time() + SESSION_LIFE_TIME);
  }
}*/
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
    <iframe id="cart-frame" name="cart-frame"></iframe>
    <div id="right-cart" class="right-cart">
      <?php //include_once "script/header_cart.php"; ?>
      <?php
        if(isset($_SESSION['id']) && $_SESSION['id'] != "" || isset($_SESSION['tmp']) && $_SESSION['tmp'] != "") {
          ?>
          <a class="cart-link" href="cart.php?uid=<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']; elseif(isset($_SESSION['id'])) echo $_SESSION['id']; ?>"></a>
        <?php
           if(!isset($_SESSION['id']) && isset($_SESSION['tmp']))  $uid = $_SESSION['tmp'];
           if(isset($_SESSION['id'])) $uid = $_SESSION['id'];
           //echo "HREN"; exit();
           if(!isset($_COOKIE['cart']) && isset($_SESSION['cart'])) {
             echo "HREN1";
             $cart = unserialize($_SESSION['cart']);
             if($cart['id'] == $uid) {
               @@include_once "DB_operations.php";
               $el = new dba;
               $el->connect();
               if($el->database === false) echo "ERROR conect to DB";
               $summ = 0;
               $count = 0;
               foreach ($cart['info'] as $key => $value) {
                 $query = "SELECT cost
                 FROM products
                 WHERE id = '".$value['prid']."'";
                 $query = $el->query($query);
                 $query = $el->fetch($query);
                 $summ += ($query[0]['cost'] * $value['count']);
                 $count += $value['count'];
               }
               $el->close();
               if($count < 1 || $count > 4)  $countText = $count." предметов";
               elseif($count == 1)           $countText = $count.' предмет';
               else                          $countText = $count.' предмета';
             }
           }
           elseif(isset($_COOKIE['cart'])) {
             echo "HREN2";
             $cart = unserialize($_COOKIE['cart']);
             if($cart['id'] == $uid) {
               @@include_once "DB_operations.php";
               $el = new dba;
               $el->connect();
               if($el->database === false) echo "ERROR conect to DB";
               $summ = 0;
               $count = 0;
               foreach ($cart['info'] as $key => $value) {
                 $query = "SELECT cost
                 FROM products
                 WHERE id = '".$value['prid']."'";
                 $query = $el->query($query);
                 $query = $el->fetch($query);
                 $summ += ($query[0]['cost'] * $value['count']);
                 $count += $value['count'];
               }
               $el->close();
               if($count < 1 || $count > 4)  $countText = $count." предметов";
               elseif($count == 1)           $countText = $count.' предмет';
               else                          $countText = $count.' предмета';
             }
           }
         }
      ?>
      <div class="cart-price">
        <p class="sum-price"><?php if(isset($summ)) echo number_format($summ, 0, ',', ' '); else echo 0; ?></p><p class="sum-curr">руб.</p>
        <p class="count-products"><?php if(isset($countText)) echo $countText; else echo '0 предметов'; ?></p>
      </div>
      <div class="cart-icon">
        <img src="<?php if(isset($count) && $count > 0) echo 'img/cart_icon_active.png'; else echo 'img/cart_icon.png'; ?>" alt="cart_icon">
      </div>
      <div class="clearfix"></div>
    </div>


  </div>
  <script type="text/javascript">
    var frame = document.getElementById('cart-frame');
    var divCart = document.getElementById('right-cart');

    frame.onload = function() {
      divCart.innerHTML = this.contentDocument.body.innerHTML;
    }
  </script>
</header>
