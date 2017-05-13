<?php
  include "script/DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT id, 
                   date, 
                   time, 
                   status, 
                   sum, 
                   email
            FROM orders";
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
