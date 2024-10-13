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
        .container{
            margin-left: 17%;
        }

        input[type="search"] {
            margin-left: 20%;
            width: 500px;
            padding: 10px;
            font-size: 16px;
            border: 2px solid black;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        /* Change border color and add shadow on focus */
        input[type="search"]:focus {
            border-color: #007BFF;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        /* Styling the placeholder text */
        input[type="search"]::placeholder {
            color: #888;
            font-style: italic;
        }

        /* Customizing the clear button in WebKit browsers */
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            height: 16px;
            width: 16px;
            background-image: url('../img/cancel.png'); /* Customize with your own image */
            background-size: contain;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
    <center><a href="adDashboard.php"><img src="../img/phoenix.jpg" alt="" style="width: 180px; height: 80px; border-radius: 5px;"></a></center>
        <h3>CPC CHECK</h3>
        <h5>Nurse Panel</h5>
        <br>
        <ul>
            <li><a href="adInventory.php" class="text-decoration-none">Inventory</a></li>
            <li><a href="adRequest.php" class="text-decoration-none">Student Request</a></li>
            <li><a href="adHistory.php" class="text-decoration-none">Student History</a></li>
            <li><a href="adRecord.php" class="text-decoration-none">Student Record</a></li>
            <li><a href="adMonitoring.php" class="text-decoration-none">Monitored Student</a></li>
        </ul>
    </div>
    <br>
    <br>
    <br><br><br>
    <button class="btn btn-success" style="float: right; margin-right: 10%; height: 50px">+ add medicine</button>
    
        <input type="search" name="search" id="" placeholder="search">
        <label for="" style="font-size: 25px; margin-left: 5%;">Course: </label>
        <select name="course" id="" style="height: 40px; background-color: grey; border-radius: 5px;">
            <option value="BSIT">BSIT</option>
            <option value="BSHM">BSHM</option>
            <option value="BEED">BEED</option>
            <option value="BSED">BSED</option>
        </select>

    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
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
                </tr>
            </tbody>
        </table>