<?php
include('database.php');
if (isset($_POST["edit"])) {
    $fullname = mysqli_real_escape_string($conn, $_POST["full_name"]);
    $branch = mysqli_real_escape_string($conn, $_POST["branch"]);
    $role = mysqli_real_escape_string($conn, $_POST["role"]);
    $idNumber = mysqli_real_escape_string($conn, $_POST["id_number"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phone_number"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE users SET full_name = '$fullname', branch = '$branch', role = '$role', id_number = '$idNumber', email = '$email', phone_number = '$phoneNumber' WHERE id = '$id'";

    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "User Updated Successfully!";
        header("Location:myorganization.php");
    }else{
        die("Something went wrong");
    }
}
?>