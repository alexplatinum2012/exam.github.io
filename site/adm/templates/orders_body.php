<?php
  include "script/DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT t1.id, t1.date, t1.time, t1.status, t1.sum, t2.email
            FROM orders as t1, user_login as t2
            WHERE t2.u_id = t1.u_id";
  $query = $el->query($query);
  $orders = $el->fetch($query);
?>
<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/orders/orders.php"; ?>
    </div>
  </div>
</div>
