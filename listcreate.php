<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script> 
    <title>Add Visit</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Add Visit</h1>
            <div>
            <a href="list.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="listprocess.php" method="post">
        <?php
include('database.php');

// Select Visitors
$sqlSelectVisitors = "SELECT name FROM visitors";
$resultVisitors = mysqli_query($conn, $sqlSelectVisitors);
?>

<div class="form-element my-4">
    <input type="text" class="form-control" name="visitor" id="visitor-select" placeholder="Select Visitor" autocomplete="off" required>
    <ul id="visitor-list" class="list-group" style="display: none;">
        <?php
        while ($rowVisitor = mysqli_fetch_assoc($resultVisitors)) {
            echo '<li class="list-group-item">' . $rowVisitor['name'] . '</li>';
        }
        ?>
    </ul>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?>
            <?php
        include('database.php');
        $sqlSelect = "SELECT name FROM employee";
        $result = mysqli_query($conn, $sqlSelect);
    ?>

        <div class="form-element my-4">
            <input type="text" class="form-control" name="host" id="employee-select" placeholder="Select Host" autocomplete="off" required>
            <ul id="employee-list" class="list-group" style="display: none;">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li class="list-group-item">' . $row['name'] . '</li>';
                }
                ?>
            </ul>
        </div>
    <?php
    // Close the database connection
    mysqli_close($conn);
    ?>
            <div class="form-elemnt my-4">
                <select name="type" id="" class="form-control">
                    <option value="" selected disabled hidden>Select Visitor Type:</option>
                    <option value="Visitor">Visitor</option>
                    <option value="Contractor">Contractor</option>
                    <option value="Delivery">Delivery</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <select name="purpose" id="" class="form-control">
                    <option value="" selected disabled hidden>Select Purpose:</option>
                    <option value="Official">Official</option>
                    <option value="Personal">Personal</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <select name="queuestatus" id="" class="form-control">
                    <option value="" selected disabled hidden>Queue Status:</option>
                    <option value="Check In">Check In</option>
                    <option value="Check Out">Check Out</option>
                </select>
            </div>
            <div class="form-element my-4">
                <textarea name="notes" id="" class="form-control" placeholder="Enter Notes:"></textarea>
            </div>
            <div class="form-element my-4">
                <input type="submit" name="create" value="Add " class="btn btn-primary">
            </div>
        </form>
          
    </div>



</body>
</html>