<?php
session_start();
date_default_timezone_set('Europe/Moscow');
if(isset($_POST['email']) && isset($_POST['password'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];
  include_once "DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT * FROM user_login WHERE email like '".$email."'";
  $query = $el->query($query);
  $query = $el->fetch($query);
  $path = explode("?", $_SERVER['HTTP_REFERER']);
  $path = $path[0];
  if($query === false) {
    $el->close();
    header("refresh:0; url=".$path."?e=".$email);
    exit();
  } elseif(count($query) > 1) {
    $el->close();
    header("refresh:0; url=".$path."?err=0");
    exit();
  } else {
    if(password_verify($password, $query[0]['password'])) {
      $_SESSION['id'] = $query[0]['u_id'];
      $_SESSION['role'] = $query[0]['role'];
      if(isset($_SESSION['tmp'])) {
        unset($_SESSION['tmp']);
        $tmp = unserialize($_SESSION['cart']);
        $tmp['id'] = $_SESSION['id'];
        $_SESSION['cart'] = serialize($tmp);
        setcookie('cart', serialize($tmp));
      }
      $el->close();
      if(stripos($path, 'checkout') !== false) {
        header("refresh:0; url=../cart.php?uid=".$_SESSION['id']);
        exit();
      }
      header("refresh:0; url=../");
      exit();
    } else {
      $el->close();
      header("refresh:0; url=".$path."?e=".$email."&p=0");
      exit();
    }
  }
}
