<?php
  session_start();
  unset($_SESSION['id']);
  unset($_SESSION['cart']);
  unset($_SESSION['role']);
  unset($_COOKIE['cart']);
  session_destroy();
  header("refresh:0;url=../");
  exit();
?>
