<?php
include '../partials/_dbconnect.php';
$orderid = $_GET['orderid'];
$sql = "UPDATE `orders` SET `order_status` = 'delivered' WHERE `orders`.`order_id` = $orderid;";
$result = mysqli_query($conn, $sql);
header("Location: /ecommerce/admin/orders.php");