<?php
  if(isset($_POST['type']) &&
     $_POST['type'] != '' &&
     isset($_POST['typeOfImg']) &&
     $_POST['typeOfImg'] != '' &&
     isset($_POST['cid']) &&
     $_POST['cid'] != '') {

      include_once "DB_operations.php";
      $el = new db;
      $el->connect();
      if($el->database === false) echo "ERROR conect to DB";
      $type = $_POST['type'];
      $typeOfImg = $_POST['typeOfImg'];
      $catID = $_POST['cid'];
      if($type == 'add') {
        // creating new file to specified folder
        if (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
          $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/cat_img/";
          $pathIMG = "../img/cat_img/";
          $iPath = "/exam/site/img/cat_img/";
          $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
          $fileFullName = $path.$fileSelfName;
          $fileIMGName = $pathIMG.$fileSelfName;
          move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
          $q = "INSERT INTO prod_category_settings (cat_id, type, link)
                VALUES ('".$catID."','".$typeOfImg."', '".$fileSelfName."')";
          $el->query($q);
          $el->close();
          echo "<img class='load-img' src='".$iPath.$fileSelfName."' title='cat_".$typeOfImg."_img' />";
        }
      } elseif($type == 'change') {
        if (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
          $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/cat_img/";
          $iPath = "/exam/site/img/cat_img/";
          $q = "SELECT link
                FROM prod_category_settings
                WHERE type = '".$typeOfImg."'";
          $q = $el->query($q);
          $oldLink = $el->fetch($q)[0];
          $oldLink = $path.$oldLink['link'];
          unlink($oldLink);
          $pathIMG = "../img/cat_img/";
          $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
          $fileFullName = $path.$fileSelfName;
          $fileIMGName = $pathIMG.$fileSelfName;
          move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
          $q = "UPDATE prod_category_settings
                SET link = '".$fileSelfName."'
                WHERE type = '".$typeOfImg."' AND
                      cat_id = '".$catID."'";
          $el->query($q);
          $el->close();
          echo "<img class='load-img' src='".$iPath.$fileSelfName."' title='cat_".$typeOfImg."_img' />";
        }
      } else {
        echo "ELSE";
      }
  }



 ?>
