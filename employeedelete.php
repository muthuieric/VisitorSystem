<?php
if (isset($_GET['id'])) {
include("database.php");
$id = $_GET['id'];
$sql = "DELETE FROM employee WHERE id='$id'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["delete"] = "Employee Deleted Successfully!";
    header("Location:employee.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Employee does not exist";
}
?>