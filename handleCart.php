<?php
session_start();
$userid = $_SESSION['userid'];
include "partials/_dbconnect.php";
$productid = $_GET['productid'];

// $sql = "DELETE FROM `cart` WHERE `cart`.`cart_p_id` = 'SELECT * FROM `cart` WHERE `p_id` = $productid'";
// $result = mysqli_query($conn,$sql);
if (isset($_GET['request']) && $_GET['request'] == "delete") {
    $sql = "SELECT * FROM `cart` WHERE `product_id` = $productid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $cartProductId = $row['cart_product_id'];
    $sql1 = "DELETE FROM `cart` WHERE `cart`.`cart_product_id` = $cartProductId";
    $result1 = mysqli_query($conn, $sql1);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $cartProductId = $_GET['cartid'];
    $productquantity = $_POST['quantity'];
    $sql = "UPDATE `cart` SET `quantity` = '$productquantity' WHERE `cart`.`cart_product_id` = $cartProductId;";
    $result = mysqli_query($conn, $sql);
    header("Location: /ecommerce/myCart.php?usercart=$userid");
}

header("Location: /ecommerce/myCart.php?usercart=$userid");