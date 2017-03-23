<iframe name="ifr1" id="ifr1"></iframe>
<iframe name="ifr2" id="ifr2"></iframe>
<iframe name="ifr3" id="ifr3"></iframe>
<iframe name="ifr4" id="ifr4"></iframe>
<iframe name="ifrVar" id="ifrVar"></iframe>

  <form name="form_productUPD" id="form_productUPD" action="" method=""></form>
  <div class="category-title">
      <p class="category-title-text">ПРОСМОТР ТОВАРА</p>
  </div>
  <div class="prod-info-holder">
    <table>
	  <tr>
	    <th class="cat-name">
		  <p>НАЗВАНИЕ КАТЕГОРИИ</p>
	    </th>
	  </tr>
	</table>
	<div class="prod-info-l">
	  <p class="pre-input">Название товара:</p>
	  <input form="form_productUPD" type="text" name="name" value="<?php echo $product[0]['name']; ?>" />
	  <p class="pre-input">Описание товара:</p>
	  <textarea form="form_productUPD" name="about"><?php echo $product[0]['about']; ?></textarea>
	</div>
	<div class="prod-info-r">
	  <p class="pre-input">Название товара:</p>
	  <label>
	    <input form="form_productUPD" class="radio" type="radio" name="corner" <?php if(isset($product[0]['corner']) && $product[0]['corner'] == 1) echo 'checked="checked"'; ?> value="1">
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
    <?php
      for($i = 0; $i < 4; $i++) {
        if(isset($prodPhoto[$i]) && $prodPhoto[$i] != "") {?>
          <div id="<?php echo 'photo'.($i+1); ?>" class="photo">
            <input form='form_productUPD' type='hidden' name='<?php echo "photo".($i+1); ?>' value='<?php echo "../img/prod_photo/".$prodPhoto[$i]['name']; ?>' />
            <div class="img">
              <img src="<?php echo '../img/prod_photo/'.$prodPhoto[$i]['name']; ?>" alt='<?php echo "photo".($i+1); ?>' />
            </div>
            <form enctype="multipart/form-data" target="<?php echo 'ifr'.($i+1); ?>" action="script/changePHOTO.php" method="post">
              <input type="hidden" name="i" value="<?php echo $i+1; ?>">
              <label class="input-file">
                <input type="file" name="filex" value="" onchange="changing(this)">
                изменить
              </label>
            </form>
            <a class="delete" target="<?php echo 'ifr'.($i+1); ?>" href="<?php echo 'script/changePHOTO.php?i='.($i+1).'&del='.$prodPhoto[$i]['name']; ?>">удалить</a>
          </div>
        <?php } else { ?>
          <div id="<?php echo 'photo'.$i+1;?>" class="photo">
            <div class="img"></div>
            <form enctype="multipart/form-data" target="<?php echo 'ifr'.$i+1; ?>" action="script/changePHOTO.php" method="post">
              <input type="hidden" name="i" value="<?php echo $i+1; ?>">
              <label class="input-file">
                <input type="file" name="filex" value="" onchange="changing(this)">
                добавить
              </label>
            </form>
          </div>
        <?php }
      }
    ?>
    <!--<div id="photo1" class="photo">
  		<div class="img"></div>
      <form enctype="multipart/form-data" target="ifr1" action="script/changePHOTO.php" method="post">
        <input type="hidden" name="i" value="1">
        <label class="input-file"><input type="file" name="filex" value="">добавить</label>
      </form>
    </div>
    <div id="photo2" class="photo">
      <div class="img">
      </div>
      <form enctype="multipart/form-data" target="ifr2" action="script/changePHOTO.php" method="post">
        <input type="hidden" name="i" value="2">
        <label class="input-file"><input type="file" name="filex" value="">добавить</label>
      </form>
    </div>
    <div id="photo3" class="photo">
      <div class="img">
      </div>
      <form enctype="multipart/form-data" target="ifr3" action="script/changePHOTO.php" method="post">
        <input type="hidden" name="i" value="3">
        <label class="input-file"><input type="file" name="filex" value="">добавить</label>
      </form>
    </div>
    <div id="photo4" class="photo">
      <div class="img">
      </div>
      <form enctype="multipart/form-data" target="ifr4" action="script/changePHOTO.php" method="post">
        <input type="hidden" name="i" value="4">
        <label class="input-file"><input type="file" name="filex" value="">добавить</label>
      </form>
    </div>-->

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
          <div class="var-l"><input form="form_productUPD" type="text" name="<?php echo 'var'.$i.'[]'; ?>" value="<?php echo $value['var']; ?>" /></div>
          <div class="var-c"><input form="form_productUPD" type="number" min="1" step="1" name="<?php echo 'var'.$i.'[]'; ?>" value="<?php echo $value['count']; ?>"></div>
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
	</div>
    <a class="delete" href="#">Удалить товар</a>
	<div class="clearfix"></div>



<script type="text/javascript">
$iframe1 = document.getElementById('ifr1');
$iframe2 = document.getElementById('ifr2');
$iframe3 = document.getElementById('ifr3');
$iframe4 = document.getElementById('ifr4');
$iframeVar = document.getElementById('ifrVar');
$divPhoto1 = document.getElementById('photo1');
$divPhoto2 = document.getElementById('photo2');
$divPhoto3 = document.getElementById('photo3');
$divPhoto4 = document.getElementById('photo4');
$divVar = document.getElementById('var');
$bCounter = document.getElementById('button-counter');
$counter = document.getElementById('counter');
$input = document.querySelectorAll("input[type='file']");

for(var i=0; i<$input.length; i++) {
  $input[i].onchange = function(e) {
    e.target.parentNode.parentNode.submit();
  }
}
function changing(e) {
  e.parentNode.parentNode.submit();
}
$iframe1.onload = function(e) {
  $divPhoto1.innerHTML = this.contentDocument.body.innerHTML;
}
$iframe2.onload = function(e) {
  $divPhoto2.innerHTML = this.contentDocument.body.innerHTML;
}
$iframe3.onload = function(e) {
  $divPhoto3.innerHTML = this.contentDocument.body.innerHTML;
}
$iframe4.onload = function(e) {
  $divPhoto4.innerHTML = this.contentDocument.body.innerHTML;
}
$iframeVar.onload = function(e) {
  $divVar.innerHTML += this.contentDocument.body.innerHTML;
}
$bCounter.onclick = function(e) {
  $counter.value = +$counter.value + 1;
}

function delParent(e) {
  $delElem = e.parentNode;
  $delElem.parentNode.removeChild($delElem);
  return false;
}
</script>
