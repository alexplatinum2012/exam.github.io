<?php
  if(isset($_GET['uid']) && isset($_SESSION['id']) && $_SESSION['id'] == $_GET['uid']) {
    include_once "script/DB_operations.php";
    $el = new dba;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $query = "SELECT * FROM users WHERE id = '".$_GET['uid']."'";
    $query = $el->query($query);
    $user = $el->fetch($query);
    $query = "SELECT * FROM user_addr WHERE u_id = '".$_GET['uid']."'";
    $query = $el->query($query);
    $addr = $el->fetch($query);
    $query = "SELECT * FROM user_login WHERE u_id = '".$_GET['uid']."'";
    $query = $el->query($query);
    $login = $el->fetch($query);
    if(!$login) {
      header("refresh:0;url=index.php");
      exit();
    }
  } else {
    header("refresh:0;url=index.php");
    exit();
  }

?>


<div class="wrapper">
  <?php include "templates/header/header.php" ?>

  <div class="category-title">
      <p class="category-title-text">ЛИЧНЫЙ КАБИНЕТ</p>
  </div>

  <div class="account-holder">
    <?php include "templates/account/account.php"; ?>
  </div>


<?php include "templates/footer/footer.php" ?>
</div>
