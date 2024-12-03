<?php
session_start();
if (!isset($_SESSION["id_number"])) {
    header("Location: ../login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "clinic");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';

if (empty($id)) {
    die("No student ID provided");
}

$sql = "SELECT * FROM students WHERE id_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No student found with ID: " . htmlspecialchars($id));
}

$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2>Student Details</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($student['name']); ?></h5>
                <p class="card-text"><strong>ID Number:</strong> <?php echo htmlspecialchars($student['id_number']); ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
                <p class="card-text"><strong>Phone:</strong> <?php echo htmlspecialchars($student['phone']); ?></p>
                <p class="card-text"><strong>Address:</strong> <?php echo htmlspecialchars($student['address']); ?></p>
                <p class="card-text"><strong>Date:</strong> <?php echo htmlspecialchars($student['date']); ?></p>
                <p class="card-text"><strong>Age:</strong> <?php echo htmlspecialchars($student['age']); ?></p>
                <p class="card-text"><strong>Gender:</strong> <?php echo htmlspecialchars($student['gender']); ?></p>
                <p class="card-text"><strong>Civil Status:</strong> <?php echo htmlspecialchars($student['civil_status']); ?></p>
                <p class="card-text"><strong>Course:</strong> <?php echo htmlspecialchars($student['course']); ?></p>
                <p class="card-text"><strong>Year and Section:</strong> <?php echo htmlspecialchars($student['year_sec']); ?></p>
                <p class="card-text"><strong>Vaccine Type:</strong> <?php echo htmlspecialchars($student['vaccine_type']); ?></p>
                <p class="card-text"><strong>Guardian Number:</strong> <?php echo htmlspecialchars($student['guardian_number']); ?></p>
                <p class="card-text"><strong>Student Number:</strong> <?php echo htmlspecialchars($student['student_number']); ?></p>
                <p class="card-text"><strong>Parent:</strong> <?php echo htmlspecialchars($student['parent']); ?></p>
                <p class="card-text"><strong>Disability:</strong> <?php echo htmlspecialchars($student['disability']); ?></p>
                <p class="card-text"><strong>Blood Pressure:</strong> <?php echo htmlspecialchars($student['blood_pressure']); ?></p>
                <p class="card-text"><strong>Temperature:</strong> <?php echo htmlspecialchars($student['temperature']); ?></p>
                <p class="card-text"><strong>Height:</strong> <?php echo htmlspecialchars($student['height']); ?></p>
                <p class="card-text"><strong>Weight:</strong> <?php echo htmlspecialchars($student['weight']); ?></p>
                <p class="card-text"><strong>Health Conditions:</strong> <?php echo htmlspecialchars($student['health_conditions']); ?></p>
            </div>
        </div>
        <a href="adRecord.php" class="btn btn-primary mt-3">Back to Student Records</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>