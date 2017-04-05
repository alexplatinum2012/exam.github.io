<?php
  @@session_start();
  date_default_timezone_set('Europe/Moscow');
  if(!isset($_SESSION['id'])) {
    if(!isset($_SESSION['tmp'])) {
       $_SESSION['tmp'] = rand();
       $_SESSION['tmpLim'] = date("dHis", time() + 1800);
    }
  }
  if(isset($_POST['pid']) && $_POST['pid'] != "" && isset($_POST['varId']) && $_POST['varId'] != "") {
    if(!isset($_SESSION['id']) && isset($_SESSION['tmp'])) {
      $uid = $_SESSION['tmp'];
      $_SESSION['tmpLim'] = date("dHis", time() + 1800);
    }
    if(isset($_SESSION['id'])) {
      $uid = $_SESSION['id'];
      $_SESSION['idLim'] = date("dHis", time() + 1800);
    }
    @@include_once "DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "INSERT INTO cart (pr_id, u_id, var_id)
    VALUES ('".$_POST['pid']."', '".$uid."', '".$_POST['varId']."')";
    $query = $el->query($query);
    $query = "SELECT SUM (t1.cost),
                     COUNT (t2.id)
              FROM products as t1,
                   cart as t2
              WHERE t2.pr_id = t1.id AND
                    t2.u_id = '".$uid."'";
    $query = $el->query($query);
    $cartInfo = $el->fetch($query);
    $el->close();
    $summ = $cartInfo[0]['sum'];
    $count = $cartInfo[0]['count'];
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
