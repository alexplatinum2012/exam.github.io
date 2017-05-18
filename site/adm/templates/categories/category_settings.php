  <iframe id="iframe" name="iframe" onload="loading(this)"></iframe>
  <div class="category-title">
      <p class="category-title-text">НАСТРОЙКА КАТЕГОРИИ <?php //echo $categoryName; ?></p>
  </div>
  <div class="table-holder">
    <table>
	  <tr>
	    <th class="cat-name">
		  <p>НАЗВАНИЕ КАТЕГОРИИ</p>
	    </th>
		<th class="count">
		  <p>КОЛЛИЧЕСТВО ТОВАРОВ</p>
	    </th>
		<th class="del">
		  <p></p>
	    </th>
	    <th class="view">
		  <p></p>
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
        <p><?php// echo $countOfProducts; ?></p>
      </td>
      <td class="del">
        <a href="<?php //echo 'script/delCat.php?cid='.$value['id']; ?>">удалить</a>
      </td>
      <td class="view">
        <a href="<?php //echo 'products_in_category.php?cd='.$value['id']; ?>">просмотр</a>
      </td>
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
        <p><?php// echo $countOfProducts; ?></p>
      </td>
      <td class="del">
        <a href="<?php //echo 'script/delCat.php?cid='.$value['id']; ?>">удалить</a>
      </td>
      <td class="view">
        <a href="<?php //echo 'products_in_category.php?cd='.$value['id']; ?>">просмотр</a>
      </td>
    </tr>

	</table>
  </div>
  <div class="add-cat">
    <form action="script/createCategory.php" method="post" name="add-cat">
      <p>Добавить категорию:</p>
	  <input type="text" name="catName" value="" />
	  <div class="clearfix"></div>
	  <button type="submit">добавить категорию</button>
	</form>
  </div>
