  <div class="category-title">
      <div class="category-title-text">
	    <p class="order-title">ЗАКАЗ</p>
            <p class="order-number">№<?php echo $orderInfo['orderid'];?></p>
            <a class="order-status">(<?php echo $orderInfo['orderstatus'] ?>)</a>
	  </div>
  </div>
  <div class="table-holder">
    <table>
	  <tr>
	    <th colspan="5" class="order-number">
		  <p>СОДЕРЖИМОЕ ЗАКАЗА</p>
	    </th>
	  </tr>
          <?php
            foreach ($orderProdInfo as $key => $value) { ?>
              <tr>
                <td class="tov-name">
                    <p><a href="<?php echo '../product.php?pid='.$value['prid']; ?>" target="_blank"><?php echo $value['prname']; ?></a></p>
                </td>
                    <td class="cost">
                      <p><?php echo number_format($value['prcost'], 0, ',', ' ').$siteSettings['curr']; ?></p>
                </td>
                    <td class="tov-count">
                      <p><?php echo $value['prvarcount']; ?></p>
                </td>
                    <td class="summ">
                      <p><?php echo number_format(($value['prcost'] * $value['prvarcount']), 0, ',', ' ').$siteSettings['curr']; ?></p>
                </td>
                <td class="del">
                      <a href="script/delPrFromOrder.php?<?php echo 'o='.$_GET['oid'].'&p='.$value['prid'].'&v='.$value['prvarid'].'&c='.$value['prvarcount']; ?>">убрать из заказа</a>
                </td>
              </tr>
            <?php }
          ?>
	</table>
  </div>
  <div class="info-holder">
    <table><tr><th>ИНФОРМАЦИЯ О ЗАКАЗЕ</th></tr></table>
	<div class="l">
	  <p class="pre-input">Контактное лицо (ФИО):</p>
	  <input type="text" name="fio" value="<?php echo $orderInfo['userfio']; ?>">
	  <p class="pre-input">Контактный телефон:</p>
	  <input type="text" name="tel" value="<?php echo $orderInfo['userphone']; ?>">
	  <p class="pre-input">E-mail:</p>
	  <input type="email" name="e-mail" value="<?php echo $orderInfo['useremail']; ?>">
	</div>
	<div class="c">
	  <p class="pre-input">Город:</p>
	  <input type="text" name="city" value="<?php echo $orderInfo['usercity']; ?>">
	  <p class="pre-input">Улица:</p>
	  <input type="text" name="street" value="<?php echo $orderInfo['userstreet']; ?>">
	  <div class="c-house">
	    <p class="pre-input">Дом:</p>
	    <input type="text" name="house" value="<?php echo $orderInfo['userhouse']; ?>">
	  </div>
	  <div class="c-apart">
	    <p class="pre-input">Квартира:</p>
	    <input type="text" name="apart" value="<?php echo $orderInfo['userapart']; ?>">
	  </div>
	</div>
	<div class="r">
	  <p class="pre-input">Способ доставки:</p>
	  <p class="delivery-type"><?php if($orderInfo['orderdelivery'] == 1) echo 'Курьерская доставка с оплатой при получении';
                                         if($orderInfo['orderdelivery'] == 2) echo 'Почта Росссии с наложенным платежем';
                                         if($orderInfo['orderdelivery'] == 3) echo 'Доставка через терминалы QIWI Post'; ?></p>
	</div>
	<div class="clearfix"></div>
	<div class="comment-holder">
      <p class="pre-input">Комментарий к заказу:</p>
	  <textarea name="comment" value=""><?php echo $orderInfo['ordercomment']; ?></textarea>
	</div>
  </div>
  <div class="cancel-order"><a href="script/delOrder.php?<?php echo 'o='.$_GET['oid']; ?>">Отменить заказ</a></div>
  <div class="clearfix"></div>
