<?php
include "DB_operations.php";
$el = new db;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$addProd = "INSERT INTO products (name, about, corner) VALUES ('".$_POST['name']."', '".$_POST['about']."', '".$_POST['corner']."')";
$el->query($addProd);
//pg_query($pg, $addProd);
$selProdID = "SELECT id FROM products WHERE name like '".$_POST['name']."'";
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
?>
