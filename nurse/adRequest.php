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

// Handle request actions (Accept/Decline)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = intval($_POST['request_id']);
    $action = $_POST['action'];
    
    if ($action === 'accept' || $action === 'decline') {
        $status = ($action === 'accept') ? 'approved' : 'rejected';
        $sql = "UPDATE medicine_requests SET status = '$status' WHERE id = $request_id";
        $conn->query($sql);
        
        if ($action === 'accept') {
            // Decrease medicine stock
            $sql = "UPDATE medicines m
                    JOIN medicine_requests mr ON m.id = mr.medicine_id
                    SET m.stock = m.stock - 1
                    WHERE mr.id = $request_id";
            $conn->query($sql);
        }
    }
}

// Fetch pending medicine requests
$sql = "SELECT mr.*, m.medicine_name, m.description, m.expiration_date, s.name as student_name
        FROM medicine_requests mr 
        JOIN medicines m ON mr.medicine_id = m.id 
        JOIN students s ON mr.student_id = s.id_number
        WHERE mr.status = 'pending' 
        ORDER BY mr.request_date ASC";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">


    <br>
    <br>
    <br><br><br>
    <?php include 'navbar.php';?>


    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Medicine</th>
                    <th>Description</th>
                    <th>Reason</th>
                    <th>Expiration Date</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['medicine_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['expiration_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['request_date']) . "</td>";
                        echo "<td>";
                        echo "<form method='POST' style='display:inline;'>";
                        echo "<input type='hidden' name='request_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' name='action' value='accept' class='btn btn-primary'>Accept</button> ";
                        echo "<button type='submit' name='action' value='decline' class='btn btn-danger'>Decline</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No pending requests</td></tr>";
                }
                ?>
            </tbody>
        </table>


</html>