<?php
include "DB_operations.php";
$el = new db;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$query = "UPDATE prod_category SET name = '".$_POST['catName']."' WHERE id = '".$_POST['catID']."'";
$el->query($query);
$el->close();
header("refresh: 0; url=../products_in_category.php?cd=".$_POST['catID']);
?>
