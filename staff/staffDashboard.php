

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
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
            text-shadow: 2px 2px 0 #000000, /* bottom shadow color */
                        -2px -2px 0 #7e7e7e; /* top shadow color */
        }
        .background {
        position: absolute; /* Use absolute positioning */
        background-image: url('../img/cpc.png');
        background-repeat: no-repeat;
        background-size: cover; /* Ensure the background image covers the entire area */
        height: 100%;
        width: 100%;
        top: 0%;
        z-index: -1;
        }
    </style>

    </style>
<body>
    <div class="sidebar">
    <center><a href="staffDashboard.php"><img src="../img/phoenix.jpg" alt="" style="width: 180px; height: 80px; border-radius: 5px;"></a></center>
        <h2>CPC CHECK</h2>
        <h5>Staff Panel</h5>
        <ul>
            <li><a href="staffInventory.php" class="text-decoration-none">Inventory</a></li>
            <li><a href="staffRequest.php" class="text-decoration-none">Student Request</a></li>
            <li><a href="staffHistory.php" class="text-decoration-none">Student History</a></li>
            <li><a href="staffRecord.php" class="text-decoration-none">Student Record</a></li>
            <li><a href="staffMonitoring.php" class="text-decoration-none">Monitored Student</a></li>
        </ul>
    </div>

    <div class="background"></div>
    
    <button class="btn btn-secondary" style="float: right; margin-right: 20px;" onclick="window.location.href='logout.php'">Log out</button>
    <div class="content">
        <h1>Welcome to the dashboard!</h1>
    </div>


    <div style="margin-left: 15%;">
    <p class="double-color">Your Partner in Health <br>and Wellness</p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>