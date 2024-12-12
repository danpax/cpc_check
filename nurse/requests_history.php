<?php 
include 'navbar.php'; 
include '../db.php';
?>


<div class="container mt-5">
    <h1 class="text-center">Requests History</h1>
    <form method="GET" action="">
  <div class="input-group mb-3">
    <input type="text" class="form-control" name="search" placeholder="Search by name or ID number">
    <button class="btn btn-primary" type="submit">Search</button>
  </div>
</form>

<table class="table table-hover align-middle">
  <thead class="table-dark text-center">
    <tr>
      <th scope="col">User Name</th>
      <th scope="col">Reason</th>
      <th scope="col">Message</th>
      <th scope="col">Visit Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $search_term = isset($_GET['search']) ? $_GET['search'] : '';

    $sql = "SELECT r.*, u.name, 
            (SELECT COUNT(*) FROM prescriptions p WHERE p.request_id = r.id) AS has_prescription 
           FROM requests r
           JOIN users u ON r.user_id = u.id 
           WHERE r.status = 'approved' 
           AND (u.name LIKE '%$search_term%' OR u.id_number LIKE '%$search_term%')";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Output data for each row
      while ($row = $result->fetch_assoc()) {
        $visit_date = new DateTime($row['visit_at']);
        $formatted_visit_date = $visit_date->format('F j, Y g:i A');

        echo "<tr class='text-center'>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>"; // User name
        echo "<td>" . htmlspecialchars($row['reason']) . "</td>"; // Request reason
        echo "<td>" . htmlspecialchars($row['message']) . "</td>"; // Request message
        echo "<td>" . htmlspecialchars($formatted_visit_date) . "</td>"; // Visit date

        // Check if a prescription exists for this request
        if ($row['has_prescription'] > 0) {
          echo "<td>
                <button type='button' class='btn btn-warning btn-sm' onclick='openEditPrescriptionModal(" . $row['id'] . ")'>
                  View Prescription
                </button>
              </td>";
        } else {
          echo "<td>
                <button type='button' class='btn btn-primary btn-sm' onclick='openAddPrescriptionModal(" . $row['id'] . ")'>
                  Add Prescription
                </button>
              </td>";
        }

        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='5' class='text-center text-muted'>No accepted requests found</td></tr>";
    }
    ?>
  </tbody>
</table>

</div>

<!-- Prescription Modal (Shared for Add/Edit) -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="prescriptionForm" method="POST" action="add_or_edit_prescription.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="prescriptionModalLabel">Add/Edit Prescription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="requestId" name="request_id">
                    <input type="hidden" id="actionType" name="action_type">

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
    <label for="medicineSelect" class="form-label">Select Medicines</label>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Medicine</th>
                <th>Stock</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="medicineTableBody">
            <?php
            // Fetch medicines
            $medicine_sql = "SELECT * FROM medicines";
            $medicines = $conn->query($medicine_sql);
            $current_date = date('Y-m-d'); // Get the current date

            if ($medicines->num_rows > 0) {
                while ($medicine = $medicines->fetch_assoc()) {
                    $is_expired = strtotime($medicine['expired_at']) <= strtotime($current_date);
                    $disabled = $is_expired ? 'disabled' : '';
                    $row_class = $is_expired ? 'table-danger' : '';

                    echo "<tr class='{$row_class}'>";
                    echo "<td>" . htmlspecialchars($medicine['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($medicine['stock']) . "</td>";
                    echo "<td><input type='number' name='quantities[" . $medicine['id'] . "]' class='form-control' min='0' max='" . $medicine['stock'] . "' {$disabled}></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No medicines available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Prescription</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openAddPrescriptionModal(requestId) {
        document.getElementById('requestId').value = requestId;
        document.getElementById('actionType').value = 'add';
        document.getElementById('prescriptionModalLabel').innerText = 'Add Prescription';
        clearModalFields();
        var modal = new bootstrap.Modal(document.getElementById('prescriptionModal'));
        modal.show();
    }

    function openEditPrescriptionModal(requestId) {
        document.getElementById('requestId').value = requestId;
        document.getElementById('actionType').value = 'edit';
        document.getElementById('prescriptionModalLabel').innerText = 'Edit Prescription';
        loadPrescriptionData(requestId); // Load existing data into the modal
        var modal = new bootstrap.Modal(document.getElementById('prescriptionModal'));
        modal.show();
    }

    function clearModalFields() {
        document.getElementById('notes').value = '';
        const quantityFields = document.querySelectorAll("input[name^='quantities']");
        quantityFields.forEach(field => field.value = '');
    }

    function loadPrescriptionData(requestId) {
        // Use AJAX to fetch the existing prescription data for this request
        fetch(`get_prescription_data.php?request_id=${requestId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('notes').value = data.notes;
                const quantities = data.quantities;
                for (const medicineId in quantities) {
                    const quantityField = document.querySelector(`input[name='quantities[${medicineId}]']`);
                    if (quantityField) {
                        quantityField.value = quantities[medicineId];
                    }
                }
            });
    }
</script>
