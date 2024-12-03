<?php
include 'navbar.php';

// Database connection
include '../db.php';

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

?>

    <div class="container-fluid" style="margin-left: 100px;">
    <table class="table table-striped table-bordered mt-5" style="margin: auto; max-width: 1280px;">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Reason</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
                // Query to fetch pending requests with the student's name
                $sql = "SELECT request.id, s.name AS student_name, request.reason, request.requested_at
                FROM requests request
                JOIN students s ON request.student_id = s.id_number
                JOIN users u ON s.id_number = u.id_number
                WHERE request.status = 'pending'";

                
                $result = $conn->query($sql);
                
                if ($result === false) {
                    die("Error executing query: " . $conn->error);
                }
                
                // Check if there are any rows returned
                
                        if ($result->num_rows) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['requested_at']) . "</td>";
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
                            echo "<tr><td colspan='4'>No pending requests</td></tr>";
                        }

                        $conn->close();
                    ?>
        </tbody>
    </table>
    </div>