<?php

require 'navbar.php';
// session_start();
// if (!isset($_SESSION["id_number"])) {
//     header("Location: ../login.php");
//     exit(); // Redirect to login if not authenticated
// }
?>


    <section class="image-gallery container">
        <div><img src="../img/pp.png" alt="Image 1"><h3 class="text-center mt-2">Respondent</h3></div>
        <div><img src="../img/pp.png" alt="Image 2"><h3 class="text-center mt-2">Nurse</h3></div>
        <div><img src="../img/pp.png" alt="Image 3"><h3 class="text-center mt-2">Respondet</h3></div>
    </section>


    <script>
                function toggleMenu() {
                    const navLinks = document.querySelector('.nav-links');
                     navLinks.classList.toggle('active');
                  }
              </script>




</body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>