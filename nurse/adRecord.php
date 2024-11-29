<?php
session_start();
if (!isset($_SESSION["id_number"])) {
    header("Location: login.php");
    exit(); // Redirect to login if not authenticated
}
?>

<!DOCTYPE html>
<html lang="en">


    <br>
    <br>
    <br><br><br>

    <?php include 'navbar.php';?>

    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 10%; height: 50px">+ add Student</button>
    
        <input type="search" name="search" id="" placeholder="search">
        <label for="" style="font-size: 25px; margin-left: 5%;">Course: </label>
        <select name="course" id="" style="height: 40px; background-color: grey; border-radius: 5px;">
            <option value="BSIT">BSIT</option>
            <option value="BSHM">BSHM</option>
            <option value="BEED">BEED</option>
            <option value="BSED">BSED</option>
        </select>

    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Id number</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Date</th>
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
                    <td><button class="btn btn-primary">view</button><button class="btn btn-dark">monitor</button></td>
                </tr>
            </tbody>
        </table>



        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content" style="max-width: 700px; min-width: 700px;">
        
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Background Information</h4>
              </div>
        
              <!-- Modal body -->
              <div class="modal-body">
                <label for="" class="form-label">Id number: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">password: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Name: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Phone#: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Address: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Email: </label>
                <input type="email" class="form-control">
                <label for="" class="form-label">Date: </label>
                <input type="date" class="form-control">
                <label for="" class="form-label">Age: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Gender: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Civil Status: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Course: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Year and Sec: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Vaccine Type: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Guardian #: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Student #: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Parent: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Disability: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Blood pressure: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Temperature: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Height: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Weight: </label>
                <input type="text" class="form-control">
                <label for="" class="form-label">Health Condition/s: </label>
                <br>
                <input type="text" class="form-control">
                <input type="text" class="form-control">
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
              </div>

              
</html>