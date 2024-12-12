<div class="container mt-5">
    <?php
    include 'navbar.php';
    include '../db.php';

    if (!isset($_GET['id'])) {
        echo "<div class='alert alert-danger'>Invalid request. No student ID provided.</div>";
        exit;
    }

    $student_id = intval($_GET['id']);

    // Check if the student is already being monitored
    $existingMonitoring = $conn->query("
        SELECT * FROM monitorings 
        WHERE user_id = $student_id
    ")->fetch_assoc();

    // Handle new appointment submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['visit_at'])) {
        $nurse_id = $_SESSION['user']['id'];
        $visit_at = $conn->real_escape_string($_POST['visit_at']);
        $notes = $conn->real_escape_string($_POST['notes']);

        $conn->query("
            INSERT INTO appointments (nurse_id, student_id, visit_at, notes, created_at) 
            VALUES ($nurse_id, $student_id, '$visit_at', '$notes', NOW())
        ");
        echo "<div class='alert alert-success'>Appointment has been successfully scheduled.</div>";
    }

    // Fetch student details
    $student = $conn->query("
        SELECT * FROM users 
        WHERE id = $student_id AND role = 'student'
    ")->fetch_assoc();

    if (!$student) {
        echo "<div class='alert alert-danger'>Student not found.</div>";
        exit;
    }
    ?>
    
    <h1 class="mb-4">Monitor Student</h1>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="text-primary"><?= htmlspecialchars($student['name']); ?></h2>
            <p><strong>ID:</strong> <?= htmlspecialchars($student['id_number']); ?></p>
            <p><strong>Course:</strong> <?= htmlspecialchars($student['course']); ?></p>
            <p><strong>Year & Section:</strong> <?= htmlspecialchars($student['year_sec']); ?></p>
            <p><strong>Health Conditions:</strong> <?= htmlspecialchars($student['health_conditions'] ?: 'None'); ?></p>
            <p><strong>Temperature:</strong> <?= htmlspecialchars($student['temperature']); ?></p>
            <p><strong>Blood Pressure:</strong> <?= htmlspecialchars($student['blood_pressure']); ?></p>
            <p><strong>Disabilities:</strong> <?= htmlspecialchars($student['disability'] ?: 'None'); ?></p>
        </div>
    </div>

    <!-- Schedule Appointment Button -->
    <div class="mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentModal">Schedule an Appointment</button>
    </div>

        <div class="alert alert-info">This student is being monitored.</div>
</div>

<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel">Schedule an Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="visit_at" class="form-label">Appointment Date & Time</label>
                        <input type="datetime-local" class="form-control" id="visit_at" name="visit_at" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter additional notes (optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>
