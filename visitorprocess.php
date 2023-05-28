<?php
include('database.php');
if (isset($_POST["create"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $idNumber = mysqli_real_escape_string($conn, $_POST["id_number"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $scanned_id = mysqli_real_escape_string($conn, $_POST["scanned_id"]);
    $redflag = mysqli_real_escape_string($conn, $_POST["redflag"]);

    $sqlInsert = "INSERT INTO visitors(name , id_number, phone , email , gender, scanned_id, redflag) VALUES ('$name', '$idNumber','$phone', '$email', '$gender', '$scanned_id', '$redflag')";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "Visitor Added Successfully!";
        header("Location:visitor.php");
    }else{
        die("Something went wrong");
    }
}
if (isset($_POST["edit"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $idNumber = mysqli_real_escape_string($conn, $_POST["id_number"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $scanned_id = mysqli_real_escape_string($conn, $_POST["scanned_id"]);
    $redflag = mysqli_real_escape_string($conn, $_POST["redflag"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE visitors SET name = '$name', id_number = '$idNumber',  phone = '$phone', email = '$email', gender = '$gender', scanned_id = '$scanned_id', redflag = '$redflag'  WHERE id='$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Visitor Updated Successfully!";
        header("Location:visitor.php");
    }else{
        die("Something went wrong");
    }
}
?>