
<?php
session_start();
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
include 'partials/_dbconect.php'; 


echo '<style>'; 
include "partials/style.css"; 
echo '</style>';


echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid ">
        <a class="navbar-brand" href="/forum">Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                </li>
             
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Top Catagories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    $sql = "SELECT catagory_name,catagory_id FROM `catagories` LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                       echo' <li><a class="dropdown-item" href="details.php?nameid='. $row['catagory_id']. '">'. $row['catagory_name']. '</a></li>';
                    }
                        
                    echo'  
                       
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="contact.php" >Contact</a>
                </li>
            </ul>
            <div class="row mx-2">';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '
                <form class="d-flex px-0 yas" action="search.php" method="get">
                <div class="yash1 d-flex">
                    <input class="form-control me-2 px-2 " name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                    <div class="yash d-flex">
                    <p class="text-dark  mx-2">Welcome <b>' . $_SESSION['useremail'] . '</b> </p>
                    
                    <a href="partials/_logout.php" class="btn btn-secondary ml-2">Logout</a>
                    </div>
                </form>';
} else {
    echo '<form class="d-flex px-0">
            <input class="form-control me-2 px-2 " type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
    
            <button class="btn btn-secondary mx-2" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-secondary ml-2"  type="button" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
        </form>';
}

echo ' </div>
        </div>
    </div>
</nav>';
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
    <strong>Success!</strong> You can now login
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}





?>