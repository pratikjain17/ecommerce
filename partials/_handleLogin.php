<?php
    $showError = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '_dbconnect.php';
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        $sql = "select * from users where user_email = '$email'";
        $result = mysqli_query($conn,$sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
                if(password_verify($password,$row['user_password'])){
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['userid'] = $row['user_id'];
                    $_SESSION['useremail'] = $email;
                    $_SESSION['cartBill'] = 0;
                    $_SESSION['useremail'] = $email;
                    echo "logged in". $email;
                    header("Location: /ecommerce/index.php");
                }
                else{
                    $error = "Unable to login";
                    header("Location: /ecommerce/index.php?error=$error");
                }
        }
        else{
            $error = "Unable to login";
            header("Location: /ecommerce/index.php?error=$error");   
        }
    }
?>