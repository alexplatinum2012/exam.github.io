  <?php
  session_start();
  //запрос из таблицы корзины
  if(!isset($_SESSION['id']) && !isset($_SESSION['tmp'])) {
    header("refresh:0;url=index.php");
    exit();
  }
  if(isset($_SESSION['id'])) {
    $session = $_SESSION['id'];
    $sessionLimit = $_SESSION['idLim'];
  }
  if(isset($_SESSION['tmp'])) {
    $session = $_SESSION['tmp'];
    $sessionLimit = $_SESSION['tmpLim'];
  }
  if(isset($_GET['uid']) && $session && $_GET['uid'] == $session) {
    include_once "script/DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $quer = "SELECT *
              FROM cart
              WHERE u_id = '".$session."'";
    $quer = $el->query($quer);
    $cartResult = $el->fetch($quer);
    $resultCart = array();
    $totalAmount = 0;
    if($cartResult) {
      foreach ($cartResult as $key => $value) {
        $quer = "SELECT t1.id AS prodId,
                         t1.name AS prodName,
                         t1.cost AS prodCost,
                         t2.name AS prodPhoto,
                         t3.count AS prodCount
                  FROM products AS t1,
                       prod_photo AS t2,
                       prod_types AS t3
                  WHERE t1.id = '".$value['pr_id']."' and
                        t2.id in (select distinct pr_id from prod_photo where pr_id = t1.id) AND
                        t3.id = '".$value['var_id']."'
                  ORDER BY t1.name";
        $quer = $el->query($quer);
        $tmp = $el->fetch($quer);
        $resultCart[]=$tmp[0];
        $totalAmount += $tmp[0]['prodcost'];
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
