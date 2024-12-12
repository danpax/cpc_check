<?php
include 'navbar.php';
include '../db.php';

// Fetch appointments
$appointments = $conn->query("
    SELECT a.*, u.name AS student_name 
    FROM appointments a 
    JOIN users u ON a.student_id = u.id 
    WHERE a.nurse_id = {$_SESSION['user']['id']}
    ORDER BY a.visit_at ASC
");
?>

<div class="container" style="margin-left: 300px;">
    <h1>Schedule Management</h1>

    <?php while ($row = $appointments->fetch_assoc()): ?>
        <div>
            <p><strong>Student:</strong> <?= $row['student_name']; ?></p>
            <p><strong>Date/Time:</strong> <?= $row['visit_at']; ?></p>
            <a href="reschedule_appointment.php?id=<?= $row['id']; ?>" class="btn btn-warning">Reschedule</a>
            <a href="cancel_appointment.php?id=<?= $row['id']; ?>" class="btn btn-danger">Cancel</a>
        </div>
    <?php endwhile; ?>
</div>
?>
