<?php
include 'navbar.php';
include '../db.php';

$user_id = $_SESSION['user']['id'];

// Fetch appointments
$appointments = $conn->query("
    SELECT a.*, u.name AS nurse_name 
    FROM appointments a 
    JOIN users u ON a.nurse_id = u.id 
    WHERE a.student_id = $user_id 
    ORDER BY a.visit_at ASC
");
?>

<div class="container">
    <h1>Your Appointments</h1>

    <?php while ($row = $appointments->fetch_assoc()): ?>
        <div>
            <p><strong>Nurse:</strong> <?= $row['nurse_name']; ?></p>
            <p><strong>Date/Time:</strong> <?= $row['visit_at']; ?></p>
            <p><strong>Notes:</strong> <?= $row['notes']; ?></p>
        </div>
    <?php endwhile; ?>
</div>
?>
