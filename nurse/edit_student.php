<?php
// Start session and include necessary files
include 'navbar.php';
include '../db.php';


$student_id = $_GET['id'];

// Fetch the student's data from the database
$query = $conn->prepare("SELECT * FROM students WHERE id = ?");
$query->bind_param('i', $student_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 0) {
    echo "Student not found.";
    exit();
}

$student = $result->fetch_assoc();

// Update the student's information if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_status'];
    $course = $_POST['course'];
    $year_sec = $_POST['year_sec'];
    $vaccine_type = $_POST['vaccine_type'];
    $guardian_number = $_POST['guardian_number'];
    $student_number = $_POST['student_number'];
    $parent = $_POST['parent'];
    $disability = $_POST['disability'];
    $blood_pressure = $_POST['blood_pressure'];
    $temperature = $_POST['temperature'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $health_conditions = $_POST['health_conditions'];

    $update_query = $conn->prepare("
        UPDATE students 
        SET name=?, phone=?, address=?, email=?, date=?, age=?, gender=?, 
            civil_status=?, course=?, year_sec=?, vaccine_type=?, guardian_number=?, 
            student_number=?, parent=?, disability=?, blood_pressure=?, 
            temperature=?, height=?, weight=?, health_conditions=? 
        WHERE id=?
    ");
    $update_query->bind_param(
        'ssssssssssssssssssssi', 
        $name, $phone, $address, $email, $date, $age, $gender, $civil_status, 
        $course, $year_sec, $vaccine_type, $guardian_number, $student_number, 
        $parent, $disability, $blood_pressure, $temperature, $height, $weight, 
        $health_conditions, $student_id
    );

    if ($update_query->execute()) {
        echo "Student information updated successfully.";
    } else {
        echo "Error updating student information: " . $conn->error;
    }
}
?>


   <div class="container">
    <div style="margin-left: 100px;">
    <h1>Edit Student Information</h1>
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required><br>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']) ?>"><br>

            <label>Address:</label>
            <textarea name="address"><?= htmlspecialchars($student['address']) ?></textarea><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>"><br>

            <label>Date of Birth:</label>
            <input type="date" name="date" value="<?= htmlspecialchars($student['date']) ?>"><br>

            <label>Age:</label>
            <input type="number" name="age" value="<?= htmlspecialchars($student['age']) ?>"><br>

            <label>Gender:</label>
            <input type="text" name="gender" value="<?= htmlspecialchars($student['gender']) ?>"><br>

            <label>Civil Status:</label>
            <input type="text" name="civil_status" value="<?= htmlspecialchars($student['civil_status']) ?>"><br>

            <label>Course:</label>
            <input type="text" name="course" value="<?= htmlspecialchars($student['course']) ?>"><br>

            <label>Year & Section:</label>
            <input type="text" name="year_sec" value="<?= htmlspecialchars($student['year_sec']) ?>"><br>

            <label>Vaccine Type:</label>
            <input type="text" name="vaccine_type" value="<?= htmlspecialchars($student['vaccine_type']) ?>"><br>

            <label>Guardian Number:</label>
            <input type="text" name="guardian_number" value="<?= htmlspecialchars($student['guardian_number']) ?>"><br>

            <label>Student Number:</label>
            <input type="text" name="student_number" value="<?= htmlspecialchars($student['student_number']) ?>"><br>

            <label>Parent:</label>
            <input type="text" name="parent" value="<?= htmlspecialchars($student['parent']) ?>"><br>

            <label>Disability:</label>
            <textarea name="disability"><?= htmlspecialchars($student['disability']) ?></textarea><br>

            <label>Blood Pressure:</label>
            <input type="text" name="blood_pressure" value="<?= htmlspecialchars($student['blood_pressure']) ?>"><br>

            <label>Temperature:</label>
            <input type="number" step="0.1" name="temperature" value="<?= htmlspecialchars($student['temperature']) ?>"><br>

            <label>Height:</label>
            <input type="number" step="0.01" name="height" value="<?= htmlspecialchars($student['height']) ?>"><br>

            <label>Weight:</label>
            <input type="number" step="0.01" name="weight" value="<?= htmlspecialchars($student['weight']) ?>"><br>

            <label>Health Conditions:</label>
            <textarea name="health_conditions"><?= htmlspecialchars($student['health_conditions']) ?></textarea><br>

            <button type="submit">Update Student</button>
        </form>

    </div>
   </div>
