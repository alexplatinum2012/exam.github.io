	<!--Wrapper-->
<a href="test.php?cat=1" target="buffer-iframe">LINK</a>
<iframe name="buffer-iframe" id="buffer-iframe">
  <?php
    if(isset($_GET['cid'])) {
      include_once "DB_operations.php";
      $el = new dba;
      $el->connect();
      if($el->database === false) echo "ERROR conect to DB";
      $sql = 
    }
  ?>
</iframe>
<div class="wrapper">
  <?php include "templates/header/header.php" ?>

  <div class="category-title">
	    <p class="category-title-text">Категория 1</p>
	    <p class="products-count">Показано 1-17 из 100 товаров</p>
  </div>

  <div id="section-holder">
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
