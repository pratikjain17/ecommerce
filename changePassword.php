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

  <title>Ecommerce website</title>
  <style>
  .bodycon {
    min-height: 75vh;
  }

  .fonts {
    font-size: large;
  }

  #imguser {
    height: 200px;
    width: 200px;
    border: 5px solid gold;
    border-radius: 5px;
  }
  </style>
</head>

<body>
  <!-- database yaha connect karna -->
  <?php include "partials/_dbconnect.php"; ?>
  <?php include "partials/header.php"; ?>

  <?php
  $userid = $_SESSION['userid'];
  $method = $_SERVER['REQUEST_METHOD'];
  $showAlert = false;
  $error = "";
  if ($method == 'POST') {
    //Update the user password
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    $sql_query = "SELECT * FROM `users` WHERE `user_id` = $userid";
    $result = mysqli_query($conn, $sql_query);
    $row = mysqli_fetch_assoc($result);
    $userPassword = $row['user_password'];
    // echo $studentPassword;
    // echo $oldPassword;
    if (password_verify($oldPassword, $userPassword)) {
      $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $sql = "UPDATE `users` SET `user_password` = '$hashedNewPassword' WHERE `users`.`user_id` = $userid";
      $result1 = mysqli_query($conn, $sql);
      $showAlert = true;
    } else {
      $error = "Old password do not match";
    }
    if ($showAlert) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successfully done </strong> Your Password has been changed | ' . $error . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
              </div>';
    }
  }
  ?>


  <?php
  $userid = $_SESSION['userid'];
  $sql = "SELECT * FROM `users` WHERE `user_id` = '$userid'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['user_id'];
  $user_name = $row['user_name'];
  $user_email = $row['user_email'];
  $user_address = $row['user_address'];
  $user_phone = $row['user_phone'];
  ?>
  <div class="container bodycon my-2 animate__animated animate__fadeInUp">
    <div aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="profile.php">Your Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
      </ol>
    </div>
    <h2><i class="fa fa-user"></i>Change Password</h2>

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label"> Old Password</label>
        <input type="password" class="form-control" id="oldPassword" name="oldPassword">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">New Password</label>
        <input type="password" class="form-control" id="newPaswword" name="newPassword">
      </div>
      <button type="submit" class="btn btn-warning">Update Password</button>
  </div>
  </form>

  </div>
  </div>







  <?php include "partials/footer.php" ?>


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