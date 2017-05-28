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
        $q = "SELECT * from site_settings";
        $q = $el->query($q);
        $q = $el->fetch($q)[0];
        if($q != '') {
          $q = "UPDATE site_settings
                SET name = '".$_POST['name']."',
                    about1 = '".$_POST['about1']."',
                    about2 = '".$_POST['about2']."',
                    footer_text = '".$_POST['footer_text']."',
                    curr = '".$_POST['curr']."'";
        } else {
          $q = "INSERT INTO site_settings (name,
                                           about1,
                                           about2,
                                           footer_text,
                                           curr)
                VALUES ('".$_POST['name']."',
                        '".$_POST['about1']."',
                        '".$_POST['about2']."',
                        '".$_POST['footer_text']."',
                        '".$_POST['curr']."')";
        }
        $el->query($q);
        header("Refresh:0; url=".$_SERVER['HTTP_REFERER']);
        break;
      case '2':
        if(isset($_POST['id']) &&
           $_POST['id'] != '') {
            $idOfImg = $_POST['id'];
            $promoTitle1 = $_POST['promo_title1'];
            $promoTitle2 = $_POST['promo_title2'];
            $about = (isset($_POST['about'])) ? $_POST['about'] : '';
            $pr_id = ($_POST['pr_id'] != '') ? $_POST['pr_id'] : 0;
            $q = "SELECT *
                  FROM main_promo
                  WHERE id = '".$idOfImg."'";
            $q = $el->query($q);
            $q = $el->fetch($q)[0];
            $type = ($q != '') ? 'change' : 'add';
            if($type == 'add') {
              $q = "INSERT INTO main_promo (id,
                                            promo_title1,
                                            promo_title2,
                                            about,
                                            pr_id)
                    VALUES ('".$idOfImg."',
                            '".$promoTitle1."',
                            '".$promoTitle2."',
                            '".$about."',
                            '".$pr_id."')";
              $el->query($q);
              $el->close();
              header("Refresh:0; url=".$_SERVER['HTTP_REFERER']);
            } elseif($type == 'change') {
              $q = "UPDATE main_promo
                    SET promo_title1 = '".$promoTitle1."',
                        promo_title2 = '".$promoTitle2."',
                        about = '".$about."',
                        pr_id = '".$pr_id."'
                    WHERE id = '".$idOfImg."'";
              $el->query($q);
              $el->close();
              header("Refresh:0; url=".$_SERVER['HTTP_REFERER']);
            }
          }
        break;
      case '3':
        if(isset($_POST['id']) &&
           $_POST['id'] != '') {
            $idOfImg = $_POST['id'];
            $q = "SELECT *
                  FROM main_promo
                  WHERE id = '".$idOfImg."'";
            $q = $el->query($q);
            $q = $el->fetch($q)[0];
            $type = ($q != '') ? 'change' : 'add';
            if($type == 'add') {
              if (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
                $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/main_promo_img/";
                $pathIMG = "../img/main_promo_img/";
                $iPath = "/exam/site/img/main_promo_img/";
                $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
                $fileFullName = $path.$fileSelfName;
                $fileIMGName = $pathIMG.$fileSelfName;
                move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
                $q = "INSERT INTO main_promo (id, link)
                      VALUES ('".$idOfImg."', '".$fileSelfName."')";
                $el->query($q);
                $el->close();
                echo "<img class='load-img' src='".$iPath.$fileSelfName."' title='main_promo_img_".$idOfImg."' />";
              }
            } elseif($type == 'change') {
              if (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
                $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/main_promo_img/";
                $iPath = "/exam/site/img/main_promo_img/";
                $q = "SELECT link
                      FROM main_promo
                      WHERE id = '".$idOfImg."'";
                $q = $el->query($q);
                $oldLink = $el->fetch($q)[0];
                if($oldLink != '') {
                  $oldLink = $path.$oldLink['link'];
                  unlink($oldLink);
                }
                $pathIMG = "../img/main_promo_img/";
                $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
                $fileFullName = $path.$fileSelfName;
                $fileIMGName = $pathIMG.$fileSelfName;
                move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
                $q = "UPDATE main_promo
                      SET link = '".$fileSelfName."'
                      WHERE id = '".$idOfImg."'";
                $el->query($q);
                $el->close();
                echo "<img class='load-img' src='".$iPath.$fileSelfName."' title='main_promo_img_".$idOfImg."' />";
              }
            } else {
              //echo "ELSE";
            }
        }




        break;

      default:

        break;
    }
  }


?>
