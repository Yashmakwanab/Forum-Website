<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "forum";


$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("sorry we fail to connect due to this error--->".mysqli_connect_error());
}


?>