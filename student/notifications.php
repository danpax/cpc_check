<?php 
include 'navbar.php'; 
include '../db.php';
?>

<div class="container mt-5">
        <h1 class="text-center">Notifications</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Reason</th>
                    <th>Message</th>
                    <th>Visit Date</th>
                    <!-- <th>Action Date</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to fetch accepted requests
                $sql = "SELECT * FROM requests WHERE status = 'accepted'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        // Format the visit date using DateTime
                        $visit_date = new DateTime($row['visit_at']);
                        $formatted_visit_date = $visit_date->format('F j, Y g:i A');

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                        echo "<td>" . htmlspecialchars($formatted_visit_date) . "</td>";
                        // echo "<td>" . htmlspecialchars($formatted_action_date) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No accepted requests found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>