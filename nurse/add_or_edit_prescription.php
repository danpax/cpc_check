<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action_type = $_POST['action_type'];
    $request_id = intval($_POST['request_id']);
    $notes = $conn->real_escape_string($_POST['notes']);
    $quantities = $_POST['quantities'] ?? [];

    if ($action_type === 'add') {
        // Add prescription logic
        $sql = "INSERT INTO prescriptions (request_id, notes, created_at) VALUES ($request_id, '$notes', NOW())";
        if ($conn->query($sql)) {
            $prescription_id = $conn->insert_id;
            foreach ($quantities as $medicine_id => $quantity) {
                $quantity = intval($quantity);
                if ($quantity > 0) {
                    $conn->query("INSERT INTO prescription_medicines (medicine_id, prescription_id, quantity) VALUES ($medicine_id, $prescription_id, $quantity)");
                    $conn->query("UPDATE medicines SET stock = stock - $quantity WHERE id = $medicine_id");
                }
            }
            header('Location: requests_history.php');
        }
    } elseif ($action_type === 'edit') {
        // Edit prescription logic
        $prescription_sql = "SELECT id FROM prescriptions WHERE request_id = $request_id";
        $prescription_result = $conn->query($prescription_sql);

        if ($prescription_result->num_rows > 0) {
            $prescription = $prescription_result->fetch_assoc();
            $prescription_id = $prescription['id'];

            // Update prescription notes
            $conn->query("UPDATE prescriptions SET notes = '$notes' WHERE id = $prescription_id");

            // Update prescription medicines
            $conn->query("DELETE FROM prescription_medicines WHERE prescription_id = $prescription_id");
            foreach ($quantities as $medicine_id => $quantity) {
                $quantity = intval($quantity);
                if ($quantity > 0) {
                    $conn->query("INSERT INTO prescription_medicines (medicine_id, prescription_id, quantity) VALUES ($medicine_id, $prescription_id, $quantity)");
                    $conn->query("UPDATE medicines SET stock = stock - $quantity WHERE id = $medicine_id");
                }
            }
            header('Location: requests_history.php');
        }
    }
}
?>
