<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Visit Details</title>
    <style>
        .visit-details{
            background-color:#f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Visit Details</h1>
            <div>
            <a href="list.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <div class="visit-details p-5 my-4">
            <?php
            include("database.php");
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT * FROM visitlist WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                 ?>
                 <h3>Visitor:</h3>
                 <p><?php echo $row["visitor"]; ?></p>
                 <h3>Host:</h3>
                 <p><?php echo $row["host"]; ?></p>
                 <h3>Type:</h3>
                 <p><?php echo $row["type"]; ?></p>
                 <h3>Purpose:</h3>
                 <p><?php echo $row["purpose"]; ?></p>
                 <h3>Queue Status:</h3>
                 <p><?php echo $row["queuestatus"]; ?></p>
                 <h3>Check In:</h3>
                 <p><?php echo $row["checkin"]; ?></p>
                 <h3>Check Out:</h3>
                 <p><?php echo $row["checkout"]; ?></p>
                 <h3>Notes:</h3>
                 <p><?php echo $row["notes"]; ?></p>
                
                 <?php
                }
            }
            else{
                echo "<h3>No visit found</h3>";
            }
            ?>
            
        </div>
    </div>
</body>
</html>