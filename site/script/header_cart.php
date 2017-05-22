<?php
  @@session_start();
  date_default_timezone_set('Europe/Moscow');
  if(!isset($_SESSION['id'])) {
    if(!isset($_SESSION['tmp'])) {
       $_SESSION['tmp'] = rand();
    }
  }

  if(isset($_POST['pid']) && $_POST['pid'] != "" && isset($_POST['varId']) && $_POST['varId'] != "") {
    if(isset($_SESSION['id'])) {
      $uid = $_SESSION['id'];
    } elseif(!isset($_SESSION['id']) && isset($_SESSION['tmp'])) {
      $uid = $_SESSION['tmp'];
    }
    if(isset($_COOKIE['cart']) && !isset($_SESSION['cart']))  unset($_COOKIE['cart']);
    if((isset($_COOKIE['cart']) && isset($_SESSION['cart'])) || isset($_SESSION['cart'])) {
      //echo  "TUT"; exit();
      $cartCookie = unserialize($_SESSION['cart']);
      if($cartCookie['id'] != $uid) {
        $cartCookie['id'] = $uid;
        $cartCookie['info'] = array(array(
                                          'prid' => $_POST['pid'],
                                          'varid' => $_POST['varId'],
                                          'count' => 1
                                          )
                                    );
      } elseif ($cartCookie['id'] == $uid) {
          $flag = false;
          for($i = 0; $i < count($cartCookie['info']); $i++) {
            if($cartCookie['info'][$i]['prid'] == $_POST['pid'] && $cartCookie['info'][$i]['varid'] == $_POST['varId']) {
              $cartCookie['info'][$i]['count']++;
              $flag = true;
            }
          }
          if(!$flag) {
            $cartCookie['info'][] = array(
                                          'prid' => $_POST['pid'],
                                          'varid' => $_POST['varId'],
                                          'count' => 1
                                          );
          }
      }
      setcookie("cart", serialize($cartCookie));
      $_SESSION['cart'] = serialize($cartCookie);
    } elseif(!isset($_COOKIE['cart']) && !isset($_SESSION['cart'])) {
      //echo  "TUT"; exit();
        $cartCookie = array();
        $cartCookie['id'] = $uid;
        $cartCookie['info'] = array(array(
                                          'prid' => $_POST['pid'],
                                          'varid' => $_POST['varId'],
                                          'count' => 1
                                          )
                                    );
        setcookie("cart", serialize($cartCookie));
        $_SESSION['cart'] = serialize($cartCookie);
      }
//echo  "TUT"; exit();
    @@include_once "DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    if(isset($_SESSION['cart']))  $cart = unserialize($_SESSION['cart']);
    elseif(!isset($_SESSION['cart']) && isset($_COOKIE['cart'])) $cart = unserialize($_COOKIE['cart']);
    else  $cart = 0;
    $summ = 0;
    $count = 0;
    if($cart != 0) {
      foreach ($cart['info'] as $key => $value) {
        $query = "SELECT cost
                  FROM products
                  WHERE id = '".$value['prid']."'";
        $query = $el->query($query);
        $query = $el->fetch($query);
        $summ += ($query[0]['cost'] * $value['count']);
        $count += $value['count'];
      }
    }

    if($count < 1 || $count > 4)  $countText = $count." предметов";
    elseif($count == 1)           $countText = $count.' предмет';
    else                          $countText = $count.' предмета';

    $query = "SELECT curr
              FROM site_settings";
    $query = $el->query($query);
    $siteSettings = $el->fetch($query)[0];
    $el->close();
    ?>
      <div id="right-cart" class="right-cart">
        <a class="cart-link" href="cart.php?uid=<?php echo $uid ?>"></a>
        <div class="cart-price">
          <p class="sum-price"><?php echo number_format($summ, 0, ',', ' '); ?></p><p class="sum-curr"><?php echo $siteSettings['curr']; ?></p>
          <p class="count-products"><?php echo $countText; ?></p>
        </div>
        <div class="cart-icon">
          <img src="<?php if($count > 0) echo 'img/cart_icon_active.png'; else echo 'img/cart_icon.png'; ?>" alt="cart_icon">
        </div>
        <div class="clearfix"></div>
      </div>
    <?php
  }


?>
