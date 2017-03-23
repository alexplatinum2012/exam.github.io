  <iframe name="ifr1" id="ifr1" src="" width="" height=""></iframe>
  <iframe name="ifr2" id="ifr2" src="" width="" height=""></iframe>
  <iframe name="ifr3" id="ifr3" src="" width="" height=""></iframe>
  <iframe name="ifr4" id="ifr4" src="" width="" height=""></iframe>
  <iframe name="ifrVar" id="ifrVar" src="" width="" height=""></iframe>

  <form name="form_productADD" id="form_productADD" action="script/createProduct.php" method="post"></form>
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
	  <input form="form_productADD" type="text" name="name" value="" />
	  <p class="pre-input">Описание товара:</p>
	  <textarea form="form_productADD" name="about"></textarea>
	</div>
	<div class="prod-info-r">
	  <p class="pre-input">Название товара:</p>
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
	  <div id="photo1" class="photo">
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
	  </div>
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
    <button form="form_productADD" type="submit" class="create-product">Создать товар</button>
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


  for(var i=0; i<$input.length; i++)
    $input[i].onchange = function(e) {
      e.target.parentNode.parentNode.submit();
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
