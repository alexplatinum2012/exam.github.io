

<header class="header">
  <img src="img/shop_logo.png" alt="shop_logo" />
</header>
<div class="list">
  <ul class="nav-list">
    <li class="<?php if($menuActive === 1) { echo 'nav-list-item active';} else { echo 'nav-list-item';}?>">
	  <img src="<?php if($menuActive === 1) { echo 'img/cart_active.png';} else { echo 'img/cart.png';}?>" alt=""/>
	  <a href="orders.php">ЗАКАЗЫ</a>
	</li>
    <li class="<?php if($menuActive === 2) { echo 'nav-list-item active';} else { echo 'nav-list-item';}?>">
	  <img src="<?php if($menuActive === 2) { echo 'img/users_active.png';} else { echo 'img/users.png';}?>" alt=""/>
	  <a href="users.php">ПОЛЬЗОВАТЕЛИ</a>
	</li>
	<li class="<?php if($menuActive === 3) { echo 'nav-list-item active';} else { echo 'nav-list-item';}?>">
	  <img src="<?php if($menuActive === 3) { echo 'img/products_active.png';} else { echo 'img/products.png';}?>" alt=""/>
	  <a href="products.php">ТОВАРЫ</a>
	</li>
	<li class="<?php if($menuActive === 4) { echo 'nav-list-item active';} else { echo 'nav-list-item';}?>">
	  <img src="<?php if($menuActive === 4) { echo 'img/categories_active.png';} else { echo 'img/categories.png';}?>" alt=""/>
	  <a href="categories.php">КАТЕГОРИИ</a>
	</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="nav-foot">
  <p>admin@mail.ru</p>
  <a href="#">Выйти</a>
</div>
<div class="clearfix"></div>