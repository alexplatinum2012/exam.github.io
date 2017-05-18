<?php
  include "script/DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT t1.id, t1.fio, t1.phone, t2.email
            FROM users as t1, user_login as t2
            WHERE t2.u_id = t1.id
            ORDER BY t1.fio";
  $query = $el->query($query);
  $result = $el->fetch($query);
  $el->close();
?>
<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/users/users.php"; ?>
    </div>
  </div>
</div>
