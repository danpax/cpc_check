<?php
session_start();
if (!isset($_SESSION["id_number"])) {
    header("Location: ../login.php");
    exit(); // Redirect to login if not authenticated
}
?>

<!DOCTYPE html>
<html lang="en">


    <br>
    <br>
    <br><br><br>
    <?php include 'navbar.php';?>

    
    <div class="container mt-5">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Medicine</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Reason</th>
                    <th>Expiration Date</th>
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
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        
</html>