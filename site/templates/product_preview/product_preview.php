<?php if(isset($catName)) $cat = true; else $cat = false; ?>

<section id="products" class="products">
  <header class="products-header">
    <p class="header-title"><?php if(isset($catName)) echo $catName; ?></p>
    <?php
      if(!$cat) {?>
        <div class="right-arrow">
          <img src="img/right_arrow.png" alt="right_arrow">
        </div>
        <div class="left-arrow">
          <img src="img/left_arrow.png" alt="left_arrow">
        </div>
      <?php } else { ?>
        <div class="nav-pages">
          <p class="nav-text">Страницы</p>
          <ul class="nav-inline-list">
            <li class="nav-inline-list-item"><a href="#">1</a></li>
            <?php
              for($i = 1; $i < ceil(count($products) / 17); $i++) {?>
                <li class="nav-inline-list-item"><a href="<?php echo $_SERVER['SERVER_ADDR'].$_SERVER['PHP_SELF']."?page=".$i; ?>"><?php echo $i+1; ?></a></li>
              <?php }
            ?>
          </ul>
        </div>
      <?php }
    ?>
  </header>
  <div id="holder" class="holder">
  <?php
    if($cat) {?>
    <div class="category-logo">
      <img src="<?php if(isset($value['category_logo_img'])) echo $value['category_logo_img']; ?>" alt="category_logo_img">
      <p class="category-logo-title"><?php if(isset($value['category_title'])) echo $value['category_title']; ?></p>
      <p class="category-logo-description"><?php if(isset($value['category_description'])) echo $value['category_description']; ?></p>
    </div>
  <?php }
    if(isset($products)) {
      $i = 0;
      foreach ($products as $key => $value) {
        if($i == 3) { ?>
          <div class="category-promo">
            <img src="" alt="category_promo">
          </div>
        <?php } else {
        ?>
        <div class="product-preview">
		  <div class="corner">
          <?php
          if(isset($value['corner']) && $value['corner'] != "") {
            $status = $value['corner']; ?>
              <img src="<?php
                            if($status == '4') echo 'img/sale_triangle.png';
                            else if ($status == '3') echo 'img/hot_triangle.png';
                            else if ($status == '2') echo 'img/new_triangle.png';
                    ?>" alt="">
          <?php } ?>
          </div>
          <div class="product-img">
            <img src="<?php if(isset($value['product_image'])) echo $value['product_image']; ?>" alt="Изображение товара">
          </div>
          <div class="product-description">
            <p class="product-name"><?php if(isset($value['name'])) echo $value['name']; ?></p>
			<div class="price-holder">
  			  <div class="product-price">
			    <p class="curr"><?php if(isset($curr)) echo $curr; ?></p>
			    <p class="product-price"><?php if(isset($value['cost'])) echo $value['cost']; ?></p>
			  </div>

			  <?php
			  if(isset($value['product_old_price']) && $value['product_old_price'] != "") {
			  ?>
			  <div class="product-old-price">
			    <p class="curr"><?php if(isset($curr)) echo $curr; ?></p>
			    <p class="product-old-price"><?php echo $value['product_old_price']; ?></p>
			  </div>
			  <?php } ?>

			</div>
          </div>
        </div>
        <?php
        }
          $i++;
        }
    }
   ?>
   </div>
   <div class="clearfix"></div>
     <?php
       if($cat) {?>
   <header class="products-header">
     <p class="header-title"><?php if(isset($headerTitle)) echo $headerTitle; ?></p>
         <div class="nav-pages">
           <p class="nav-text"></p>
           <ul class="nav-inline-list">
             <li class="nav-inline-list-item"><a href="#">1</a></li>
             <?php
             for($i = 1; $i < ceil(count($products) / 17); $i++) {?>
               <li class="nav-inline-list-item"><a href="<?php echo $_SERVER['SERVER_ADDR'].$_SERVER['PHP_SELF']."?page=".$i+1; ?>"><?php echo $i+1; ?></a></li>
             <?php } ?>
           </ul>
         </div>
     <?php }
     ?>
   </header>
</section>
