<?php

$pg = pg_connect("host=localhost dbname=site user=postgres password=ambassador");
if($pg === false) echo "ERROR conect to DB";
else echo "CONNECTION GRANTED!";

pg_query($pg, "create table users (user_id serial, user_f varchar, user_i varchar, user_o varchar);");


?>



<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <div class="wrapper">  
    <div class="holder">
      <?php include "templates/users/users.php"; ?>
    </div>
  </div>
</div>