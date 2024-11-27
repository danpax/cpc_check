



<!DOCTYPE html>
<html lang="en">

    <br>
    <br>
    <br><br><br>
    
    <?php include 'index.php';?>
    

    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th>Parent/Guadian</th>
                    <th>Phone#</th>
                    <th>Email</th>
                    <th>Emergencey#</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><i class="fa fa-eye" data-bs-toggle="modal" data-bs-target="#myModal" style="cursor: pointer;"></i></td>
                </tr>
            </tbody>
        </table>

        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Background Information</h4>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body">
                <label for="" class="form-label">Health Condition/s: </label>
                <br>
                <input type="text" class="form-control">
                <input type="text" class="form-control">
                <input type="text" class="form-control">
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
              </div>



</html>