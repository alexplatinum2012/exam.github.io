<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "CATEGORY"; ?></title>
	  <?php include "templates/orders_css_linker.php"; ?>
  </head>
  <body>
  
  	<?php
      $menuActive = 1;	
	  include "templates/orders_body.php"; 
	?>
  </body>
</html>