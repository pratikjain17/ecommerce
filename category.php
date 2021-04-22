<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <title>Products</title>
  <style>
  .container {
    min-height: 90%;
  }
  </style>
</head>

<body>
  <?php include "partials/_dbconnect.php"; ?>

  <!-- header over here -->
  <?php include "partials/header.php"; ?>

  <!-- Taking the category from the category table -->
  <?php
    $catid = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id`=$catid";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>



  <div class="container">
    <h2 class="text-center py-2">Welcome to Sync E-commerce store</h2>
    <h3 class="text-center py-2">Products</h3>
    <div class="product container row">
      <?php
            $catid = $_GET['catid'];
            $sql = "SELECT * FROM `products` WHERE `product_category_id`=$catid";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_image = $row['product_image'];


                // products will be displayed over here 
                echo '<div class="col-md-4 my-2" style="display:inline-block;">
                <div class="card" style="width: 18rem;">
                    <img src="img/' . $product_image . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $product_name . '</h5>
                        <p class="card-text">' . $product_description . '</p>
                        <p>Price : ' . $product_price . '</p>
                        <a href="product.php?productid=' . $product_id . '" class="btn btn-primary">View</a>
                        <a href="myCart.php?productid=' . $product_id . '" class="btn btn-success">Add to cart</a>
                    </div>
                </div>
            </div>';

                if ($noResult) {
                    echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-5">No Products found</h1>
                  <p class="lead">Please browse other categories</p>
                </div>
              </div>';
                }
            }
            ?>
      <!-- <div class="col-md-4 my-2" style="display:inline-block;">
                <div class="card" style="width: 18rem;">
                    <img src="https://source.unsplash.com/2400x800/?fashion,shirts" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Mens Fashion</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div> -->

    </div>
  </div>

  <?php include "partials/footer.php"; ?>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>

</body>

</html>