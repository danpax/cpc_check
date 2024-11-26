


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
        <br>
        <br>
        <br>
        <br>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 10%; height: 50px">+ add medicine</button>
    <input type="search" name="search" id="" placeholder="search">

    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Medicine</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Expiration Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    <button class="btn btn-danger w-50">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        



        <!-- Modal -->
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Background Information</h4>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body">
                <label for="" class="form-label">Medicine: </label>
                <br>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Stock: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Description: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Expiration Date: </label>
                <input type="date" class="form-control">
                <br>
                <button type="button" class="btn btn-primary" style="font-size: 18px; max-width: 100px; min-width: 100px; float: right;">add</button>
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
              </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>