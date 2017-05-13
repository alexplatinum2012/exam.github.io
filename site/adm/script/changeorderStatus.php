<?php
if(isset($_GET['s']) && $_GET['s'] != '') {
  include_once "DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "UPDATE orders
            SET status = '".$_GET['s']."'
            WHERE id = '".$_GET['o']."'";
  $el->query($query);
  $el->close();
  echo $_GET['s'];
} else {
  echo "false";
}

?>
