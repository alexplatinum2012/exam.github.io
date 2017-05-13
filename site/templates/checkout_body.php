<?php session_start();
function prnt($q) {
  if(is_array($q)) {
    echo "<br />----------------------------<br />";
    foreach ($q as $key => $value) {
      echo "$key";
      prnt($value);
      echo "<br />";
    }
  } else {
    echo " = ".$q."<br />";
  }
}
  if(stripos($_SERVER['HTTP_REFERER'], 'login') !== false) {
    $xxx = 1;
  }
  else if(isset($_POST['page-num']) && $_POST['page-num'] != "") {
    $xxx = $_POST['page-num'];
    if($xxx == 1) {
        $u_ss = unserialize($_SESSION['cart']);
        $u_sess = $u_ss['info'];
        foreach ($_POST as $key => $value) {
          if(stripos($key, 'arr') !== false) {
            $arr = explode('|', $key);
            $prId = $arr[1];
            $varId = $arr[2];
            $varCount = $value;
            for ($i = 0; $i < count($u_sess); $i++) {
              if($u_sess[$i]['prid'] == $prId && $u_sess[$i]['varid'] == $varId) {
                $u_sess[$i]['count'] = $varCount;
              }
            }
          }
        }
        $u_ss['info'] = $u_sess;
        $_SESSION['cart'] = serialize($u_ss);
        setcookie('cart', $_SESSION['cart']);
    }
    if($xxx > 1) {
      include_once "script/DB_operations.php";
      $el = new dba;
      $el->connect();
      if($el->database === false) echo "ERROR conect to DB";
      if($xxx == 2) {
        $scCart = (isset($_COOKIE['cart']) && $_COOKIE['cart'] === $_SESSION['cart']) ?
                    unserialize($_COOKIE['cart']) : 
                    unserialize($_SESSION['cart']);
        $scCart['u_info'] = array();
        $uInfo = $scCart['u_info'];
        foreach ($_POST as $key => $value) {
            if($key == 'page-num')                continue;
            $uInfo[$key] = $value;
        }
        if(isset($_SESSION['id'])) {
          $query = "SELECT t1.city,
                           t1.fio,
                           t1.phone,
                           t2.street, 
                           t2.house, 
                           t2.apart,
                           t3.email 
          FROM users as t1, 
               user_addr as t2,
               user_login as t3
          WHERE t2.u_id = t1.id AND
                t3.u_id = t1.id AND
                t1.id = '".$_SESSION['id']."'";
          
          $query = $el->query($query);
          $query = $el->fetch($query);
          $city = $uInfo['city'] = $query[0]['city'];
          $street = $uInfo['street'] = $query[0]['street'];
          $house = $uInfo['house'] = $query[0]['house'];
          $apart = $uInfo['apart'] = $query[0]['apart'];
          $uInfo['fio'] = $query[0]['fio'];
          $uInfo['userphone'] = $query[0]['phone'];
          $uInfo['useremail'] = $query[0]['email'];
        } else {
          $city = $uInfo['city'] = '';
          $street = $uInfo['street'] = '';
          $house = $uInfo['house'] = '';
          $apart = $uInfo['apart'] = '';
        }
        $scCart['u_info'] = $uInfo;
        $u_sess = $scCart['info'];
        foreach ($_POST as $key => $value) {
          if(stripos($key, 'arr') !== false) {
            $arr = explode('|', $key);
            $prId = $arr[1];
            $varId = $arr[2];
            $varCount = $value;
            for ($i = 0; $i < count($u_sess); $i++) {
              if($u_sess[$i]['prid'] == $prId && $u_sess[$i]['varid'] == $varId) {
                $u_sess[$i]['count'] = $varCount;
              }
            }
          }
        }
        $scCart['info'] = $u_sess;
        $_SESSION['cart'] = serialize($scCart);
        setcookie('cart', $_SESSION['cart']);
      } elseif($xxx == 3) {
        $scCart = (isset($_COOKIE['cart']) && $_COOKIE['cart'] === $_SESSION['cart']) ?
                    unserialize($_COOKIE['cart']) : 
                    unserialize($_SESSION['cart']);
        $uInfo = $scCart['u_info'];
        foreach ($_POST as $key => $value) {
            if($key == 'page-num')                continue;
            $uInfo[$key] = $value;
        }
        $scCart['u_info'] = $uInfo;
        $_SESSION['cart'] = serialize($scCart);
        setcookie('cart', $_SESSION['cart']);

        $infoOrder = array();
        $prInfo = $scCart['info'];
        for($i = 0; $i < count($prInfo); $i++) {
            $q = "SELECT name AS prodname, 
                         cost AS prodcost 
                  FROM products 
                  WHERE id = '".$prInfo[$i]['prid']."'";
            $q = $el->query($q);
            $q = $el->fetch($q);
            $infoOrder[$i] = $q[0];
            $infoOrder[$i]['varcount'] = $prInfo[$i]['count'];
            $prInfo[$i]['cost'] = $q[0]['prodcost'];
        }
        $scCart['info'] = $prInfo;
        $_SESSION['cart'] = serialize($scCart);
        setcookie('cart', $_SESSION['cart']);

      } elseif($xxx == 4) {
        $scCart = (isset($_COOKIE['cart']) && $_COOKIE['cart'] === $_SESSION['cart']) ?
                    unserialize($_COOKIE['cart']) : 
                    unserialize($_SESSION['cart']);
        $prInfo = $scCart['info'];
        $chMas = array();
        foreach ($prInfo as $key => $value) {
            $q = "UPDATE prod_types
                  SET count = count - '".$value['count']."'
                  WHERE id = '".$value['varid']."' AND
                        count >= '".$value['count']."'";
            $q = $el->query($q);
            if($el->fetch($q) !== false) {
                unset($prInfo[$key]);
            }
            else {
                $chMas[$key]['varid'] = $value['varid'];
                $chmas[$key]['varcount'] = $value['count'];
            }
            
        }
        if(count($scCart['info']) != count($chMas)) {
            foreach ($chMas as $key => $value) {
                $q = "UPDATE prod_types
                      SET count = count + '".$value['varcount']."'
                      WHERE id = '".$value['varid']."'";
            }
            $scCart['info'] = $prInfo;
            $_SESSION['cart'] = serialize($scCart);
            setcookie('cart', $_SESSION['cart']);
            header("Refresh:0;url=index.php");
            exit();
        }
        
        $tmpUniqueId = date("is").rand();
        $uid = $scCart['id'];    
        $sum = 0;
        foreach ($scCart['info'] as $key => $value) {
            $sum += $value['count'] * $value['cost'];
        }
        $query = "INSERT INTO orders (u_id, 
                                      fio,
                                      phone,
                                      email,
                                      status, 
                                      city, 
                                      street, 
                                      house, 
                                      apart, 
                                      delivery_type, 
                                      comment, 
                                      tmp_unique_id, 
                                      sum)
                  VALUES ('".$uid."',
                          '".$scCart['u_info']['fio']."',
                          '".$scCart['u_info']['userphone']."',
                          '".$scCart['u_info']['useremail']."',
                          'В обработке',
                          '".$scCart['u_info']['city']."',
                          '".$scCart['u_info']['street']."',
                          '".$scCart['u_info']['house']."',
                          '".$scCart['u_info']['apart']."',
                          '".$scCart['u_info']['delivery']."',
                          '".$scCart['u_info']['comment']."',
                          '".$tmpUniqueId."',
                          '".$sum."')";
        $query = $el->query($query);
        
        $query = "SELECT id 
                  FROM orders 
                  WHERE tmp_unique_id = '".$tmpUniqueId."'";
        $query = $el->query($query);
        $query = $el->fetch($query);
        $IDorder = $query[0]['id'];
        
        foreach ($scCart['info'] as $key => $value) {
            $query = "INSERT INTO order_detail (order_id, 
                                                pr_id, 
                                                var_id,
                                                cost,
                                                var_count)
                      VALUES ('".$IDorder."',
                              '".$value['prid']."',
                              '".$value['varid']."',
                              '".$value['cost']."',
                              '".$value['count']."')";
            $query = $el->query($query);
        }
        if(isset($_COOKIE['cart'])) {
            unset($_COOKIE['cart']);
            unset($_SESSION['cart']);
        } else {
            unset($_SESSION['cart']);
        }
      }
    }
  } else {
    header("refresh:0;url=index.php");
    exit();
  }
?>
<div class="wrapper">
  <?php include "templates/header/header.php" ?>

  <div class="category-title">
      <p class="category-title-text">ОФОРМЛЕНИЕ ЗАКАЗА</p>
  </div>
  <div class="checkout-holder">
    <?php
      if($xxx == 1) { ?>
        <header class="checkout-header">
          <p><?php echo $xxx; ?>.</p> <p class="inf">Контактная информация</p>
        </header>
      <?php } elseif ($xxx == 2) { ?>
        <div class="one">
        <p>1.</p> <p class="inf">Контактная информация</p>
        </div>
        <header class="checkout-header">
          <p><?php echo $xxx; ?>.</p> <p class="inf">Информация о доставке</p>
        </header>
      <?php } elseif ($xxx == 3) { ?>
        <div class="one">
        <p>1.</p> <p class="inf">Контактная информация</p>
        </div>
        <div class="two">
          <p>2.</p> <p class="inf">Информация о доставке</p>
        </div>
        <header class="checkout-header">
          <p><?php echo $xxx; ?>.</p> <p class="inf">Подтверждение заказа</p>
        </header>
      <?php } elseif($xxx == 4) {} ?>

    <?php include "templates/checkout/checkout".$xxx.".php"; ?>
  <div class="clearfix"></div>
    <?php
      if($xxx == 1) { ?>
        <div class="two">
          <p>2.</p> <p class="inf">Информация о доставке</p>
        </div>
        <div class="three">
          <p>3.</p> <p class="inf">Подтверждение заказа</p>
        </div>
        <div class="clearfix"></div>
      <?php } elseif ($xxx == 2) { ?>
        <div class="three">
          <p>3.</p> <p class="inf">Подтверждение заказа</p>
        </div>
        <div class="clearfix"></div>
      <?php } elseif ($xxx == 3) {?>
        <div class="clearfix"></div>
      <?php } elseif ($xxx == 4) {}  ?>
  </div>

  <?php include "templates/footer/footer.php" ?>
</div>
