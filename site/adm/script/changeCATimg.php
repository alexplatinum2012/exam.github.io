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
      $typeOfImg = ($typeOfImg == 'logo') ? 'logo_link' : 'promo_link';
      $catID = $_POST['cid'];
      $q = "SELECT id
            FROM prod_category_settings
            WHERE cat_id = '".$catID."'";
      $q = $el->query($q);
      $q = $el->fetch($q)[0];
      $type = ($q != '') ? 'change' : 'add';
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
          $q = "INSERT INTO prod_category_settings (cat_id, ".$typeOfImg.")
                VALUES ('".$catID."', '".$fileSelfName."')";
          $el->query($q);
          $el->close();
          echo "<img class='load-img' src='".$iPath.$fileSelfName."' title='cat_".explode('_',$typeOfImg)[0]."_img' />";
        }
      } elseif($type == 'change') {
        if (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
          $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/cat_img/";
          $iPath = "/exam/site/img/cat_img/";
          $q = "SELECT ".$typeOfImg."
                FROM prod_category_settings
                WHERE cat_id = '".$catID."'";
          $q = $el->query($q);
          $oldLink = $el->fetch($q)[0];
          if($oldLink != '') {
            $oldLink = $path.$oldLink[$typeOfImg];
            unlink($oldLink);
          }
          $pathIMG = "../img/cat_img/";
          $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
          $fileFullName = $path.$fileSelfName;
          $fileIMGName = $pathIMG.$fileSelfName;
          move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
          $q = "UPDATE prod_category_settings
                SET ".$typeOfImg." = '".$fileSelfName."'
                WHERE cat_id = '".$catID."'";
          $el->query($q);
          $el->close();
          echo "<img class='load-img' src='".$iPath.$fileSelfName."' title='cat_".explode('_', $typeOfImg)[0]."_img' />";
        }
      } else {
        //echo "ELSE";
      }
  }



 ?>
