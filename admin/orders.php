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
  if (isset($_GET['updatesuccess']) && $_GET['updatesuccess'] == true) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Update successful
</div>';
  }
  if (isset($_GET['updatesuccess']) && $_GET['updatesuccess'] == false) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Update Not successful
</div>';
  }
  if (isset($_GET['catadded']) && $_GET['catadded'] == true) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Category succesfully added
</div>';
  }
  if (isset($_GET['catadded']) && $_GET['catadded'] == false) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Adding Category failed
</div>';
  }
  ?>
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="orders.php">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="suggestions.php">Suggestions</a>
      </li>
    </ul>
  </div>


  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-center">Category Image</th>
          <th scope="col" class="text-center">Category Name</th>
          <th scope="col" class="text-center">Catgeory Descritpion</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $category_id = $row['category_id'];
          $category_name = $row['category_name'];
          $category_desc = $row['category_description'];
          $category_image = $row['category_image'];

          // categories will be displayed over here 
          echo ' <tr>
          <th scope="row" class="text-center">' . $category_id . '</th>
          <td class="text-center"><img src="../img/' . $category_image . '" alt="" class="category_image"></td>
          <td class="text-center">' . $category_name . '</td>
          <td class="text-center">' . $category_desc . '</td>
          <td class="text-center"><a class="btn btn-success" href="category.php?catid=' . $category_id . '">Go</a>
          <a class="btn btn-warning" href="updateCategory.php?catid=' . $category_id . '"><i class="fas fa-edit"></i></a>
          <a class="btn btn-danger" href="deleteCategory.php?catid=' . $category_id . '"><i class="far fa-trash-alt"></i></a></td>
        </tr>';
        }
        ?>
      </tbody>
    </table>

  </div>
  <a href=""></a>




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