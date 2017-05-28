  <form id="changeUserInfo" name="changeUserInfo" action="script/changeUserInfo.php" method="post">
    <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
  </form>
  <div class="category-title">
      <p class="category-title-text">ПОЛЬЗОВАТЕЛИ</p>
  </div>
  <div class="info-holder">
    <table><tr><th>ИНФОРМАЦИЯ О ПОЛЬЗОВАТЕЛЕ</th></tr></table>
	<div class="l">
	  <p class="pre-input">Контактное лицо (ФИО):</p>
	  <input form="changeUserInfo" type="text" name="fio" value="<?php echo $result[0]['fio']; ?>">
	  <p class="pre-input">Контактный телефон:</p>
	  <input form="changeUserInfo" type="text" name="phone" value="<?php echo $result[0]['phone']; ?>">
	  <p class="pre-input">E-mail:</p>
	  <input form="changeUserInfo" type="email" name="e-mail" value="<?php echo $result[0]['email']; ?>">
	</div>
	<div class="c">
	  <p class="pre-input">Город:</p>
	  <input form="changeUserInfo" type="text" name="city" value="<?php echo $result[0]['city']; ?>">
	  <p class="pre-input">Улица:</p>
	  <input form="changeUserInfo" type="text" name="street" value="<?php echo $result[0]['street']; ?>">
	  <div class="c-house">
	    <p class="pre-input">Дом:</p>
	    <input form="changeUserInfo" type="text" name="house" value="<?php echo $result[0]['house']; ?>">
	  </div>
	  <div class="c-apart">
	    <p class="pre-input">Квартира:</p>
	    <input form="changeUserInfo" type="text" name="apart" value="<?php echo $result[0]['apart']; ?>">
	  </div>
	</div>
  <div class="r">
	  <p class="pre-input">Тип пользователя:</p>
    <select form="changeUserInfo" class="user-role" name="role">
      <option value="admin" <?php if($result[0]['role'] == 'admin') echo 'style="color:lightgreen" selected'; ?>>Администратор</option>
      <option value="seller" <?php if($result[0]['role'] == 'seller') echo 'style="color:lightgreen" selected'; ?>>Продавец</option>
      <option value="user" <?php if($result[0]['role'] == 'user') echo 'style="color:lightgreen" selected'; ?>>Пользователь</option>
    </select>
    <div class="clearfix"></div>
	  <button form="changeUserInfo" class="apply-change" type="submit" name="button">Применить изменения</button>
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
          <?php
                $total = 0;
                if(isset($orderInfo) && is_array($orderInfo) && $orderInfo[0] != '') {
                  foreach ($orderInfo as $key => $value) {
                    $total += $value['ordersum'];
          ?>
            	      <tr>
                      <td class="order-number">
                          <p><a href="order_information.php?oid=<?php echo $value['orderid']; ?>">№<?php echo $value['orderid']; ?></a></p>
                      </td>
                          <td class="cost">
                            <p><?php echo number_format($value['ordersum'], 0, ',', ' '); ?> руб.</p>
                      </td>
                          <td class="data">
                            <p><?php echo date("d.m.Y в H:i",strtotime($value['orderdate'].' '.$value['ordertime'])); ?></p>
                      </td>
                    </tr>
          <?php   }
              }
          ?>
	  <tr class="last-line">
	    <td class="last-line" colspan="3">
		  <div>
		    <p class="txt">ИТОГОВАЯ СУММА ЗАКАЗОВ</p>
		    <p class="total"><?php echo number_format($total, 0, ',', ' '); ?></p>
		    <p class="curr">руб.</p>
		  </div>
		</td>
	  </tr>
	</table>
  </div>
  <a class="del-user" href="script/delete_user.php?duid=<?php echo $_GET['uid']; ?>">Удалить пользователя</a>
