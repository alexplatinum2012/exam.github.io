<?php

    if(isset($_GET['o']) && $_GET['o'] != '') {
        include "DB_operations.php";
        $el = new db;
        $el->connect();
        if($el->database === false) echo "ERROR conect to DB";
        $query = "SELECT pr_id,
                         var_id,
                         var_count
                  FROM order_detail
                  WHERE order_id = '".$_GET['o']."'";
        $query = $el->query($query);
        $resPr = $el->fetch($query);
        foreach ($resPr as $key => $value) {
            $query = "UPDATE prod_types
                      SET count = count + '".$value['var_count']."'
                      WHERE pr_id = '".$value['pr_id']."' AND
                            id = '".$value['var_id']."'";
            $el->query($query);
        }
        $query = "DELETE
                  FROM order_detail
                  WHERE order_id = '".$_GET['o']."'";
        $el->query($query);
        $query = "DELETE
                  FROM orders
                  WHERE id = '".$_GET['o']."'";
        $query = $el->query($query);
        $el->close();
        //exit();
        header("Refresh:0;url=../orders.php");
    }
    else  header("Refresh:0;url=".$_SERVER['HTTP_REFERER']);
?>
