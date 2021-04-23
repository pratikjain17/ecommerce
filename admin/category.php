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
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <title>Ecommerce</title>
  <style>
  .bodycon {
    min-height: 80vh;
    display: flex;
    flex-direction: column;
  }

  .category_image {
    width: 100px;
    height: 100px;
  }
  </style>
</head>

<body>
  <!-- database yaha connect karna -->
  <?php include "../partials/_dbconnect.php"; ?>




  <?php
  session_start();
  echo '  <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="">
            <h2><i class="fas fa-school"></i> Ecommerce</h2>
        </a>';
  if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true) {
    echo '<form class="form-inline my-2 my-lg-0" method="get">
            <h6 class = "my-2 mx-2" style="color:white;">Welcome Admin <br>' . $_SESSION['adminEmail'] . '</h6>
            <a href = "../partials/_logout.php" class="btn btn-danger ml-2">Logout</a>
            <a href = "addProduct.php" class="btn btn-warning ml-2">Add a product</a>
            <a href = "addCategory.php" class="btn btn-success ml-2">Add a Category</a>
          </form>';
  }
  echo '</nav>';
  ?>

  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Product Image</th>
          <th scope="col">Product Name</th>
          <th scope="col">Product Description</th>
          <th scope="col">Product Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
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
          echo ' <tr>
          <th scope="row" class="text-center">' . $product_id . '</th>
          <td class="text-center"><img src="../img/' . $product_image . '" alt="" class="category_image"></td>
          <td class="text-center">' . $product_name . '</td>
          <td class="text-center">' . $product_description . '</td>
          <td class="text-center">' . $product_price . '</td>
          <td class="text-center"><a class="btn btn-danger" href="deleteProduct.php?productid=' . $product_id . '">Delete</a>
          <a class="btn btn-warning" href="updateProduct.php?productid=' . $product_id . '">Update</a></td>
        </tr>';

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
      </tbody>
    </table>
  </div>





  <?php include "../partials/footer.php" ?>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>