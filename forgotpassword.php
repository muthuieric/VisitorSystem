<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: dashboard.php");
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Forgot Password</h1>

        <?php
       if (isset($_POST["reset_password"])) {
        $email = $_POST["email"];
    
        // Validate the email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-danger'>Invalid email address</div>";
        } else {
            // Generate a unique token
            $token = uniqid();
            // Add additional randomization techniques if desired
            // $token = uniqid(rand(), true); // Example with additional randomization
    
            // Store the token in the database or associate it with the user's email
    
            // Send the password reset instructions to the user's email
            // ...
    
            // Check if the password reset was successful
            if ($passwordResetSuccessful) {
                echo "<div class='alert alert-success'>Password reset instructions sent to your email</div>";
            } else {
                echo "<div class='alert alert-danger'>Failed to reset password. Please try again later.</div>";
            }
        }
    }
    
        
        ?>

        <form action="forgot_password.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Reset Password" name="reset_password" class="btn btn-primary">
            </div>
        </form>

        <div>
            <p>Remember your password? <a href="login.php">Login Here</a></p>
            <p>Not registered yet? <a href="registration.php">Register Here</a></p>
        </div>
    </div>
</body>
</html>
