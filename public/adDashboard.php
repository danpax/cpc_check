<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background-color: grey;
            height: 100vh;
            width: 250px;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 15px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 20px;
        }

        .content h1 {
            color: #333;
            margin-bottom: 2 rem;
        }
        .double-color {
            margin-top: 100px;
            margin-left: 120px;
            font-weight: bold;
            font-size: 60px; /* Adjust as needed */
            color: #0a07f1; /* Primary text color */
            text-shadow: 2px 2px 0 #e06ecd, /* First shadow color */
                        -2px -2px 0 #e06ecd; /* Second shadow color */
        }

    </style>
</head>
<body>
    <div class="sidebar">
    <center><a href="adDashboard.php"><img src="../img/phoenix.jpg" alt="" style="width: 180px; height: 80px; border-radius: 5px;"></a></center>
        <h2>CPC CHECK</h2>
        <h5>Nurse Panel</h5>
        <ul>
            <li><a href="adInventory.php" class="text-decoration-none">Inventory</a></li>
            <li><a href="adRequest.php" class="text-decoration-none">Student Request</a></li>
            <li><a href="adHistory.php" class="text-decoration-none">Student History</a></li>
            <li><a href="adRecord.php" class="text-decoration-none">Student Record</a></li>
            <li><a href="adMonitoring.php" class="text-decoration-none">Monitored Student</a></li>
        </ul>
    </div>
    <button class="btn btn-secondary" style="float: right; margin-right: 20px;">Log out</button>
    <div class="content">
        <h1>Welcome to the dashboard!</h1>
    </div>


    <div style="margin-left: 15%;">
    <p class="double-color">Your Partner in Health <br>and Wellness</p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>