<?php
session_start();
include '../db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $student_id = $_POST['student_id'];
    $user_id = $_POST['user_id'];

    // Insert into the `monitorings` table
    $query = $conn->prepare("INSERT INTO monitorings (user_id) VALUES (?)");
    $query->bind_param('i', $user_id);

    if ($query->execute()) {
        $_SESSION['message'] = "Student successfully added to monitoring.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to add student to monitoring.";
        $_SESSION['message_type'] = "danger";
    }

    header("Location: monitorings.php"); // Redirect back to the page
    exit();
}
?>