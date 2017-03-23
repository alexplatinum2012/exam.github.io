<?php
  include "DB_info.php";


  class db {
    var $database;

    function connect() {
      $tmp = pg_connect("host=".host." dbname=".dbName." user=".user." password=".password);
      if($tmp !== false)
        $this->database = $tmp;
    }

    function query($q) {
      return pg_query($this->database, $q);
    }

    function fetch($var) {
      return pg_fetch_all($var);
    }

    function close() {
      return pg_close($this->database);
    }
  }
?>
