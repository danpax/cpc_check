<?php

include 'navbar.php';
include '../db.php';

$user_id = $_SESSION["user"]['id'];
$sql = "SELECT request.*
        FROM requests request 
        WHERE request.user_id = '$user_id' 
        ORDER BY request.created_at DESC";

$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">My Medicine Requests</h2>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">Reason</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="text-center">
                            <td><?= htmlspecialchars($row['reason']) ?></td>
                            <td><?= date("F j, Y, g:i A", strtotime($row['created_at'])) ?></td>
                            <td>
                                <span class="badge 
                                    <?= $row['status'] === 'pending' ? 'bg-warning text-dark' : ($row['status'] === 'approved' ? 'bg-success' : 'bg-danger') ?>">
                                    <?= ucfirst(htmlspecialchars($row['status'])) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($row['status'] === 'approved'): ?>
                                    <button class="btn btn-info btn-sm" onclick="viewPrescription(<?= $row['id'] ?>)">
                                        <i class="fas fa-file-prescription"></i> View Prescription
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fas fa-ban"></i> No Prescription
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No requests found
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Prescription Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prescriptionModalLabel">Prescription Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="prescriptionDetails" class="text-center">
                    <!-- Prescription details will be loaded here dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function viewPrescription(requestId) {
        // Display a loading spinner while fetching data
        const loadingSpinner = `
            <div class="d-flex justify-content-center align-items-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`;
        document.getElementById('prescriptionDetails').innerHTML = loadingSpinner;

        // Fetch prescription details via AJAX
        fetch(`get_prescription_details.php?request_id=${requestId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let prescriptionHtml = `
                        <p><strong>Notes:</strong> ${data.prescription.notes}</p>
                        <h6 class="mt-3">Medicines:</h6>
                        <ul class="list-group list-group-flush">
                    `;
                    data.medicines.forEach(med => {
                        prescriptionHtml += `
                            <li class="list-group-item">
                                <strong>${med.name}</strong> - ${med.quantity}
                            </li>`;
                    });
                    prescriptionHtml += '</ul>';
                    document.getElementById('prescriptionDetails').innerHTML = prescriptionHtml;
                } else {
                    document.getElementById('prescriptionDetails').innerHTML = `
                        <div class="alert alert-warning" role="alert">
                            ${data.message}
                        </div>`;
                }
            })
            .catch(error => {
                console.error('Error fetching prescription:', error);
                document.getElementById('prescriptionDetails').innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        Failed to load prescription details. Please try again later.
                    </div>`;
            });

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('prescriptionModal'));
        modal.show();
    }
</script>

