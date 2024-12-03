<?php
include '../db.php'; // Include your database connection file
include 'navbar.php'; // Include your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['user']['id'])) {
    echo "You must be logged in to view this page.";
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user']['id'];

// Query to check if the user is being monitored
$query_monitoring = $conn->prepare("SELECT * FROM monitorings WHERE user_id = ?");
$query_monitoring->bind_param('i', $user_id);
$query_monitoring->execute();
$result_monitoring = $query_monitoring->get_result();

// Query to fetch student details
$query_student = $conn->prepare("SELECT * FROM students WHERE user_id = ?");
$query_student->bind_param('i', $user_id);
$query_student->execute();
$result_student = $query_student->get_result();
$student = $result_student->fetch_assoc();

// Check if the user is being monitored
$is_monitored = $result_monitoring->num_rows > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Status</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Monitoring Status</h1>

        <div class="card mt-4">
            <div class="card-body">
                <?php if ($is_monitored): ?>
                    <h3 class="text-success text-center">You are currently being monitored by the nurse.</h3>
                <?php else: ?>
                    <h3 class="text-danger text-center">You are not currently being monitored.</h3>
                <?php endif; ?>
            </div>
        </div>

        <!-- View Details Button -->
        <div class="text-center mt-4">
            <?php if ($student): ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentDetailsModal">
                    View Details
                </button>
            <?php endif; ?>
        </div>
    </div>

    

    <!-- Student Details Modal -->
    <div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentDetailsModalLabel">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($student): ?>
                        <p><strong>Name:</strong> <?= htmlspecialchars($student['name']) ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($student['phone']) ?></p>
                        <p><strong>Address:</strong> <?= htmlspecialchars($student['address']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
                        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($student['date']) ?></p>
                        <p><strong>Age:</strong> <?= htmlspecialchars($student['age']) ?></p>
                        <p><strong>Gender:</strong> <?= htmlspecialchars($student['gender']) ?></p>
                        <p><strong>Course:</strong> <?= htmlspecialchars($student['course']) ?></p>
                        <p><strong>Year & Section:</strong> <?= htmlspecialchars($student['year_sec']) ?></p>
                        <p><strong>Vaccine Type:</strong> <?= htmlspecialchars($student['vaccine_type']) ?></p>
                        <p><strong>Vaccine Type:</strong> <?= htmlspecialchars($student['guardian_number']) ?></p>
                        <p><strong>Vaccine Type:</strong> <?= htmlspecialchars($student['student_number']) ?></p>
                        <p><strong>Vaccine Type:</strong> <?= htmlspecialchars($student['parent']) ?></p>
                        <p><strong>Vaccine Type:</strong> <?= htmlspecialchars($student['disability']) ?></p>
                        <p><strong>Vaccine Type:</strong> <?= htmlspecialchars($student['blood_pressure']) ?></p>
                        <p><strong>Vaccine Type:</strong> <?= htmlspecialchars($student['temperature']) ?></p>
                        <p><strong>Health conditions:</strong> <?= htmlspecialchars($student['health_conditions']) ?></p>
                    <?php else: ?>
                        <p class="text-danger">Student details not found.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
