<?php

$showError = false;

if ($_SERVER["REQUEST_METHOD"] ==  "POST") {
    include '_dbconect.php';
    $username = $_POST["loginEmail"];
    $password = $_POST["loginpassword"];


    $sql = "Select * from users where user_email = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num==1){
        $raw = mysqli_fetch_assoc($result);
            if (password_verify($password, $raw['user_pass'])){ 
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $raw['sno'];
                // $_SESSION['sno'] = $row['sno'];
              $_SESSION['useremail'] = $username;
            echo "logged in ". $username;
        }  else{
            $showError = "Invalid Credentials";
        }
    
        header("Location: /forum/index.php");  
    }
    else{
        $showError = "Invalid Credentials";
    }
    header("Location: /forum/index.php");  
        
}
?>
