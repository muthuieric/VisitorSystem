<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .navbar {
            background-color: #fff;
            color: #000;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .navbar .navbar-brand {
            color: #000;
        }

        .navbar .navbar-nav .nav-link {
            color: #000;
            transition: color 0.3s ease;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .navbar .navbar-nav .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <title>Visitors Management System</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Visitors Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
               
                <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'visitors') echo 'active'; ?>" href="visitor.php">Visitors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'visits') echo 'active'; ?>" href="list.php">Visit List</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-X+AKAeGvB/mPlvhXeKcP72R2nQJXvgtnox0dC0i9VoRQ+qbSdHs0RyOa2NxBRKGQ" crossorigin="anonymous"></script> 
</body>
</html>
