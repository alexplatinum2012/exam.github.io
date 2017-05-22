<?php
@@session_start();
date_default_timezone_set('Europe/Moscow');
include_once "script/DB_operations.php";
$el = new dba;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$query = "SELECT id, name FROM prod_category ORDER BY name";
$query = $el->query($query);
$dbAnswer = $el->fetch($query);

$query = "SELECT *
          FROM site_settings";
$query = $el->query($query);
$siteSettings = $el->fetch($query)[0];
$el->close();
$siteName = explode(' ', $siteSettings['name']);
?>

<header class="header">
  <div class="header-logo">
    <p class="logo-first-line"><?php echo $siteName[0]; ?></p>
    <p class="logo-second-line"><?php echo $siteName[1]; ?></p>
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
      <?php
        if(isset($_SESSION['id']) && $_SESSION['id'] != "" || isset($_SESSION['tmp']) && $_SESSION['tmp'] != "") {
          ?>
          <a class="cart-link" href="cart.php?uid=<?php if(isset($_SESSION['tmp']))
                                                          echo $_SESSION['tmp'];
                                                        elseif(isset($_SESSION['id']))
                                                          echo $_SESSION['id']; ?>"></a>
        <?php
           if(!isset($_SESSION['id']) && isset($_SESSION['tmp']))  $uid = $_SESSION['tmp'];
           if(isset($_SESSION['id'])) $uid = $_SESSION['id'];
           if(!isset($_COOKIE['cart']) && isset($_SESSION['cart'])) {
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
           elseif(isset($_COOKIE['cart']) && isset($_SESSION['cart'])) {
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
         }
      ?>
      <div class="cart-price">
        <p class="sum-price"><?php if(isset($summ)) echo number_format($summ, 0, ',', ' '); else echo 0; ?></p><p class="sum-curr"><?php echo $siteSettings['curr']; ?></p>
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
