<?php
@@session_start();
if(isset($_GET['pid']) && $_GET['pid'] != "" && isset($_GET['vid']) && $_GET['vid'] != "") {
  $uid = (isset($_SESSION['id']) ? $_SESSION['id'] : $_SESSION['tmp']);
  include_once "DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
//  $query = "DELETE
//            FROM cart
//            WHERE pr_id = '".$_GET['pid']."' AND
//                  var_id = '".$_GET['vid']."' AND
//                  u_id = '".$uid."'";
//  $query = $el->query($query);
  //echo "pid = ".$_GET['pid']."; vid = ".$_GET['vid']."; uid = ".$uid.";";
  $delCart = unserialize($_SESSION['cart']);
  $cartInfo = $delCart['info'];
  for ($i = 0; $i < count($cartInfo); $i++) {
      if($cartInfo[$i]['prid'] == $_GET['pid'] && $cartInfo[$i]['varid'] == $_GET['vid']) 
          unset($cartInfo[$i]);
  }
  $summ = 0;
  $count = 0;
  foreach ($cartInfo as $key => $value) {
    $query = "SELECT cost
    FROM products
    WHERE id = '".$value['prid']."'";
    $query = $el->query($query);
    $query = $el->fetch($query);
    $summ += ($query[0]['cost'] * $value['count']);
    $count += $value['count'];
  }
  $el->close();
  $delCart['info'] = $cartInfo;
  $_SESSION['cart'] = serialize($delCart);
  setcookie('cart', $_SESSION['cart']);
  
  if($count < 1 || $count > 4)  $countText = $count." предметов";
  elseif($count == 1)           $countText = $count.' предмет';
  else                          $countText = $count.' предмета';
  ?>
    <div id="right-cart" class="right-cart">
      <a class="cart-link" <?php if($count > 0) echo "href = cart.php?uid=$uid"; else echo '';?>></a>
      <div class="cart-price">
        <p class="sum-price"><?php echo number_format($summ, 0, ',', ' '); ?></p><p class="sum-curr">руб.</p>
        <p class="count-products"><?php echo $countText; ?></p>
      </div>
      <div class="cart-icon">
        <img src="<?php if($count > 0) echo 'img/cart_icon_active.png'; else echo 'img/cart_icon.png'; ?>" alt="cart_icon">
      </div>
      <div class="clearfix"></div>
    </div>
    
<?php } ?>
