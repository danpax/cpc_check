<?php
// Start session
// session_start();

// Database connection
$host = "localhost";
$username = "root"; // Use your MySQL username
$password = "";     // Use your MySQL password
$database = "clinic";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_user'])) {
    $id_number = $_POST['id_number'];
    $password = $_POST['password'];

    // Check if the user exists
    $query = "SELECT * FROM users WHERE id_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Validate password (assuming plain text as per your preference)
        if ($password === $user['password']) {
            // Password is correct
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['id_number'] = $user['id_number'];
            $_SESSION['role'] = $user['role']; // Store user role
            $_SESSION['success_message'] = "Login successfully!";
            
            // Redirect to home.php
            header("Location: home.php");
            if ($user['role'] === 'admin') {
                header("Location: adDashboard.php"); // Admin dashboard
            } else {
                header("Location: staffDashboard.php"); // Staff dashboard
            }
            exit();
        } else {
            echo "<script>alert('Invalid ID number or password.');</script>";
        }
    } else {
        echo "<script>alert('Invalid ID number or password.');</script>";
    }
    $stmt->close();
}


$conn->close();
?>