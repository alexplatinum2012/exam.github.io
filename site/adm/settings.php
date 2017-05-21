<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "CATEGORY"; ?></title>
	  <?php include "templates/settings_css_linker.php"; ?>
  </head>
  <body>
  	<?php
	  $menuActive = 5;
	  include "templates/settings_body.php";
	?>
  </body>
</html>
