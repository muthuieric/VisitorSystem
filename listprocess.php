<?php
include('database.php');
if (isset($_POST["create"])) {
    $visitor = mysqli_real_escape_string($conn, $_POST["visitor"]);
    $host = mysqli_real_escape_string($conn, $_POST["host"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $purpose = mysqli_real_escape_string($conn, $_POST["purpose"]);
    $queuestatus = mysqli_real_escape_string($conn, $_POST["queuestatus"]);
    $notes = mysqli_real_escape_string($conn, $_POST["notes"]);
    $sqlInsert = "INSERT INTO visitlist(visitor , host , type , purpose , queuestatus, notes) VALUES ('$visitor','$host','$type', '$purpose', '$queuestatus', '$notes' )";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "Visit Added Successfully!";
        header("Location:list.php");
    }else{
        die("Something went wrong");
    }
}
if (isset($_POST["edit"])) {
    $visitor = mysqli_real_escape_string($conn, $_POST["visitor"]);
    $host = mysqli_real_escape_string($conn, $_POST["host"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $purpose = mysqli_real_escape_string($conn, $_POST["purpose"]);
    $queuestatus = mysqli_real_escape_string($conn, $_POST["queuestatus"]);
    $checkout = mysqli_real_escape_string($conn, $_POST["checkout"]);
    $notes = mysqli_real_escape_string($conn, $_POST["notes"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE visitlist SET visitor = '$visitor', host = '$host', type = '$type', purpose = '$purpose', queuestatus = '$queuestatus',  checkout = '$checkout', notes = '$notes' WHERE id='$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Visit Updated Successfully!";
        header("Location:list.php");
    }else{
        die("Something went wrong");
    }
}
?>