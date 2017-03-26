<?php
if(isset($_GET['cid'])) {
  include_once "script/DB_operations.php";
  $el = new dba;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $sql = "SELECT * FROM prod_category WHERE id = '".$_GET['cid']."'";
  $sql = $el->query($sql);
  $category = $el->fetch($sql);
  $catName = $category[0]['name'];
  $curr = 'руб.';
  $headerTitle = "Товары";

  $sql = "SELECT * FROM products WHERE cat_id = '".$_GET['cid']."'";
  $sql = $el->query($sql);
  $products = $el->fetch($sql);
  $el->close();
}
?>
	<!--Wrapper-->
<a href="test.php?cat=1" target="buffer-iframe">LINK</a>
<iframe name="buffer-iframe" id="buffer-iframe">
</iframe>
<div class="wrapper">
  <?php include "templates/header/header.php" ?>

  <div class="category-title">
	    <p class="category-title-text">Категория 1</p>
	    <p class="products-count">Показано 1-17 из 100 товаров</p>
  </div>

  <div id="section-holder">
    <?php include "templates/product_preview/product_preview.php"; ?>
    <!--Here is frame's body loading-->
  </div>

  <?php include "templates/footer/footer.php" ?>
</div>
<script type="text/javascript">
  var frame = document.getElementById('buffer-iframe');
  var sectionHolder = document.getElementById('section-holder');
  frame.onload = function(e){
    sectionHolder.innerHTML = this.contentDocument.body.innerHTML;
  }
</script>
    <!--End wrapper-->
