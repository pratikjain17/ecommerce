<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
include 'partials/_dbconnect.php';
include 'partials/header.php';

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
  </style>
</head>

<body>
  <section id="center" class="center_register">
    <div class="container">
      <div class="row">
        <div class="register_1 clearfix">
          <div class="register_1l clearfix">
            <div class="register_1li clearfix">
              <div class="center_3r1 clearfix">
                <div class="row">
                  <div class="col-sm-9">
                    <h4>Merchant Check Out Page</h4>
                  </div>
                </div>
              </div>
              <!-- <pre>
	</pre> -->
              <form method="post" action="pgRedirect.php">
                <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <tbody>
                      <tr>
                        <th>S.No</th>
                        <th>Label</th>
                        <th>Value</th>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td><label>ORDER_ID::*</label></td>
                        <td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID"
                            autocomplete="off" value="<?php echo  "ORDS" . rand(10000, 99999999) ?>" readonly>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td><label>CUSTID ::*</label></td>
                        <td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off"
                            value="<?php echo $_SESSION['userid'] ?>" readonly></td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td><label>INDUSTRY_TYPE_ID ::*</label></td>
                        <td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID"
                            autocomplete="off" value="Retail" readonly></td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td><label>Channel ::*</label></td>
                        <td><input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID"
                            autocomplete="off" value="WEB" readonly>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td><label>txnAmount*</label></td>
                        <td><input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT"
                            value="<?php echo $_SESSION['cartBill'] ?>" readonly>
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td><input value="CheckOut" type="submit" onclick=""></td>
                      </tr>
                    </tbody>
                  </table>
                  * imp : Undeditable Mandatory Fields
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

  </section>

  <div class="container">
    <h2>Delivering Your Order</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $fullname = $_POST['fullName'];
      $contactNumber = $_POST['contactNumber'];
      $pincode = $_POST['pincode'];
      $address = $_POST['address'];

      echo '<h2>Your Name : ' . $fullname . '</h2> 
      <h2>Your Contact Number : ' . $contactNumber . ' </h2> 
      <h2>Your Pincode : ' . $pincode . ' </h2> 
      <h2>Your Address : ' . $address . ' </h2> ';
    }
    ?>
  </div>
</body>


</html>
<?php
include 'partials/footer.php';
?>