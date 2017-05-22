  <form id="cat_settings" name="cat_settings" class="logo" action="script/changeCatSettings.php" method="post"></form>
  <iframe id="iframe" name="iframe" onload="loading(this)"></iframe>
  <div class="category-title">
      <p class="category-title-text">НАСТРОЙКА КАТЕГОРИИ <?php //echo $categoryName; ?></p>
  </div>
  <div class="table-holder">
    <table>
	  <tr>
	    <th colspan="2" class="cat-name">
		  <p>НАСТРОЙКА ЛОГО КАТЕГОРИИ</p>
	    </th>
	  </tr>
    <tr>
      <td class="cat-name">
        <div id="cat_logo_img" class="logo-img">
          <div id='logoIMG' class="image">
            <?php //here understanding of availability of existing the image in DB if true $text = CHANGE else ADD
              if($catLogo != '') {
                echo "<img class='load-img' src='".$catLogo."' title='cat_logo_img' />";
                $txt = 'Изменить';
                $type = 'change';
              }
              else {
                $txt = 'Добавить';
                $type = 'add';
              }
            ?>
          </div>
          <form id="changeCATlogoImg" class="form" enctype="multipart/form-data" target="iframe" action="script/changeCATimg.php" method="post">
            <input class="input" type="hidden" name="type" value="<?php echo $type; ?>" />
            <input class="input" type="hidden" name="typeOfImg" value="logo" />
            <input class="input" type="hidden" name="cid" value="<?php echo $_GET['cid']; ?>" />
            <label class="input-file"><input type="file" name="filex" value="" onchange="changing('changeCATlogoImg', 'logoIMG')" /><?php echo $txt; ?></label>
          </form>
        </div>

      </td>
      <td class="count">
        <p class='pre-input'><b>Заголовок лого</b></p>
        <input form="cat_settings" type="text" name="logo_title" value="<?php echo $logoTitle; ?>" />
        <p class="pre-input"><b>Описание категории</b></p>
        <textarea form="cat_settings" name="logo_description"><?php echo $logoDescription; ?></textarea>
      </td>
    </tr>
  </table>
  <table>
  <tr>
    <th colspan="2" class="cat-name">
    <p>НАСТРОЙКА ПРОМО КАТЕГОРИИ</p>
    </th>
  </tr>
    <tr>
      <td class="cat-name">
        <div id="cat_logo_img" class="logo-img">
          <div id='promoIMG' class="image">
            <?php //here understanding of availability of existing the image in DB if true $text = CHANGE else ADD
              if($catPromo != '') {
                echo "<img class='load-img' src='".$catPromo."' title='cat_logo_img' />";
                $txt = 'Изменить';
                $type = 'change';
              }
              else {
                $txt = 'Добавить';
                $type = 'add';
              }
            ?>
          </div>
          <form id="changeCATpromoImg" class="form" enctype="multipart/form-data" target="iframe" action="script/changeCATimg.php" method="post">
            <input class="input" type="hidden" name="type" value="<?php echo $type; ?>" />
            <input class="input" type="hidden" name="typeOfImg" value="promo" />
            <input class="input" type="hidden" name="cid" value="<?php echo $_GET['cid']; ?>" />
            <label class="input-file"><input type="file" name="filex" value="" onchange="changing('changeCATpromoImg', 'promoIMG')" /><?php echo $txt; ?></label>
          </form>
        </div>

      </td>
      <td class="count">
        <p class='pre-input'><b>Выфберите продукт, который будет в промо части этой категории</b></p>
        <select form="cat_settings" name="promo_pr_id">
          <option value="">-- Не выбирать ничего</option>
          <?php foreach ($selectArr as $key => $value) {
            if($value['id'] == $prID) { ?>
              <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
          <?php }
          } ?>
        </select>
        <br/>
        <hr>
        <p class='pre-input'><b>ЗАГОЛОВОК</b></p>
        <input form="cat_settings" type="text" name="promo_title1" value="<?php echo $promoTitle1; ?>" />
        <p class='pre-input'><b>ПРОМО ТОВАРА</b></p>
        <input form="cat_settings" type="text" name="promo_title2" value="<?php echo $promoTitle2; ?>" />
      </td>
    </tr>

	</table>
  </div>
  <div class="add-cat">
	  <div class="clearfix"></div>
    <input form="cat_settings" type="hidden" name="catID" value="<?php echo $_GET['cid']; ?>">
	  <button id="saveCatSettings" form="cat_settings" class="dou" type="submit">Сохранить</button>
  </div>
