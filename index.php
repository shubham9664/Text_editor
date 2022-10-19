<?php include('config.php') ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./summernote/summernote-lite.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
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

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="#">
                RMS ADD
            </a>
        </div>
    </nav>
    <div class="container py-3" id="page-container">
        <div class="row">
            <div class="col-md-8">
                <h3>RMS </h3>
            </div>
            <div class="col-md-4">

                <form action="" method="post" class="d-flex">
                    <input type="search" name='searchfile' placeholder='Search From Heading' class='form-control mx-1'>
                    <button type="submit" class="btn btn-primary mr-5 px-2 " name="search_submit">Search</button>
                </form>
            </div>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) :
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
            <a href="manage_page.php" class="btn btn-info text-light text-decoration-none"> + Add RMS</a>
        </div>
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-xl-4 gx-4 gy-2">
            <?php
            $limit = 3;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $offset = ($page - 1) * $limit;
            $sql = "SELECT * FROM data_add ORDER BY id DESC Limit {$offset}, {$limit}";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            ?>

                <table class="table table-bordered">
                    <thead>
                        <th>S.No.</th>
                        <th>File Name</th>
                        <th>Content</th>
                        <th>Document Name</th>
                        <th>Action</th>

                    </thead>

                    <tbody>
                        <?php
                        if (isset($_POST['search_submit'])) {
                            $search = mysqli_real_escape_string($conn, $_POST['searchfile']);
                            $sqls = "SELECT * FROM data_add WHERE fname LIKE '%$search%'";
                            $search_result = mysqli_query($conn, $sqls);
                            $rows = mysqli_num_rows($search_result);
                            if ($rows > 0) {
                                foreach ($search_result as $search_data) {
                        ?>
                                    <tr>
                                        <td><?php echo $search_data['id'] ?></td>
                                        <td><?php echo $search_data['fname'] ?></td>
                                        <td><?php echo $search_data['content'] ?></td>
                                        <td><?php echo $search_data['file'] ?></td>

                                        <td class='delete'>
                                            <a href="manage_page.php?id=<?php echo $search_data['id']; ?>"><i class='fa fa-edit'></i></a>
                                            <a href="delete.php?id=<?php echo $search_data['id']; ?>"><i class='fa fa-trash'></i></a>
                                        </td>
                                    </tr>

                                <?php
                                }
                            } else {
                                echo "<p style='color:red;'>No Record Found</p>";
                            }
                        } else {
                            foreach ($result as  $row) {
                                ?>

                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['fname'] ?></td>
                                    <td><?php echo $row['content'] ?></td>
                                    <td><?php echo $row['file'] ?></td>

                                    <td class='delete'>
                                        <a href="manage_page.php?id=<?php echo $row['id']; ?>"><i class='fa fa-edit'></i></a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>"><i class='fa fa-trash'></i></a>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    }
                    ?>

                    </tbody>
                </table>
                <?php

                $sql1 = "SELECT *FROM data_add";
                $reslut1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($reslut1) > 0) {
                    $total_records = mysqli_num_rows($reslut1);
                    $total_page = ceil($total_records / $limit);
                    echo "<ul class='pagination'>";
                    if ($page > 1) {
                        echo "<li><a href ='index.php?page=" . ($page - 1) . "' class='page-link'>Prev</a></li>";
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $page) {
                            $active = 'active';
                        } else {
                            $active = "";
                        }
                        echo "<li class ='$active'><a href ='index.php?page=$i' class='page-link'>$i</a></li>";
                    }
                    if ($total_page > $page) {
                        echo "<li><a href ='index.php?page=" . ($page + 1) . "' class='page-link'>Next</a></li>";
                    }
                    echo "</ul>";
                }
                ?>

        </div>
    </div>
    <script>
        $(function() {
            $('.delete_data').click(function(e) {
                e.preventDefault()
                var _conf = confirm("Are you sure to delete this page content?")
                if (_conf === true) {
                    location.href = $(this).attr('href')
                }
            })
        })
    </script>
</body>

</html>

