<?php
include '../db.php';

$requestId = $_GET['id'];
$visitAt = date('Y-m-d H:i:s', strtotime('+1 day')); // Example: Set appointment for the next day

$conn->query("
    UPDATE requests 
    SET status = 'approved', visit_at = '$visitAt'
    WHERE id = $requestId
");

header('Location: dashboard.php');
?>
