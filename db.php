<?php
// Database connection file
$servername = "localhost"; // Change if necessary
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "cpc_clinic"; // Your database name

// Check if connection already exists
if (!isset($conn)) {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

// Connection is active and can be reused across scripts
?>
