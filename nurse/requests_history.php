<?php 
include 'navbar.php'; 
include '../db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Requests History</h1>
    <table class="table table-striped table-bordered" style="margin-left: 100px;">
        <thead class="table-dark">
            <tr>
                <th>User Name</th>
                <th>Reason</th>
                <th>Message</th>
                <th>Visit Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to fetch accepted requests with user details
            $sql = "SELECT 
                        r.*, 
                        u.*, 
                        s.* 
                    FROM 
                        requests r 
                    LEFT JOIN 
                        users u ON r.user_id = u.id 
                    LEFT JOIN 
                        students s ON u.id = s.user_id
                    WHERE 
                        r.status = 'accepted'";
            
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    // Format the visit date using DateTime
                    $visit_date = new DateTime($row['visit_at']);
                    $formatted_visit_date = $visit_date->format('F j, Y g:i A');
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>"; // User name
                    echo "<td>" . htmlspecialchars($row['reason']) . "</td>"; // Request reason
                    echo "<td>" . htmlspecialchars($row['message']) . "</td>"; // Request message
                    echo "<td>" . htmlspecialchars($formatted_visit_date) . "</td>"; // Visit date
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No accepted requests found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
