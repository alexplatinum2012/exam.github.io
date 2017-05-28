<?php
  include_once "script/DB_operations.php";
  $el = new db;
  $el->connect();
  if($el->database === false) echo "ERROR conect to DB";
  $query = "SELECT *
            FROM product_blocks
            ORDER BY id";
  $tmp = $el->query($query);
  $blockSettings = $el->fetch($tmp);
  $el->close();
  $iPath = "/exam/site/img/block_img/";
?>

<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/settings/blocks.php"; ?>
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
  function addNewBlock(button) {
    var div = button.previousElementSibling;
    var i = (div.childElementCount > 0) ? (+div.lastElementChild.dataset.id + 1) : 1;
    var newEl = document.createElement('table');
    newEl.dataset.id = i;
    var str = "<tr><th><p>НАСТРОЙКА БЛОКА</p></th><th><form id='block" + i + "' name='block" + i + "' action='script/changeBlock.php' method='post'></form><input form='block" + i + "' class='input' type='hidden' name='typer' value='2' /><input form='block" + i + "' type='hidden' name='id' value='" + i + "'><button form='block" + i + "' type='submit'>Сохранить изменения</button><iframe id='ifrDel' name='ifrDel'></iframe><form action='script/changeBlock.php' target='ifrDel' method='post'><input type='hidden' name='id' value='" + i + "'><input type='hidden' name='typer' value='3'><button class='del' type='button' onClick='delBlock(this, " + i + ")'>Удалить блок</button></form></th></tr><tr><td><div id='block_img' class='promo-img'><div id='blockIMG" + i + "' class='image'></div><form id='changeblockImg" + i + "' class='form' enctype='multipart/form-data' target='iframe' action='script/changeBlock.php' method='post'><input class='input' type='hidden' name='typer' value='1' /><input class='input' type='hidden' name='id' value='" + i + "' /><label class='input-file'><input type='file' name='filex' value='' onchange=changing('changeblockImg" + i + "','blockIMG" + i + "'); />Добавить</label></form></div></td><td><p class='pre-input'><b>ЗАГОЛОВОК</b></p><input form=block" + i + " type='text' name='line1' value='' /><p class='pre-input'><b>ТЕКСТ</b></p><input form='block" + i + "' type='text' name='line2' value='' /></td></tr>";
    newEl.innerHTML = str;
    div.appendChild(newEl);
  }
  function delBlock(el, id) {
    el.parentNode.submit();
    var str = "table[data-id='" + id + "']";
    var t = document.querySelector(str);
    t.parentNode.removeChild(t);
  }
</script>
