<?php
session_start();
if (!isset($_SESSION["id_number"])) {
    header("Location: login.php");
    exit(); // Redirect to login if not authenticated
}
?>

<!DOCTYPE html>
<html lang="en">


    </style>
        <br>
        <br>
        <br>
        <br>
    <?php include 'navbar.php';?>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 10%; height: 50px">+ Add Medicine</button>
    <input type="search" name="search" id="search" placeholder="Search" onkeyup="searchMedicines()">

    <div class="container mt-5">
        <table class="table table-striped table-bordered" id="medicineTable">
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
                <!-- Rows will be added here -->
            </tbody>
        </table>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Medicine</h4>
                    </div>
                    <div class="modal-body">
                        <label for="medicine" class="form-label">Medicine: </label>
                        <input type="text" id="medicine" class="form-control">
                        <label for="stock" class="form-label">Stock: </label>
                        <input type="text" id="stock" class="form-control">
                        <label for="description" class="form-label">Description: </label>
                        <input type="text" id="description" class="form-control">
                        <label for="expiration" class="form-label">Expiration Date: </label>
                        <input type="date" id="expiration" class="form-control">
                        <button type="button" class="btn btn-primary mt-3" id="addMedicineBtn">Add</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>