<?php

include 'navbar.php';
include '../db.php';
// Handle Add Student Form Submission
if (isset($_POST['add_student'])) {
    // Get the password and other user information from the form
    $password = $_POST['password'];
    $id_number = $_POST['id_number'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $role = 'student'; // Default role for students

    // Insert the user into the 'users' table
    $sql_user = "INSERT INTO users (id_number, password, role) VALUES ('$id_number', '$hashed_password', '$role')";

    if ($conn->query($sql_user) === TRUE) {
        // Retrieve the ID of the newly created user
        $user_id = $conn->insert_id;

        // Get student details from the form
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

        // Insert student data into the 'students' table
        $sql_student = "INSERT INTO students (user_id, name, phone, address, email, date, age, gender, civil_status, course, year_sec, vaccine_type, guardian_number, student_number, parent, disability, blood_pressure, temperature, height, weight, health_conditions) 
                        VALUES ('$user_id', '$name', '$phone', '$address', '$email', '$date', '$age', '$gender', '$civil_status', '$course', '$year_sec', '$vaccine_type', '$guardian_number', '$student_number', '$parent', '$disability', '$blood_pressure', '$temperature', '$height', '$weight', '$health_conditions')";

        if ($conn->query($sql_student) === TRUE) {
            // Success message if both student and user are added
            echo "<div class='alert alert-success'>New student added successfully and linked to the user account!</div>";
        } else {
            // Error while adding student
            echo "<div class='alert alert-danger'>Error adding student: " . $conn->error . "</div>";
        }
    } else {
        // Error while creating user
        echo "<div class='alert alert-danger'>Error creating user: " . $conn->error . "</div>";
    }
}


// Handle Delete Student
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id = $id");
    header("Location: nurse_students.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<div class="container mt-4" style="margin-left: 300px;">
    <h1 class="text-center">Nurse Students Management</h1>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        <i class="fas fa-plus"></i> Add New Student
    </button>

    <!-- Students Table -->
    <table class="table table-bordered table-striped" >
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>ID Number</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("
    SELECT 
        students.*, 
        users.id AS user_id, 
        users.id_number AS user_id_number, 
        users.role AS user_role 
    FROM 
        students 
    LEFT JOIN 
        users 
    ON 
        students.user_id = users.id
");

            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td> <!-- Student ID -->
                    <td><?php echo $row['user_id_number']; ?></td> <!-- Student ID Number -->
                    <td><?php echo $row['name']; ?></td> <!-- Student Name -->
                    <td><?php echo $row['phone']; ?></td> <!-- Student Phone -->
                    <td><?php echo $row['address']; ?></td> <!-- Student Address -->
                    <td><?php echo $row['course']; ?></td> <!-- Student Course -->
                    <td><?php echo $row['user_id']; ?></td> <!-- User ID -->
                    <td><?php echo $row['user_id_number']; ?></td> <!-- User ID Number -->
                    <td><?php echo $row['user_role']; ?></td> <!-- User Role -->
                    <td class="action-buttons">
                        <!-- Edit Button -->
                        <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <!-- <button type='button' class='btn btn-secondary' onclick='viewStudent(<?php echo $row['user_id'] ?>)'>View</button> -->
                        <!-- <button type='button' class='btn btn-dark'>Monitor</button> -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#monitorModal" 
                                
                                data-user-id="<?php echo $row['user_id']; ?>">
                            Monitor
                        </button>
                        <!-- Delete Button -->
                        <!-- <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </a> -->
                    </td>
                </tr>
            <?php endwhile; ?>

        </tbody>
    </table>
</div>
<!-- Monitor Confirmation Modal -->
<div class="modal fade" id="monitorModal" tabindex="-1" aria-labelledby="monitorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="monitorModalLabel">Confirm Monitoring</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to monitor this student?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="monitorForm" method="POST" action="monitor_student.php">
                    <input type="hidden" name="student_id" id="modal-student-id">
                    <input type="hidden" name="user_id" id="modal-user-id">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_number" class="form-label">ID Number:</label>
                            <input type="text" class="form-control" id="id_number" name="id_number" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age:</label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="civil_status" class="form-label">Civil Status:</label>
                            <select class="form-control" id="civil_status" name="civil_status">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="course" class="form-label">Course:</label>
                            <select class="form-control" id="course" name="course">
                                <option value="BSIT">BSIT</option>
                                <option value="BSHM">BSHM</option>
                                <option value="BEED">BEED</option>
                                <option value="BSED">BSED</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="year_sec" class="form-label">Year and Section:</label>
                            <input type="text" class="form-control" id="year_sec" name="year_sec">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="vaccine_type" class="form-label">Vaccine Type:</label>
                            <input type="text" class="form-control" id="vaccine_type" name="vaccine_type">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guardian_number" class="form-label">Guardian Number:</label>
                            <input type="tel" class="form-control" id="guardian_number" name="guardian_number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="student_number" class="form-label">Student Number:</label>
                            <input type="tel" class="form-control" id="student_number" name="student_number">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="parent" class="form-label">Parent:</label>
                        <input type="text" class="form-control" id="parent" name="parent">
                    </div>
                    <div class="mb-3">
                        <label for="disability" class="form-label">Disability:</label>
                        <input type="text" class="form-control" id="disability" name="disability">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="blood_pressure" class="form-label">Blood Pressure:</label>
                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="temperature" class="form-label">Temperature:</label>
                            <input type="text" class="form-control" id="temperature" name="temperature">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="height" class="form-label">Height:</label>
                            <input type="text" class="form-control" id="height" name="height">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Weight:</label>
                            <input type="text" class="form-control" id="weight" name="weight">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="health_conditions" class="form-label">Health Conditions:</label>
                        <textarea class="form-control" id="health_conditions" name="health_conditions" rows="3"></textarea>
                    </div>
                    <button type="submit" name="add_student" class="btn btn-primary">Add Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function viewStudent(id) {
        window.location.href = 'view_student.php?id=' + id;
    }

    function monitorStudent(id) {
        window.location.href = 'monitor_student.php?id=' + id;
    }
    var monitorModal = document.getElementById('monitorModal');
    monitorModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var studentId = button.getAttribute('data-student-id');
        var userId = button.getAttribute('data-user-id');

        // Update the form inputs with the selected student and user IDs
        document.getElementById('modal-student-id').value = studentId;
        document.getElementById('modal-user-id').value = userId;
    });
</script>


</html>