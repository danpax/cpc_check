 <?php include 'navbar.php'; ?>

<h1 class="bg-dark" style="width: 30%; text-align: center; position: relative; margin-top: 2%; margin-left: auto; margin-right: auto; color: white;">MONITORED STUDENTS</h1>

<div class="table-container">
    <table class="table table-light table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Names</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mark</td>
                <td><i class="fa fa-eye" data-bs-toggle="modal" data-bs-target="#myModal" style="cursor: pointer;"></i></td>
            </tr>
        </tbody>
    </table>
</div>

          <div class="background"></div>

        <p class="double-color">Your Partner in Health <br>and Wellness</p>
          
        
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Background Information</h4>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body">
                <label for="" class="form-label">Name: </label>
                <input type="text" name="" id="" class="form-control">
                <br>
                <label for="" class="form-label">Address: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Date of Birth: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Parent/Guardian: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Phone #: </label>
                <input type="text" name="" id="" class="form-control">
                <br>
                <label for="" class="form-label">Email: </label>
                <input type="email" class="form-control">
                <br>
                <label for="" class="form-label">Emergency #: </label>
                <input type="text" class="form-control">
                <br><br>
                <label for="" class="form-label">Health Condition/s: </label>
                <br>
                <input type="text" class="form-control">
                <input type="text" class="form-control">
                <input type="text" class="form-control">
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal" style="border-radius: 3px; width: 90px;">Close</button>
              </div>



              <script>
                function toggleMenu() {
                    const navLinks = document.querySelector('.nav-links');
                     navLinks.classList.toggle('active');
                  }
              </script>



          
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>