


<!DOCTYPE html>
<html lang="en">

        <br>
        <br>
        <br>
        <br>
        <br>

    <?php include 'index.php';?>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 10%; height: 50px">+ add medicine</button>
    <input type="search" name="search" id="" placeholder="search">

    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Medicine</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Expiration Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    <button class="btn btn-danger w-50">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        



        <!-- Modal -->
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Background Information</h4>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body">
                <label for="" class="form-label">Medicine: </label>
                <br>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Stock: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Description: </label>
                <input type="text" class="form-control">
                <br>
                <label for="" class="form-label">Expiration Date: </label>
                <input type="date" class="form-control">
                <br>
                <button type="button" class="btn btn-primary" style="font-size: 18px; max-width: 100px; min-width: 100px; float: right;">add</button>
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
              </div>


</html>