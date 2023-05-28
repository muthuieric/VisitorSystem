<?php
if (isset($_GET['id'])) {
    include("database.php");

    $id = $_GET['id'];
    
    // Retrieve the user's role based on their ID
    $sql = "SELECT role FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
    if ($user["role"] === "Administrator") {
        echo "Error: Cannot delete the administrator account.";
    } else {
        // Proceed with the deletion process
        $sql = "DELETE FROM users WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            session_start();
            $_SESSION["delete"] = "User Deleted Successfully!";
            header("Location: myorganization.php");
            exit();
        } else {
            die("Something went wrong");
        }
    }
} else {
    echo "User does not exist";
}
?>
