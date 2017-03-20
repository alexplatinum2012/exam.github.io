<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "CATEGORY"; ?></title>
	  <?php include "templates/products_css_linker.php"; ?>
  </head>
  <body>
  	<?php 
	  $menuActive = 3;	
	  include "templates/products_body.php"; 
	?>
  </body>
</html>