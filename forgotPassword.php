<?php
include "partials/_dbconnect.php";
include 'sendmail.php';
date_default_timezone_set("Asia/Kolkata");
$success = "";
$error = "";
if (!empty($_POST['submit'])) {
  $email = $_POST['forgotPassEmail'];
  $result = mysqli_query($con, "SELECT * FROM `users` WHERE `user_email` = $email;");
  $count = mysqli_num_rows($result);
  if ($count > 0) {
    $otp = rand(100000, 999999);
    $mail_status  = sendOtp($email, $otp);

    if ($mail_status == 1) {
      $result = mysqli_query($conn, "INSERT INTO `otp` (`otp_id`, `otp`, `otp_is_expired`, `created_at`) VALUES (NULL, '$otp', '0', current_timestamp());");
      $current_id = mysqli_insert_id($conn);

      if (!empty($current_id)) {
        $success = 1;
      }
    }
  } else {
    $error = "Email does not exists";
  }
}

if (!empty($_POST['submit_otp'])) {
  $result = mysqli_query($conn, "SELECT * FROM `otp` WHERE `otp` = $otp AND `otp_is_expired` != 1 AND NOW() <= DATE_ADD(created_at,INTERVAL 15 MINUTE)");
  $count = mysqli_num_rows($result);
  if (!empty($count)) {
    $result = mysqli_query($conn, "UPDATE `otp` SET `otp_is_expired` = '1' WHERE `otp`.`otp_id` = 1;");
    $success = 2;
  } else {
    $success = 1;
    $error = "Invalid OTP";
  }
}


?>


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
  <style>
  .category_image {
    width: 100%;
    height: 100px;
  }

  .bodycon {
    height: 83vh;
  }
  </style>
</head>

<body>
  <?php include "partials/_dbconnect.php"; ?>

  <!-- header over here -->
  <?php include "partials/header.php"; ?>



  <div class="container py-2 my-3 bodycon">
    <form method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
      <?php
      if (!empty($success == 1)) {

      ?>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Enter OTP </label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="otp"
          required>
      </div>
      <button type="submit" class="btn btn-primary" name="submit_otp">Verify OTP</button>
      <?php } else if ($success == 2) { ?>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Enter New Password</label>
        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          name="newPassword" required>
      </div>
      <button type="submit" class="btn btn-primary" name="submit_password">Confirm New Password</button>
      <?php } else { ?>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Enter Email address For Verification</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          name="forgotPassEmail" required>
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Send OTP</button>
      <?php } ?>
    </form>
  </div>

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