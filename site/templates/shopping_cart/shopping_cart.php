<iframe name="framer" id="framer"></iframe>
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
          $i = 1;
          foreach ($resultCart as $key => $value) { ?>
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
                <p>1</p>
              </div>
              <div class="plus" onclick="operate(this, <?php echo $i; ?>)">
                <p>+</p>
              </div>
            </td>
            <td class="total-col total-<?php echo $i ?>">
              <div><?php echo number_format($value['prodcost'], 0, ',', ' '); ?></div>
              <p class="curr">руб.</p>
            </td>
            <td class="delete-col">
              <a target="cart-frame" href="script/del_from_cart.php?pid=<?php echo $value['prodid']; ?>" onclick="del_block(this)">
                <img src="img/delete.png" alt="delete">
              </a>
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
            <a href="#">Вернуться к покупкам</a>
          </div>
        </div>
        <div class="pay-out">
          <div class="inform-pay">
            <p class="txt">Итого</p>
            <p class="summ"><?php echo number_format($totalAmount, 0, ',', ' '); ?></p>
            <p class="curr">руб.</p>
          </div>
          <div class="button-pay">
            <a href="#">Оформить заказ</a>
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
          el.parentNode.parentNode.parentNode.style.display = 'none';
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
          // Fix for IE parseFloat(0.55).toFixed(0) = 0;
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
                var result = cost * parseInt(divCounter.firstElementChild.innerHTML);
                result = number_format(result, 0, ',', ' ');
                total.innerHTML = result;
                totalAmountPrice -= cost;
                totalAmount.innerHTML = number_format(totalAmountPrice, 0, ',', ' ');
              }
              break;
            case 'plus' :
              if(ext < max) {
                divCounter.firstElementChild.innerHTML = ++ext;
                var result = cost * parseInt(divCounter.firstElementChild.innerHTML);
                result = number_format(result, 0, ',', ' ');
                total.innerHTML = result;
                totalAmountPrice += cost;
                totalAmount.innerHTML = number_format(totalAmountPrice, 0, ',', ' ');
              }
          }
        }
      </script>

  </div>
  <div class="clearfix"></div>
