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
  <title>Sync Commerce</title>
  <style>
  .category_image {
    width: 100%;
    height: 100px;
  }
  </style>
</head>

<body>
  <?php include "partials/_dbconnect.php"; ?>

  <!-- header over here -->
  <?php include "partials/header.php"; ?>

  <?php
  // $productid = $_GET['productid'];
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $bill = 0;
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM `cart` WHERE `user_id` = $userid";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $productid = $row['product_id'];
      $sql1 = "SELECT * FROM `products` WHERE `product_id` = $productid";
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      $productPrice = $row1['product_price'];
      // $bill += $productPrice;
      // $_SESSION['cartBill'] = $bill;
    }
  }

  ?>

  <?php
  // if logged in then echo shipping address form and payment option
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '<div class="container py-2 my-2">
        <h2 class="text-center">Enter your shipping details</h2>
    <form method="post" action="payment.php">
      <div class="form-group">
        <label for="exampleFormControlInput1">Your Full Name</label>
        <input type="text" class="form-control" id="fullName"  name="fullName" placeholder="Your Name" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Your Contact number</label>
        <input type="text" class="form-control" id="contactNumber"  name="contactNumber" placeholder="Your Number" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Your pincode</label>
        <input type="text" class="form-control" id="pincode"  name="pincode" placeholder="Your Pincode" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Your Address</label>
        <textarea class="form-control" id="address" name="address" rows="3"></textarea required>
      </div>
      <label for="Payment-options">Payment Option</label>
      <div class="form-check">
      <input class="form-check-input" type="radio" name="paymentoption" id="flexRadioDefault1" required>
      <label class="form-check-label" for="flexRadioDefault1">
        Cash on delivery
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="paymentoption" id="flexRadioDefault2" required>
      <label class="form-check-label" for="flexRadioDefault2">
        Credit card/Debit card
      </label>
    </div>
    <div class="form-group my-2">
        <input class="btn btn-info text-center" type="submit" value="Proceed" required>
    </div>
    
    
    </form>
    <h2 class ="my-3 py-3">Your total : RS. ' . $_SESSION['cartBill'] . ' </h2>
    </div>';
  } else {
    echo '<div class="container py-2 my-2">
        <h4 class="py-2" style="color:red;">You are not logged in....Please Login to checkout</h4>
</div>';
  }
  ?>

  <!-- <h2>Your total : </h2> -->





  <?php include "partials/footer.php"; ?>
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