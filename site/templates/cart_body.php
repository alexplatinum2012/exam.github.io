  <?php
  session_start();
  //запрос из session - cookie корзины
  if(!isset($_SESSION['id']) && !isset($_SESSION['tmp'])) {
    header("refresh:0;url=index.php");
    exit();
  }
  if(isset($_SESSION['id'])) {
    $session = $_SESSION['id'];
  }
  if(isset($_SESSION['tmp'])) {
    $session = $_SESSION['tmp'];
  }
  if(isset($_GET['uid']) && $session && $_GET['uid'] == $session) {
    include_once "script/DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    // $quer = "SELECT *
    //           FROM cart
    //           WHERE u_id = '".$session."'";
    // $quer = $el->query($quer);
    // $cartResult = $el->fetch($quer);
    $resultCart = array();
    $totalAmount = 0;
    if(isset($_SESSION['cart'])) {
      $sss = unserialize($_SESSION['cart']);
      for ($i = 0; $i < count($sss['info']); $i++) {
        $quer = "SELECT t1.id AS prodId,
                        t1.name AS prodName,
                        t1.cost AS prodCost,
                        t2.name AS prodPhoto,
                        t3.count AS prodCount
                  FROM products AS t1,
                       prod_photo AS t2,
                       prod_types AS t3
                  WHERE t1.id = '".$sss['info'][$i]['prid']."' AND
                        t2.id in (SELECT DISTINCT pr_id
                                  FROM prod_photo
                                  WHERE pr_id = t1.id) AND
                        t3.id = '".$sss['info'][$i]['varid']."'
                  ORDER BY t1.name";
        $quer = $el->query($quer);
        $tmp = $el->fetch($quer);
        if($tmp[0]['prodcount'] == 0) {
          if(isset($_COOKIE['cart'])) {
            unset($sss['info'][$i]);
            $_SESSION['cart'] = serialize($sss);
            setcookie('cart', serialize($sss));
          } else {
            unset($sss['info'][$i]);
            $_SESSION['cart'] = serialize($sss);
          }
        } else {
          $tmp[0]['prodvarid'] = $sss['info'][$i]['varid'];
          if($tmp[0]['prodcount'] < $sss['info'][$i]['count']) {
            $sss['info'][$i]['count'] = $tmp[0]['prodcount'];
            $tmp[0]['ccc'] = $tmp[0]['prodcount'];
            if(isset($_COOKIE['cart'])) {
              $_SESSION['cart'] = serialize($sss);
              setcookie('cart', serialize($sss));
            } else {
              $_SESSION['cart'] = serialize($sss);
            }
          } else {
            $tmp[0]['ccc'] = $sss['info'][$i]['count'];
          }
          $resultCart[]=$tmp[0];
          $totalAmount += $tmp[0]['prodcost'] * $tmp[0]['ccc'];
        }
      }
      $el->close();
    }
  }



  ?>
  <div class="wrapper">
    <?php include "templates/header/header.php" ?>

    <div class="category-title">
  	    <p class="category-title-text">Корзина</p>
    </div>
    <?php include 'templates/shopping_cart/shopping_cart.php'; ?>
    <?php include "templates/footer/footer.php" ?>
</div>
