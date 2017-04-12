  <div class="category-title">
      <p class="category-title-text">ЗАКАЗЫ</p>
  </div>
  <div class="table-holder">
    <table>
	  <tr>
	    <th class="order-number">
		  <p>НОМЕР ЗАКАЗА</p>
	    </th>
		<th class="status">
		  <p>СТАТУС</p>
	    </th>
		<th class="summ">
		  <p>СУММА</p>
	    </th>
		<th class="order-time">
		  <p>ВРЕМЯ ЗАКАЗА</p>
	    </th>
	    <th class="view">
		  <p></p>
	    </th>
	  </tr>
    <?php
    foreach ($orders as $key => $value) { ?>
      <tr>
        <td class="order-number">
          <p class="l">№<?php echo $value['id']; ?></p>
          <p class="c">от</p>
          <p class="r"><?php echo $value['email']; ?></p>
        </td>
        <td class="status">
          <a href="#"><?php echo $value['status']; ?></a>
        </td>
        <td class="summ">
          <p><?php echo number_format($value['sum'], 0, ',', ' '); ?>руб.</p>
        </td>
        <td class="order-time">
          <p><?php echo date("d.m.Y в H:i",strtotime($value['date'].' '.$value['time'])); ?></p>
        </td>
        <td class="view">
          <a href="order_information.php?oid=<?php echo $value['id']; ?>">просмотр</a>
        </td>
      </tr>

    <?php } ?>

	</table>
  </div>
