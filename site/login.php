<?php $xxx = 4; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "CATEGORY"; ?></title>
	  <?php include "templates/checkout_css_linker.php"; ?>
  </head>
  <body>
  	<?php include "templates/checkout_body.php"; ?>
  </body>
</html>