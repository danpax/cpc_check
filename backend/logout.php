<?php
session_start();
session_destroy(); // Destroy the session
session_start();
$_SESSION['success_message'] = "Logout successfully!";
header("Location: login.php"); // Redirect to login page
exit();
?>