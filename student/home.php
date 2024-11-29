<?php
session_start();
if (!isset($_SESSION["id_number"])) {
    header("Location: ../login.php");
    exit(); // Redirect to login if not authenticated
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Homepage</title>
</head>
<style>
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
  @media (max-width: 768px) {
    .background{
        height: 100%;
        width: 100%;
        background-position: center center;
    }
}

</style>
<body>
    <div class="navbar bg-dark">
    <div>
        <a href="home.php">
            <img src="../img/phoenix.jpg" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50px; margin-right: 5px;">
        </a>
    </div>
    <button class="toggle-btn" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </button>
    <ul class="nav-links">
        <li><a href="home.php">Home</a></li>
        <li><a href="medicine.php">Medicine</a></li>
        <li><a href="clinic.php">Clinic Staff</a></li>
        <li><a href="request.php">My Request</a></li>
        <li><a href="notification.php"><i class="fas fa-bell" style="font-size:24px;"></i></a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>
</div>

<h1 class="bg-dark" style="width: 30%; text-align: center; position: relative; margin-top: 2%; margin-left: auto; margin-right: auto; color: white;">MONITORED STUDENTS</h1>

<div class="table-container">
    <table class="table table-light table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Names</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mark</td>
                <td><i class="fa fa-eye" data-bs-toggle="modal" data-bs-target="#myModal" style="cursor: pointer;"></i></td>
            </tr>
        </tbody>
    </table>
</div>

          <div class="background"></div>

        <p class="double-color">Your Partner in Health <br>and Wellness</p>
          
        
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Background Information</h4>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body">
                <label for="" class="form-label">Name: </label>
                <input type="text" name="" id="" class="form-control">
                <br>
                <label for="" class="form-label">Address: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Date of Birth: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Parent/Guardian: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Phone #: </label>
                <input type="text" name="" id="" class="form-control">
                <br>
                <label for="" class="form-label">Email: </label>
                <input type="email" class="form-control">
                <br>
                <label for="" class="form-label">Emergency #: </label>
                <input type="text" class="form-control">
                <br><br>
                <label for="" class="form-label">Health Condition/s: </label>
                <br>
                <input type="text" class="form-control">
                <input type="text" class="form-control">
                <input type="text" class="form-control">
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal" style="border-radius: 3px; width: 90px;">Close</button>
              </div>



              <script>
                function toggleMenu() {
                    const navLinks = document.querySelector('.nav-links');
                     navLinks.classList.toggle('active');
                  }
              </script>



          
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>