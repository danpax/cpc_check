<?php
include '../db.php';

$requestId = $_GET['id'];

$db->query("UPDATE requests SET status = 'rejected' WHERE id = $requestId");

header('Location: nurse_dashboard.php');
?>
