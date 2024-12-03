<?php
include 'db.php';
session_start();
if(isset($_SESSION['user'])) {
    if($_SESSION['user']['role'] == 'nurse') {
        header('Location: nurse/adDashboard.php');
    }
    else {
        header('Location: student/home.php');
    }
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login_user'])) {
    $id_number = $_POST['id_number'];
    $password = $_POST['password'];
    // $role = $_POST['role'];

    // Fetch user data from database based on ID number and role
    $query = "SELECT * FROM users WHERE id_number = '$id_number'";
    $result = mysqli_query($conn, $query);
    // var_dump($result);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Check if the role is 'nurse', bypass password verification for nurse
        if ($user['role'] == 'nurse' && $password == $user['password']) {
            
            $_SESSION['success_message'] = 'Successfully logged in as Nurse!';
            $_SESSION['user'] = $user;

            header('Location: nurse/adDashboard.php');
            exit();
        } else {
            // For other roles, verify the password using password_verify
            if (password_verify($password, $user['password'])) {
               
                $_SESSION['success_message'] = 'Successfully logged in!';
                $_SESSION['user'] = $user;
                header('Location: student/home.php');
                exit();
            } else {
                $error = "Incorrect password.";
            }
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
            background-image: linear-gradient(to right, #87CEFA, #4682B4);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin: auto;
        }

        .form-container img {
            height: 60px;
            width: 60px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 15px;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .form-container .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form action="login.php" method="POST">
                <img src="img/phoenix.jpg" alt="Logo">
                <h1>Log in</h1>

                <?php if (isset($error)): ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter ID number" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                </div>

                <!-- <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="student">Student</option>
                        <option value="nurse">Nurse</option>
                        <option value="staff">Staff</option>
                    </select>
                </div> -->

                <button type="submit" name="login_user" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

