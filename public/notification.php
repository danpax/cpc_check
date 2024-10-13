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

    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>You're request is accepted</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>