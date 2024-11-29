<?php
session_start();
if (!isset($_SESSION["id_number"])) {
    header("Location: login.php");
    exit(); // Redirect to login if not authenticated
}
?>



<!DOCTYPE html>
<html lang="en">

    <button class="btn btn-secondary" style="float: right; margin-right: 20px;" onclick="window.location.href='../logout.php'">Log out</button>

    <div class="content">

        <h1>Welcome to the dashboard!</h1>
        
    </div>


    <div style="margin-left: 15%;">
    <p class="double-color">Your Partner in Health <br>and Wellness</p>
    </div>
    <?php include 'navbar.php';?>


</html>