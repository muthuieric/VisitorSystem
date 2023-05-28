<?php
$currentPage = 'visitors'
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
    <title>Visitors List</title>

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
        <a href="visitorcreate.php" class="btn btn-primary">Add New Visitor</a>
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
$sqlTotal = "SELECT COUNT(*) as total FROM visitors";
$resultTotal = mysqli_query($conn, $sqlTotal);
$dataTotal = mysqli_fetch_assoc($resultTotal);
$totalRecords = $dataTotal['total'];

// Calculate total pages
$totalPages = ceil($totalRecords / $limit);

// Generate sorting links
$sortLinks = [
    'id' => '#',
    'name' => 'Name',
    'id_number' => 'ID Number',
    'phone' => 'Phone Number',
    'email' => 'Email',
    'gender' => 'Gender',
    'redflag' => 'Red Flag'
];

// Construct the SQL query with sorting
$sqlSelect = "SELECT * FROM visitors ORDER BY $sortField $sortOrder LIMIT $offset, $limit";
$result = mysqli_query($conn, $sqlSelect);
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><a href="?sort=id&order=<?php echo ($sortField == 'id' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['id']; ?></a></th>
            <th><a href="?sort=name&order=<?php echo ($sortField == 'name' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['name']; ?></a></th>
            <th><a href="?sort=id_number&order=<?php echo ($sortField == 'id_number' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['id_number']; ?></a></th>
            <th><a href="?sort=phone&order=<?php echo ($sortField == 'phone' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['phone']; ?></a></th>
            <th><a href="?sort=email&order=<?php echo ($sortField == 'email' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['email']; ?></a></th>
            <th><a href="?sort=gender&order=<?php echo ($sortField == 'gender' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['gender']; ?></a></th>
            <th><a href="?sort=redflag&order=<?php echo ($sortField == 'redflag' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['redflag']; ?></a></th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php while($data = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['id_number']; ?></td>
                <td><?php echo $data['phone']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['gender']; ?></td>
                <td><?php echo $data['redflag']; ?></td>
                <td>
                    <a href="visitoredit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="visitordelete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
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


</html>
        
