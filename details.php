<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Welcome to Forum</title>
    <style>
        .ques {
            min-height: 500px;
        }
    </style>

</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconect.php'; ?>

    <?php
    $id = $_GET['nameid'];
    $sql = "SELECT * FROM `catagories` WHERE catagory_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['catagory_name'];
        $catdesc = $row['catagory_description'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 

        $sno = $_POST['sno'];
    
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_catid`, `thread_userid`, `timestamp`) VALUES (' $th_title', ' $th_desc', '$id', '$sno', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Problem has been added! please wait for community to respond
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }

    ?>


    <div class="container my-3">
        <div class="jumbotron bg-light px-4 py-5 rounded-3">
            <h2 class="display-4">Welcome to <?php echo $catname; ?> forums</h2>
            <p class="lead"><?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums.<br>
                Do not post copyright-infringing material.<br>
                Do not post “offensive” posts, links or images.<br>
                Do not cross post questions.</p>
            <p class="lead">
                <a class="btn btn-secondary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '    <div class="container">
            <h2 class="py-2">Start a Discussion</h2>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

                </div>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Explain Your Problem</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>

                </div>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>';
    } else {
        echo ' <div class="container my-3">
        <h2 class="py-2">Start a Discussion</h2>
        <div class="jumbotron bg-light px-4 py-4 rounded-3 d-flex justify-content-center align-items-center">
            <p class="lead mx-0 my-0 fw-normal">You Are Not Loggedin. Please Login To Be Able To Start Discussion. </p>
        </div>
    </div>';
    }
    ?>
    <div class="container py-3 ques ">
        <h2 class="py-2">Forum Questions</h2>

        <?php
        $id = $_GET['nameid'];
        $sql = "SELECT * FROM `threads` WHERE thread_catid=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_userid = $row['thread_userid'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_userid' ";
           
            $result2 = mysqli_query($conn, $sql2);
            $row2 =  mysqli_fetch_assoc($result2);
            


            echo ' <div class="media d-flex">
                <img src="img/png.png" width=35px height=35px class="mr-3 me-2" alt="...">
                <div class="media-body">
                
                <p class=" my-0"><b>Asked By :- ' . $row2['user_email'] . '</b> at ' . $thread_time . '</P>
                    <h5 class="mt-0"><a class="text-dark  " href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                    <p>' . $desc . '</p>
                </div>
                </div> ';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid bg-light rounded-3 px-4 py-4">
            <div class="container">
              <p class="display-6">No result found</p>
              <p class="lead">Be the first person to ask a question</p>
            </div>
          </div>';
        }
        ?>

    </div>
    <?php include 'partials/_footer.php'; ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>