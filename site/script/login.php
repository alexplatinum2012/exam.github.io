<?php
session_start();

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
    header("refresh:0; url=../login.php?e=".$email);
    exit();
  } elseif(count($query) > 1) {
    header("refresh:0; url=../login?err=0");
    exit();
  } else {
    if(password_verify($password, $query[0]['password'])) {
      $_SESSION['id'] = $query[0]['u_id'];
      header("refresh:0; url=../index.php");
      exit();
    }
  }
}
