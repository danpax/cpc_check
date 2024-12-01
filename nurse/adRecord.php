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

// Add new student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_student'])) {
    $fields = [
        'id_number', 'name', 'phone', 'address', 'email', 'date', 'age',
        'gender', 'civil_status', 'course', 'year_sec', 'vaccine_type',
        'guardian_number', 'student_number', 'parent', 'disability',
        'blood_pressure', 'temperature', 'height', 'weight', 'health_conditions'
    ];

    $data = [];
    foreach ($fields as $field) {
        if ($field === 'age') {
            $data[$field] = intval($_POST[$field]);
            // $data[$field] = password_hash($_POST[$field], PASSWORD_DEFAULT);
        // } elseif ($field === 'password') {
        //     $data[$field] = intval($_POST[$field]);
        }
         else {
            $data[$field] = $conn->real_escape_string($_POST[$field]);
        }
    }

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", $data) . "'";

    // $sql = "INSERT INTO students ($columns) VALUES ($values)";

    $sql_student = "INSERT INTO students ($columns) VALUES ($values)";
    
    if ($conn->query($sql_student) === TRUE) {
        
        // Capture the password from the form and hash it
        $id_number = $_POST['id_number'];
        $password = $_POST['password']; // Get password from the form
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $role = 'student'; // Default role

        // Insert into the 'users' table
        $sql_user = "INSERT INTO users (id_number, password, role) VALUES ('$id_number', '$hashed_password', '$role')";

        if ($conn->query($sql_user) === TRUE) {
            // If both insertions are successful
            $success_message = "New student added successfully and user created!";
        } else {
            // If there's an error with the user insert
            $error_message = "Error creating user: " . $conn->error;
        }
    } else {
        // Error with student insertion
        $error_message = "Error adding student: " . $conn->error;
    }

    // if ($conn->query($sql) === TRUE) {
    //     $success_message = "New student added successfully";
    // } else {
    //     $error_message = "Error: " . $conn->error;
    // }
}

// Fetch students
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$course_filter = isset($_GET['course']) ? $conn->real_escape_string($_GET['course']) : '';

$sql = "SELECT * FROM students WHERE 1=1";
if (!empty($search)) {
    $sql .= " AND (name LIKE '%$search%' OR id_number LIKE '%$search%')";
}
if (!empty($course_filter)) {
    $sql .= " AND course = '$course_filter'";
}
$sql .= " ORDER BY name ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">




    <?php include 'navbar.php';?>

    <div class="container mt-5">
        <h2 class="mb-4">Student Records</h2>
        
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">+ Add Student</button>
        
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="search" name="search" class="form-control" placeholder="Search by name or ID" value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <div class="col-md-5" style="margin-left: 150px;">
                    <select name="course" class="form-control">
                        <option value="">All Courses</option>
                        <option value="BSIT" <?php echo $course_filter == 'BSIT' ? 'selected' : ''; ?>>BSIT</option>
                        <option value="BSHM" <?php echo $course_filter == 'BSHM' ? 'selected' : ''; ?>>BSHM</option>
                        <option value="BEED" <?php echo $course_filter == 'BEED' ? 'selected' : ''; ?>>BEED</option>
                        <option value="BSED" <?php echo $course_filter == 'BSED' ? 'selected' : ''; ?>>BSED</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Number</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "<td>
                                <button class='btn btn-primary btn-sm' onclick='viewStudent(\"" . $row['id_number'] . "\")'>View</button>
                                <button class='btn btn-dark btn-sm' onclick='monitorStudent(\"" . $row['id_number'] . "\")'>Monitor</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No students found</td></tr>";
                }
                ?>
            </tbody>
        </table>
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
    </script>

              
</html>