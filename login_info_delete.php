<?php
if (isset($_GET['id'])) {
include("database.php");
$id = $_GET['id'];
$sql = "DELETE FROM login_info WHERE id='$id'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["delete"] = "User Activity Deleted Successfully!";
    header("Location:login_info.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Activity does not exist";
}
?>