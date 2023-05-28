<?php
$currentPage = 'visits'
?>

<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$allowedRoles = ["Guard", "Secretary", "Administrator"]; // Array of allowed roles

if (!in_array($_SESSION["role"], $allowedRoles)) {
    echo "Access denied. You do not have permission to view this page.";
    exit();
}

if ($_SESSION["role"] === "Guard" || $_SESSION["role"] === "Secretary") {
    include "guard_menu_items.php";
} else {
    include "other_menu_items.php";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Visitor List</title>

    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup",function(){
                var value =$(this).val().toLowerCase();
                $("#myTable tr").filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

<style>
.table thead th a {
    text-decoration: none;
    color: black;
}
</style>


<style>
    .pagination {
        justify-content: right;
    }
    .pagination li a {
        text-decoration: none;
        color: black; /* Update the color to black */
    }
</style>



</head>
<body>

<header class="d-flex justify-content-between my-4">
    <h1>Visitors List</h1>
    <div>
        <a href="listcreate.php" class="btn btn-primary">Add New Visit</a>
            <button class="btn btn-primary" onclick="printTable()">Print</button>
    </div>
</header>
<?php
if (isset($_SESSION["create"])) {
?>
<div class="alert alert-success">
    <?php 
    echo $_SESSION["create"];
    ?>
</div>
<?php
unset($_SESSION["create"]);
}
?>
    <?php
if (isset($_SESSION["update"])) {
?>
<div class="alert alert-success">
    <?php 
    echo $_SESSION["update"];
    ?>
</div>
<?php
unset($_SESSION["update"]);
}
?>
<?php
if (isset($_SESSION["delete"])) {
?>
<div class="alert alert-success">
    <?php 
    echo $_SESSION["delete"];
    ?>
</div>
<?php
unset($_SESSION["delete"]);
}
?>


<div class="form-group">
    <input type="text" name= "search" id="myInput" class="form-control" placeholder="Search...">
</div>

<?php
include('database.php');

// Pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Offset for SQL query

// Sorting variables
$sortField = isset($_GET['sort']) ? $_GET['sort'] : 'id'; // Default sorting field
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc'; // Default sorting order

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM visitlist";
$resultTotal = mysqli_query($conn, $sqlTotal);
$dataTotal = mysqli_fetch_assoc($resultTotal);
$totalRecords = $dataTotal['total'];

// Calculate total pages
$totalPages = ceil($totalRecords / $limit);

// Generate sorting links
$sortLinks = [
    'id' => '1D',
    'visitor' => 'Visitor',
    'host' => 'Host',
    'type' => 'Visit Type',
    'purpose' => 'Purpose',
    'queuestatus' => 'Queue Status',
    'checkin' => 'Check In Time',
    'checkout' => 'Check Out Time'
];

// Construct the SQL query with sorting
$sqlSelect = "SELECT * FROM visitlist ORDER BY $sortField $sortOrder LIMIT $offset, $limit";
$result = mysqli_query($conn, $sqlSelect);
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th><a href="?sort=id&order=<?php echo ($sortField == 'id' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['id']; ?></a></th>
            <th><a href="?sort=visitor&order=<?php echo ($sortField == 'visitor' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['visitor']; ?></a></th>
            <th><a href="?sort=host&order=<?php echo ($sortField == 'host' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['host']; ?></a></th>
            <th><a href="?sort=type&order=<?php echo ($sortField == 'type' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['type']; ?></a></th>
            <th><a href="?sort=purpose&order=<?php echo ($sortField == 'purpose' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['purpose']; ?></a></th>
            <th><a href="?sort=queuestatus&order=<?php echo ($sortField == 'queuestatus' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['queuestatus']; ?></a></th>
            <th><a href="?sort=checkin&order=<?php echo ($sortField == 'checkin' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['checkin']; ?></a></th>
            <th><a href="?sort=checkout&order=<?php echo ($sortField == 'checkout' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['checkout']; ?></a></th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php while($data = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['visitor']; ?></td>
                <td><?php echo $data['host']; ?></td>
                <td><?php echo $data['type']; ?></td>
                <td><?php echo $data['purpose']; ?></td>
                <td><?php echo $data['queuestatus']; ?></td>
                <td><?php echo $data['checkin']; ?></td>
                <td><?php echo $data['checkout']; ?></td>
                <td>
                    <a href="listview.php?id=<?php echo $data['id']; ?>" class="btn btn-info">Read More</a>
                    <a href="listedit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="listdelete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Pagination links -->
<ul class="pagination">
    <?php if ($page > 1): ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?php echo ($page - 1); ?>&sort=<?php echo $sortField; ?>&order=<?php echo $sortOrder; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <span class="page-link" aria-hidden="true">&laquo;</span>
        </li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($page == $i): ?>
            <li class="page-item active"><span class="page-link"><?php echo $i; ?></span></li>
        <?php else: ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>&sort=<?php echo $sortField; ?>&order=<?php echo $sortOrder; ?>"><?php echo $i; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?php echo ($page + 1); ?>&sort=<?php echo $sortField; ?>&order=<?php echo $sortOrder; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <span class="page-link" aria-hidden="true">&raquo;</span>
        </li>
    <?php endif; ?>
</ul>

<script>
function printTable() {
  window.print();
}
</script>


</body>
</html>

    