<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] ==  "POST") {
    include '_dbconect.php';
    $username = $_POST["signupemail"];
    $password = $_POST["signuppassword"];
    $cpassword = $_POST["signupcpassword"];

    $exitsql ="SELECT * FROM `users` WHERE user_email = ' $username'";
    $result = mysqli_query($conn, $exitsql);
    $numexitrows = mysqli_num_rows($result);
    if($numexitrows > 0){
        $showError = " username alredy exits";
    }
    else{
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) VALUES ( '$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
         else{
           $showError = "password do not match";
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");


   
}

?>

