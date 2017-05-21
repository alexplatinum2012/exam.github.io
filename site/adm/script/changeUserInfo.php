<?php
  include "DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "UPDATE users
            SET fio = '".$_POST['fio']."',
                phone = '".$_POST['phone']."',
                city = '".$_POST['city']."'
            WHERE id = '".$_POST['uid']."'";
  $el->query($query);
  $query = "UPDATE user_login
            SET email = '".$_POST['e-mail']."',
                role = '".$_POST['role']."'
            WHERE u_id = '".$_POST['uid']."'";
  $el->query($query);
  $query = "UPDATE user_addr
            SET street = '".$_POST['street']."',
                house = '".$_POST['house']."',
                apart = '".$_POST['apart']."'
            WHERE u_id = '".$_POST['uid']."'";
  $el->query($query);
  $el->close();
  header("Refresh:0; url=".$_SERVER['HTTP_REFERER']);
?>
