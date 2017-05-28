  <form id="1" name="1" action="script/changeGlobal.php" method="post"></form>
  <iframe id="iframe" name="iframe" onload="loading(this)"></iframe>
  <div class="category-title">
      <p class="category-title-text">НАСТРОЙКИ БЛОКОВ</p>
  </div>
  <div class="table-holder">
    <?php
    if(isset($blockSettings) && $blockSettings[0] != '') {
      foreach ($blockSettings as $key => $value) {
    ?>
    <table data-id = <?php echo $value['id']; ?>>
      <tr>
        <th>
        <p>НАСТРОЙКА БЛОКА</p>
        </th>
        <th>
          <form id="block<?php echo $value['id']; ?>" name="block<?php echo $value['id']; ?>" action="script/changeBlock.php" method="post"></form>
          <input form="block<?php echo $value['id']; ?>" class="input" type="hidden" name="typer" value="2" />
          <input form="block<?php echo $value['id']; ?>" type="hidden" name="id" value="<?php echo $value['id']; ?>">
          <button form="block<?php echo $value['id']; ?>" type="submit">Сохранить изменения</button>
          <iframe id="ifrDel" name="ifrDel"></iframe>
          <form action="script/changeBlock.php" target="ifrDel" method="post">
            <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
            <input type="hidden" name="typer" value="3">
            <button class="del" type="button" onClick="delBlock(this, <?php echo $value['id']; ?>)">Удалить блок</button>
          </form>
        </th>
      </tr>
      <tr>
        <td>
          <div id="block_img" class="promo-img">
            <div id='blockIMG<?php echo $value['id']; ?>' class="image">
              <?php
                if(isset($value['link']) && $value['link'] != '') {
                  echo "<img class='load-img' src='".$iPath.$value['link']."' title='block_img".$value['id']."'/>";
                  $txt = 'Изменить';
                } else {
                  $txt = 'Добавить';
                }
              ?>
            </div>
            <form id="changeblockImg<?php echo $value['id']; ?>" class="form" enctype="multipart/form-data" target="iframe" action="script/changeBlock.php" method="post">
              <input class="input" type="hidden" name="typer" value="1" />
              <input class="input" type="hidden" name="id" value="<?php echo $value['id']; ?>" />
              <label class="input-file"><input type="file" name="filex" value="" onchange="changing('changeblockImg<?php echo $value['id']; ?>', 'blockIMG<?php echo $value['id']; ?>')" /><?php echo $txt; ?></label>
            </form>
          </div>
        </td>
        <td>
          <p class='pre-input'><b>ЗАГОЛОВОК</b></p>
          <input form="block<?php echo $value['id']; ?>" type="text" name="line1" value="<?php echo $value['line1']; ?>" />
          <p class='pre-input'><b>ТЕКСТ</b></p>
          <input form="block<?php echo $value['id']; ?>" type="text" name="line2" value="<?php echo $value['line2']; ?>" />
        </td>
      </tr>
  	</table>
<?php
  }
}
?>
</div>
<button type="button" onclick="addNewBlock(this)">Добавить новый блок</button>
