  <div class="category-title">
      <p class="category-title-text">ПОЛЬЗОВАТЕЛИ</p>
  </div>
  <div class="table-holder">
    <table>
	  <tr>
	    <th class="name">
		  <p>ИМЯ</p>
	    </th>
		<th class="email">
		  <p>E-MAIL</p>
	    </th>
		<th class="tel">
		  <p>ТЕЛЕФОН</p>
	    </th>
	    <th class="view">
		  <p></p>
	    </th>
	  </tr>
    <?php
      if($result) {
        foreach ($result as $key => $value) { ?>
          <tr>
      	    <td class="name">
      		  <p><?php echo $value['fio']; ?></p>
      	    </td>
      		<td class="email">
      		  <a href="mailto:users@mail.ru"><?php echo $value['email']; ?></a>
      	    </td>
      		<td class="tel">
      		  <p><a href="tel:<?php echo $value['phone']; ?>"><?php echo $value['phone']; ?></a></p>
      	    </td>
      	    <td class="view">
      		  <a href="user_information.php?uid=<?php echo $value['id']; ?>">просмотр</a>
      	    </td>
      	  </tr>
        <?php }
      }
    ?>
	</table>
  </div>
