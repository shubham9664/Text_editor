<?php include 'config.php' ?>
<?php
$del_id = $_GET['id'];
$sql = "DELETE FROM data_add WHERE id = '$del_id'";
$result = mysqli_query($conn, $sql);
if($result){
    header("Location:index.php");
}
?>