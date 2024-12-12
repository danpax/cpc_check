<?php
include '../db.php';

header('Content-Type: application/json');

if (isset($_GET['request_id'])) {
    $request_id = intval($_GET['request_id']);

    // Fetch prescription details
    $sql = "SELECT * FROM prescriptions WHERE request_id = $request_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $prescription = $result->fetch_assoc();

        // Fetch prescription medicines
        $medicine_sql = "SELECT pm.quantity, m.name 
                         FROM prescription_medicines pm
                         JOIN medicines m ON pm.medicine_id = m.id
                         WHERE pm.prescription_id = " . $prescription['id'];
        $medicine_result = $conn->query($medicine_sql);

        $medicines = [];
        while ($medicine = $medicine_result->fetch_assoc()) {
            $medicines[] = [
                'name' => $medicine['name'],
                'quantity' => $medicine['quantity']
            ];
        }

        echo json_encode([
            'success' => true,
            'prescription' => [
                'notes' => $prescription['notes']
            ],
            'medicines' => $medicines
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No prescription found for this request.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request ID.'
    ]);
}
?>
