  <div class="category-title">
      <p class="category-title-text">ПОЛЬЗОВАТЕЛИ</p>
  </div>
  <div class="info-holder">
    <table><tr><th>ИНФОРМАЦИЯ О ПОЛЬЗОВАТЕЛЕ</th></tr></table>
	<div class="l">
	  <p class="pre-input">Контактное лицо (ФИО):</p>
	  <input type="text" name="fio" value="<?php echo $result[0]['fio']; ?>">
	  <p class="pre-input">Контактный телефон:</p>
	  <input type="text" name="tel" value="<?php echo $result[0]['phone']; ?>">
	  <p class="pre-input">E-mail:</p>
	  <input type="email" name="e-mail" value="<?php echo $result[0]['email']; ?>">
	</div>
	<div class="c">
	  <p class="pre-input">Город:</p>
	  <input type="text" name="city" value="<?php echo $result[0]['city']; ?>">
	  <p class="pre-input">Улица:</p>
	  <input type="text" name="street" value="<?php echo $result[0]['street']; ?>">
	  <div class="c-house">
	    <p class="pre-input">Дом:</p>
	    <input type="text" name="house" value="<?php echo $result[0]['house']; ?>">
	  </div>
	  <div class="c-apart">
	    <p class="pre-input">Квартира:</p>
	    <input type="text" name="apart" value="<?php echo $result[0]['apart']; ?>">
	  </div>
	</div>
	<div class="clearfix"></div>
  </div>
  <div class="table-holder">
    <table>
	  <tr>
	    <th class="name">
		  <p>ИСТОРИЯ ЗАКАЗОВ</p>
	    </th>
		<th class="email">
		  <p></p>
	    </th>
		<th class="tel">
		  <p></p>
	    </th>
	    <th class="view">
		  <p></p>
	    </th>
	  </tr>
	  <tr>
	    <td class="order-number">
		  <p>№8911</p>
	    </td>
		<td class="cost">
		  <p>15 470 руб.</p>
	    </td>
		<td class="data">
		  <p>01.01.2011 в 15:44</p>
	    </td>
	  </tr>
	  	  <tr>
	    <td class="order-number">
		  <p>№8911</p>
	    </td>
		<td class="cost">
		  <p>15 470 руб.</p>
	    </td>
		<td class="data">
		  <p>01.01.2011 в 15:44</p>
	    </td>
	  </tr>
	  	  <tr>
	    <td class="order-number">
		  <p>№8911</p>
	    </td>
		<td class="cost">
		  <p>15 470 руб.</p>
	    </td>
		<td class="data">
		  <p>01.01.2011 в 15:44</p>
	    </td>
	  </tr>
	  <tr class="last-line">
	    <td class="last-line" colspan="3">
		  <div>
		    <p class="txt">ИТОГОВАЯ СУММА ЗАКАЗОВ</p>
		    <p class="total">21 970</p>
		    <p class="curr">руб.</p>
		  </div>
		</td>
	  </tr>
	</table>
  </div>
  <a class="del-user" href="script/delete.user.php?duid=<?php echo $_GET['uid']; ?>">Удалить пользователя</a>
