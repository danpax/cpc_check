<?php

include 'navbar.php';
include '../db.php';
// Handle Add Student Form Submission
if (isset($_POST['add_student'])) {
    // Get the form inputs
    $password = $_POST['password'];
    $id_number = $_POST['id_number'];
    $role = 'student'; // Default role for students
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_status'];
    $course = $_POST['course'];
    $year_sec = $_POST['year_sec'];
    $vaccine_type = $_POST['vaccine_type'];
    $guardian_number = $_POST['guardian_number'];
    $parent = $_POST['parent'];
    $disability = $_POST['disability'];
    $blood_pressure = $_POST['blood_pressure'];
    $temperature = $_POST['temperature'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $health_conditions = $_POST['health_conditions'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepared statement to insert data
    $sql_student = "INSERT INTO users (
        id_number, role, password, name, phone, address, email, birthdate, gender, 
        civil_status, course, year_sec, vaccine_type, guardian_number, parent, 
        disability, blood_pressure, temperature, height, weight, health_conditions, updated_at, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    
    $stmt = $conn->prepare($sql_student);
    
    if ($stmt) {
        $stmt->bind_param(
            'issssssssssssssssssss', // Correct format
            $id_number, 
            $role, 
            $hashed_password, 
            $name, 
            $phone, 
            $address, 
            $email, 
            $birthdate, 
            $gender, 
            $civil_status, 
            $course, 
            $year_sec, 
            $vaccine_type, 
            $guardian_number, 
            $parent, 
            $disability, 
            $blood_pressure, 
            $temperature, 
            $height, 
            $weight, 
            $health_conditions
        );
    
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>New student added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error adding student: " . $stmt->error . "</div>";
        }
    
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error preparing statement: " . $conn->error . "</div>";
    }
    
}



// Handle Delete Student
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: nurse_students.php");
    exit();
}
?>

<div class="container mt-4">
    <h1 class="text-center">Nurse Students Management</h1>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        <i class="fas fa-plus"></i> Add New Student
    </button>
    <form method="GET" action="">
  <div class="input-group mb-3">
    <input type="text" class="form-control" name="search" placeholder="Search by name, ID number, or course">
    <button class="btn btn-primary" type="submit">Search</button>
  </div>
</form>
    <!-- Students Table -->
    <table class="table table-hover align-middle table-bordered">
  <thead class="table-dark text-center">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">ID Number</th>
      <th scope="col">Name</th>
      <th scope="col">Course</th>
      <th scope="col">Updated At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $search_term = isset($_GET['search']) ? $_GET['search'] : '';
    $records_per_page = 10; // Adjust as needed
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $sql = "SELECT * FROM users 
            WHERE role = 'student' 
              AND (name LIKE '%$search_term%' 
              OR id_number LIKE '%$search_term%' 
              OR course LIKE '%$search_term%') 
            LIMIT $offset, $records_per_page";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()): ?>
      <tr class="text-center">
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['id_number']); ?></td>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['course']); ?></td>
        <td><?php echo htmlspecialchars(date("F j, Y g:i A", strtotime($row['updated_at']))); ?></td>
        <td class="d-flex justify-content-center gap-2">
          <!-- Edit Button -->
          <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit
          </a>
          <!-- Monitor Button -->
          <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#monitorModal<?php echo $row['id']; ?>">
            Monitor
          </button>
        </td>
      </tr>
      <!-- Modal for Monitor Confirmation -->
      <div class="modal fade" id="monitorModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="monitorModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="add_monitor_student.php">
                        <div class="modal-header">
                        <?php echo $row['id']; ?>
                            <h5 class="modal-title" id="monitorModalLabel<?php echo $row['id']; ?>">Confirm Monitoring</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to monitor the student <strong><?php echo htmlspecialchars($row['name']); ?></strong>?
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
  </tbody>
</table>

    <?php
    $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role = 'student'"));
    $total_pages = ceil($total_records / $records_per_page);
    
    echo "<ul class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
    }
    echo "</ul>";
    
    ?>
</div>
<!-- Monitor Confirmation Modal -->

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
                            <label for="birthdate" class="form-label">Birthdate:</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                        </div>
                    </div>
                    <div class="row">
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
                        <!-- <div class="col-md-6 mb-3">
                            <label for="student_number" class="form-label">Student Number:</label>
                            <input type="tel" class="form-control" id="student_number" name="student_number">
                        </div> -->
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

