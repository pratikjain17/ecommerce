<?php
include '../partials/_dbconnect.php';
$catid = $_GET['catid'];
$sql = "DELETE FROM `categories` WHERE `categories`.`category_id` = $catid";
$result = mysqli_query($conn, $sql);
header("Location: /ecommerce/admin/home.php");