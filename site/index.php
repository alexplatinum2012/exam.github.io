<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "MAIN"; ?></title>
	<?php include "templates/main_css_linker.php"; ?>
  </head>
  <body>
	<?php include "templates/main_body.php"; ?>
  </body>
</html>
