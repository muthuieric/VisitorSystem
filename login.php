<?php
session_start();

if (isset($_SESSION["user"])) {
    if ($_SESSION["role"] === "Guard" || $_SESSION["role"] === "Secretary") {
        header("Location: visitor.php");
    } else {
        header("Location: dashboard.php");
    }
    exit();
}


require_once "database.php";


if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"]; // Added role field

    $sql = "SELECT * FROM users WHERE email = '$email' AND role = '$role'"; // Include role in the query
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (password_verify($password, $user["password"])) {
            // Store user login information in the login_info table
            $userID = $user["id"]; // Assuming the user ID column is named "id" in the users table
            $fullName = $user["full_name"];
            $branch = $user["branch"];
            $idNumber = $user["id_number"];
            $email = $user["email"];
            $phoneNumber = $user["phone_number"];

            // Insert the login record
            $insertSql = "INSERT INTO login_info (user_id,  full_name, branch, role, id_number, email, phone_number) VALUES ('$userID',  '$fullName', '$branch', '$role', '$idNumber', '$email', '$phoneNumber')";
            mysqli_query($conn, $insertSql);

            // Set the user session variables
            $_SESSION["user"] = "yes";
            $_SESSION["role"] = $role; // Store the selected role in session
            $_SESSION["userID"] = $userID; // Store the user ID in session
            if ($role === "Guard" || $role === "Secretary") {
                header("Location: visitor.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email or role does not exist</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" class="form-control">
                    <option value="Administrator">Administrator</option>
                    <option value="Guard">Guard</option>
                    <option value="Secretary">Secretary</option>
                </select>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>

        <div>
            <p>Not registered yet? <a href="registration.php">Register Here</a></p>
            <p><a href="forgotpassword.php">Forgot Password?</a></p> <!-- Add Forgot Password link -->
        </div>
    </div>
</body>
</html>

