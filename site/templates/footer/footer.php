
<footer class="footer">
  footer
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
