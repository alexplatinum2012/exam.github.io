<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "CATEGORY"; ?></title>
	  <?php include "templates/categories_css_linker.php"; ?>
  </head>
  <body>
  	<?php
	  $menuActive = 4;
	  include "templates/category_settings_body.php";
	?>
  </body>
</html>
