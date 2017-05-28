<footer class="footer">
  <div class="left-block">
    <p class="footer-text "><?php echo $siteSettings['footer_text']; ?></p>
  </div>
  <?php
    if(isset($_SESSION['id']) &&
       $_SESSION['id'] != '' &&
       isset($_SESSION['role']) &&
       $_SESSION['role'] == 'admin') {
         echo "<a class='admin-panel' style='display:block; float:left;margin-left:50%; margin-top:1%' href='adm/orders.php'>admin panel</a>";
       }
  ?>
  <div class="right-block">
    <a href="#" onclick="return up()">Наверх</a>
    <div class="arrow-up">
      <img src="img/up_arrow.png" alt="up_arrow">
    </div>
  </div>
  <div class="clearfix"></div>
</footer>
<script type="text/javascript">
  var timer;
  function up() {
  var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
  if(top > 0) {
    window.scrollBy(0,-100);
    timer = setTimeout('up()',20);
  } else clearTimeout(timer);
  return false;
}
</script>
<?php

?>
