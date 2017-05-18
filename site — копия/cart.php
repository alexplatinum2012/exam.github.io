<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "CATEGORY"; ?></title>
	  <?php include "templates/cart_css_linker.php"; ?>
  </head>
  <body>
  	<?php include "templates/cart_body.php"; ?>
  </body>
</html>
