<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Sync Commerce</title>
    <style>
        .prod_img {
            height: 100px;
            width: 100px;
        }
    </style>
</head>

<body>
    <?php include "partials/_dbconnect.php"; ?>

    <!-- header over here -->
    <?php include "partials/header.php"; ?>
    <?php
    $bill = 0.00;
    $numberOfItems = 0;
    ?>




    <!-- My cart of the user -->
    <div class="container">
        <h2 class="text-center">My Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <?php

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                if (isset($_GET['productid'])) {
                    $productid = $_GET['productid'];
                    $user_id = $_SESSION['userid'];
                    $sql = "INSERT INTO `cart` (`cart_product_id`, `product_id`, `user_id`, `timestamp`) VALUES (NULL, '$productid', '$user_id', current_timestamp());";
                    $result = mysqli_query($conn, $sql);
                    $sql1 = "SELECT `product_id` FROM `cart` WHERE `user_id` = $user_id";
                    $result1 = mysqli_query($conn, $sql1);
                    while ($row = mysqli_fetch_assoc($result1)) {
                        $i = 1;
                        $productid = $row['product_id'];
                        $sql2 = "SELECT * FROM `products` WHERE `product_id` = $productid";
                        $result2 = mysqli_query($conn, $sql2);
                        $product = mysqli_fetch_assoc($result2);
                        $product_name = $product['product_name'];
                        $product_desc = $product['product_description'];
                        $product_category_id = $product['product_category_id'];
                        $product_price = $product['product_price'];
                        $product_image = $product['product_image'];
                        $bill += $product_price;
                        $_SESSION['cartBill'] += $product_price;
                        $numberOfItems = mysqli_num_rows($result2);
                        $_SESSION['cartItems'] = mysqli_num_rows($result2);
                        echo '<tbody>
                        <tr>
                            <td>' . $i . '</td>
                            <td>' . $productid . '</td>
                            <td>' . $product_name . '</td>
                            <td><img src="img/' . $product_image . '" alt="" class="prod_img"></td>
                            <td>Rs.' . $product_price . '</td>
                            <td><a class="btn btn-success text-center" href="product.php?productid=' . $productid . '&request=view">View</a>
                            <a class="btn btn-warning text-center" href="handleCart.php?productid=' . $productid . '&request=delete">Delete</a></td>
                        </tr>
                    </tbody>
                    ';
                        $i++;
                    }
                } else if (isset($_GET['usercart']) && $_GET['usercart'] == $_SESSION['userid']) {
                    $user_id = $_SESSION['userid'];
                    $sql1 = "SELECT `product_id` FROM `cart` WHERE `user_id` = $user_id";
                    $result1 = mysqli_query($conn, $sql1);
                    while ($row = mysqli_fetch_assoc($result1)) {
                        $i = 1;
                        $productid = $row['product_id'];
                        $sql2 = "SELECT * FROM `products` WHERE `product_id` = $productid";
                        $result2 = mysqli_query($conn, $sql2);
                        $product = mysqli_fetch_assoc($result2);
                        $product_name = $product['product_name'];
                        $product_desc = $product['product_description'];
                        $product_category_id = $product['product_category_id'];
                        $product_price = $product['product_price'];
                        $product_image = $product['product_image'];
                        $bill += $product_price;
                        $_SESSION['cartBill'] += $product_price;
                        $numberOfItems = mysqli_num_rows($result2);
                        $_SESSION['cartItems'] = mysqli_num_rows($result2);
                        echo '<tbody>
                        <tr>
                            <td>' . $i . '</td>
                            <td>' . $productid . '</td>
                            <td>' . $product_name . '</td>
                            <td><img src="img/' . $product_image . '" alt="" class="prod_img"></td>
                            <td>Rs.' . $product_price . '</td>
                            <td><a class="btn btn-success text-center" href="product.php?productid=' . $productid . '&request=view">View</a>
                            <a class="btn btn-warning text-center" href="handleCart.php?productid=' . $productid . '&request=delete">Delete</a></td>
                        </tr>
                    </tbody>
                   ';
                        $i++;
                    }
                    // header("Location: /Baby Choice/index.php");
                }
            } else {
                echo 'You are not logged in to view the cart';
            }
            ?>




        </table>
        <a class="btn btn-success text-center" href="checkout.php">Proceed to
            checkout</a>
        <a class="btn btn-warning text-center" href="index.php">Add products</a>
    </div>






    <?php include "partials/footer.php"; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>


</html>