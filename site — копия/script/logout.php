<?php
  session_start();
  unset($_SESSION['id']);
  header("refresh:0;url=../index.php");
  exit();
?>
