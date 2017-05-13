<?php
  session_start();
  if(isset($_SESSION['id']) &&
     $_SESSION['id'] != '' &&
     isset($_SESSION['role']) &&
     $_SESSION['role'] == 'admin') {

    define('host', 'localhost');
    define('dbName', 'site');
    define('user', 'postgres');
    define('password', 'ambassador');
  }
  else {
    header("Refresh:0;url=../");
    exit();
  }
?>
