<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>User Activity Log</title>

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
    <h1>User Activity Log</h1>
    <div>
        <button class="btn btn-primary" onclick="printTable()">Print</button>
        <a href="myorganization.php" class="btn btn-primary">Back</a>
    </div>
</header>
<?php
session_start();
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
$sqlTotal = "SELECT COUNT(*) as total FROM login_info";
$resultTotal = mysqli_query($conn, $sqlTotal);
$dataTotal = mysqli_fetch_assoc($resultTotal);
$totalRecords = $dataTotal['total'];

// Calculate total pages
$totalPages = ceil($totalRecords / $limit);

// Generate sorting links
$sortLinks = [
    'id' => '#',
    'user_id' => 'User ID',
    'full_name' => 'Full Name',
    'branch' => 'Branch',
    'role' => 'Role',
    'id_number' => 'ID Number',
    'email' => 'Email',
    'phone_number' => 'Phone Number',
    'logintime' => 'Login Time',
    'logout_time' => 'Logout Time'
];

// Construct the SQL query with sorting
$sqlSelect = "SELECT * FROM login_info ORDER BY $sortField $sortOrder LIMIT $offset, $limit";
$result = mysqli_query($conn, $sqlSelect);
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th><a href="?sort=id&order=<?php echo ($sortField == 'id' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['id']; ?></a></th>
            <th><a href="?sort=user_id&order=<?php echo ($sortField == 'user_id' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['user_id']; ?></a></th>
            <th><a href="?sort=full_name&order=<?php echo ($sortField == 'fullname' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['full_name']; ?></a></th>
            <th><a href="?sort=branch&order=<?php echo ($sortField == 'branch' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['branch']; ?></a></th>
            <th><a href="?sort=role&order=<?php echo ($sortField == 'role' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['role']; ?></a></th>
            <th><a href="?sort=id_number&order=<?php echo ($sortField == 'id_number' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['id_number']; ?></a></th>
            <th><a href="?sort=email&order=<?php echo ($sortField == 'email' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['email']; ?></a></th>
            <th><a href="?sort=phone_number&order=<?php echo ($sortField == 'phone_number' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['phone_number']; ?></a></th>
            <th><a href="?sort=logintime&order=<?php echo ($sortField == 'logintime' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['logintime']; ?></a></th>
            <th><a href="?sort=logout_time&order=<?php echo ($sortField == 'logout_time' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"><?php echo $sortLinks['logout_time']; ?></a></th>


            <th>Action</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php while($data = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['user_id']; ?></td>
                <td><?php echo $data['full_name']; ?></td>
                <td><?php echo $data['branch']; ?></td>
                <td><?php echo $data['role']; ?></td>
                <td><?php echo $data['id_number']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['phone_number']; ?></td>
                <td><?php echo $data['logintime']; ?></td>
                <td><?php echo $data['logout_time']; ?></td>

                <td>
                    <a href="login_info_delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
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