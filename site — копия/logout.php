<?php
session_start();
if(isset($_SESSION['id'])) {
  unset($_SESSION['id']);
  header("refresh:0; url=index.php");
  exit();
}
