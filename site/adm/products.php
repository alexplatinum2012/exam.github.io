<!DOCTYPE html>
<html>
  <head>
    <meta>
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "CATEGORY"; ?></title>
	  <?php include "templates/products_css_linker.php"; ?>
  </head>
  <body>
  	<?php
	  $menuActive = 3;
	  include "templates/products.php";
	?>
  </body>
</html>
