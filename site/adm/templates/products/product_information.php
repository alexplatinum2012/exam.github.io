  <iframe name="ifr1" id="ifr1" src="" width="" height=""></iframe>
  <iframe name="ifr2" id="ifr2" src="" width="" height=""></iframe>
  <iframe name="ifr3" id="ifr3" src="" width="" height=""></iframe>
  <iframe name="ifr4" id="ifr4" src="" width="" height=""></iframe>

  <form name="form_productADD" id="form_productADD" action="" method=""></form>
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
	  <input form="form_productADD" type="text" name="name" value="" />
	  <p class="pre-input">Описание товара:</p>
	  <textarea form="form_productADD" name="about"></textarea>
	</div>
	<div class="prod-info-r">
	  <p class="pre-input">Название товара:</p>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="deliveryType" checked="checked" value="1">
	    <span class="radio-custom"></span>
        <span class="label">Отсутствует</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="deliveryType" value="2">
	    <span class="radio-custom"></span>
        <span class="label">NEW</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="deliveryType" value="3">
	    <span class="radio-custom"></span>
        <span class="label">HOT</span>
	  </label>
	  <label>
	    <input form="form_productADD" class="radio" type="radio" name="deliveryType" value="4">
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
	  <div class="photo">
  		<div id="img1" class="img">
  		  <!--<img src="" alt=""/>-->
  		</div>
      <form enctype="multipart/form-data" target="ifr1" action="test.php" method="post">
        <input type="hidden" name="i" value="1">
        <label class="input-file">
          <input type="file" name="filex" value="">
          изменить
        </label>
      </form>
  		<a class="delete" href="#">удалить</a>
    </div>
    <div class="photo">
      <div id="img2" class="img">
        <!--<img src="" alt=""/>-->
      </div>
      <form enctype="multipart/form-data" target="ifr2" action="test.php" method="post">
        <input type="hidden" name="i" value="2">
        <label class="input-file">
          <input type="file" name="filex" value="">
          изменить
        </label>
      </form>
      <a class="delete" href="#">удалить</a>
    </div>
    <div class="photo">
      <div id="img3" class="img">
        <!--<img src="" alt=""/>-->
      </div>
      <form enctype="multipart/form-data" target="ifr3" action="test.php" method="post">
        <input type="hidden" name="i" value="3">
        <label class="input-file">
          <input type="file" name="filex" value="">
          изменить
        </label>
      </form>
      <a class="delete" href="#">удалить</a>
    </div>
    <div class="photo">
      <div id="img4" class="img">
        <!--<img src="" alt=""/>-->
      </div>
      <form enctype="multipart/form-data" target="ifr4" action="test.php" method="post">
        <input type="hidden" name="i" value="4">
        <label class="input-file">
          <input type="file" name="filex" value="">
          изменить
        </label>
      </form>
      <a class="delete" href="#">удалить</a>
    </div>

	  <div class="clearfix"></div>
	</div>

	<div class="prod-var-holder">
	  <table>
	    <tr>
	      <th class="cat-name">
		    <p>ФОТОГРАФИИ ТОВАРА</p>
	      </th>
	    </tr>
	  </table>
	  <div class="var">
	    <div class="var-l">
		  <input form="" type="text" name="" value="1" />
		  <input form="" type="text" name="" value="2" />
		  <input form="" type="text" name="" value="3" />
		</div>
		<div class="var-r">
		  <a href="#">Удалить</a>
		  <a href="#">Удалить</a>
		  <a href="#">Удалить</a>
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
  $divImg1 = document.getElementById('img1');
  $divImg2 = document.getElementById('img2');
  $divImg3 = document.getElementById('img3');
  $divImg4 = document.getElementById('img4');
  $input = document.querySelectorAll("input[type='file']");

  for(var i=0; i<$input.length; i++)
    $input[i].onchange = function(e) {
      e.target.parentNode.parentNode.submit();
    }
  $iframe1.onload = function(e) {
    $divImg1.innerHTML = this.contentDocument.body.innerHTML;
  }
  $iframe2.onload = function(e) {
    $divImg2.innerHTML = this.contentDocument.body.innerHTML;
  }
  $iframe3.onload = function(e) {
    $divImg3.innerHTML = this.contentDocument.body.innerHTML;
  }
  $iframe4.onload = function(e) {
    $divImg4.innerHTML = this.contentDocument.body.innerHTML;
  }

</script>
