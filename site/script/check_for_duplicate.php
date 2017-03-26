<?php
  if(isset($_POST['e-mail']) && $_POST['e-mail'] != "") {
    include_once "DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    // checking for duplicate e-mail
    if(isset($_POST['u-id']) && $_POST['u-id'] != "")
      $dupEMAIL = "SELECT * FROM user_login WHERE email like '".$_POST['e-mail']."' and u_id <> '".$_POST['u-id']."'";
    else
      $dupEMAIL = "SELECT * FROM user_login WHERE email like '".$_POST['e-mail']."'";
    $dupEMAIL = $el->query($dupEMAIL);
    $dupEMAIL = $el->fetch($dupEMAIL);
    $el->close();
    if($dupEMAIL === false) {
      echo 'false';
      exit();
    }  else  {
        echo "true";
        exit();
      }
  } else {
      echo 'false';
      exit();
    }
?>
