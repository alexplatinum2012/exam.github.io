<script type="text/javascript">
  var loadFrame = function(e){}
  var changing = function(e){}
  var delBlock = function(e){}
</script>
  <iframe name="ifrVar" id="ifrVar"></iframe>

  <form name="form_productADD" id="form_productADD" action="script/createProduct.php" method="post"></form>
  <input form="form_productADD" type="hidden" name="catID" value="<?php echo $_GET['cid']; ?>" />
  <div class="category-title">
      <p class="category-title-text">СОЗДАНИЕ ТОВАРА</p>
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
	  <input form="form_productADD" type="text" name="name" value="" required />
    <p class="pre-input">Цена товара:</p>
    <input form="form_productADD" type="text" name="cost" value="" required />
	  <p class="pre-input">Описание товара:</p>
	  <textarea form="form_productADD" name="about"></textarea>
	</div>
	<div class="prod-info-r">
	  <p class="pre-input">Ярлык товара:</p>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="corner" checked="checked" value="1">
	    <span class="radio-custom"></span>
        <span class="label">Отсутствует</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="corner" value="2">
	    <span class="radio-custom"></span>
        <span class="label">NEW</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="corner" value="3">
	    <span class="radio-custom"></span>
        <span class="label">HOT</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="corner" value="4">
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

    <iframe onload="loadFrame(this)" name="ifr1" id="ifr1"></iframe>
	  <div id="photo1" class="photo">
  		<div class="img"></div>
      <form class="form" enctype="multipart/form-data" target="ifr1" action="script/changePHOTO.php" method="post">
        <input class="input" type="hidden" name="i" value="1">
        <label class="input-file"><input type="file" name="filex" value="" onchange="changing(this)" />добавить</label>
      </form>
    </div>
  </div>
  <div class="clearfix"></div>

<!--onload="loadFrame(this)"-->

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
        <div class="var-r">
          <p class="pre-input">Цена</p>
        </div>
      </div>
	  </div>
    <div class="var-create">
      <div class="var-line">
        <form name="var-create" id="var-create" target="ifrVar" class="" target="ifrVar" action="script/addVAR.php" method="post"></form>
        <input form="var-create" id="counter" type="hidden" name="counter" value="0" />
  	    <div class="var-l"><input form="var-create" type="text" name="name" value="" required /></div>
        <div class="var-c"><input form="var-create" type="number" min="1" step="1" name="count" value="1" /></div>
        <button id="button-counter" form="var-create" type="submit" name="button">Создать новую вариацию</button>
      </div>
    </div>
	  <div class="clearfix"></div>
	</div>
    <button form="form_productADD" type="submit" class="create-product">Создать товар</button>
	<div class="clearfix"></div>



<script type="text/javascript">
  $iframeVar = document.getElementById('ifrVar');
  $divVar = document.getElementById('var');
  $bCounter = document.getElementById('button-counter');
  $counter = document.getElementById('counter');
  $input = document.querySelectorAll("input[type='file']");

  function delBlock(el) {
    el.parentNode.parentNode.removeChild(el.parentNode);
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

  $iframeVar.onload = function(e) {
    $divVar.innerHTML += this.contentDocument.body.innerHTML;
  }
  $bCounter.onclick = function(e) {
    $counter.value = +$counter.value + 1;
  }


</script>
