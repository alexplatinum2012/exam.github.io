<?php
  include_once "script/DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT *
            FROM site_settings";
  $tmp = $el->query($query);
  $siteSettings = $el->fetch($tmp)[0];
  $name = $footerText = $curr = $about1 = $about2 = '';
  if($siteSettings != '') {
    $name = $siteSettings['name'];
    $footerText = $siteSettings['footer_text'];
    $curr = $siteSettings['curr'];
    $about1 = $siteSettings['about1'];
    $about2 = $siteSettings['about2'];
  }

  $query = "SELECT *
            FROM main_promo
            ORDER BY id";
  $query = $el->query($query);
  $mainPromo = $el->fetch($query);

  $query = "SELECT id, name
            FROM products
            WHERE (SELECT SUM(count)
                   FROM prod_types
                   WHERE pr_id = products.id) > 0
            ORDER BY cat_id";
  $query = $el->query($query);
  $selectArr = $el->fetch($query);
  $el->close();
  $iPath = "/exam/site/img/main_promo_img/";
?>

<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/settings/settings.php"; ?>
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
    div.parentNode.querySelector('label.input-file').innerText = 'Изменить';
    div.classList.remove('active');
  }
</script>
