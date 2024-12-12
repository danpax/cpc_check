<?php
include 'navbar.php';
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $reason = $conn->real_escape_string($_POST['reason']);
    $message = $conn->real_escape_string($_POST['message']);
    $is_urgent = isset($_POST['urgent']) ? 1 : 0;

    $conn->query("
        INSERT INTO requests (user_id, reason, message, status, created_at) 
        VALUES ($user_id, '$reason', '$message', 'pending', NOW())
    ");

    echo "<div class='container'><p>Your health request has been submitted successfully.</p></div>";
}
?>

<div class="container">
    <h1>Submit Health Request</h1>
    <form method="POST">
        <label for="reason">Reason for Request:</label>
        <input type="text" id="reason" name="reason" required />

        <label for="message">Additional Message:</label>
        <textarea id="message" name="message"></textarea>

        <label for="urgent">
            <input type="checkbox" id="urgent" name="urgent" />
            Mark as Urgent
        </label>

        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</div>
?>
