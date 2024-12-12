<?php
include 'navbar.php';
include '../db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $db->real_escape_string($_POST['name']);
    $email = $db->real_escape_string($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    $query = "UPDATE users SET name = '$name', email = '$email'";
    if ($password) {
        $query .= ", password = '$password'";
    }
    $query .= " WHERE id = $user_id";

    $db->query($query);

    echo "<div class='container'><p>Your account settings have been updated successfully.</p></div>";
}

// Fetch current user details
$user = $db->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
?>

<div class="container">
    <h1>Account Settings</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $user['name']; ?>" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $user['email']; ?>" required />

        <label for="password">Password (Leave blank to keep current password):</label>
        <input type="password" id="password" name="password" />

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
?>
