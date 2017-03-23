<?php

if(isset($_GET['del'])) {
  $number = $_GET['i'];
  unlink($_GET['del']);
  ?>
  <div class="img">

  </div>
  <form enctype="multipart/form-data" target="<?php echo 'ifr'.$number; ?>" action="test.php" method="post">
    <input type="hidden" name="i" value="<?php echo $number; ?>">
    <label class="input-file">
      <input type="file" name="filex" value="" onchange="changing(this)">
      добавить
    </label>
  </form>
  <?php
} elseif (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
    $number = $_POST['i'];
    $path = "../img/prod_photo/";
    $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
    $fileFullName = $path.$fileSelfName;
    move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
  ?>
    <input form='form_productADD' type='hidden' name='<?php echo "photo$number"; ?>' value='<?php echo $fileSelfName; ?>' />
    <div class="img">
      <img src="<?php echo $fileFullName; ?>" alt='<?php echo "photo$number"; ?>' />
    </div>
    <form enctype="multipart/form-data" target="<?php echo 'ifr'.$number; ?>" action="test.php" method="post">
      <input type="hidden" name="i" value="<?php echo $number; ?>">
      <label class="input-file">
        <input type="file" name="filex" value="">
        изменить
      </label>
    </form>
    <a class="delete" target="<?php echo 'ifr'.$number; ?>" href="<?php echo 'test.php?i='.$number.'&del='.$fileFullName; ?>">удалить</a>
<?php } ?>

<!--
echo "file name: ".$_FILES["ufile"]["name"]."<br/>";
 echo "file type: ".$_FILES["ufile"]["type"]."<br/>";
 echo "file size: ".$_FILES["ufile"]["size"]."<br/>";
 echo "file tmp name: ".$_FILES["ufile"]["tmp_name"]."<br/>";
 echo "upload err code: ".$_FILES["ufile"]["error"]."<br/>";
 echo "<br/> <br/>=====================<br/>";
 echo file_get_contents($_FILES["ufile"]["tmp_name"]);
 //
 // move_uploaded_file($_FILES["ufile"]["tmp_name"], "myurl");
-->
