  <form id="1" name="1" action="script/changeGlobal.php" method="post"></form>
  <iframe id="iframe" name="iframe" onload="loading(this)"></iframe>
  <div class="category-title">
      <p class="category-title-text">ГЛАВНЫЕ НАСТРОЙКИ САЙТА</p>
  </div>
  <div class="table-holder">
    <table>
      <tr>
        <th>
        <p>НАСТРОЙКИ МАГАЗИНА</p>
        </th>
        <th>
          <form id="site-settings" name="site-settings" action="script/changeGlobal.php" method="post"></form>
          <input form="site-settings" type="hidden" name="typer" value="1" />
          <button form="site-settings" type="submit">Сохранить изменения</button>
        </th>
      </tr>
      <tr>
        <td>
          <p class='pre-input'><b>Название магазина</b></p>
          <input form="site-settings" form="" type="text" name="name" value="<?php echo $name; ?>" />
          <p class='pre-input'><b>Текст в подвале</b></p>
          <input form="site-settings" form="" type="text" name="footer_text" value="<?php echo $footerText; ?>" />
          <p class='pre-input'><b>Отображаемая валюта</b></p>
          <input form="site-settings" form="" type="text" name="curr" value="<?php echo $curr; ?>" />
        </td>
        <td>
          <p class='pre-input'><b>Текст о магазине 1</b></p>
          <textarea form="site-settings" name="about1"><?php echo $about1; ?></textarea>
          <p class='pre-input'><b>Текст о магазине 2</b></p>
          <textarea form="site-settings" name="about2"><?php echo $about2; ?></textarea>
        </td>
      </tr>
    </table>

    <?php
      for ($i = 0; $i < 4; $i++) {
    ?>
    <table>
      <tr>
        <th>
        <p>НАСТРОЙКА ПРОМО <?php echo ($i+1); ?></p>
        </th>
        <th>
          <form id="promo<?php echo ($i+1); ?>" name="promo<?php echo ($i+1); ?>" action="script/changeGlobal.php" method="post"></form>
          <input form="promo<?php echo ($i+1); ?>" type="hidden" name="typer" value="2">
          <input form="promo<?php echo ($i+1); ?>" type="hidden" name="id" value="<?php echo ($i+1); ?>">
          <button form="promo<?php echo ($i+1); ?>" type="submit">Сохранить изменения</button>
        </th>
      </tr>
      <tr>
        <td>
          <div id="main_promo_img" class="promo-img">
            <div id='promoIMG<?php echo ($i+1); ?>' class="image">
              <?php
                if(isset($mainPromo[$i]['link']) && $mainPromo[$i]['link'] != '') {
                  echo "<img class='load-img' src='".$iPath.$mainPromo[$i]['link']."' title='main_promo_img".($i+1)."'/>";
                  $txt = 'Изменить';
                } else {
                  $txt = 'Добавить';
                }
              ?>
            </div>
            <form id="changeMainPromoImg<?php echo ($i+1); ?>" class="form" enctype="multipart/form-data" target="iframe" action="script/changeGlobal.php" method="post">
              <input class="input" type="hidden" name="typer" value="3" />
              <input class="input" type="hidden" name="id" value="<?php echo ($i+1); ?>" />
              <label class="input-file"><input type="file" name="filex" value="" onchange="changing('changeMainPromoImg<?php echo ($i+1); ?>', 'promoIMG<?php echo ($i+1); ?>')" /><?php echo $txt; ?></label>
            </form>
          </div>
        </td>
        <td>
          <p class='pre-input'><b>Выфберите продукт</b></p>
          <select form="promo<?php echo ($i+1); ?>" name="pr_id">
            <option value="">-- Не выбирать ничего</option>
            <?php foreach ($selectArr as $key => $value) {
              if($value['id'] == $mainPromo[$i]['pr_id']) { ?>
                <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
            <?php }
            } ?>
          </select>
          <br/>
          <hr>
          <p class='pre-input'><b>ЗАГОЛОВОК</b></p>
          <input form="promo<?php echo ($i+1); ?>" type="text" name="promo_title1" value="<?php echo $mainPromo[$i]['promo_title1']; ?>" />
          <p class='pre-input'><b>ПРОМО ТОВАРА</b></p>
          <input form="promo<?php echo ($i+1); ?>" type="text" name="promo_title2" value="<?php echo $mainPromo[$i]['promo_title2']; ?>" />
          <?php
            if($i == 0) {?>
              <p class='pre-input'><b>ПРОМО ТОВАРА</b></p>
              <input form="promo<?php echo ($i+1); ?>" type="text" name="about" value="<?php echo $mainPromo[$i]['about']; ?>" />
            <?php }
          ?>
        </td>
      </tr>
  	</table>
<?php } ?>
