<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($pageTitle)) echo $pageTitle; else echo "CATEGORY"; ?></title>
	  <?php include "templates/users_css_linker.php"; ?>
  </head>
  <body>
  	<?php 
	  $menuActive = 2;	
	  include "templates/user_information_body.php"; 
	?>
  </body>
</html>