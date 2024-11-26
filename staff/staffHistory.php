


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
        .container{
            margin-left: 17%;
        }
    </style>
<body>
    <div class="sidebar">
    <center><a href="staffDashboard.php"><img src="../img/phoenix.jpg" alt="" style="width: 180px; height: 80px; border-radius: 5px;"></a></center>
        <h3>CPC CHECK</h3>
        <h5>Staff Panel</h5>
        <br>
        <ul>
            <li><a href="staffInventory.php" class="text-decoration-none">Inventory</a></li>
            <li><a href="staffRequest.php" class="text-decoration-none">Student Request</a></li>
            <li><a href="staffHistory.php" class="text-decoration-none">Student History</a></li>
            <li><a href="staffRecord.php" class="text-decoration-none">Student Record</a></li>
            <li><a href="staffMonitoring.php" class="text-decoration-none">Monitored Student</a></li>
        </ul>
    </div>
    <br>
    <br>
    <br><br><br>

    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Medicine</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Reason</th>
                    <th>Expiration Date</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>