

<!DOCTYPE html>
<html lang="en">
<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
</head> -->
    <style>
        /* body {
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
        } */
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
<!-- <body>
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
    </div> -->
    <br>
    <br>
    <br><br><br>

    <?php include 'navbar.php';?>

    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 10%; height: 50px">+ add Student</button>
    
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



        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content" style="max-width: 700px; min-width: 700px;">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Background Information</h4>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body">
                <label for="" class="form-label">Name: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Phone#: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Address: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Email: </label>
                <input type="email" class="form-control">
                <label for="" class="form-label">Date: </label>
                <input type="date" class="form-control">
                <label for="" class="form-label">Age: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Gender: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Civil Status: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Course: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Year and Sec: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Vaccine Type: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Guardian #: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Student #: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Parent: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Disability: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Blood pressure: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Temperature: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Height: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Weight: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Health Condition/s: </label>
                <br>
                <input type="text" class="form-control">
                <input type="text" class="form-control">
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
              </div>

              
</html>