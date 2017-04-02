
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
//session_start();
//date_default_timezone_set('Europe/Moscow');
//$l=date("dHis", time()+1800); // день,Час, минута, секунда
//echo $l."<br />";
//$l+=3700; // Прибавляем к настоящему времени нужный тебе лимит. я прибавил 600
//echo $l;
/*$_SESSION['LIMIT']=$limit;

session_start();
$time=date(dHis);
$limit=$_SESSION['LIMIT'];
if ($time>$limit) exit();*/
date_default_timezone_set('Europe/Moscow');
echo "<br />current=".date("dHis");
echo "<br />idLim=".$_SESSION['idLim'];
echo "<br />tmpLim=".$_SESSION['tmpLim'];
?>
