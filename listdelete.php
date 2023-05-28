<?php
if (isset($_GET['id'])) {
include("database.php");
$id = $_GET['id'];
$sql = "DELETE FROM visitlist WHERE id='$id'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["delete"] = "Visit Deleted Successfully!";
    header("Location:list.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Visit does not exist";
}
?>