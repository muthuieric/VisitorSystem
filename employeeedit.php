<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Edit Employee</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Edit Employee</h1>
            <div>
            <a href="employee.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="employeeprocess.php" method="post">
            <?php 
            
            if (isset($_GET['id'])) {
                include("database.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM employee WHERE id=$id";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                ?>
                     <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="name" placeholder="Enter Name:" autocomplete="off" required value="<?php echo $row["name"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="jobtitle" placeholder="Enter Job Title:"  autocomplete="off" required value="<?php echo $row["jobtitle"]; ?>">
            </div>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="id_number" placeholder="Enter Id Number:" pattern="[0-9]{8}" autocomplete="off" value="<?php echo $row["id_number"]; ?>">
            </div>  
            <div class="form-elemnt my-4">
            <input type="tel" id="phone" name="phone" class="form-control" autocomplete="off" pattern="^\d{10}$" required placeholder="Enter Phone Number:" value="<?php echo $row["phone"]; ?>">
            </div>
            <div class="form-element my-4">
                <input type="email" id="" class="form-control" name="email" placeholder="Enter Email:" value="<?php echo $row["email"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <select name="gender" id="" class="form-control">
                    <option value="" selected disabled hidden>Select Gender:</option>
                    <option value="Male" <?php if($row["gender"]=="Male"){echo "selected";} ?>>Male</option>
                    <option value="Female" <?php if($row["gender"]=="Female"){echo "selected";} ?>>Female</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <select name="department" id="" class="form-control">
                    <option value="" selected disabled hidden>Select Department:</option>
                    <option value="Marketing" <?php if($row["department"]=="Marketing"){echo "selected";} ?>>Marketing</option>
                    <option value="Finance" <?php if($row["department"]=="Finance"){echo "selected";} ?>>Finance</option>
                    <option value="IT" <?php if($row["department"]=="IT"){echo "selected";} ?>>IT</option>
                    <option value="Human Resourses" <?php if($row["department"]=="Human Resourses"){echo "selected";} ?>>Human Resources</option>
                </select>
            </div>
            
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <div class="form-element my-4">
                <input type="submit" name="edit" value="Edit Employee" class="btn btn-primary">
            </div>
                <?php
            }else{
                echo "<h3>Employee Does Not Exist</h3>";
            }
            ?>
           
        </form>
        
        
    </div>
</body>
</html>