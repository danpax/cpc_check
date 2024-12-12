<?php
include 'navbar.php';
include '../db.php';

// Fetch all requests with filters
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';
$query = "SELECT r.*, u.name FROM requests r JOIN users u ON r.user_id = u.id";
if ($statusFilter !== 'all') {
    $query .= " WHERE r.status = '$statusFilter'";
}
$query .= " ORDER BY r.created_at DESC";
$requests = $conn->query($query);
?>

<div class="container" style="margin-left: 300px;">
    <h1>Request Management</h1>

    <form method="GET" class="filter-form">
        <label for="status">Filter by Status:</label>
        <select id="status" name="status">
            <option value="all" <?= $statusFilter == 'all' ? 'selected' : ''; ?>>All</option>
            <option value="pending" <?= $statusFilter == 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="approved" <?= $statusFilter == 'approved' ? 'selected' : ''; ?>>Approved</option>
            <option value="rejected" <?= $statusFilter == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
        </select>
        <button type="submit" class="btn btn-primary">Apply</button>
    </form>

    <?php while ($row = $requests->fetch_assoc()): ?>
        <div>
            <p><strong>Student:</strong> <?= $row['name']; ?></p>
            <p><strong>Reason:</strong> <?= $row['reason']; ?></p>
            <p><strong>Status:</strong> <?= ucfirst($row['status']); ?></p>
            <a href="approve_request.php?id=<?= $row['id']; ?>" class="btn btn-success">Approve</a>
            <a href="reject_request.php?id=<?= $row['id']; ?>" class="btn btn-danger">Reject</a>
        </div>
    <?php endwhile; ?>
</div>
?>
