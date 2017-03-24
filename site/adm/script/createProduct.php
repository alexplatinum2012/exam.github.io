<?php
include "DB_operations.php";
$el = new db;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$arr1 = array("\'", "\"");
$arr2 = array(" ", " ");
$strName = str_ireplace('\'', ' ', $_POST['name']);
$strAbout = str_ireplace('\'', ' ', $_POST['about']);
$addProd = "INSERT INTO products (cat_id, name, about, corner, cost) VALUES ('".$_POST['catID']."', '".$strName."', '".$strAbout."', '".$_POST['corner']."', '".$_POST['cost']."')";
$el->query($addProd);
//pg_query($pg, $addProd);
$selProdID = "SELECT id FROM products WHERE name like '".$strName."'";
$selProdID = $el->query($selProdID);
$selProdID = $el->fetch($selProdID);

foreach ($_POST as $key => $value) {
  if(strpos($key, 'photo') !== false) {
    $addPhoto = "INSERT INTO prod_photo (pr_id, name) VALUES ('".$selProdID[0]['id']."', '".$value."')";
    $el->query($addPhoto);
  }
}
foreach ($_POST as $key => $value) {
  if(strpos($key, 'var') !== false) {
    $addVar = "INSERT INTO prod_types (pr_id, count, var) VALUES ('".$selProdID[0]['id']."', '".$value[1]."', '".$value[0]."')";
    $el->query($addVar);
  }
}
$el->close();
header("refresh: 0; url=../products_in_category.php?cd=".$_POST['catID']);
?>
