<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Add Employee</title>
</head>
<body>
    
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Add Employee</h1>
            <div>
            <a href="employee.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="employeeprocess.php" method="post">
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="name" placeholder="Enter Name:"  autocomplete="off" required>
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="jobtitle" placeholder="Enter Job Title:" autocomplete="off" required>
            </div>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="id_number" placeholder="Enter Id Number:" pattern="[0-9]{8}" autocomplete="off">
            </div>  
            <div class="form-elemnt my-4">
            <input type="tel" id="phone" name="phone" class="form-control" autocomplete="off" pattern="^\d{10}$" required placeholder="Enter Phone Number:" />        
            </div>
            <div class="form-element my-4">
                <input type="email" id="" class="form-control"  autocomplete="off" name="email"placeholder="Enter Email:">
            </div>
            <div class="form-elemnt my-4">
                <select name="gender" id="" class="form-control" >
                    <option value=""selected disabled hidden>Select Gender:</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <select name="department" id="" class="form-control">
                    <option value="" selected disabled hidden>Select Department:</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Finance">Finance</option>
                    <option value="IT">IT</option>
                    <option value="Human Resourses">Human Resources</option>
                </select>
            </div>
            <div class="form-element my-4">
                <input type="submit" name="create" value="Add " class="btn btn-primary">
            </div>
        </form>
        
        
    </div>
</body>
</html>