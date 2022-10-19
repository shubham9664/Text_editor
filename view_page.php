<?php include('config.php') ?>

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Editor</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./summernote/summernote-lite.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./summernote/summernote-lite.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <style>
         :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }
        
        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }
        .btn-info.text-light:hover,.btn-info.text-light:focus{
            background: #000;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="#">
           Add Somthing
            </a>
        </div>
    </nav>
    <div class="container py-3" id="page-container">
        <h3>Creating Page Content using Summernote Library</h3>
        <hr>
        <?php 
        if(isset($_SESSION['msg'])):
        ?>
        <div class="alert alert-<?php echo $_SESSION['msg']['type'] ?>">
            <div class="d-flex w-100">
                <div class="col-11"><?php echo $_SESSION['msg']['text'] ?></div>
                <div class="col-1 d-flex justify-content-end align-items-center"><button class="btn-close" onclick="$(this).closest('.alert').hide('slow')"></button></div>
            </div>
        </div>
        <?php 
            unset($_SESSION['msg']);
        endif;
        ?>
        <div class="col-12 my-2">
            <a href="./" class="btn btn-info text-light text-decoration-none"> Back to List</a>
        </div>
        <div class="content">
            <?php echo isset($_GET['page']) && is_file("./pages/{$_GET['page']}") ? file_get_contents("./pages/{$_GET['page']}") : "<center>Unknown Page Content.</center>" ?>
        </div>
    </div>
</body>
</html>