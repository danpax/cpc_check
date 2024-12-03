<?php
include 'navbar.php';
include '../db.php';

// Handle Accept Action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'accept') {
    $request_id = $_POST['request_id'];
    $message = $_POST['message'];
    $visit_at = $_POST['visit_at'];

    // Update the request status and message
    $sql_update = "UPDATE requests SET status = 'accepted', message = ?, visit_at = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssi", $message, $visit_at, $request_id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Request has been accepted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error accepting request: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Requests</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container-fluid" style="margin-left: 100px;">
    <table class="table table-striped table-bordered mt-5" style="margin: auto; max-width: 1280px;">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Reason</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Query to fetch pending requests with the student's name
        $sql = "SELECT request.*, s.name AS student_name, s.user_id
                FROM requests request
                JOIN students s ON request.user_id = s.user_id
                WHERE request.status = 'pending'";

        $result = $conn->query($sql);

        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        // Check if there are any rows returned
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-primary' onclick='openAcceptModal(" . $row['id'] . ")'>Accept</button> ";
                echo "<button type='button' class='btn btn-secondary' onclick='viewStudent(" . $row['user_id'] . ")'>View</button>";
                echo "<button type='button' class='btn btn-dark' >Monitor</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No pending requests</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Accept Request Modal -->
<div class="modal fade" id="acceptRequestModal" tabindex="-1" aria-labelledby="acceptRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="acceptRequestModalLabel">
                    <i class="fas fa-check-circle me-2"></i> Accept Request
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p class="text-muted mb-3">
                    Please provide a message for the request before accepting. The student will be notified with the message you input.
                </p>
                <form id="acceptRequestForm" method="POST">
                    <!-- Hidden Input for Request ID -->
                    <input type="hidden" id="acceptRequestId" name="request_id" value="">

                    <!-- Message Input -->
                    <div class="mb-3">
                        <label for="acceptMessage" class="form-label fw-bold">Message</label>
                        <textarea 
                            class="form-control" 
                            id="acceptMessage" 
                            name="message" 
                            rows="4" 
                            placeholder="Enter your message here..." 
                            required
                            style="resize: none; border: 1px solid #ccc; border-radius: 10px; padding: 10px;"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="acceptMessage" class="form-label fw-bold">Message</label>
                        <input type="datetime-local" class="form-control" name="visit_at">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="action" value="accept" class="btn btn-success w-100">
                        <i class="fas fa-paper-plane me-2"></i> Submit
                    </button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times-circle me-2"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- FontAwesome Icons -->


<!-- Student Info Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="studentModalLabel">Student Information</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Name:</strong>
                            <p id="studentName" class="text-muted"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>ID Number:</strong>
                            <p id="studentIdNumber" class="text-muted"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Email:</strong>
                            <p id="studentEmail" class="text-muted"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Phone:</strong>
                            <p id="studentPhone" class="text-muted"></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <strong>Address:</strong>
                            <p id="studentAddress" class="text-muted"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <strong>Age:</strong>
                            <p id="studentAge" class="text-muted"></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Gender:</strong>
                            <p id="studentGender" class="text-muted"></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Civil Status:</strong>
                            <p id="studentCivilStatus" class="text-muted"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Course:</strong>
                            <p id="studentCourse" class="text-muted"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Year and Section:</strong>
                            <p id="studentYearSec" class="text-muted"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Vaccine Type:</strong>
                            <p id="studentVaccineType" class="text-muted"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Guardian Number:</strong>
                            <p id="studentGuardianNumber" class="text-muted"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Height:</strong>
                            <p id="studentHeight" class="text-muted"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Weight:</strong>
                            <p id="studentWeight" class="text-muted"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Blood Pressure:</strong>
                            <p id="studentBloodPressure" class="text-muted"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Temperature:</strong>
                            <p id="studentTemperature" class="text-muted"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <strong>Health Conditions:</strong>
                            <p id="studentHealthConditions" class="text-muted"></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <strong>Disability:</strong>
                            <p id="studentDisability" class="text-muted"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
// Fetch and display student details in the modal
function viewStudent(userId) {
    fetch(`fetch_student_info.php?user_id=${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                // Populate modal fields
                document.getElementById('studentName').innerText = data.name || 'N/A';
                document.getElementById('studentIdNumber').innerText = data.id_number || 'N/A';
                document.getElementById('studentEmail').innerText = data.email || 'N/A';
                document.getElementById('studentPhone').innerText = data.phone || 'N/A';
                document.getElementById('studentAddress').innerText = data.address || 'N/A';
                document.getElementById('studentAge').innerText = data.age || 'N/A';
                document.getElementById('studentGender').innerText = data.gender || 'N/A';
                document.getElementById('studentCivilStatus').innerText = data.civil_status || 'N/A';
                document.getElementById('studentCourse').innerText = data.course || 'N/A';
                document.getElementById('studentYearSec').innerText = data.year_sec || 'N/A';
                document.getElementById('studentVaccineType').innerText = data.vaccine_type || 'N/A';
                document.getElementById('studentGuardianNumber').innerText = data.guardian_number || 'N/A';
                document.getElementById('studentHeight').innerText = data.height || 'N/A';
                document.getElementById('studentWeight').innerText = data.weight || 'N/A';
                document.getElementById('studentBloodPressure').innerText = data.blood_pressure || 'N/A';
                document.getElementById('studentTemperature').innerText = data.temperature || 'N/A';
                document.getElementById('studentHealthConditions').innerText = data.health_conditions || 'N/A';
                document.getElementById('studentDisability').innerText = data.disability || 'N/A';

                // Show modal
                new bootstrap.Modal(document.getElementById('studentModal')).show();
            }
        })
        .catch(error => {
            console.error('Error fetching student details:', error);
        });
}

// Set request ID in the modal when accepting
function openAcceptModal(requestId) {
    document.getElementById('acceptRequestId').value = requestId;
    new bootstrap.Modal(document.getElementById('acceptRequestModal')).show();
}
</script>
</body>
</html>
