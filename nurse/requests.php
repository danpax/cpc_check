
<?php
include 'navbar.php';
include '../db.php';

// Handle Accept Action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'accept') {
    $request_id = intval($_POST['request_id']);
    $message = trim($_POST['message']);
    $visit_at = date('Y-m-d H:i:s', strtotime($_POST['visit_at']));

   
    // Check if the request exists
    $result = $conn->query("SELECT * FROM requests WHERE id = $request_id");
    if ($result->num_rows === 0) {
        echo "<div class='alert alert-danger'>No matching request found for ID: $request_id</div>";
        exit;
    }

    // Prepare and execute the update query
    $sql_update = "UPDATE requests SET status = 'approved', message = ?, visit_at = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);

    if ($stmt === false) {
        echo "<div class='alert alert-danger'>Prepare failed: " . $conn->error . "</div>";
        exit;
    }

    // Bind parameters
    if (!$stmt->bind_param("ssi", $message, $visit_at, $request_id)) {
        echo "<div class='alert alert-danger'>Binding parameters failed: " . $stmt->error . "</div>";
        exit;
    }

    // Execute the query
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<div class='alert alert-success'>Request has been accepted successfully!</div>";
        } else {
            echo "<div class='alert alert-warning'>No rows were updated. The request might already be approved.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error executing query: " . $stmt->error . "</div>";
    }
}
?>
<h1 class="text-center">Requests</h1>
  <table class="table table-striped table-hover table-bordered text-center align-middle mt-5 shadow-sm" style="margin: auto; max-width: 1280px; border-radius: 8px; overflow: hidden;">
    <thead class="table-dark" style="position: sticky; top: 0; z-index: 10;">
        <tr>
            <th style="width: 25%;">Name</th>
            <th style="width: 35%;">Reason</th>
            <th style="width: 20%;">Date</th>
            <th style="width: 20%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Query to fetch pending requests with the student's name
        $sql = "SELECT r.*, u.name 
        FROM requests r 
        JOIN users u ON r.user_id = u.id 
        WHERE r.status = 'pending'";

        $result = $conn->query($sql);

        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        // Check if there are any rows returned
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                echo "<td>" . htmlspecialchars(date("Y-m-d", strtotime($row['created_at']))) . "</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-success btn-sm mx-1' onclick='openAcceptModal(" . $row['id'] . ")'>Accept</button>";
                // echo "<button type='button' class='btn btn-secondary btn-sm mx-1' onclick='viewStudent(" . $row['user_id'] . ")'>View</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No pending requests</td></tr>";
        }
        ?>
    </tbody>
</table>


<!-- Accept Request Modal -->
<div class="modal fade" id="acceptRequestModal" tabindex="-1" aria-labelledby="acceptRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="acceptRequestModalLabel">
                    Accept Request
                </h5>
                <button type="button" class="btn-close b" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        Submit
                    </button>
                </form>
            </div>

            <!-- Modal Footer -->
            <!-- <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times-circle me-2"></i> Close
                </button>
            </div> -->
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
