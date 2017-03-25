<?php
include "DB_operations.php";
$el = new db;
$el->connect();
if($el->database === false) echo "ERROR conect to DB";
$arr1 = array("\'", "\"");
$arr2 = array(" ", " ");
$strName = str_ireplace('\'', ' ', $_POST['name']);
$strAbout = str_ireplace('\'', ' ', $_POST['about']);
$query = "UPDATE products
          SET name = '".$strName."',
              about = '".$strAbout."',
              corner = '".$_POST['corner']."',
              cost = '".$_POST['cost']."'
          WHERE id = '".$_POST['pid']."'";
$el->query($query);

$query = "DELETE
          FROM prod_types
          WHERE pr_id = '".$_POST['pid']."'";
$el->query($query);

foreach ($_POST as $key => $value) {
  if(strpos($key, 'var') !== false) {
    $query = "INSERT INTO prod_types (pr_id, count, var)
              VALUES ('".$_POST['pid']."', '".$value[1]."', '".$value[0]."')";
    $el->query($query);
  }
}

$el->close();
header("refresh: 0; url=../products_in_category.php?cd=".$_POST['catID']);
?>
