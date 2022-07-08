<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Welcome to Forum</title>
    
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconect.php'; ?>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <img src="img/pexels-olia-danilevich-4974912.jpg" class="d-block w-100   "  alt="...">
            </div>
            <div class="carousel-item ">
                <img src="img/pexels-olia-danilevich-4974915.jpg" class="d-block w-100 " alt="...">
            </div>
            <div class="carousel-item ">
                <img src="img/pexels-olia-danilevich-4974920.jpg" class="d-block w-100 "  alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container my-3">
        <h2 class="text-center my-2">Forum-Catagories</h2>
        <div class="row ">
            <?php
            $sql = "SELECT * FROM `catagories`";
            $result =mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){ 
                // echo $row  ['catagory_id'];
                // echo $row  ['catagory_name'];
                $id = $row['catagory_id'];
                $name = $row['catagory_name'];
                $desc = $row['catagory_description'];
                echo ' <div class="col-sm-4 my-2  d-flex justify-content-center">
                            <div class="card" style="width: 18rem;">
                                <img src="img/card-'.$id.'.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="details.php?nameid='. $id .'" >'. $name .'</a></h5>
                                    <p class="card-text">'. $desc .'</p>
                                    <a href="details.php?nameid='. $id .'" class="btn btn-secondary">View Details</a>
                                </div>
                            </div>
                        </div>';
            }
            ?>
        </div>
    </div>
    <?php include 'partials/_footer.php'; ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>