<?php 
include 'navbar.php'; 
include '../db.php';
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Notifications</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">Reason</th>
                    <th scope="col">Message</th>
                    <th scope="col">Visit Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to fetch accepted requests
                $sql = "SELECT * FROM requests WHERE status = 'approved'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        // Format the visit date using DateTime
                        $visit_date = new DateTime($row['visit_at']);
                        $formatted_visit_date = $visit_date->format('F j, Y g:i A');
                        ?>
                        <tr class="text-center">
                            <td><?= htmlspecialchars($row['reason']); ?></td>
                            <td><?= htmlspecialchars($row['message']); ?></td>
                            <td><?= htmlspecialchars($formatted_visit_date); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            No accepted requests found
                        </td>
                    </tr>
                    <?php
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
