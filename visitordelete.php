<?php
if (isset($_GET['id'])) {
include("database.php");
$id = $_GET['id'];
$sql = "DELETE FROM visitors WHERE id='$id'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["delete"] = "Visitor Deleted Successfully!";
    header("Location:visitor.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Employee does not exist";
}
?>