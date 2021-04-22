<?php
    $showError = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '_dbconnect.php';
        $email = $_POST['adminEmail'];
        $password = $_POST['adminPassword'];

        $sql = "SELECT * FROM `admin` WHERE `admin_email` LIKE '$email'";
        $result = mysqli_query($conn,$sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
                if($row['admin_password'] == $password){
                    session_start();
                    $_SESSION['adminloggedin'] = true;
                    $_SESSION['adminEmail'] = $email;
                    echo "logged in". $email;
                    header("Location: /ecommerce/admin/home.php");
                }
                else{
                    $error = "Unable to login";
                    header("Location: /ecommerce/admin/home.php?error=$error");
                }
        }
        else{
            $error = "Unable to login";
            header("Location: /ecommerce/admin/home.php?error=$error");   
        }
    }
?>