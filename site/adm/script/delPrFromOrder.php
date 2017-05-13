<?php

    if(isset($_GET['p']) && 
       isset($_GET['o']) &&
       isset($_GET['v']) &&
       $_GET['p'] != '' &&
       $_GET['o'] != '' &&
       $_GET['v'] != '') {
        
        include "DB_operations.php";
        $el = new db;
        $el->connect();
        if($el->database === false) echo "ERROR conect to DB";
        $query = "SELECT var_count, 
                         cost
                  FROM order_detail
                  WHERE order_id = '".$_GET['o']."' AND
                        pr_id = '".$_GET['p']."' AND
                        var_id = '".$_GET['v']."'";
        $query = $el->query($query);
        $resPr = $el->fetch($query)[0];
        $query = "UPDATE prod_types
                  SET count = count + '".$resPr['var_count']."'
                  WHERE pr_id = '".$_GET['p']."' AND
                        id = '".$_GET['v']."'";
        $el->query($query);
        $query = "DELETE
                  FROM order_detail
                  WHERE order_id = '".$_GET['o']."' AND
                        pr_id = '".$_GET['p']."' AND
                        var_id = '".$_GET['v']."'";
        $el->query($query);
        $query = "UPDATE orders
                  SET sum = sum - '".($resPr['var_count'] * $resPr['cost'])."'
                  WHERE id = '".$_GET['o']."'";
        $query = $el->query($query);
        $el->close();  
        header("Refresh:0;url=".$_SERVER['HTTP_REFERER']);
    }  
    else        header("Refresh:0;url=".$_SERVER['HTTP_REFERER']);
?>
