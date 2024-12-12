<?php
include 'navbar.php';
include '../db.php';

// Fetch pending requests and upcoming appointments
$pendingRequests = $conn->query("SELECT * FROM requests WHERE status = 'pending'");
$appointments = $conn->query("
    SELECT a.*, u.name AS student_name FROM appointments a
    JOIN users u ON a.student_id = u.id
    WHERE a.nurse_id = {$_SESSION['user']['id']}
    ORDER BY a.visit_at ASC
");
?>

<div class="container" style="margin-left: 300px;">
    <h1>Nurse Dashboard</h1>
    <section>
        <h2>Pending Requests</h2>
        <?php while ($row = $pendingRequests->fetch_assoc()): ?>
            <div>
                <p><strong>Student:</strong> <?= $row['user_id']; ?></p>
                <p><strong>Reason:</strong> <?= $row['reason']; ?></p>
                <p><strong>Message:</strong> <?= $row['message']; ?></p>
                <a href="approve_request.php?id=<?= $row['id']; ?>" class="btn btn-success">Approve</a>
                <a href="reject_request.php?id=<?= $row['id']; ?>" class="btn btn-danger">Reject</a>
            </div>
        <?php endwhile; ?>
    </section>

    <section>
        <h2>Upcoming Appointments</h2>
        <?php while ($row = $appointments->fetch_assoc()): ?>
            <div>
                <p><strong>Student:</strong> <?= $row['student_name']; ?></p>
                <p><strong>Date/Time:</strong> <?= $row['visit_at']; ?></p>
                <p><strong>Notes:</strong> <?= $row['notes']; ?></p>
            </div>
        <?php endwhile; ?>
    </section>
</div>
?>
