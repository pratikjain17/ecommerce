<?php
include '../partials/_dbconnect.php';
$productid = $_GET['productid'];
$sql = "DELETE FROM `products` WHERE `products`.`product_id` = $productid";
$result = mysqli_query($conn, $sql);
header("Location: /ecommerce/admin/home.php");