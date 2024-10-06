<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Medicine</title>
</head>
<style>
    body{
    background-image: linear-gradient(to right, skyblue, blue); /* Gradient background */
    }

</style>
<body>
    <div class="navbar bg-dark">
        <div><a href="home.html"><img src="../img/phoenix.jpg" style="width: 70px; height: 70px; border-radius: 50px;"></a></div>
        <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="medicine.html">Medicine</a></li>
        <li><a href="clinic.html">Clinic Staff</a></li>
        <li><a href="request.html">My Request</a></li>
        <a href="notification.html"><i class='fas fa-bell' style='font-size:24px;'></i></a>
        <li><a href="login.html">Log out</a></li>
        </ul>
    </div>
    <br>
    <br>
    <input type="search" placeholder="search">
    
    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Medicine</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Biogesic</td>
                    <td>Analgesic and antipyretic medication.</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Request</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Modal Heading</h4>
                </div>
          
                <!-- Modal body -->
                <div class="modal-body">
                  Modal body..
                </div>
          
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>