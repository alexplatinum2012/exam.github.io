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
    echo "TUT ENTER";

    echo "<br />START<br />";

    echo "<p style='color:white'>COOKIE = ".isset($_COOKIE['cart'])."<br /> SESSION = ".isset($_SESSION['cart'])."</p>";




    if(isset($_COOKIE['cart']) && isset($_SESSION['cart'])) {
      echo "TUT1";
      $cartCookie = unserialize($_COOKIE['cart']);
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
          //echo $cartCookie['info'];
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
    }
    if(!isset($_COOKIE['cart']) && !isset($_SESSION['cart'])) {
      echo "TUT2";
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
      if(!isset($_COOKIE['cart']) && isset($_SESSION['cart'])) {
        echo "TUT3";
        $cartCookie = array();
        $cartCookie['id'] = $uid;
        $cartCookie['info'] = array(array(
                                          'prid' => $_POST['pid'],
                                          'varid' => $_POST['varId'],
                                          'count' => 1
                                          )
                                    );
        $_SESSION['cart'] = serialize($cartCookie);
      }
    @@include_once "DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    // $cart = (isset($_COOKIE['cart'])) ?
    //                                     unserialize($_COOKIE['cart']) :
    //                                     (isset($_SESSION['cart'])) ?
    //                                                                 unserialize($_SESSION['cart']) :
    //                                                                 0;
    if(isset($_COOKIE['cart']))  $cart = unserialize($_COOKIE['cart']);
    elseif(isset($_SESSION['cart'])) $cart = unserialize($_SESSION['cart']);
    else  $cart = 0;
    //echo "234324324234342342423 - ".$cart; exit();
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
    ?>
      <div id="right-cart" class="right-cart">
        <a class="cart-link" href="cart.php?uid=<?php echo $uid ?>"></a>
        <div class="cart-price">
          <p class="sum-price"><?php echo number_format($summ, 0, ',', ' '); ?></p><p class="sum-curr">руб.</p>
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
