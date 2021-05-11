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

  <!-- Taking the product from the get request of product id. -->
  <?php
  $productid = $_GET['productid'];
  $sql = "SELECT * FROM `products` WHERE `product_id` = $productid";
  $result = mysqli_query($conn, $sql);
  $noResult = false;
  while ($row = mysqli_fetch_assoc($result)) {
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $product_desc = $row['product_description'];
    $product_category_id = $row['product_category_id'];
    $product_price = $row['product_price'];
    $product_image = $row['product_image'];
  }

  ?>

  <?php
  $method = $_SERVER['REQUEST_METHOD'];
  $showAlert = false;
  if ($method == 'POST') {
    //Insert comment into comments table DB
    $comment = $_POST['comment'];
    $userid = $_POST['userid'];
    $sql_query = "INSERT INTO `comments` (`comment_id`, `comment_content`, `product_id`, `comment_by`, `comment_time`) VALUES (NULL, '$comment', '$product_id', '$userid', current_timestamp());";
    $result = mysqli_query($conn, $sql_query);
    $showAlert = true;
    if ($showAlert) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successfully done </strong> Your comment has been added.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
              </div>';
    }
  }
  ?>

  <div class="container my-3 py-0">
    <div class="jumbotron py-3">
      <img src="img/<?php echo $product_image ?>" class="card-img-top" style="width:100%;height:400px">
      <h1 class="display-5"><?php echo $product_name ?></h1>
      <p class="lead"><?php echo $product_desc ?></p>
      <hr class="my-3">
      <p class="lead"><b> Price : Rs.<?php echo $product_price ?>/-</b></p>
      <p class="lead">
        <a class="btn btn-success btn-lg" href="checkout.php?productid=<?php echo $productid ?>" role="button">Buy
          Now</a>
        <a class="btn btn-danger btn-lg" href="myCart.php?productid=<?php echo $product_id; ?>" role="button">Add to
          Cart</a>
      </p>
    </div>
  </div>

  <?php
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo ' <div class="container">
        <h2>Post a comment/review on this product</h2>
        <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your comment.</label>
                <textarea class="form-control my-2" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="userid" value="' . $_SESSION['userid'] . '">
            </div>
            <button type="submit" class="btn btn-success my-2">Post Comment</button>

        </form>
    </div>';
  } else {
    echo '<div class="container">
        <h2>Post a comment/review on this product</h2>
        <h4 class="py-2" style="color:red;">You are not logged in....Please Login to comment</h4>
</div>';
  }

  ?>

  <br>

  <div class="container">
    <h2>Comments/Reviews</h2>
    <?php
    $productid = $_GET['productid'];
    $sql = "SELECT * FROM `comments` WHERE `product_id`=$productid";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
      $noResult = false;
      $id = $row['comment_id'];
      $content = $row['comment_content'];
      $comment_time = $row['comment_time'];
      $comment_by = $row['comment_by'];
      $sql2 = "select * from `users` where user_id = $comment_by";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $useremail = $row2['user_email'];
      echo '
        <div class="media py-3 my-3" id="question">
        <img class="mr-3" src="img/userdefault.png" width="50px" style="border:2px solid red; border-radius:50%" alt="Generic placeholder image">
        <div class="media-body">
            <p class = "font-weight-bold my-0">' . $useremail . '   at '   . $comment_time . '</p>
            ' . $content . '
        </div>
    </div>';
    }

    if ($noResult) {
      echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-5">No comments found</h1>
          <p class="lead">Be the first person to comment on this topic.</p>
        </div>
      </div>';
    }

    ?>
  </div>




  <?php include "partials/footer.php"; ?>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>

</body>

</html>