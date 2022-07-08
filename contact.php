<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Welcome to Forum</title>
    <link rel="stylesheet" href="partials/basic.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
       
    </style>
</head>

<body>
    <?php include 'partials/_dbconect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $th_name = $_POST['name'];
        $th_email = $_POST['email'];
        $th_subject = $_POST['subject'];
        $th_desc = $_POST['description'];

        $th_name = str_replace("<", "&lt;", $th_name);
        $th_name = str_replace(">", "&gt;", $th_name); 

        $th_email = str_replace("<", "&lt;", $th_email);
        $th_email = str_replace(">", "&gt;", $th_email); 

        $th_subject = str_replace("<", "&lt;", $th_subject);
        $th_subject = str_replace(">", "&gt;", $th_subject); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 

    
        $sql = "INSERT INTO `contactus` (`name`, `email`, `subject`, `description`) VALUES ('$th_name', ' $th_email', ' $th_subject', '$th_desc')";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Problem has been added! please wait for admin to respond
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }

    ?>
    <div class="container my-3 bg-light">
        <section class="mb-4">
            <h2 class="h1-responsive font-weight-bold text-center my-4 pt-3">Contact us</h2>
            <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
                a matter of hours to help you.</p>

            <div class="row">
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="contact.php" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control">
                                    <label for="name" class="">Your name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="email" name="email" class="form-control">
                                    <label for="email" class="">Your email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <input type="text" id="subject" name="subject" class="form-control">
                                    <label for="subject" class="">Subject</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="md-form">
                                    <textarea type="text" id="message" name="description" rows="2" class="form-control md-textarea"></textarea>
                                    <label for="message">Your message</label>
                                </div>

                            </div>
                        </div>
                    </form>

                    <div class="my-2 llst">
                        <a class="btn btn-secondary" onclick="document.getElementById('contact-form').submit();">Send</a>
                    </div>
                    <div class="status"></div>
                </div>
                <div class="col-md-3 text-center last">
                    <ul class="list-unstyled mb-0">
                        <li><i class="bi bi-geo-alt-fill"></i>
                            <p class=" ">Ahmedabad, PN 382350, INDIA</p>
                        </li>

                        <li><i class="bi bi-telephone-fill"></i>
                            <p>+91 9510803236</p>
                        </li>

                        <li><i class="bi bi-envelope-fill"></i>
                            <p>contact@forum.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>