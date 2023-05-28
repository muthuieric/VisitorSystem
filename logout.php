<?php
session_start();

require_once "database.php";

if (isset($_SESSION["user"])) {
    // Retrieve user details from login_info table
    $userID = $_SESSION["userID"]; // Assuming the user ID is stored in $_SESSION["userID"]

    // Query to fetch user details from login_info
    $sql = "SELECT * FROM login_info WHERE user_id = '$userID'";
    $result = mysqli_query($conn, $sql);
    $userInfo = mysqli_fetch_assoc($result);

    if ($userInfo) {
        $fullName = $userInfo["full_name"];
        $branch = $userInfo["branch"];
        $role = $userInfo["role"];
        $idNumber = $userInfo["id_number"];
        $email = $userInfo["email"];
        $phoneNumber = $userInfo["phone_number"];
        $loginTime = $userInfo["logintime"]; // Assuming the column name is 'logintime'

        // Insert the logout record
        $insertSql = "INSERT INTO logout (user_id, full_name, branch, role, id_number, email, phone_number, logintime) VALUES ('$userID', '$fullName', '$branch', '$role', '$idNumber', '$email', '$phoneNumber', '$loginTime')";
        mysqli_query($conn, $insertSql);

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>User details not found in login_info table</div>";
    }
} else {
    header("Location: login.php");
    exit();
}
?>
