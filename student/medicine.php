<?php
session_start();
if (!isset($_SESSION["id_number"])) {
    header("Location: ../login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "clinic");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle medicine request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_medicine'])) {
    $medicine_id = intval($_POST['medicine_id']);
    $reason = $conn->real_escape_string($_POST['reason']);
    $student_id = $_SESSION["id_number"];
    
    $sql = "INSERT INTO medicine_requests (medicine_id, student_id, reason, request_date) VALUES ($medicine_id, '$student_id', '$reason', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Request submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error submitting request. Please try again.');</script>";
    }
}

// Fetch medicines
$sql = "SELECT * FROM medicines WHERE stock > 0 AND expiration_date > CURDATE() ORDER BY medicine_name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student - Medicines</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

<div class="container mt-5">
        <input type="search" id="search" placeholder="Search" onkeyup="searchMedicines()">
        
        <table class="table table-striped table-bordered" id="medicineTable">
            <thead class="table-dark">
                <tr>
                    <th>Medicine</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['medicine_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td><button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#requestModal" . $row['id'] . "'>Request</button></td>";
                        echo "</tr>";
                        
                        // Modal for each medicine
                        echo "<div class='modal' id='requestModal" . $row['id'] . "'>";
                        echo "<div class='modal-dialog'><div class='modal-content'>";
                        echo "<div class='modal-header'><h4 class='modal-title'>Request " . htmlspecialchars($row['medicine_name']) . "</h4></div>";
                        echo "<div class='modal-body'>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='medicine_id' value='" . $row['id'] . "'>";
                        echo "<textarea class='form-control' name='reason' rows='3' placeholder='Enter your reason here' required></textarea>";
                        echo "<button type='submit' name='request_medicine' class='btn btn-primary mt-3'>Submit Request</button>";
                        echo "</form></div>";
                        echo "<div class='modal-footer'><button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button></div>";
                        echo "</div></div></div>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No medicines available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchMedicines() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("medicineTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>