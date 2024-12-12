<?php
include 'navbar.php';
include '../db.php';

$students = $conn->query("SELECT * FROM users WHERE role = 'student'");
?>

<div class="container" style="margin-left: 300px;">
    <h1>Student Health Profiles</h1>
    <?php while ($row = $students->fetch_assoc()): ?>
        <div>
            <p><strong>Name:</strong> <?= $row['name']; ?></p>
            <p><strong>Course:</strong> <?= $row['course']; ?></p>
            <p><strong>Health Conditions:</strong> <?= $row['health_conditions']; ?></p>
            <a href="monitor_student.php?id=<?= $row['id']; ?>" class="btn btn-primary">Monitor</a>
        </div>
    <?php endwhile; ?>
</div>
?>
