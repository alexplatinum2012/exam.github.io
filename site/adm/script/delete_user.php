<?php
  if(isset($_GET['duid']) && $_GET['duid'] != "") {
    include "DB_operations.php";
    $el = new db;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "DELETE
              FROM users
              WHERE id = '".$_GET['duid']."'";
    $query = $el->query($query);
    $query = "DELETE
              FROM user_addr
              WHERE u_id = '".$_GET['duid']."'";
    $query = $el->query($query);
    $query = "DELETE
              FROM user_login
              WHERE u_id = '".$_GET['duid']."'";
    $query = $el->query($query);
    header("refresh:0;url=../users.php");
  }
?>
