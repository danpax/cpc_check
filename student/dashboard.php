<?php
include 'navbar.php';
include '../db.php';

$user_id = $_SESSION['user']['id'];

// Fetch health requests
$requests = $conn->query("
    SELECT * 
    FROM requests 
    WHERE user_id = $user_id 
    ORDER BY created_at DESC
");

// Fetch upcoming appointments
$appointments = $conn->query("
    SELECT a.*, u.name AS nurse_name 
    FROM appointments a 
    JOIN users u ON a.nurse_id = u.id 
    WHERE a.student_id = $user_id 
    AND a.visit_at >= NOW()
    ORDER BY a.visit_at ASC
");
?>

<div class="container">
    <h1>Student Dashboard</h1>

    <section>
        <h2>Your Health Requests</h2>
        <?php while ($row = $requests->fetch_assoc()): ?>
            <div>
                <p><strong>Reason:</strong> <?= $row['reason']; ?></p>
                <p><strong>Status:</strong> <?= ucfirst($row['status']); ?></p>
                <p><strong>Date Submitted:</strong> <?= $row['created_at']; ?></p>
            </div>
        <?php endwhile; ?>
    </section>

    <section>
        <h2>Upcoming Checkups</h2>
        <?php while ($row = $appointments->fetch_assoc()): ?>
            <div>
                <p><strong>Nurse:</strong> <?= $row['nurse_name']; ?></p>
                <p><strong>Date/Time:</strong> <?= $row['visit_at']; ?></p>
                <p><strong>Notes:</strong> <?= $row['notes']; ?></p>
            </div>
        <?php endwhile; ?>
    </section>
</div>
?>
