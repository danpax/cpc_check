<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../login.php");
    exit();
}
else {
    if($_SESSION['user']['role'] == 'student') {
        echo "<script>window.history.back();</script>";
    }
}

$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name
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
            color: #f8f9fa;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
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

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }

        .sidebar a i {
            margin-right: 15px;
            font-size: 18px;
        }

        .sidebar img {
            width: 150px;
            border-radius: 5px;
            margin: 20px auto;
            display: block;
        }

        /* Main content area */
        .content {
            margin-left: 250px; /* Matches the sidebar width */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* Responsive Sidebar */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px; /* Adjust to match sidebar */
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
            }

            .content {
                margin-left: 180px;
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
    <aside class="sidebar" role="navigation">
        <!-- Logo Section -->
        <a href="adDashboard.php">
            <img src="../img/phoenix.jpg" alt="Logo">
        </a>
        <h2>CPC CHECK</h2>
        <h5>Nurse Panel</h5>
    
        <!-- Navigation Links -->
        <ul>
            <li>
                <a href="adMedicine.php" class="<?= $current_page == 'adMedicine.php' ? 'active' : '' ?>">
                    <i class="fas fa-pills"></i> Medicine
                </a>
            </li>
            <li>
                <a href="requests.php" class="<?= $current_page == 'requests.php' ? 'active' : '' ?>">
                    <i class="fas fa-clipboard-list"></i> Requests
                </a>
            </li>
            <li>
                <a href="requests_history.php" class="<?= $current_page == 'requests_history.php' ? 'active' : '' ?>">
                    <i class="fas fa-history"></i> Student History
                </a>
            </li>
            <li>
                <a href="students.php" class="<?= $current_page == 'students.php' ? 'active' : '' ?>">
                    <i class="fas fa-user"></i> Students
                </a>
            </li>
            <li>
                <a href="monitorings.php" class="<?= $current_page == 'monitorings.php' ? 'active' : '' ?>">
                    <i class="fas fa-chart-line"></i> Monitored Students
                </a>
            </li>
            <li>
                <a href="calendar.php" class="<?= $current_page == 'calendar.php' ? 'active' : '' ?>">
                    <i class="fas fa-calendar"></i> Calendar
                </a>
            </li>
        </ul>

        <!-- Logout Section -->
        <div class="mt-auto">
            <a href="../logout.php" class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main Content Area -->
    <div class="content">
        <!-- Example Placeholder Content -->
