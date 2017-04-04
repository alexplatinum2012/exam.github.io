<?php
if(isset($_GET['pid']) && $_GET['pid'] != "") {
  $uid = (isset($_SESSION['id']) ? $_SESSION['id'] : $_SESSION['tmp']);
  include_once "DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "DELETE
            FROM cart
            WHERE pr_id = '".$_GET['pid']."' AND
                  u_id = '".$uid."'";
  $query = $el->query($query);
  $el->close();
}
include "header_cart.php";
?>
