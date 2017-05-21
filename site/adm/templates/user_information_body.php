<?php
  if(isset($_GET['uid']) && $_GET['uid'] != "") {
    include "script/DB_operations.php";
    $el = new db;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "SELECT t1.*,
                     t2.email,
                     t2.role,
                     t3.street,
                     t3.house,
                     t3.apart
              FROM users as t1,
                   user_login as t2,
                   user_addr as t3
              WHERE t3.u_id = t1.id AND
                    t2.u_id = t1.id AND
                    t1.id = '".$_GET['uid']."'";
    $query = $el->query($query);
    $result = $el->fetch($query);

    $query = "SELECT id AS orderid,
                     sum AS ordersum,
                     date AS orderdate,
                     time AS ordertime
              FROM orders
              WHERE u_id = '".$_GET['uid']."'";
    $query = $el->query($query);
    $orderInfo = $el->fetch($query);
    $el->close();
  } else {
    header("refresh:0; url=../users.php");
    exit();
  }
?>
<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/users/user_information.php"; ?>
    </div>
  </div>
</div>
