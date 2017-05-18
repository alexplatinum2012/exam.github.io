  <div class="category-title">
      <p class="category-title-text">ТОВАРЫ</p>
  </div>
  <div class="this-cat-holder">
    <form id="changeCatNameForm" name="changeCatNameForm" action="script/changeCatName.php" method="post">
      <p>Текущая категория:</p>
	  <input type="text" name="catName" value="<?php echo $catName; ?>" />
    <input type="hidden" name="catID" value="<?php echo $_GET['cd']; ?>" />
	  <button class="rename-cat" type="submit">переименовать</button>
	</form>
	<div class="clearfix"></div>
  <a class="add-prod" href="<?php echo 'product_addition.php?cid='.$_GET['cd']; ?>">Добавить товар в категорию</a>
  </div>
  <div class="table-holder">
    <table>
	  <tr>
	    <th class="prod-name">
		  <p>НАЗВАНИЕ ТОВАРА</p>
	    </th>
		<th class="cost">
		  <p>СТОИМОСТЬ</p>
	    </th>
	    <th class="view">
		  <p></p>
	    </th>
	  </tr>
    <?php
      if(isset($dbAnswer) && $dbAnswer != "") {
        foreach ($dbAnswer as $key => $value) {?>
          <tr>
      	    <td class="prod-name">
      		  <p><?php echo $value['name']; ?></p>
      	    </td>
      		<td class="cost">
      		  <p><?php echo $value['cost']; ?></p>
      	    </td>
      	    <td class="view">
      		  <a href="<?php echo 'product_information.php?pid='.$value['id']; ?>">просмотр</a>
      	    </td>
      	  </tr>
        <?php
        }
      }?>


	</table>
  </div>
