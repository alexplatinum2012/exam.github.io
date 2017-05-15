<?php
include $_SERVER['DOCUMENT_ROOT']."/exam/site/adm/script/DB_operations.php";

if(isset($_GET['del'])) {
  if(isset($_GET['pid'])) {
    $el = new db;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "DELETE
              FROM prod_photo
              WHERE id = '".$_GET['pid']."'";
    $el->query($query);
    $el->close();
  }
  $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/prod_photo/";
  unlink($path.$_GET['del']);
  ?>
  <!--script type="text/javascript">
    //var div = document.querySelector("<?php //echo '#photo'.$number ?>");
    //div.parentNode.removeChild(div);
  </script-->

  <?php
} elseif (isset($_FILES['filex']['name']) && substr($_FILES['filex']['type'], 0, 5) == "image") {
    if(isset($_POST['del'])) {
      if(isset($_POST['pid'])) {
        $el = new db;
        $el->connect();
        if($el->database === false) echo "ERROR conect to DB";
        $query = "DELETE
                  FROM prod_photo
                  WHERE id = '".$_POST['pid']."'";
        $el->query($query);
        $el->close();
      }
      $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/prod_photo/";
      unlink($path.$_POST['del']);
    }
    date_default_timezone_set('Europe/Moscow');
    $number = $_POST['i'];
    $path = $_SERVER['DOCUMENT_ROOT']."/exam/site/img/prod_photo/";
    $pathIMG = "../img/prod_photo/";
    $fileSelfName = date("Ymdhis")."-".rand().".".substr($_FILES['filex']['type'],6);
    $fileFullName = $path.$fileSelfName;
    $fileIMGName = $pathIMG.$fileSelfName;
    move_uploaded_file($_FILES["filex"]["tmp_name"], $fileFullName);
    if(isset($_POST['prid'])) {
      $el = new db;
      $el->connect();
      if($el->database === false) echo "ERROR conect to DB";
      $query = "INSERT INTO prod_photo (pr_id, name)
                VALUES('".$_POST['prid']."', '".$fileSelfName."')";
      $el->query($query);
      $query = "SELECT id
                FROM prod_photo
                WHERE pr_id = '".$_POST['prid']."' AND
                      name like '".$fileSelfName."'";
      $query = $el->query($query);
      $query = $el->fetch($query);
      $el->close();
      ?>
      <input form='form_productADD' type='hidden' name='<?php echo "photo$number"; ?>' value='<?php echo $fileSelfName; ?>' />
      <div class="img">
        <img src="<?php echo $fileIMGName; ?>" alt='<?php echo "photo$number"; ?>' />
      </div>
      <form enctype="multipart/form-data" target="<?php echo 'ifr'.$number; ?>" action="script/changePHOTO.php" method="post">
        <input type="hidden" name="i" value="<?php echo $number; ?>">
        <input type="hidden" name="pid" value="<?php echo $query[0]['id']; ?>">
        <input type="hidden" name="del" value="<?php echo $fileSelfName; ?>">
        <input type="hidden" name="prid" value="<?php echo $_POST['prid']; ?>" />
        <label class="input-file">
          <input type="file" name="filex" value="" onchange="changing(this)">
          изменить
        </label>
      </form>
      <a class="delete" target="ifr<?php echo $number; ?>" href="script/changePHOTO.php?pid=<?php echo $query[0]['id']; ?>&del=<?php echo $fileSelfName; ?>" onclick="delBlock(this)">удалить</a>
    <?php } else {
  ?>
    <input form='form_productADD' type='hidden' name='<?php echo "photo$number"; ?>' value='<?php echo $fileSelfName; ?>' />
    <div class="img">
      <img src="<?php echo $fileIMGName; ?>" alt='<?php echo "photo$number"; ?>' />
    </div>
    <form enctype="multipart/form-data" target="<?php echo 'ifr'.$number; ?>" action="script/changePHOTO.php" method="post">
      <input type="hidden" name="i" value="<?php echo $number; ?>">
      <label class="input-file">
        <input type="file" name="filex" value="" onchange="changing(this)">
        изменить
      </label>
    </form>
    <a class="delete" target="ifr<?php echo $number; ?>" href="<?php echo 'script/changePHOTO.php?del='.$fileSelfName; ?>" onclick="delBlock(this)">удалить</a>
<?php }} ?>
