<iframe name="framer" id="framer"></iframe>
    <form name="to-order" id="to-order" action="checkout.php" method="post">
      <input type="hidden" name="page-num" value="<?php if(isset($_SESSION['id'])) echo 2; else echo 1; ?>">
      <input type="hidden" name="status" value="created">
    </form>
    <div class="cart-holder">
      <iframe name="ifr-cart" id="ifr-cart"></iframe>
      <table>
        <tr>
          <th colspan="2">Товар</th>
          <th>Доступность</th>
          <th>Стоимость</th>
          <th>Колличество</th>
          <th colspan="2">Итого</th>
        </tr>
        <?php
          for ($i = 0; $i < count($resultCart); $i++) {
            for ($j = $i + 1; $j < count($resultCart); $j++) {
              if($resultCart[$i]['ccc'] == 0) continue;
              if($resultCart[$j]['prodvarid'] == $resultCart[$i]['prodvarid'] && $resultCart[$j]['prodid'] == $resultCart[$i]['prodid']) {
                  $resultCart[$i]['ccc']++;
                  $resultCart[$j]['ccc'] = 0;
              }
            }
          }
          for ($i = 0; $i < count($resultCart); $i++) {
            if(!isset($resultCart[$i]['ccc'])) $resultCart[$i]['ccc'] = 1;
          }
          $i = 1;
          foreach ($resultCart as $key => $value) {
            if($value['ccc'] == 0) {
              $i++;
              continue;
            }
            ?>
            <tr>
              <td class="img-col">
                <div><img src="img/prod_photo/<?php echo $value['prodphoto']; ?>" alt="">
                </div>
              </td>
              <td class="name-col"><?php echo $value['prodname']; ?></td>
              <td class="availability-col"><?php if($value['prodcount'] > 0) echo 'Есть в наличии'; else echo 'нет в наличии' ?></td>
              <td class="price-col price-<?php echo $i ?>" name="<?php echo $value['prodcost']; ?>">
                <div><?php echo number_format($value['prodcost'], 0, ',', ' '); ?></div>
                <p class="curr">руб.</p>
              </td>
              <td class="quantity-col">
                <div class="minus" onclick="operate(this, <?php echo $i; ?>)">
                  <p>-</p>
                </div>
                <div name="count-<?php echo $value['prodcount']; ?>" class="count count-<?php echo $i ?>">
                  <p><?php echo $value['ccc']; ?></p>
                  <input form="to-order" type="hidden" name="<?php echo 'arr|'.$value['prodid'].'|'.$value['prodvarid']; ?>" value="<?php echo $value['ccc']; ?>">
                </div>
                <div class="plus" onclick="operate(this, <?php echo $i; ?>)">
                  <p>+</p>
                </div>
              </td>
              <td class="total-col total-<?php echo $i ?>">
                <div><?php echo number_format(($value['prodcost'] * $value['ccc']), 0, ',', ' '); ?></div>
                <p class="curr">руб.</p>
              </td>
              <td class="delete-col">
                <div class="" onclick="del_block(this)">
                  <a href="script/del_from_cart.php?pid=<?php echo $value['prodid']; ?>&vid=<?php echo $value['prodvarid']; ?>" target="cart-frame">
                    <img src="img/delete.png" alt="delete">
                  </a>
                </div>
              </td>
            </tr>
          <?php
            $i++;
          }
          ?>

      </table>

      <div class="checkout">
        <div class="backward">
          <div class="button-a">
            <a href="<?php if(stripos($_SERVER['HTTP_REFERER'], 'cart.php') !== false) echo 'index.php'; else echo $_SERVER['HTTP_REFERER']; ?>">Вернуться к покупкам</a>
          </div>
        </div>
        <div class="pay-out">
          <div class="inform-pay">
            <p class="txt">Итого</p>
            <p class="summ"><?php echo number_format($totalAmount, 0, ',', ' '); ?></p>
            <input form="to-order" type="hidden" name="sum" value="<?php echo $totalAmount; ?>">
            <p class="curr">руб.</p>
          </div>
          <div class="button-pay">
            <a href="" onclick="return sbmt()">Оформить заказ</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>

      <script type="text/javascript">
      var totalAmount = document.querySelector("div.inform-pay p.summ");
      var totalAmountPrice = <?php echo $totalAmount; ?>;
        function del_block(el, prId) {
          setTimeout(function(){
                                  var priceAmount = document.querySelector('div.cart-price p.sum-price');
                                  el.parentNode.parentNode.style.display = 'none';
                                  totalAmount.innerHTML = priceAmount.innerHTML;
                               }, 1000);
          return true;
        }
        function number_format(number, decimals, dec_point, thousands_sep) {
          number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
          var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
              var k = Math.pow(10, prec);
              return '' + (Math.round(n * k) / k)
                .toFixed(prec);
            };
          s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
          if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
          }
          if ((s[1] || '')
            .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
              .join('0');
          }
          return s.join(dec);
        }
        function operate(el, position) {
          var divCounter = document.querySelector('div.count-' + position);
          var max = divCounter.getAttribute('name');
          max = parseInt(max.substring(6));
          var min = 1;
          var ext = parseInt(divCounter.firstElementChild.innerHTML);
          var total = document.querySelector('td.total-' + position + ' div');
          var cost = document.querySelector('td.price-' + position);
          var costName = cost.getAttribute('name');
          cost = parseInt(costName);
          var totalAmount = document.querySelector("div.inform-pay p.summ");
          switch(el.className) {
            case 'minus' :
              if(ext > 1) {
                divCounter.firstElementChild.innerHTML = --ext;
                divCounter.firstElementChild.nextElementSibling.value = ext;
                var result = cost * parseInt(divCounter.firstElementChild.innerHTML);
                result = number_format(result, 0, ',', ' ');
                total.innerHTML = result;
                totalAmountPrice -= cost;
                totalAmount.nextElementSibling.value = totalAmountPrice;
                totalAmount.innerHTML = number_format(totalAmountPrice, 0, ',', ' ');
              }
              break;
            case 'plus' :
              if(ext < max) {
                divCounter.firstElementChild.innerHTML = ++ext;
                divCounter.firstElementChild.nextElementSibling.value = ext;
                var result = cost * parseInt(divCounter.firstElementChild.innerHTML);
                result = number_format(result, 0, ',', ' ');
                total.innerHTML = result;
                totalAmountPrice += cost;
                totalAmount.nextElementSibling.value = totalAmountPrice;
                totalAmount.innerHTML = number_format(totalAmountPrice, 0, ',', ' ');
              }
          }
        }
        function sbmt() {
          document.getElementById('to-order').submit();
          return false;
        }
      </script>

  </div>
  <div class="clearfix"></div>
