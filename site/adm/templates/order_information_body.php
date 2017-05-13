<div class="w960">
  <div class="nav">
    <?php include "templates/nav/nav.php" ?>
  </div>
  <?php

    if(isset($_GET['oid']) && $_GET['oid'] != '') {
        include_once "script/DB_operations.php";
        $el = new db;
        $el->connect();
        if($el->database === false) echo "ERROR conect to DB";
        $query = "SELECT
                    id AS orderid,
                    status AS orderstatus,
                    city AS usercity,
                    street AS userstreet,
                    house AS userhouse,
                    apart AS userapart,
                    delivery_type AS orderdelivery,
                    fio AS userfio,
                    email AS useremail,
                    phone AS userphone,
                    comment AS ordercomment
                  FROM
                    orders
                  WHERE
                    id = '".$_GET['oid']."'";
        $query = $el->query($query);
        $orderInfo = $el->fetch($query)[0];
        $query = "SELECT
                    t2.var_count AS prvarcount,
                    t2.cost AS prcost,
                    t2.pr_id AS prid,
                    t2.var_id AS prvarid,
                    t3.name AS prname
                  FROM
                    orders t1,
                    order_detail t2,
                    products t3
                  WHERE
                    t1.id = '".$_GET['oid']."' AND
                    t2.order_id = t1.id AND
                    t2.pr_id = t3.id";
        $query = $el->query($query);
        $orderProdInfo = $el->fetch($query);
    }
  ?>
  <div class="wrapper">
    <div class="holder">
      <?php include "templates/orders/order_information.php"; ?>
    </div>
  </div>
</div>
