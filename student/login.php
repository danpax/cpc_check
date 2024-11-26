
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
    <form action="" method="POST" class="form">
        <div>
            <img src="../img/phoenix.jpg" alt="Logo" class="mb-3" 
                 style="height: 50px; width: 50px; object-fit: cover; border-radius: 40px;">
            <h1 style="text-align: center;">Log in</h1>

            <label for="id_number" class="form-label">ID Number</label>
            <input type="text" name="id_number" class="form-control" id="id_number" placeholder="Enter ID number" required>
            <br>
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            <br>
            <center><button class="button" type="submit" name="login_user">Login</button></center>
        </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
