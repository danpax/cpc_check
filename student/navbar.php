<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../login.php");
    exit();
}
else {
    if($_SESSION['user']['role'] == 'nurse') {
        echo "<script>window.history.back();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Homepage</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #343a40 !important;
            padding: 10px 20px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff !important;
            font-weight: bold;
        }
        .navbar-brand img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
        .navbar-nav .nav-link {
            color: #ddd !important;
            font-size: 15px;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #fff !important;
        }
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        .navbar-toggler-icon {
            color: #fff;
        }
        .dropdown-menu {
            background-color: #343a40;
            border: none;
            margin-top: 8px;
        }
        .dropdown-item {
            color: #ddd;
            font-size: 14px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .dropdown-item:hover {
            background-color: #495057;
            color: #fff;
        }
        .nav-item .fas {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Logo and Title -->
            <a class="navbar-brand" href="home.php">
                <img src="../img/phoenix.jpg" alt="Logo">
                <span>Student Portal</span>
            </a>

            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="request.php"><i class="fas fa-pills"></i> Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calendar.php"><i class="fas fa-pills"></i> Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myrequests.php"><i class="fas fa-file-alt"></i> My Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notifications.php"><i class="fas fa-bell"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">
                            <i class="fas fa-user"></i> Logout
                        </a>
                        <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul> -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Optional JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
