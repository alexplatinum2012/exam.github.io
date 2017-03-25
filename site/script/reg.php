<?php
if($_POST['password'] === $_POST['re-password']) {

  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
  //include "DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  // checking for duplicate fio and e-mail
  $dupFIO = "SELECT * FROM users WHERE fio like '"$_POST['fio']"'";
  $dupFIO = $el->query($dupFIO);
  if($dupFIO === false) {
    $dupEMAIL = "SELECT * FROM user_login WHERE email like '".$_POST['e-mail']."'";
    $dupEMAIL = $el->query($dupEMAIL);
    if($dupEMAIL ===false) {
      $query = "INSERT INTO users (fio) VALUES ('".$_POST['fio']."')";
      $el->query($query);
      $query = "SELECT id FROM users where fio like '".$_POST['fio']."'";
      $query = $el->query($query);
      $uid = $el->fetch($query);
      $uid = $uid[0]['id'];
      $query = "INSERT INTO user_login (u_id, email, password) VALUES ('".$uid."', '".$_POST['e-mail']."', '".$pass."')";
      $el->query($query);
      $el->close();
      header("refresh: 0; url=../account.php?uid=".$uid);
    } else {
      $el->close();
      header("refresh: 0; url=..register.php?err=2");
    }
  } else {
    $el->close();
    header("refresh: 0; url=..register.php?err=1");
  }
} else header("refresh: 0; url=..register.php?err=0");
?>
