<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Sidebar container styling */
    .sidebar {
        background-color: #343a40;
        color: #fff;
        height: 100vh;
        width: 250px;
        padding: 20px;
        position: fixed;
        top: 0;
        left: 0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .sidebar h2, .sidebar h5 {
        text-align: center;
        margin-bottom: 1rem;
        color: #f8f9fa;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        width: 100%;
    }

    .sidebar li {
        margin-bottom: 15px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 10px;
        text-decoration: none;
        color: #ddd;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
        font-size: 16px;
    }

    .sidebar a:hover, .sidebar a.active {
        background-color: #495057;
        color: #fff;
    }

    .sidebar a i {
        margin-right: 15px;
        font-size: 18px;
    }

    .sidebar img {
        width: 150px;
        height: auto;
        border-radius: 5px;
        margin: 10px 0;
    }

    /* Responsive Sidebar */
    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
            padding: 15px;
        }

        .sidebar h2 {
            font-size: 18px;
        }

        .sidebar h5 {
            font-size: 14px;
        }

        .sidebar a {
            font-size: 14px;
        }

        .sidebar img {
            width: 120px;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            width: 180px;
            padding: 10px;
        }

        .sidebar a {
            font-size: 13px;
        }

        .sidebar img {
            width: 100px;
        }
    }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <!-- Logo Section -->
        <a href="adDashboard.php">
            <img src="../img/phoenix.jpg" alt="Logo">
        </a>
        <h2>CPC CHECK</h2>
        <h5>Nurse Panel</h5>

        <!-- Navigation Links -->
        <ul>
            <li><a href="adMedicine.php"><i class="fas fa-pills"></i>Medicine</a></li>
            <li><a href="requests.php"><i class="fas fa-clipboard-list"></i>Requests</a></li>
            <li><a href="requests_history.php"><i class="fas fa-history"></i>Student History</a></li>
            <li><a href="students.php"><i class="fas fa-user"></i>Students</a></li>
            <li><a href="monitorings.php"><i class="fas fa-chart-line"></i>Monitored Student</a></li>
            <li><a href="calendar.php"><i class="fas fa-chart-line"></i>Calendar</a></li>
        </ul>

        <!-- Footer -->
        <div class="mt-auto">
            <a href="../logout.php" class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
