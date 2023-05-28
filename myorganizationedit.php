<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Edit User</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Edit User</h1>
            <div>
            <a href="myorganization.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="myorganizationprocess.php" method="post">
            <?php 
            
            if (isset($_GET['id'])) {
                include("database.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM users WHERE id=$id";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                ?>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="full_name" placeholder="Enter Full Name:"  readonly autocomplete="off" value="<?php echo $row["full_name"]; ?>">
            </div>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="branch" placeholder="Enter Branch:" value="<?php echo $row["branch"]; ?>">
            </div>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="id_number" placeholder="Enter Id Number:" pattern="[0-9]{8}" autocomplete="off"  readonly value="<?php echo $row["id_number"]; ?>">
            </div>  
            <div class="form-group my-4">
                <input type="email" class="form-control" name="email" placeholder="Enter Email:"  readonly value="<?php echo $row["email"]; ?>">
            </div>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number:" autocomplete="off" pattern="^\d{10}$" value="<?php echo $row["phone_number"]; ?>"  >
            </div>
            <div class="form-group my-4">
                <label for="role">Role:</label>
                <select name="role" class="form-control my-4" disabled>
                    <option value="Guard" <?php if($row["role"]=="Guard"){echo "selected";} ?>>Guard</option>
                    <option value="Secretary" <?php if($row["role"]=="Secretary"){echo "selected";} ?>>Secretary</option>
                </select>
            </div>
           
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <div class="form-element my-4">
                <input type="submit" name="edit" value="Edit Details" class="btn btn-primary">
            </div>
                <?php
            }else{
                echo "<h3>Registered User Does Not Exist</h3>";
            }
            ?>   
        </form>
        
        
    </div>
</body>
</html>