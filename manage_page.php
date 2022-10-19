<?php include('config.php');  ?>
<?php session_start(); ?>
<?php
if (isset($_POST['update'])) {
    $upd_id = mysqli_real_escape_string($conn, $_GET['id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    if (empty($_FILES['file']['name'])) {
        $file = $_POST['old_image'];
    } else {
        $file = mysqli_real_escape_string($conn, $_FILES['file']['name']);
        $file_size =  mysqli_real_escape_string($conn, $_FILES['file']['size']);
        $file_tmp = mysqli_real_escape_string($conn, $_FILES['file']['tmp_name']);
        $file_type = mysqli_real_escape_string($conn, $_FILES['file']['type']);
        $image_upload = mysqli_real_escape_string($conn, move_uploaded_file($file_tmp, "upload/" . $file));
    }
    $sqli = "UPDATE data_add SET fname = '$fname', content = '$content',file = '$file' WHERE id= '$upd_id'";
    // echo $sqli;die;
    $res = mysqli_query($conn, $sqli);
    if ($res) {
        header('Location:index.php');
    }
}
if (isset($_POST['save'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $file = mysqli_real_escape_string($conn, $_FILES['file']['name']);
    $file_size =  mysqli_real_escape_string($conn, $_FILES['file']['size']);
    $file_tmp = mysqli_real_escape_string($conn, $_FILES['file']['tmp_name']);
    $file_type = mysqli_real_escape_string($conn, $_FILES['file']['type']);
    mysqli_real_escape_string($conn, move_uploaded_file($file_tmp, "upload/" . $file));
    $sql = "INSERT INTO data_add(fname,content, file) VALUES ('$fname','$content', '$file')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location:index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RMS</title>
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
            /* font-family: Apple Chancery, cursive; */
        }

        input.form-control.border-0 {
            transition: border .3s linear
        }

        input.form-control.border-0:focus {
            box-shadow: unset !important;
            border-color: var(--bs-info) !important
        }

        .note-editor.note-frame .note-editing-area .note-editable,
        .note-editor.note-airframe .note-editing-area .note-editable {
            background: var(--bs-white);
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="#">
                RMS
            </a>
        </div>
    </nav>
    <div class="container py-3" id="page-container">
        <?php
        if (isset($_SESSION['msg'])) :
        ?>
            <div class="alert alert-<?php
                                    echo $_SESSION['msg']['type']
                                    ?>">
                <div class="d-flex w-100">
                    <div class="col-11"><?php
                                        echo $_SESSION['msg']['text']
                                        ?></div>
                    <div class="col-1"><button class="btn-close" onclick="$(this).closest('.alert').hide('slow')"></button></div>
                </div>
            </div>
        <?php
            unset($_SESSION['msg']);
        endif;
        ?>
        <div class="card">
            <div class="card-header">
                Manage Page Content
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['id'])) {
                    $upd_id = $_GET['id'];
                    $sql2 = "SELECT *FROM data_add WHERE id = '{$upd_id}'";
                    $result2 = mysqli_query($conn, $sql2);
                    $list = mysqli_fetch_assoc($result2);
                }
                ?>
                <form action="" id="content-form" method="POST" enctype="multipart/form-data">
                    <div class="form-group col-6">
                        <label for="fname" class="control-label">File Name
                        </label>
                        <input type="text" name=" fname" id="filename" autofocus autocomplete="off" class="form-control form-control-sm border-0 border-bottom rounded-0" value="<?php if (isset($_GET['id'])) {
                                                                                                                                                                                        echo $list['fname'];
                                                                                                                                                                                    } ?>" required>

                    </div>
                    <div class="form-group col-12">
                        <label for="filecontent" class="control-label">Content</label>
                        <textarea id="filecontent" name="content" class="summernote" required><?php if (isset($_GET['id'])) {
                                                                                                    echo $list['content'];
                                                                                                } ?></textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="control-label">Document Name
                        </label>
                        <input type="file" name="file" autofocus autocomplete="off" class="form-control form-control-sm border-0 border-bottom rounded-0" value="<?php if (isset($_GET['id'])) {
                                                                                                                                                                        echo $list['file'];
                                                                                                                                                                    } ?>" <?php
                                                                                                                                                                            ?>>
                        <input type="hidden" name="old_image" value="<?php if (isset($_GET['id'])) {
                                                                            echo $list['file'];
                                                                        } ?>">
                    </div>
                    <div class="card-footer">
                        <?php
                        if (isset($_GET['id'])) {
                            echo '<button class="btn btn-sm rounded-0 btn-primary" name="update" type="submit">Update</button>';
                        } else {
                            echo '<button class="btn btn-sm rounded-0 btn-primary" name="save" type="submit">Save</button>';
                        }
                        ?>
                        <a class="btn btn-sm rounded-0 btn-light" href="./">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
    <script>
        $('.summernote').summernote({
            placeholder: 'Create you content here.',
            tabsize: 5,
            height: '25vh',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // function submitData() {
        //     let filename = $('#filename').val();
        //     let filecontent = $('#filecontent').val();
        //     console.log(filecontent)
        //     jQuery.ajax({
        //         method: 'post',
        //         url: 'save_page.php',
        //         data: {
        //             filename: filename,
        //             filecontent: filecontent
        //         },
        //         success: function(data) {
        //             console.log('res', data)
        //         }
        //     })
        // }
    </script>
</body>

</html>