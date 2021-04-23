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
  $error = "";
  $catid = $_GET['catid'];
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $catname = $_POST['name'];
    $catdesc = $_POST['desc'];
    $catimage = $_FILES['category_image']['name'];
    $destination = "C:/xampp/htdocs/ecommerce/img/" . basename($_FILES['category_image']['name']);
    move_uploaded_file($_FILES['category_image']['tmp_name'], $destination);

    $sql = "UPDATE `categories` SET `category_name` = '$catname', `category_description` = '$catdesc', `category_image` = '$catimage' WHERE `categories`.`category_id` = $catid;";
    $result = mysqli_query($conn, $sql);

    header("Location: /ecommerce/admin/home.php?catadded=true");
    // echo $productimage;
  }
  ?>




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

  <?php
  $catid = $_GET['catid'];
  $sql = "SELECT * FROM `categories` WHERE `category_id` = $catid";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $category_id = $row['category_id'];
  $category_name = $row['category_name'];
  $category_desc = $row['category_description'];
  $category_image = $row['category_image'];

  ?>

  <div class="container">
    <h2>Add Category</h2>
    <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
      <div class="form-group">
        <label for="exampleFormControlFile1">Category Image</label>
        <input type="file" name="category_image" class="form-control" value="<?php echo $category_name ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Category Name</label>
        <input type="text" class="form-control" id="name" placeholder="" name="name"
          value="<?php echo $category_name ?>" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Category Description</label>
        <textarea class="form-control" id="desc" name="desc" rows="3" required><?php echo $category_desc ?></textarea>
      </div>
      <button class="btn btn-success" type="submit">Update</button>

    </form>
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