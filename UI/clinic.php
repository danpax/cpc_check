

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Homepage</title>
</head>
<style>
      .image-gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .image-gallery img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .image-gallery img:hover {
            transform: scale(1.01);
        }
      
</style>
<body>
    <div class="navbar bg-dark">
        <div><a href="home.php"><img src="../img/phoenix.jpg" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50px;"></a></div>
        <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="medicine.php">Medicine</a></li>
        <li><a href="clinic.php">Clinic Staff</a></li>
        <li><a href="request.php">My Request</a></li>
        <a href="notification.php"><i class='fas fa-bell' style='font-size:24px;'></i></a>
        <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>

    <section class="image-gallery container">
        <div><img src="../img/pp.png" alt="Image 1"><h3 class="text-center mt-2">Respondent</h3></div>
        <div><img src="../img/pp.png" alt="Image 2"><h3 class="text-center mt-2">Nurse</h3></div>
        <div><img src="../img/pp.png" alt="Image 3"><h3 class="text-center mt-2">Respondet</h3></div>
    </section>







</body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>