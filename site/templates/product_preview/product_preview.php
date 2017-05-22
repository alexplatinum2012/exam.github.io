<?php if(isset($catName)) $cat = true; else $cat = false; ?>

<section name="products" class="products">
  <header class="products-header">
    <p class="header-title"><?php if(isset($catName)) echo $catName; else echo $headerTitle; ?></p>
    <?php
      if(!$cat) {?>
        <div class="right-arrow">
          <img name="right-arrow" src="img/right_arrow.png" alt="right_arrow">
        </div>
        <div class="left-arrow">
          <img name="left-arrow" src="img/left_arrow.png" alt="left_arrow">
        </div>
      <?php } else { ?>
        <div class="nav-pages">
          <p class="nav-text">Страницы</p>
          <ul class="nav-inline-list">
            <?php
              $countOfPages = ceil($countOfProducts / $limit);
              if($countOfPages == 8) { ?>
                <li class="nav-inline-list-item"><a class="page<?php if($page == 1) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=1&l=$limit"; ?>' target="ifr-cat">1</a></li>
                <?php
                for ($i = 2; $i <= $countOfPages; $i++) { ?>
                  <?php
                  if($i < 7) { ?>
                    <li class="nav-inline-list-item"><a class="page<?php if($page == $i) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$i&l=$limit"; ?>' target="ifr-cat"><?php echo $i; ?></a></li>
                  <?php }
                }
                echo "<a class='page'>...</a>";
                ?>
                <li class="nav-inline-list-item"><a class="page<?php if($page == $countOfPages) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$countOfPages&l=$limit"; ?>' target="ifr-cat"><?php echo $countOfPages; ?></a></li>
              <?php } elseif($countOfPages > 8) {
                if($page < 5) { ?>
                  <li class="nav-inline-list-item"><a class="page<?php if($page == 1) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=1&l=$limit"; ?>' target="ifr-cat">1</a></li>
                  <?php
                  for ($i = 2; $i <= $countOfPages; $i++) { ?>
                    <?php
                    if($i < 7) { ?>
                      <li class="nav-inline-list-item"><a class="page<?php if($page == $i) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$i&l=$limit"; ?>' target="ifr-cat"><?php echo $i; ?></a></li>
                    <?php }
                  }
                  echo "<a class='page'>...</a>";
                  ?>
                  <li class="nav-inline-list-item"><a class="page<?php if($page == $countOfPages) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$countOfPages&l=$limit"; ?>' target="ifr-cat"><?php echo $countOfPages; ?></a></li>
                <?php } else {
                ?>
                  <li class="nav-inline-list-item"><a class="page<?php if($page == 1) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=1&l=$limit"; ?>' target="ifr-cat">1</a></li>
                  <?php
                  echo "<a class='page'>...</a>";
                  for ($i = 2; $i <= $countOfPages; $i++) { ?>
                    <?php
                    if($i >= ($page - 2) && $i <= ($page + 2)) { ?>
                      <li class="nav-inline-list-item"><a class="page<?php if($page == $i) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$i&l=$limit"; ?>' target="ifr-cat"><?php echo $i; ?></a></li>
                    <?php }
                  }
                  echo "<a class='page'>...</a>"; ?>
                  <li class="nav-inline-list-item"><a class="page<?php if($page == $countOfPages) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$countOfPages&l=$limit"; ?>' target="ifr-cat"><?php echo $countOfPages; ?></a></li>
                <?php
                  }
                }  else {
                for ($i = 1; $i <= $countOfPages; $i++) { ?>
                  <li class="nav-inline-list-item"><a class="page<?php if($page == $i) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$i&l=$limit"; ?>' target="ifr-cat"><?php echo $i; ?></a></li>
                <?php }
              } ?>
          </ul>
        </div>
      <?php }
    ?>
  </header>
  <div name="holder" class="holder">
  <?php
    if($cat) {?>
    <div class="category-logo">
      <img src="<?php echo $catLogo; ?>" alt="category_logo_img">
      <p class="category-logo-title"><?php echo $logoTitle; ?></p>
      <p class="category-logo-description"><?php echo $logoDescription; ?></p>
    </div>
  <?php }
    if(isset($result) && $result[0] != "") {
      $i = 0;
      foreach ($result as $key => $value) {
        if($cat && count($result) > 12) {
          if($i == 11) { ?>
            <div class="category-promo">
              <a class="feeling" <?php if($prID > 0) echo 'href="product.php?pid='.$prID.'"'; ?>></a><!--//!!!!!!!! -->
              <div class="promo">
                  <p class="promo-first-line"><?php echo $promoTitle1; ?></p>
                  <p class="promo-second-line"><?php echo $promoTitle2; ?></p>
                  <p class="promo-third-line"><?php echo $prAbout; ?></p>
                  <p class="promo-price"><?php echo number_format($prCost, 0, ',', ' ').$siteSettings['curr']; ?></p>
                  <div class="promo-look">
                    <button type="button" name="button">Посмотреть  +</button>
                  </div>
                </div>
              <img src="<?php echo $catPromo; ?>" alt="category_promo">
            </div>
        <?php }
        }
        $i++;
        ?>
        <div class="product-preview">
          <a class="feeling" href="product.php?pid=<?php echo $value['prodid']; ?>"></a>
		      <div class="corner">
            <?php
            if(isset($value['prodcorner']) && $value['prodcorner'] != "") {
              $status = $value['prodcorner']; ?>
                <img src="<?php
                              if($status == '4') echo 'img/sale_triangle.png';
                              else if ($status == '3') echo 'img/hot_triangle.png';
                              else if ($status == '2') echo 'img/new_triangle.png';
                      ?>" alt="">
            <?php } ?>
          </div>
          <div class="product-img">
            <img src="img/prod_photo/<?php if(isset($value['prodphoto'])) echo $value['prodphoto']; ?>" alt="Изображение товара">
          </div>
          <div class="product-description">
            <p class="product-name"><?php if(isset($value['prodname'])) echo $value['prodname']; ?></p>
			<div class="price-holder">
  			  <div class="product-price">
			    <p class="curr"><?php echo $siteSettings['curr']; ?></p>
			    <p class="product-price"><?php if(isset($value['prodcost'])) echo number_format($value['prodcost'], 0, ',', ' '); ?></p>
			  </div>

			  <?php
			  if(isset($value['product_old_price']) && $value['product_old_price'] != "") {
			  ?>
			  <div class="product-old-price">
			    <p class="curr"><?php echo $siteSettings['curr']; ?></p>
			    <p class="product-old-price"><?php echo number_format($value['product_old_price'], 0, ',', ' '); ?></p>
			  </div>
			  <?php } ?>

			</div>
          </div>
        </div>
        <?php
        }
    }
   ?>
   </div>
   <div class="clearfix"></div>
     <?php
       if($cat) {?>
   <header class="products-header">
     <p class="header-title"><?php if(isset($catName)) echo $catName; ?></p>
     <div class="nav-pages">
       <p class="nav-text">Страницы</p>
       <ul class="nav-inline-list">
         <?php
           $countOfPages = ceil($countOfProducts / $limit);
           if($countOfPages == 8) { ?>
             <li class="nav-inline-list-item"><a class="page<?php if($page == 1) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=1&l=$limit"; ?>' target="ifr-cat">1</a></li>
             <?php
             for ($i = 2; $i <= $countOfPages; $i++) { ?>
               <?php
               if($i < 7) { ?>
                 <li class="nav-inline-list-item"><a class="page<?php if($page == $i) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$i&l=$limit"; ?>' target="ifr-cat"><?php echo $i; ?></a></li>
               <?php }
             }
             echo "<a class='page'>...</a>";
             ?>
             <li class="nav-inline-list-item"><a class="page<?php if($page == $countOfPages) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$countOfPages&l=$limit"; ?>' target="ifr-cat"><?php echo $countOfPages; ?></a></li>
           <?php } elseif($countOfPages > 8) {
             if($page < 5) { ?>
               <li class="nav-inline-list-item"><a class="page<?php if($page == 1) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=1&l=$limit"; ?>' target="ifr-cat">1</a></li>
               <?php
               for ($i = 2; $i <= $countOfPages; $i++) { ?>
                 <?php
                 if($i < 7) { ?>
                   <li class="nav-inline-list-item"><a class="page<?php if($page == $i) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$i&l=$limit"; ?>' target="ifr-cat"><?php echo $i; ?></a></li>
                 <?php }
               }
               echo "<a class='page'>...</a>";
               ?>
               <li class="nav-inline-list-item"><a class="page<?php if($page == $countOfPages) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$countOfPages&l=$limit"; ?>' target="ifr-cat"><?php echo $countOfPages; ?></a></li>
             <?php } else {
             ?>
               <li class="nav-inline-list-item"><a class="page<?php if($page == 1) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=1&l=$limit"; ?>' target="ifr-cat">1</a></li>
               <?php
               echo "<a class='page'>...</a>";
               for ($i = 2; $i <= $countOfPages; $i++) { ?>
                 <?php
                 if($i >= ($page - 2) && $i <= ($page + 2)) { ?>
                   <li class="nav-inline-list-item"><a class="page<?php if($page == $i) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$i&l=$limit"; ?>' target="ifr-cat"><?php echo $i; ?></a></li>
                 <?php }
               }
               echo "<a class='page'>...</a>"; ?>
               <li class="nav-inline-list-item"><a class="page<?php if($page == $countOfPages) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$countOfPages&l=$limit"; ?>' target="ifr-cat"><?php echo $countOfPages; ?></a></li>
             <?php
               }
             }  else {
             for ($i = 1; $i <= $countOfPages; $i++) { ?>
               <li class="nav-inline-list-item"><a class="page<?php if($page == $i) echo ' active'; else echo ''; ?>" href='<?php echo "script/cat_out.php?cid=$catId&page=$i&l=$limit"; ?>' target="ifr-cat"><?php echo $i; ?></a></li>
             <?php }
           } ?>
       </ul>
     </div>
     <?php }
     ?>
   </header>
</section>
<script type="text/javascript">
  if(typeof holder !== "undefined") {
    var holders = document.querySelectorAll("div.holder[name='holder']");
    holder2 = holders[holders.length - 1];
    holder2.style.width = "<?php if(isset($width)) echo $width.'px'; else echo '1170px'; ?>";
    var leftArrows = document.querySelectorAll("img[name='left-arrow']");
    leftArrow2 = leftArrows[leftArrows.length - 1];
    var rightArrows = document.querySelectorAll("img[name='right-arrow']");
    rightArrow2 = rightArrows[rightArrows.length - 1];
    if(parseInt(holder2.style.width) > 1170) {
      rightArrow2.setAttribute('src', 'img/right_arrow_active.png');
      rightArrow2.style.cursor = 'pointer';
    }

    leftArrow2.onclick = function(e) {
      if(e.target.tagName === "IMG") {
        moover2(1);
      }
    }
    rightArrow2.onclick = function(e) {
      if(e.target.tagName === "IMG") {
        moover2(-1);
      }
    }
    function moover2(direction) {
      var width = parseFloat(holder2.style.width);
      var mLeft = (holder2.style.marginLeft == "") ? 0 : parseFloat(holder2.style.marginLeft);
      var maxMLeft = width - 1170;
      var minMLeft = 0;
      var step = 1170;

      var newMLeft = mLeft + (step * direction);
      if(newMLeft >= 0) {
        newMLeft = 0;
        rightArrow2.setAttribute('src', 'img/right_arrow_active.png');
        rightArrow2.style.cursor = 'pointer';
        leftArrow2.setAttribute('src', 'img/left_arrow.png');
        leftArrow2.style.cursor = 'default';
      }
      if(newMLeft < 0 && (newMLeft * -1) < maxMLeft) {
        rightArrow2.setAttribute('src', 'img/right_arrow_active.png');
        rightArrow2.style.cursor = 'pointer';
        leftArrow2.setAttribute('src', 'img/left_arrow_active.png');
        leftArrow2.style.cursor = 'pointer';
      }
      if((newMLeft * -1) >= maxMLeft) {
        newMLeft = maxMLeft * -1;
        rightArrow2.setAttribute('src', 'img/right_arrow.png');
        rightArrow2.style.cursor = 'default';
        leftArrow2.setAttribute('src', 'img/left_arrow_active.png');
        leftArrow2.style.cursor = 'pointer';
      }
      holder2.style.marginLeft = newMLeft + "px";
    }
} else {
    var holder = document.querySelectorAll("div.holder[name='holder']");
    holder = holder[holder.length - 1];
    holder.style.width = "<?php if(isset($width)) echo $width.'px'; else echo '1170px'; ?>";
    var leftArrow = document.querySelectorAll("img[name='left-arrow']");
    leftArrow = leftArrow[leftArrow.length - 1];
    var rightArrow = document.querySelectorAll("img[name='right-arrow']");
    rightArrow = rightArrow[rightArrow.length - 1];
    if(parseInt(holder.style.width) > 1170) {
      rightArrow.setAttribute('src', 'img/right_arrow_active.png');
      rightArrow.style.cursor = 'pointer';
    }

    leftArrow.onclick = function(e) {
      if(e.target.tagName === "IMG") {
        moover(1);
      }
    }
    rightArrow.onclick = function(e) {
      if(e.target.tagName === "IMG") {
        moover(-1);
      }
    }
    function moover(direction) {
      var width = parseFloat(holder.style.width);
      var mLeft = (holder.style.marginLeft == "") ? 0 : parseFloat(holder.style.marginLeft);
      var maxMLeft = width - 1170;
      var minMLeft = 0;
      var step = 1170;

      var newMLeft = mLeft + (step * direction);
      if(newMLeft >= 0) {
        newMLeft = 0;
        rightArrow.setAttribute('src', 'img/right_arrow_active.png');
        rightArrow.style.cursor = 'pointer';
        leftArrow.setAttribute('src', 'img/left_arrow.png');
        leftArrow.style.cursor = 'default';
      }
      if(newMLeft < 0 && (newMLeft * -1) < maxMLeft) {
        rightArrow.setAttribute('src', 'img/right_arrow_active.png');
        rightArrow.style.cursor = 'pointer';
        leftArrow.setAttribute('src', 'img/left_arrow_active.png');
        leftArrow.style.cursor = 'pointer';
      }
      if((newMLeft * -1) >= maxMLeft) {
        newMLeft = maxMLeft * -1;
        rightArrow.setAttribute('src', 'img/right_arrow.png');
        rightArrow.style.cursor = 'default';
        leftArrow.setAttribute('src', 'img/left_arrow_active.png');
        leftArrow.style.cursor = 'pointer';
      }
      holder.style.marginLeft = newMLeft + "px";
    }
  }

</script>
