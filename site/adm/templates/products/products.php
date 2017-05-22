  <div class="category-title">
      <p class="category-title-text">ВСЕ ТОВАРЫ</p>
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
      		  <p><?php echo number_format($value['cost'], 0, ',', ' ').$siteSettings['curr']; ?></p>
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
