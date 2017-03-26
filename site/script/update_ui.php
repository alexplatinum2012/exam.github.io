<?php
$uid = (isset($_POST['uid'])) ? $_POST['uid'] : '';
if($uid == '') {
  header("refresh:0; url=../index.php");
  exit();
}

$fio = (isset($_POST['fio'])) ? $_POST['fio'] : '';
$phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
$email = (isset($_POST['e-mail'])) ? $_POST['e-mail'] : '';
$city = (isset($_POST['city'])) ? $_POST['city'] : '';
$street = (isset($_POST['street'])) ? $_POST['street'] : '';
$house = (isset($_POST['house'])) ? $_POST['house'] : '';
$apart = (isset($_POST['apart'])) ? $_POST['apart'] : '';

if($email == '') {
  echo "here"; exit();
  header("refresh: 0; url=../account.php?uid=".$_POST['uid']."&err=1");
  exit();
}
include_once "DB_operations.php";
$el = new dba;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$query = "UPDATE users
          SET fio = '".$fio."',
              phone = '".$phone."',
              city = '".$city."'";

$el->query($query);

if(isset($_POST['password']) && isset($_POST['re-password']) && $_POST['password'] === $_POST['re-password']) {
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $query = "UPDATE user_login
            SET email = '".$email."',
                password = '".$password."'
            WHERE u_id = '".$uid."'";
} else {
  $query = "UPDATE user_login
            SET email = '".$email."'
            WHERE u_id = '".$uid."'";
}
$el->query($query);

$query = "SELECT * FROM user_addr WHERE u_id = '".$uid."'";
$query = $el->query($query);
$query = $el->fetch($query);
if($query === false) {
  $query = "INSERT INTO user_addr (u_id, street, house, apart)
            VALUES ('".$uid."', '".$street."', '".$house."', '".$apart."')";
}  else {
     $query = "UPDATE user_addr
               SET street = '".$street."',
                   house = '".$house."',
                   apart = '".$apart."'
               WHERE u_id = '".$uid."'";
  }
$el->query($query);

if(isset($_SESSION['id'])) {
  header("refresh:0; url=../account.php?uid=".$uid);
  exit();
}  else {
  header("refresh:0; url=../login.php");
}
