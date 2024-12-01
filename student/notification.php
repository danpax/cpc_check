<?php include 'navbar.php'; ?>

    <div class="background"></div>

    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>You're request is accepted</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <script>
                function toggleMenu() {
                    const navLinks = document.querySelector('.nav-links');
                     navLinks.classList.toggle('active');
                  }
              </script>

    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>