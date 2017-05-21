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
    $catSettings = $el->fetch($q)[0];
    $path = "/exam/site/img/cat_img/";
    $catLogo = ($catSettings['logo_link']) ? $path.$catSettings['logo_link'] : '';
    $logoTitle = $catSettings['logo_title'];
    $logoDescription = $catSettings['logo_description'];
    $catPromo = ($catSettings['promo_link']) ? $path.$catSettings['promo_link'] : '';
    $promoTitle1 = $catSettings['promo_title1'];
    $promoTitle2 = $catSettings['promo_title2'];
    $prID = $catSettings['promo_pr_id'];
    $q = "SELECT id, name
          FROM products
          WHERE cat_id = '".$_GET['cid']."' AND
          (SELECT SUM(count)
           FROM prod_types
           WHERE pr_id = products.id) > 0
           ORDER BY id";
    $q = $el->query($q);
    $selectArr = $el->fetch($q);
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
    div.nextElementSibling.firstElementChild.value = 'change';
    div.parentNode.querySelector('label.input-file').innerText = 'Изменить';
    div.classList.remove('active');
  }
</script>
