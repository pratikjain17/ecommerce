<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $user_id = $_SESSION['userid'];
    $userid = $_SESSION['userid'];
    $_SESSION['cartBill'] = 0.00;
    $_SESSION['cartItems'] = 0;
    $bill = 0.00;
    $numberOfItems = 0;
    $sql1 = "SELECT * FROM `cart` WHERE `user_id` = $user_id";
    $result1 = mysqli_query($conn, $sql1);
    while ($row = mysqli_fetch_assoc($result1)) {
        // print_r($row);
        $cartquantity = $row['quantity'];
        $cartProductid = $row['cart_product_id'];
        $pid = $row['product_id'];
        $sql2 = "SELECT * FROM `products` WHERE `product_id` = $pid";
        $result2 = mysqli_query($conn, $sql2);
        $product = mysqli_fetch_assoc($result2);
        $product_name = $product['product_name'];
        $product_desc = $product['product_description'];
        $product_category_id = $product['product_category_id'];
        $product_price = $product['product_price'];
        $product_image = $product['product_image'];
        // $bill += ($product_discountprice * $cartquantity);
        $_SESSION['cartBill'] += ($product_price * $cartquantity);
        // $numberOfItems = mysqli_num_rows($result2);
        // $_SESSION['cartItems'] = mysqli_num_rows($result2);

    }
} else {
    $userid = 0;
}
?>
<?php
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sync Ecommerce Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<a class="dropdown-item" href="category.php?catid=' . $row['category_id'] . '">' .
        $row['category_name'] . '</a>';
};
echo '</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="myCart.php?usercart=' . $_SESSION['userid'] . '" tabindex="-1">Your Cart</a>
        </li>
      </ul>';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo ' <form class="d-flex" action="/ecommerce/search.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" name="query" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
    <a href="profile.php" class="my-2 mx-2" style="color:white;">Welcome <br>' . $_SESSION['useremail'] . '</a>
    <a href="partials/_logout.php" class="btn btn-danger ml-2">Logout</a>
</nav>';
} else {
    echo '<form class="d-flex" action="/ecommerce/search.php" method="get">
  <input class="form-control me-2" type="search" placeholder="Search" name="query" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>
</div>
<!-- login button -->
<button type="button" class="btn btn-info mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">
  Login
</button>
<!-- signUp button -->
<button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">
  SignUp
</button>
</div>
</nav> ';
}

include 'partials/loginmodal.php';
include 'partials/signupModal.php';
include 'partials/adminLoginModal.php';

if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfully done: </strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['error']) && $_GET['error'] == "Unable to login") {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Email or password is not correct || Unable to login
</div>';
}