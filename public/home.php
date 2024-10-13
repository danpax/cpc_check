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
      body{
    background-image: linear-gradient(to right, skyblue, blue); /* Gradient background */

      }
      input[text="text"]{
        margin-right: 20%;
      }
</style>
<body>
    <div class="navbar bg-dark">
        <div><a href="home.php"><img src="../img/phoenix.jpg" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50px;"></a></div>
        <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="medicine.php">Medicine</a></li>
        <li><a href="clinic.php">Clinic Staff</a></li>
        <li><a href="request.php">My Request</a></li>
        <a href="notification.php"><i class='fas fa-bell' style='font-size:24px;'></i></a>
        <li><a href="login.php">Log out</a></li>
        </ul>
    </div>
        <h1 class="bg-dark" style="width: 30%; text-align: center; position: relative; margin-top: 2%; margin-left: 900px; color: white;">MONITORED STUDENTS</h1>
        <table class="table table-light table-bordered" style="width: 30%; margin-left: 900px;">
            <thead>
              <tr>
                <th>Names</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td >Mark</td>
                <td><i class="fa fa-eye" data-bs-toggle="modal" data-bs-target="#myModal" style="cursor: pointer;"></i></td>
              </tr>
            </tbody>
          </table>

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
                <label for="">Name: </label>
                <input type="text" name="" id="">
                <br>
                <label for="">Address: </label>
                <input type="text">
                <br>
                <label for="">Date of Birth: </label>
                <input type="text">
                <br>
                <label for="">Parent/Guardian: </label>
                <input type="text">
                <br>
                <label for="">Phone #: </label>
                <input type="text" name="" id="">
                <br>
                <label for="">Email: </label>
                <input type="email">
                <br>
                <label for="">Emergency #: </label>
                <input type="text">
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
              </div>



          

</body>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>