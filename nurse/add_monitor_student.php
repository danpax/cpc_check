<?php
// Include the database connection
include '../db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the form
    $user_id = intval($_POST['user_id']);

    // Check if the student is already being monitored
    $check_query = $conn->prepare("SELECT * FROM monitorings WHERE user_id = ?");
    $check_query->bind_param('i', $user_id);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('This student is already being monitored.'); window.history.back();</script>";
        exit();
    }

    // Add the student to the monitoring table
    $insert_query = $conn->prepare("INSERT INTO monitorings (user_id, created_at) VALUES (?, NOW())");
    $insert_query->bind_param('i', $user_id);

    if ($insert_query->execute()) {
        echo "<script>alert('Student successfully added to monitoring.'); window.location.href = 'monitor_student.php?id=" . $user_id . "';</script>";
    } else {
        echo "<script>alert('Failed to add student to monitoring. Please try again.'); window.history.back();</script>";
    }
}
?>
