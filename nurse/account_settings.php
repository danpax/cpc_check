<?php
include 'navbar.php';
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("
        UPDATE users 
        SET name = '$name', email = '$email', password = '$password'
        WHERE id = {$_SESSION['user']['id']}
    ");
    echo "Account updated successfully.";
}

// Fetch current user details
$user = $conn->query("SELECT * FROM users WHERE id = {$_SESSION['user']['id']}")->fetch_assoc();
?>

<div class="container" style="margin-left: 300px;">
    <h1>Account Settings</h1>

    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $user['name']; ?>" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $user['email']; ?>" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
?>
