<?php
    $showError = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '_dbconnect.php';
        $user_email = $_POST['signupEmail'];
        $user_pass = $_POST['signupPassword'];
        $user_cpass = $_POST['signupCpassword'];
        
        //check if user already exists or not
        $existsSQL = "select * from `users` where user_email=`$user_email`";
        $result = mysqli_query($conn,$existsSQL);
        $numRows = mysqli_num_rows($result);
        if($numRows>0){
            $showError = "Email already in use";
        }
        else{
            if($user_pass == $user_cpass){
                $hash_password = password_hash($user_pass,PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `timestamp`) VALUES (NULL, '$user_email', '$hash_password', current_timestamp());";
                $result = mysqli_query($conn,$sql);

                if($result){
                    $showAlert = true;
                    header("Location:/ecommerce/index.php?signupSuccess=true");
                    exit();
                }
            }
            else{
                $showError = "Passwords do not match";
                header("Location:/ecommerce/index.php?signupSuccess=false&error=$showError");
            }
        }
        header("Location:/ecommerce/index.php?signupSuccess=false&error=$showError");
    }
?>