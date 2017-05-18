<script type="text/javascript">
  loading = function(t){};
</script>
<?php
  if(isset($_GET['cid']) && $_GET['cid'] != "") {
    include_once "script/DB_operations.php";
    $el = new db;
    $el->connect();
    if($el->database === false) echo "ERROR conect to DB";
    $q = "SELECT *
          FROM prod_category_settings
          WHERE cat_id = '".$_GET['cid']."'";
    $q = $el->query($q);
    $catImgs = $el->fetch($q);
    $catLogo = '';
    $catPromo = '';
    $path = "/exam/site/img/cat_img/";
    if($catImgs[0] != '') {
      foreach ($catImgs as $key => $value) {
        if($value['type'] == 'logo')  $catLogo = $path.$value['link'];
        if($value['type'] == 'promo')  $catPromo = $path.$value['link'];
      }
    }
  }
?>

<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/categories/category_settings.php"; ?>
    </div>
  </div>
</div>


<script type="text/javascript">
  function changing(formId, div) {
    document.getElementById(div).classList.add("active");
    document.getElementById(formId).submit();
  }
  function loading(t) {
    var div = document.querySelector('div.image.active');
    div.innerHTML = t.contentDocument.body.innerHTML;
    div.classList.remove('active');
  }
</script>
