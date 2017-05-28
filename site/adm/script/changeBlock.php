<?php
function prnt($q) {
  if(is_array($q)) {
    echo "<br />----------------------------<br />";
    foreach ($q as $key => $value) {
      echo "$key";
      prnt($value);
      echo "<br />";
    }
  } else {
    echo " = ".$q."<br />";
  }
}
  if(isset($_POST['typer']) && $_POST['typer'] != '') {
    $case = $_POST['typer'];
    include_once "DB_operations.php";
    $el = new db;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    switch ($case) {
      case '1':
        if(isset($_POST['id']) &&
           $_POST['id'] != '') {
            $idOfImg = $_POST['id'];
            $q = "SELECT *
                  FROM product_blocks
                  WHERE id = '".$idOfImg."'";
            $q = $el->query($q);
            $q = $el->fetch($q)[0];
            $type = ($q != '') ? 'change' : 'add';
            if($type == 'add') {
              if (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
                $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/block_img/";
                $pathIMG = "../img/block_img/";
                $iPath = "/exam/site/img/block_img/";
                $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
                $fileFullName = $path.$fileSelfName;
                $fileIMGName = $pathIMG.$fileSelfName;
                move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
                $q = "INSERT INTO product_blocks (id, link)
                      VALUES ('".$idOfImg."', '".$fileSelfName."')";
                $el->query($q);
                $el->close();
                echo "<img class='load-img' src='".$iPath.$fileSelfName."' title='block_img_".$idOfImg."' />";
              }
            } elseif($type == 'change') {
              if (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
                $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/block_img/";
                $iPath = "/exam/site/img/block_img/";
                $q = "SELECT link
                      FROM product_blocks
                      WHERE id = '".$idOfImg."'";
                $q = $el->query($q);
                $oldLink = $el->fetch($q)[0];
                if($oldLink) {
                  if($oldLink['link'] != '') {
                    $oldLink = $path.$oldLink['link'];
                    unlink($oldLink);
                  }
                }
                $pathIMG = "../img/block_img/";
                $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
                $fileFullName = $path.$fileSelfName;
                $fileIMGName = $pathIMG.$fileSelfName;
                move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
                $q = "UPDATE product_blocks
                      SET link = '".$fileSelfName."'
                      WHERE id = '".$idOfImg."'";
                $el->query($q);
                $el->close();
                echo "<img class='load-img' src='".$iPath.$fileSelfName."' title='block_img_".$idOfImg."' />";
              }
            } else {
              //echo "ELSE";
            }
        }
        break;

      case '2':
        $q = "SELECT * from product_blocks
              WHERE id = '".$_POST['id']."'";
        $q = $el->query($q);
        $q = $el->fetch($q)[0];
        if($q != '') {
          $q = "UPDATE product_blocks
                SET line1 = '".$_POST['line1']."',
                    line2 = '".$_POST['line2']."'";
        } else {
          $q = "INSERT INTO product_blocks (id,
                                           line1,
                                           line2)
                VALUES ('".$_POST['id']."',
                        '".$_POST['line1']."',
                        '".$_POST['line2']."')";
        }
        $el->query($q);
        header("Refresh:0; url=".$_SERVER['HTTP_REFERER']);
        break;

      case '3':
        if(isset($_POST['id']) &&
           $_POST['id'] != '') {
            $id = $_POST['id'];
            $q = "SELECT *
                  FROM product_blocks
                  WHERE id = '".$id."'";
            $q = $el->query($q);
            $q = $el->fetch($q)[0];
            if($q != '') {
              $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/block_img/";
              $oldLink = $path.$q['link'];
              unlink($oldLink);
              $q = "DELETE
                    FROM product_blocks
                    WHERE id = '".$id."'";
              $el->query($q);
              $el->close();
            }
          }
        break;


      default:

        break;
    }
  }


?>
