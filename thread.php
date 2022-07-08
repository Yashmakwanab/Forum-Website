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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_userid = $row['thread_userid'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_userid' ";
        $result2 = mysqli_query($conn, $sql2);
        $row2 =  mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $comment = $_POST['comment'];

        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment); 
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES (' $comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Comment has been added!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }
    ?>

<input type="hidden" name="sno">
    <div class="container my-3">
        <div class="jumbotron bg-light px-4 py-5 rounded-3">
            <h2 class="display-4"><?php echo $title; ?></h2>
            <p class="lead"><?php echo $desc; ?> </p>
            <hr class="my-4">
            <p> Posted By:-<b><?php echo $posted_by; ?></b> </p>
        </div>
    </div>
    <?php
     if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '<div class="container">
        <h2 class="py-2">Post a Comment</h2>
        <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type Your Comment :-</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">

            </div>
            <button type="submit" class="btn btn-secondary">Post Comment</button>
        </form>
    </div>';
    }
     else{
        echo ' <div class="container my-3">
        <h2 class="py-2">Post a Comment</h2>
        <div class="jumbotron bg-light px-4 py-4 rounded-3 d-flex justify-content-center align-items-center">
            <p class="lead mx-0 my-0 fw-normal">You Are Not Loggedin. Please Login To Be Able To Start Discussion. </p>
        </div>
    </div>';
    }
    ?>
    <div class="container py-3 ques">
        <h2 class="py-2">Discussions</h2>

        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $thread_userid = $row['comment_by'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_userid' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 =  mysqli_fetch_assoc($result2);

            echo ' <div class="media d-flex py-1">
                <img src="img/png.png" width=35px height=35px class="mr-3 me-2" alt="...">
                <div class="media-body">
                    <p class=" my-0"><b>' . $row2['user_email'] . '</b> at '.$comment_time.'</P>
                ' . $content . '
                </div>
                </div> ';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid bg-light rounded-3 px-4 py-4">
            <div class="container">
              <p class="display-6">No result found</p>
              <p class="lead">Be the first person to answer a question</p>
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