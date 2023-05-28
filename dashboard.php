<?php
$currentPage = 'dashboard'
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



<?php
include('database.php');

// Query to fetch visitor type data
$typeSql = "SELECT type, COUNT(*) AS count FROM visitlist GROUP BY type";
$typeResult = mysqli_query($conn, $typeSql);

// Fetch data for type chart
$typeLabels = [];
$typeData = [];

while ($typeRow = mysqli_fetch_assoc($typeResult)) {
  $typeLabels[] = $typeRow['type'];
  $typeData[] = $typeRow['count'];
}

// Query to fetch visitor purpose data
$purposeSql = "SELECT purpose, COUNT(*) AS count FROM visitlist GROUP BY purpose";
$purposeResult = mysqli_query($conn, $purposeSql);

// Fetch data for purpose chart
$purposeLabels = [];
$purposeData = [];

while ($purposeRow = mysqli_fetch_assoc($purposeResult)) {
  $purposeLabels[] = $purposeRow['purpose'];
  $purposeData[] = $purposeRow['count'];
}

mysqli_close($conn);
?>

<!--No of Users dashboard-->
<?php
include('database.php');

// Query to fetch the number of visits
$sql = "SELECT COUNT(*) AS total_users FROM login_info";
$result = $conn->query($sql);

$totalUsers = $result->fetch_assoc()['total_users'];

// Close the connection
$conn->close();
?>


<!--visitors dashboard-->
<?php
include('database.php');

// Query to fetch the number of visits
$sql = "SELECT COUNT(*) AS total_visits FROM visitlist";
$result = $conn->query($sql);

$totalVisits = $result->fetch_assoc()['total_visits'];

// Close the connection
$conn->close();
?>

<!--column chart-->
<?php
include('database.php');

// Query to fetch the number of visitors for each host
$sql = "SELECT host, COUNT(visitor) AS visitor_count FROM visitlist GROUP BY host";
$result = $conn->query($sql);

$hosts = [];
$visitorCounts = [];

while ($row = $result->fetch_assoc()) {
    $hosts[] = $row['host'];
    $visitorCounts[] = $row['visitor_count'];
}

// Close the connection
$conn->close();
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
    <title>Dashboard</title>



  <style>
    .chart-container {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      background-color: white;
      width: 400px;
      height: 300px;
      margin-bottom: 20px;
      display: inline-block;
    }
  </style>

  <!--No of Users dashboard-->
  <style>
        .users-container {
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            width: 400px;
            height: 145px;
            margin-top:25px;
            margin-bottom: 10px;
            display: inline-block;
          
        }

        .user-heading {
            font-size: 20px;
        }

        .user-count {
            font-size: 60px;
            color: blue;
            text-align: center;
        }
    </style>


<!--visitors dashboard-->
  <style>
        .dashboard-container {
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            width: 400px;
            height: 145px;
            display: inline-block;
          
        }

        .visits-heading {
            font-size: 20px;
        }

        .visits-count {
            font-size: 60px;
            color: blue;
            text-align: center;
        }
    </style>

<!--column chart-->
<style>
    #host-visitor-chart-container {
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
        padding: 20px;
        width: 1250px;
        height: 500px;
        margin-top: 0px;

    }
 </style>



  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
      // Draw chart for visitors by type
      var typeData = google.visualization.arrayToDataTable([
        ['Visitor Type', 'Count'],
        <?php
        for ($i = 0; $i < count($typeLabels); $i++) {
          echo "['" . $typeLabels[$i] . "', " . $typeData[$i] . "],";
        }
        ?>
      ]);

      var typeOptions = {
        title: 'Visitors by Type',
      };

      var typeChart = new google.visualization.PieChart(document.getElementById('type-chart'));
      typeChart.draw(typeData, typeOptions);

      // Draw chart for visitors by purpose
      var purposeData = google.visualization.arrayToDataTable([
        ['Visitor Purpose', 'Count'],
        <?php
        for ($i = 0; $i < count($purposeLabels); $i++) {
          echo "['" . $purposeLabels[$i] . "', " . $purposeData[$i] . "],";
        }
        ?>
      ]);

      var purposeOptions = {
        title: 'Visitors by Purpose',
      };

      var purposeChart = new google.visualization.PieChart(document.getElementById('purpose-chart'));
      purposeChart.draw(purposeData, purposeOptions);
    }
  </script>

<!--column chart-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Host');
            data.addColumn('number', 'Visitor Count');
            data.addRows([
                <?php
                for ($i = 0; $i < count($hosts); $i++) {
                    echo "['" . $hosts[$i] . "', " . $visitorCounts[$i] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Host Visitor Chart',
                titleTextStyle: {
                    fontSize: 20,
                    marginTop: -20 // Adjust the margin-top value to move the title up or down
                },
                chartArea: {width: '80%'},
                hAxis: {
                    title: 'Host'
                },
                vAxis: {
                    title: 'Visitor Count',
                    ticks: [1, 2, 3] // Customize the y-axis labels
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('host-visitor-chart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>



<div class="text-center">
            <h1>Dashboard</h1>
</div>
<div class="d-flex justify-content-between my-4">
<div>
    <div class="users-container">
        <h2 class="user-heading text-center">No. of Users Logged In</h2>
        <p class="user-count text-center"><?php echo $totalUsers; ?></p>
    </div>
    <div class="dashboard-container">
        <h2 class="visits-heading text-center">No. of Visits</h2>
        <p class="visits-count text-center"><?php echo $totalVisits; ?></p>
    </div>
      </div>
  <div class="d-flex justify-content-between my-4">    
    <div class="chart-container" > 
        <div id="type-chart" style="width: 100%; height: 100%;"></div>
    </div>
    <div class="chart-container">
        <div id="purpose-chart" style="width: 100%; height: 100%;"></div>
    </div>
</div>
</div>

<div id="host-visitor-chart-container">
    <div id="host-visitor-chart" style="width: 100%; height: 100%;"></div>
</div>


  </div>
</body>
</html>