<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: dashboard.php");
    exit();
}

require_once "database.php";

if (isset($_POST["submit"])) {
    $fullName = $_POST["full_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    $role = $_POST["role"]; // Added role field
    $idNumber = $_POST["id_number"]; // Added id_number field
    $branch = $_POST["branch"]; // Added branch field
    $phoneNumber = $_POST["phone_number"]; // Added phone_number field

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat) || empty($idNumber) || empty($branch) || empty($phoneNumber)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8 || strlen($password) > 24) {
        array_push($errors, "Password must be between 8 and 24 characters long");
    }
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
        array_push($errors, "Password must include at least one uppercase letter, one lowercase letter, one number, and one special character");
    }
    if (strlen($idNumber) !== 8) {
        array_push($errors, "ID number must be exactly 8 digits long");
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        array_push($errors, "Email already exists!");
    }

    // Check if the selected role is "Guard" or "Secretary"
    if ($role === "Administrator") {
        array_push($errors, "Registration as an administrator is not allowed");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO users (full_name, email, password, role, id_number, branch, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "sssssss", $fullName, $email, $passwordHash, $role, $idNumber, $branch, $phoneNumber);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>Sign up</h1>
   <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="full_name" placeholder="Full Name:" autocomplete="off">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:" >
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="id_number" placeholder="Id Number:" pattern="[0-9]{8}" autocomplete="off">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="branch" placeholder="Branch:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phone_number" placeholder="Phone Number:" autocomplete="off" pattern="^\d{10}$"  >
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" class="form-control">
                    <option value="Guard">Guard</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Administrator">Administrator</option> 
                </select>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>

        <div>
            <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
        </div>
    </div>
</body>
</html>
