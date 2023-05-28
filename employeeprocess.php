<?php
include('database.php');
if (isset($_POST["create"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $jobtitle = mysqli_real_escape_string($conn, $_POST["jobtitle"]);
    $idNumber = mysqli_real_escape_string($conn, $_POST["id_number"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $department = mysqli_real_escape_string($conn, $_POST["department"]);

    $sqlInsert = "INSERT INTO employee(name , jobtitle ,   id_number, phone , email, gender, department) VALUES ('$name','$jobtitle', '$idNumber', '$phone', '$email', '$gender', '$department')";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "Employee Added Successfully!";
        header("Location:employee.php");
    }else{
        die("Something went wrong");
    }
}
if (isset($_POST["edit"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $jobtitle = mysqli_real_escape_string($conn, $_POST["jobtitle"]);
    $idNumber = mysqli_real_escape_string($conn, $_POST["id_number"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $department = mysqli_real_escape_string($conn, $_POST["department"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE employee SET name = '$name', jobtitle = '$jobtitle',  id_number = '$idNumber', phone = '$phone', email = '$email', gender = '$gender', department = '$department' WHERE id='$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Employee Updated Successfully!";
        header("Location:employee.php");
    }else{
        die("Something went wrong");
    }
}
?>