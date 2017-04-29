<?php session_start(); ?>

<?php
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
?>
<div class="wrapper">
  <?php include "templates/header/header.php" ?>

  <div class="category-title">
      <p class="category-title-text">ОФОРМЛЕНИЕ ЗАКАЗА</p>
  </div>
  <?php
  //echo $_SERVER['HTTP_REFERER'];
  if(stripos($_SERVER['HTTP_REFERER'], 'login') !== false) {
    $xxx = 1;
    //echo $_SERVER['HTTP_REFERER'];
    //exit();
  }
  else if(isset($_POST['page-num']) && $_POST['page-num'] != "") {
    $xxx = $_POST['page-num'];
    if($xxx == 1) {

      //if(stripos('login', $_SERVER['HTTP_REFERER']) === false) {
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
    //  }
    }
    if($xxx > 1) {
      include_once "script/DB_operations.php";
      $el = new dba;
      $el->connect();
      if($el->database === false) echo "ERROR conect to DB";
      if($xxx == 2) {
        if(isset($_SESSION['id'])) {
          $query = "SELECT t1.city, t2.street, t2.house, t2.apart
          FROM users as t1, user_addr as t2
          WHERE t2.u_id = t1.id AND
          t1.id = '".$_SESSION['id']."'";
          $query = $el->query($query);
          $query = $el->fetch($query);
          $city = $query[0]['city'];
          $street = $query[0]['street'];
          $house = $query[0]['house'];
          $apart = $query[0]['apart'];
        } else {
          $city = '';
          $street = '';
          $house = '';
          $apart = '';
        }

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
      } elseif($xxx == 3) {
        $tmpUniqueId = date("is").rand();
        $uid = unserialize($_SESSION['cart']);
        $uid = $uid['id'];
        $query = "INSERT INTO orders (u_id, status, city, street, house, apart, delivery_type, comment, tmp_unique_id, sum)
        VALUES ('".$uid."',
        '".$_POST['status']."',
        '".$_POST['city']."',
        '".$_POST['street']."',
        '".$_POST['house']."',
        '".$_POST['apart']."',
        '".$_POST['delivery']."',
        '".$_POST['comment']."',
        '".$tmpUniqueId."',
        '".$_POST['sum']."')";
        $query = $el->query($query);

        $query = "SELECT id FROM orders WHERE tmp_unique_id = '".$tmpUniqueId."'";
        $query = $el->query($query);
        $query = $el->fetch($query);
        $IDorder = $query[0]['id'];

        foreach ($_POST as $key => $value) {
          if(stripos($key, 'arr') !== false) {
            $arr = explode('|', $key);
            $prId = $arr[1];
            $varId = $arr[2];
            $varCount = $value;
            //echo "prid=$prId; varid=$varId; varcount=$varCount; <br />";
            $query = "INSERT INTO order_detail (order_id, pr_id, var_id, var_count)
            VALUES ('".$IDorder."',
            '".$prId."',
            '".$varId."',
            '".$varCount."')";
            $query = $el->query($query);
          }
        }
// Вопрос в том что запрос ниже запрашивает инфу из таблиц юзера, а при временном юзере записи в этих таблицая отсутствуют!!!
        $query = "SELECT t1.id AS orderid,
        t1.city AS city,
        t1.street AS street,
        t1.house AS house,
        t1.apart AS apart,
        t1.delivery_type AS orderdelivery,
        t1.comment AS ordercomment,
        t2.fio as userfio,
        t2.phone AS userphone,
        t3.email AS useremail,
        t4.name AS prodname,
        t4.cost AS prodcost,
        t5.var_count AS varcount,
        t5.var_id AS varid
        FROM orders AS t1,
        users AS t2,
        user_login AS t3,
        products AS t4,
        order_detail AS t5
        WHERE t5.order_id = t1.id AND
        t4.id = t5.pr_id AND
        t3.u_id = t2.id AND
        t2.id = t1.u_id AND
        t1.id = '".$IDorder."'";
        $query = $el->query($query);
        $infoOrder = $el->fetch($query);
        prnt($infoOrder);
      } elseif($xxx == 4) {
        $idOrder = $_POST['order-id'];
        foreach ($_POST as $key => $value) {
          if(stripos($key, 'varid') !== false) {
            $tmp = explode("|", $key);
            $query = "UPDATE prod_types
            SET count = count - '".$value."'
            WHERE id = '".$tmp[1]."'";
            $query = $el->query($query);
          }
        }
        delCartByTime ($_SESSION['id']);
        $query = "UPDATE orders
        SET status = 'В обработке'
        WHERE id = '".$idOrder."'";
        $query = $el->query($query);
      }
    }
  } else {
    header("refresh:0;url=index.php");
    exit();
  }
?>
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
