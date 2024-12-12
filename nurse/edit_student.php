<?php
// Start session and include necessary files
include 'navbar.php';
include '../db.php';

$student_id = $_GET['id'] ?? null;

// Check if student ID is provided
if (!$student_id) {
    echo "<div class='alert alert-danger'>No student ID provided.</div>";
    exit();
}

// Fetch the student's data
$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param('i', $student_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 0) {
    echo "<div class='alert alert-danger'>Student not found.</div>";
    exit();
}

$student = $result->fetch_assoc();

// Update the student's information if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $civil_status = $_POST['civil_status'] ?? '';
    $course = $_POST['course'] ?? '';
    $year_sec = $_POST['year_sec'] ?? '';
    $vaccine_type = $_POST['vaccine_type'] ?? '';
    $guardian_number = $_POST['guardian_number'] ?? '';
    $parent = $_POST['parent'] ?? '';
    $disability = $_POST['disability'] ?? '';
    $blood_pressure = $_POST['blood_pressure'] ?? '';
    $temperature = $_POST['temperature'] ?? '';
    $height = $_POST['height'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $health_conditions = $_POST['health_conditions'] ?? '';

    $update_query = $conn->prepare("
        UPDATE users 
        SET 
            name = ?, phone = ?, address = ?, email = ?, birthdate = ?, 
            gender = ?, civil_status = ?, course = ?, year_sec = ?, 
            vaccine_type = ?, guardian_number = ?, parent = ?, disability = ?, 
            blood_pressure = ?, temperature = ?, height = ?, weight = ?, 
            health_conditions = ?, updated_at = NOW()
        WHERE id = ?
    ");
    $update_query->bind_param(
        'ssssssssssssssssssi', 
        $name, $phone, $address, $email, $birthdate, $gender, 
        $civil_status, $course, $year_sec, $vaccine_type, 
        $guardian_number, $parent, $disability, $blood_pressure, 
        $temperature, $height, $weight, $health_conditions, 
        $student_id
    );

    if ($update_query->execute()) {
        // echo "<div class='alert alert-success'>Student information updated successfully.</div>";
        echo "<script>alert('Student information updated successfully.'); window.location.href = 'edit_student.php?id=" . $student_id . "';</script>";
    } else {
        echo "<div class='alert alert-danger'>Error updating student information: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Edit Student Information</h1>

    <form method="POST" class="row g-3 shadow p-4 bg-white rounded">
        <!-- Name -->
        <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>
        <!-- Phone -->
        <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($student['phone']) ?>">
        </div>
        <!-- Address -->
        <div class="col-12">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="2"><?= htmlspecialchars($student['address']) ?></textarea>
        </div>
        <!-- Email -->
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($student['email']) ?>">
        </div>
        <!-- Date of Birth -->
        <div class="col-md-6">
            <label for="birthdate" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= htmlspecialchars($student['birthdate']) ?>">
        </div>
        <!-- Gender -->
        <div class="col-md-6">
            <label for="gender" class="form-label">Gender</label>
            <!-- <input type="text" class="form-control" id="gender" name="gender" value="<?= htmlspecialchars($student['gender']) ?>"> -->
            <select class="form-control" id="gender" name="gender" value="<?= htmlspecialchars($student['gender']) ?>">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <!-- Civil Status -->
        <div class="col-md-6">
            <label for="civil_status" class="form-label">Civil Status</label>
            <!-- <input type="text" class="form-control" id="civil_status" name="civil_status" value="<?= htmlspecialchars($student['civil_status']) ?>"> -->
            <select class="form-control" id="civil_status" name="civil_status" value="<?= htmlspecialchars($student['civil_status']) ?>">
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
            </select>
        </div>
        <!-- Course -->
        <div class="col-md-6">
            <label for="course" class="form-label">Course</label>
            <!-- <input type="text" class="form-control" id="course" name="course" value="<?= htmlspecialchars($student['course']) ?>"> -->
            <select class="form-control" id="course" name="course" value="<?= htmlspecialchars($student['course']) ?>">
                <option value="BSIT">BSIT</option>
                <option value="BSHM">BSHM</option>
                <option value="BEED">BEED</option>
                <option value="BSED">BSED</option>
            </select>
        </div>
        <!-- Year & Section -->
        <div class="col-md-6">
            <label for="year_sec" class="form-label">Year & Section</label>
            <input type="text" class="form-control" id="year_sec" name="year_sec" value="<?= htmlspecialchars($student['year_sec']) ?>">
        </div>
        <!-- Vaccine Type -->
        <div class="col-md-6">
            <label for="vaccine_type" class="form-label">Vaccine Type</label>
            <input type="text" class="form-control" id="vaccine_type" name="vaccine_type" value="<?= htmlspecialchars($student['vaccine_type']) ?>">
        </div>
        <!-- Guardian Number -->
        <div class="col-md-6">
            <label for="guardian_number" class="form-label">Guardian Number</label>
            <input type="text" class="form-control" id="guardian_number" name="guardian_number" value="<?= htmlspecialchars($student['guardian_number']) ?>">
        </div>
        <!-- Additional Fields -->
        <div class="col-12">
            <label for="health_conditions" class="form-label">Health Conditions</label>
            <textarea class="form-control" id="health_conditions" name="health_conditions" rows="2"><?= htmlspecialchars($student['health_conditions']) ?></textarea>
        </div>
        <!-- Submit Button -->
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
