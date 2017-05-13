<?php
  session_start();
  unset($_SESSION['id']);
  unset($_SESSION['cart']);
  unset($_SESSION['role']);
  header("refresh:0;url=../");
  exit();
?>
