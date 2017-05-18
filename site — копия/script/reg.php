<?php
if($_POST['password'] === $_POST['re-password']) {

  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
  include_once "DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $dupEMAIL = "SELECT *
               FROM user_login
               WHERE email like '".$_POST['e-mail']."'";
  $dupEMAIL = $el->query($dupEMAIL);
  $dupEMAIL = $el->fetch($dupEMAIL);
  if($dupEMAIL === false) {
    $query = "INSERT INTO users (fio)
              VALUES ('".$_POST['fio']."')";
    $el->query($query);
    $query = "SELECT id
              FROM users
              WHERE fio like '".$_POST['fio']."'";
    $query = $el->query($query);
    $uid = $el->fetch($query);
    //$_POST['fio'] = $uid[0]['fio'];
    $uid = $uid[0]['id'];
    $query = "INSERT INTO user_login (u_id, email, password)
              VALUES ('".$uid."', '".$_POST['e-mail']."', '".$pass."')";
    $el->query($query);
    $el->close();

    header("refresh: 0; url=../account.php?uid=".$uid);
  } else {
    $el->close();
    header("refresh: 0; url=../register.php?err=1");
  }
} else header("refresh: 0; url=../register.php?err=0");
?>
