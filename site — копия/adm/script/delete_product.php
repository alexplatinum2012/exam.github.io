<?php
include "DB_operations.php";
$el = new db;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$arr1 = array("\'", "\"");
$arr2 = array(" ", " ");
$strName = str_ireplace('\'', ' ', $_POST['name']);
$strAbout = str_ireplace('\'', ' ', $_POST['about']);
$delTypes = "DELETE FROM prod_types WHERE pr_id = '".$_POST['pid']."'";
$delPhoto = "DELETE FROM prod_photo WHERE pr_id = '".$_POST['pid']."'";
$delProd = "DELETE FROM products WHERE id = '".$_POST['pid']."'";
$el->query($delTypes);
$el->query($delPhoto);
$el->query($delProd);
$el->close();
header("refresh: 0; url=../products_in_category.php?cd=".$_POST['catID']);
?>
