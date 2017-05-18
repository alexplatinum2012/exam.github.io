<?php
include "DB_operations.php";
$el = new db;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$addCat = "INSERT INTO prod_category (name) VALUES ('".$_POST['catName']."')";
$el->query($addCat);
$el->close();
header('Refresh: 0; url=../categories.php');
?>
