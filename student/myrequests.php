<?php

include 'navbar.php';

// Database connection
$conn = new mysqli("localhost", "root", "", "clinic");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION["user"]['id'];

$sql = "SELECT request.*
FROM requests request 
WHERE request.user_id = '$user_id' 
ORDER BY request.created_at DESC";

$result = $conn->query($sql);
?>


<div class="container mt-5">
    <h2 class="mb-4 text-center">My Medicine Requests</h2>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Reason</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['reason']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td>
                                <span class="badge <?= $row['status'] === 'pending' ? 'bg-warning' : ($row['status'] === 'approved' ? 'bg-success' : 'bg-danger') ?>">
                                    <?= ucfirst(htmlspecialchars($row['status'])) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            No requests found
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


    
