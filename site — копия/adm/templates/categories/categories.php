  <div class="category-title">
      <p class="category-title-text">ЗАКАЗЫ</p>
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

      <?php
        if(is_array($dbAnswer)) {
          foreach ($dbAnswer as $key => $value) {
            $countOfProducts = 0;
            foreach ($value as $k => $v) {
              if($k == 'id') {
                $tmpQuery = "SELECT id FROM products WHERE cat_id = '".$v."'";
                $tmp = $el->query($tmpQuery);
                $tmp = $el->fetch($tmp);
                $countOfProducts = (isset($tmp) && $tmp[0] != "") ? count($tmp) : 0;
              }
            } ?>
              <tr>
                <td class="cat-name">
                  <img src="img/folder.png" />
                  <p><?php echo $value['name']; ?></p>
                </td>
                <td class="count">
                  <p><?php echo $countOfProducts; ?></p>
                </td>
                <td class="del">
                  <a href="<?php echo 'script/delCat.php?cid='.$value['id']; ?>">удалить</a>
                </td>
                <td class="view">
                  <a href="<?php echo 'products_in_category.php?cd='.$value['id']; ?>">просмотр</a>
                </td>
              </tr>

        <?php  }
        $el->close();
      }
      ?>
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
