<section class="checkout-body">
  <form id="order-complite" action="" method="post">
    <input type="hidden" name="page-num" value="4">
    <input type="hidden" name="order-id" value="<?php echo $IDorder; ?>">
  </form>
  <div class="order-list">
    <p class="title-form">Состав заказа</p>
	<table class="t-order-list">
	  <tr>
	    <th class="prod">Товар</th>
  		<th class="cost">Стоимость</th>
  		<th class="count">Колличество</th>
  		<th class="total">Итого</th>
	  </tr>
	</table>
	<hr />
	<table class="t-order-list">
    <?php
      $sum = 0;
      $prdcts = '';
      $prdctscnts = '';
      foreach ($infoOrder as $key => $value) {
        $sum += $value['prodcost'] * $value['varcount'];
        ?>
        <input form="order-complite" type="hidden" name="<?php echo 'varid|'.$value['varid']; ?>" value="<?php echo $value['varcount']; ?>">
        <tr>
          <td class="prod"><?php echo $value['prodname']; ?></td>
          <td class="cost"><div><p><?php echo number_format($value['prodcost'], 0, ',', ' '); ?></p><p class="curr">руб.</p></div></td>
          <td class="count"><?php echo $value['varcount']; ?></td>
          <td class="total"><div><p><?php echo number_format(($value['prodcost'] * $value['varcount']), 0, ',', ' '); ?></p><p class="curr">руб.</p></div></td>
        </tr>
      <?php } ?>
	  <tr>
	    <td class="total-all" colspan=4><div><p>Итого:</p><p class="sum"><?php echo number_format($sum, 0, ',', ' '); ?></p><p class="curr">руб.</p></div></td>
	  </tr>
	</table>

  </div>
  <div class="user-confirm-info">
	<p class="title-form">Доставка</p>
	<div class="left">
	  <p class="pre-input">Контактное лицо (ФИО):</p>
	  <p class="mb31"><?php echo $scCart['u_info']['fio']; ?></p>
	  <p class="pre-input">Контактный телефон:</p>
	  <p class="mb31"><?php echo $scCart['u_info']['userphone']; ?></p>
	  <p class="pre-input">E-mail:</p>
	  <p class="mb31"><?php echo $scCart['u_info']['useremail']; ?></p>
	</div>
	<div class="center">
	  <p class="pre-input">Город:</p>
	  <p class="mb31"><?php echo $scCart['u_info']['city']; ?></p>
	  <p class="pre-input">Улица:</p>
	  <p class="mb31"><?php echo $scCart['u_info']['street']; ?></p>
	  <div class="c-left">
	    <p class="pre-input">Дом:</p>
    	<p class="house mb31"><?php echo $scCart['u_info']['house']; ?></p>
	  </div>
	  <div class="c-right">
	    <p class="apart pre-input">Квартира:</p>
	    <p class="mb31"><?php echo $scCart['u_info']['apart']; ?></p>
	  </div>
	</div>
	<div class="right">
	  <p class="pre-input">Способ доставки:</p>
      <p class="mb31"><?php if($scCart['u_info']['delivery'] == 1) echo 'Курьерская доставка с оплатой при получении';
                            if($scCart['u_info']['delivery'] == 2) echo 'Почта Росссии с наложенным платежем';
                            if($scCart['u_info']['delivery'] == 3) echo 'Доставка через терминалы QIWI Post'; ?></p>
	  <p class="pre-input">Комментарий к заказу:</p>
	  <p class="mb31"><?php echo $scCart['u_info']['comment']; ?></p>
	</div>
	<div class="clearfix"></div>
    <button form="order-complite" type="submit">Продолжить</button>
  </div>

  <div class="clearfix"></div>
</section>
