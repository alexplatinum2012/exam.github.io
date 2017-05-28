<script type="text/javascript">
  var loadFrame = function(e){}
  var changing = function(e){}
  var delBlock = function(e){}
  var dou = function(str){}
</script>
<iframe name="ifrVar" id="ifrVar"></iframe>

  <form name="form_productADD" id="form_productADD" action="" method="post"></form>
  <div class="category-title">
      <p class="category-title-text">ПРОСМОТР ТОВАРА</p>
  </div>
  <div class="prod-info-holder">
    <table>
	  <tr>
	    <th class="cat-name">
		  <p>ТОВАР</p>
	    </th>
	  </tr>
	</table>
	<div class="prod-info-l">
    <input form="form_productADD" type="hidden" name="pid" value="<?php echo $product[0]['id']; ?>">
    <input form="form_productADD" type="hidden" name="catID" value="<?php echo $product[0]['cat_id']; ?>">
	  <p class="pre-input">Название товара:</p>
	  <input form="form_productADD" type="text" name="name" value="<?php echo $product[0]['name']; ?>" />
    <p class="pre-input">Старая цена товара:</p>
    <input form="form_productADD" type="text" name="old_cost" value="<?php echo $product[0]['old_cost']; ?>" />
    <p class="pre-input">Цена товара:</p>
    <input form="form_productADD" type="text" name="cost" value="<?php echo $product[0]['cost']; ?>" />
	  <p class="pre-input">Описание товара:</p>
	  <textarea form="form_productADD" name="about"><?php echo $product[0]['about']; ?></textarea>
	</div>
	<div class="prod-info-r">
	  <p class="pre-input">Название товара:</p>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="corner" <?php if(isset($product[0]['corner']) && $product[0]['corner'] == 1) echo 'checked="checked"'; ?> value="1">
	    <span class="radio-custom"></span>
        <span class="label">Отсутствует</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="corner" <?php if(isset($product[0]['corner']) && $product[0]['corner'] == 2) echo 'checked="checked"'; ?> value="2">
	    <span class="radio-custom"></span>
        <span class="label">NEW</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="corner" <?php if(isset($product[0]['corner']) && $product[0]['corner'] == 3) echo 'checked="checked"'; ?> value="3">
	    <span class="radio-custom"></span>
        <span class="label">HOT</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="corner" <?php if(isset($product[0]['corner']) && $product[0]['corner'] == 4) echo 'checked="checked"'; ?> value="4">
	    <span class="radio-custom"></span>
        <span class="label">SALE</span>
	  </label>
	</div>
	<div class="clearfix"></div>

	</div>

	<div class="prod-photo-holder">
	  <table>
	    <tr>
	      <th class="cat-name">
		    <p>ФОТОГРАФИИ ТОВАРА</p>
	      </th>
	    </tr>
	  </table>
    <div>
      <?php
        for($i = 0; $i <= count($prodPhoto); $i++) {
          if($i == count($prodPhoto) && $i != 0) {?>
            <iframe onload="loadFrame(this)" name="ifr<?php echo $i+1 ?>" id="ifr<?php echo $i+1 ?>"></iframe>
            <div id="photo<?php echo $i+1;?>" class="photo">
              <div class="img"></div>
              <form enctype="multipart/form-data" target="ifr<?php echo $i+1; ?>" action="script/changePHOTO.php" method="post">
                <input type="hidden" name="i" value="<?php echo $i+1; ?>" />
                <input type="hidden" name="prid" value="<?php echo $product[0]['id']; ?>" />
                <label class="input-file">
                  <input type="file" name="filex" value="" onchange="changing(this)">
                  добавить
                </label>
              </form>
            </div>
          <?php } elseif(isset($prodPhoto[$i]) && $prodPhoto[$i] != "") {?>
            <iframe onload="loadFrame(this)" name="ifr<?php echo $i+1; ?>" id="ifr<?php echo $i+1; ?>"></iframe>
            <div id="photo<?php echo $i+1; ?>" class="photo">
              <input form='form_productADD' type='hidden' name='photo<?php echo $i+1; ?>' value="../img/prod_photo/<?php echo $prodPhoto[$i]['name']; ?>" />
              <div class="img">
                <img src="<?php echo '../img/prod_photo/'.$prodPhoto[$i]['name']; ?>" alt='<?php echo "photo".$i+1; ?>' />
              </div>
              <form enctype="multipart/form-data" target="ifr<?php echo $i+1; ?>" action="script/changePHOTO.php" method="post">
                <input type="hidden" name="i" value="<?php echo $i+1; ?>">
                <input type="hidden" name="pid" value="<?php echo $prodPhoto[$i]['id']; ?>">
                <input type="hidden" name="del" value="<?php echo $prodPhoto[$i]['name']; ?>">
                <input type="hidden" name="prid" value="<?php echo $prodPhoto[$i]['pr_id']; ?>" />
                <label class="input-file">
                  <input type="file" name="filex" value="" onchange="changing(this)">
                  изменить
                </label>
              </form>
              <a class="delete" target="ifr<?php echo $i+1; ?>" href="script/changePHOTO.php?pid=<?php echo $prodPhoto[$i]['id']; ?>&del=<?php echo $prodPhoto[$i]['name']; ?>" onclick="delBlock(this)">удалить</a>
            </div>
          <?php } else { ?>

          <?php }
        }
      ?>
    </div>


	  <div class="clearfix"></div>
	</div>

  <div class="prod-var-holder">
	  <table>
	    <tr>
	      <th class="cat-name">
		    <p>ВАРИАЦИИ ТОВАРА</p>
	      </th>
	    </tr>
	  </table>
	  <div id="var" class="var">
      <form name="var" id="var" class="" target="ifrVar" action="index.html" method="post"></form>
      <div class="var-line">
        <div class="var-l">
          <p class="pre-input">Позиция</p>
        </div>
        <div class="var-c">
          <p class="pre-input">Кол-во</p>
        </div>
      </div>
      <?php foreach ($prodVar as $key => $value): $i = 0;?>
        <div class="var-line">
          <div class="var-l"><input form="form_productADD" type="text" name="<?php echo 'var'.$i.'[]'; ?>" value="<?php echo $value['var']; ?>" /></div>
          <div class="var-c"><input form="form_productADD" type="number" min="1" step="1" name="<?php echo 'var'.$i.'[]'; ?>" value="<?php echo $value['count']; ?>"></div>
          <a class="not-link" onclick="delParent(this)">Удалить</a>
        </div>

    <?php $i++; endforeach; ?>
  </div>
  	  <div class="clearfix"></div>
  <hr>
    <div class="var-create">
      <div class="var-line">
        <form name="var-create" id="var-create" target="ifrVar" class="" target="ifrVar" action="script/addVAR.php" method="post"></form>
        <input form="var-create" id="counter" type="hidden" name="counter" value="0" />
  	    <div class="var-l"><input form="var-create" type="text" name="name" value="" required /></div>
        <div class="var-c"><input form="var-create" type="number" min="1" step="1" name="count" value="1"></div>
        <button id="button-counter" form="var-create" type="submit" name="button">Создать новую вариацию</button>
      </div>
    </div>
	  <div class="clearfix"></div>
    <input type="hidden" name="dou" value="">
    <button form="form_productADD" class="dou" type="submit" onclick="dou('update')">Изменить товар</a>
    <button form="form_productADD" class="dou" type="submit" onclick="dou('delete')">Удалить товар</a>
	</div>

<script type="text/javascript">
$iframeVar = document.getElementById('ifrVar');
$divVar = document.getElementById('var');
$bCounter = document.getElementById('button-counter');
$counter = document.getElementById('counter');
$input = document.querySelectorAll("input[type='file']");

function delBlock(el) {
  var ifr = el.parentNode.previousElementSibling;
  var div = el.parentNode;
  var par = el.parentNode.parentNode;
  //par.removeChild(ifr);
  par.removeChild(div);
}
function changing(e) {
  var el = e.parentNode.parentNode.parentNode.previousElementSibling;
  if(el.contentDocument.body.childNodes.length == 0) {
    var reg = /\D+/ig;
    var cloneIframe = el.cloneNode(true);
    cloneIframe.name = 'ifr' + (+el.name.replace(reg, '') + 1);
    cloneIframe.id = 'ifr' + (+el.id.replace(reg, '') + 1);
    var cloneDiv = el.nextElementSibling.cloneNode(true);
    cloneDiv.id = 'photo' + (+el.nextElementSibling.id.replace(reg, '') + 1);
    el.parentNode.appendChild(cloneIframe);
    el.parentNode.appendChild(cloneDiv);
    var form = cloneDiv.querySelector('form');
    form.setAttribute('target', cloneIframe.id);
    var input = cloneDiv.querySelector('input');
    input.value = +el.id.replace(reg, '') + 1;
  }
  e.parentNode.parentNode.submit();
}
function loadFrame(el) {
  if(el.contentDocument.body.innerHTML == "") return;
  el.nextElementSibling.innerHTML = el.contentDocument.body.innerHTML;
}
function delParent(e) {
  $delElem = e.parentNode;
  $delElem.parentNode.removeChild($delElem);
  return false;
}
function dou(str) {
  var form = document.getElementById("form_productADD");
  form.setAttribute('action', 'script/' + str + '_product.php')
}

$iframeVar.onload = function(e) {
  $divVar.innerHTML += this.contentDocument.body.innerHTML;
}
$bCounter.onclick = function(e) {
  $counter.value = +$counter.value + 1;
}
</script>
