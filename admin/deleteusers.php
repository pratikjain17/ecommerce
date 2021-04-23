<?php
include '../partials/_dbconnect.php';
$userid = $_GET['userid'];
$sql = "DELETE FROM `users` WHERE `users`.`user_id` = $userid";
$result = mysqli_query($conn, $sql);
header("Location: /ecommerce/admin/home.php");