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
        if(isset($orders) && $orders[0] != '') {
          $arr = array('Принят' => '#0a8eaf', 'Отгружен' => '#1ba254', 'У курьера' => '#ad5a00', 'Доставлен' => '#a01ba2', 'Отмена' => '#6c6c6c');
            foreach ($orders as $key => $value) { ?>
              <tr>
                <td class="order-number">
                  <p class="l">№<?php echo $value['id']; ?></p>
                  <p class="c">от</p>
                  <p class="r"><?php echo $value['email']; ?></p>
                </td>
                <td class="status">
                  <a href="#" style="color:<?php echo $arr[$value['status']]; ?>" data-oid="<?php echo $value['id']; ?>" onclick="return createPopup(this)"><?php echo $value['status']; ?></a>
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

    <?php
            }
        }
    ?>

	</table>
  </div>
  <iframe id='ifr1' name='ifr1'></iframe>
  <script type="text/javascript">
    function cancelPopup() {
      var div = document.querySelector("div.popup-window");
      if(!div) return;
      div.style.display = "none";
      document.body.removeChild(div);
    }
    var arr = {'Принят' : '#0a8eaf', 'Отгружен' : '#1ba254', 'У курьера' : '#ad5a00', 'Доставлен' : '#a01ba2', 'Отмена' : '#6c6c6c'};
    var ifr1 = document.getElementById('ifr1');
    var boofer = false;
    function createPopup(el) {
      var coordsEl = el.getBoundingClientRect();
      var div = document.createElement("div");
      for (var key in arr) {
        //if (object.hasOwnProperty(key)) {
          div.innerHTML += "<a target='ifr1' href='#' style='color:" + arr[key] + "' data-oid='" + el.dataset.oid + "' onclick='commit(this)'>" + key + "</a>";
        //}
      }
      div.className = "popup-window";
      div = document.body.appendChild(div)
      div.style.display = "block";
      div.style.left = coordsEl.left + "px";
      div.style.top = (coordsEl.top + 20) + "px";
      boofer = el;
      if (event.stopPropagation) {
       event.stopPropagation();
      } else {
       event.cancelBubble = true;
      }
    }
    document.body.onclick = cancelPopup;
    function commit(el) {
      el.href = "script/changeOrderStatus.php?s=" + el.innerHTML + "&o=" + el.dataset.oid;
      boofer.style.color = arr[el.innerHTML];
      document.body.removeChild(document.querySelector("div.popup-window"));
    }

    ifr1.onload = function() {
      if(ifr1.contentDocument.body.innerHTML != 'false') {
        if(boofer) {
          boofer.innerHTML = ifr1.contentDocument.body.innerHTML;
          boofer = false;
        }
      }
    }
  </script>
