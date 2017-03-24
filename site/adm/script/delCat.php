<?php
include "DB_operations.php";
$el = new db;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$query = "DELETE FROM prod_category WHERE id = '".$_GET['cid']."'";
$el->query($query);
$el->close();
header("refresh: 0; url=../categories.php");
?>
