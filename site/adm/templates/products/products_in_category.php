  <div class="category-title">
      <p class="category-title-text">ТОВАРЫ</p>
  </div>
  <div class="this-cat-holder">
    <form id="catNameForm" name="catNameForm">
      <p>Текущая категория:</p>
	  <input type="text" name="catName" value="<?php echo $catName; ?>" />
	  <a href="#">переименовать</a>
	</form>
	<div class="clearfix"></div>
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
      <?php } ?>


	</table>
  </div>
