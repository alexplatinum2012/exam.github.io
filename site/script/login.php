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
  if($query === false) {
    $el->close();
    header("refresh:0; url=../login.php?e=".$email);
    exit();
  } elseif(count($query) > 1) {
    $el->close();
    header("refresh:0; url=../login?err=0");
    exit();
  } else {
    if(password_verify($password, $query[0]['password'])) {
      $_SESSION['id'] = $query[0]['u_id'];
      if(isset($_SESSION['tmp'])) {
        $query = "UPDATE cart
                  SET u_id = '".$_SESSION['id']."'
                  WHERE u_id = '".$_SESSION['tmp']."'";
        $query = $el->query($query);
        unset($_SESSION['tmp']);
        unset($_SESSION['tmpLim']);
      }
      $_SESSION['idLim'] = date("dHis", time() + 1800);
      $el->close();
      header("refresh:0; url=../index.php");
      exit();
    }
  }
}
