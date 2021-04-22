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

  <!-- Corousel here for the website  -->
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/slider_1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/slider_2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/2400x800/?fashion,shirts" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>

  <div class="container">
    <h2 class="text-center py-2">Welcome to Sync E-commerce store</h2>
    <h3 class="text-center py-2">Our Categories</h3>
    <div class="category container row">
      <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['category_id'];
                $category_name = $row['category_name'];
                $category_desc = $row['category_description'];
                $category_image = $row['category_image'];

                // categories will be displayed over here 
                echo '<div class="col-md-4 my-2" style="display:inline-block;">
                <div class="card gal--animation gal--part' . $category_id . '" style="width: 18rem;">
                    <img src="img/' . $category_image . '" class="card-img-top category_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $category_name . '</h5>
                        <p class="card-text">' . $category_desc . '</p>
                        <a href="category.php?catid=' . $category_id . '" class="btn btn-primary">' . $category_name . '</a>
                    </div>
                </div>
            </div>';
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

  <?php include "partials/contact.php"; ?>
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