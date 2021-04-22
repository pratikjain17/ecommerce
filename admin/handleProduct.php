<?php 
    session_start();
    $email = $_SESSION['adminEmail'];
    include "../partials/_dbconnect.php";
    $productid = $_GET['productid'];

    // $sql = "DELETE FROM `cart` WHERE `cart`.`cart_p_id` = 'SELECT * FROM `cart` WHERE `p_id` = $productid'";
    // $result = mysqli_query($conn,$sql);
    if(isset($_GET['action']) && $_GET['action'] == "delete"){
        $sql = "DELETE FROM `products` WHERE `products`.`product_id` =$productid";
        $result = mysqli_query($conn,$sql);
        header("Location: /ecommerce/admin/home.php"); 

    }
    else if(isset($_GET['action']) && $_GET['action'] == "update"){
        header("Location: /ecommerce/admin/updateProduct.php?productid=$productid"); 
        
    }
    
  

    
?>