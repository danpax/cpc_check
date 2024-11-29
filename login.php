<?php
include 'db.php';
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login_user'])) {
    $id_number = $_POST['id_number'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Fetch user data from database based on ID number and role
    $query = "SELECT * FROM users WHERE id_number = '$id_number' AND role = '$role'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password (if stored in plain text, compare directly)
        if ($password === $user['password']) {
            // Set session variables
            $_SESSION['id_number'] = $user['id_number'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['success_message'] = 'Successfully logged in!';

            // Redirect user based on role
            switch ($user['role']) {
                case 'student':
                    header('Location: student/home.php');
                    break;
                case 'nurse':
                    header('Location: nurse/adDashboard.php');
                    break;
                case 'staff':
                    header('Location: staff/staffdashboard.php');
                    break;
                default:
                    $error = "Invalid role.";
            }
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found or role mismatch.";
    }
}
// After database operations
mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Log in</title>
    <style>
        body {
            background-image: linear-gradient(to right, skyblue, blue);
        }

        .form {
            background-color: #ffffff;
            width: 25%;
            margin: auto;
            margin-top: 15%;
            padding: 50px;
            border-radius: 10px;
        }

        .button {
            width: 40%;
            background-color: rgb(49, 100, 241);
            font-size: 15px;
            border-radius: 8px;
            border: none;
            font-weight: bold;
            color: white;
            padding: 10px 20px;
        }

        .button:hover {
            background-color: black;
        }
    </style>
</head>
<body>

    <div class="container">
    <form action="login.php" method="POST" class="form">
            <div>
                <img src="img/phoenix.jpg" alt="Logo" class="mb-3" 
                     style="height: 50px; width: 50px; object-fit: cover; border-radius: 40px;">
                <h1 style="text-align: center;">Log in</h1>

                <?php if (isset($error)): ?>
                    <p style="color: red; text-align: center;"><?php echo $error; ?></p>
                <?php endif; ?>

                <label for="id_number" class="form-label">ID Number</label>
                <input type="text" name="id_number" class="form-control" id="id_number" placeholder="Enter ID number" required>
                
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-control" id="role" required>
                    <option value="student">Student</option>
                    <option value="nurse">Nurse</option>
                    <option value="staff">Staff</option>
                </select>

                <center>
                    <button class="button mt-3" type="submit" name="login_user">Login</button>
                </center>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
