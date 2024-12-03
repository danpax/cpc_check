<?php 
include 'navbar.php'; 
include '../db.php'; 

// SQL query to fetch all monitorings with user details and student name
$query = "
    SELECT 
    monitorings.id AS monitoring_id, 
    users.id AS user_id, 
    users.id_number, 
    students.name AS student_name
FROM monitorings
JOIN users ON monitorings.user_id = users.id
LEFT JOIN students ON students.user_id = users.id
GROUP BY monitorings.id, users.id
";

$result = mysqli_query($conn, $query);

// Form submission to add a monitoring schedule
if (isset($_POST['submit_schedule'])) {
    $monitoring_id = $_POST['monitoring_id'];
    $schedule_date = $_POST['schedule_date'];

    $insert_query = "INSERT INTO monitoring_schedules (monitoring_id, date) VALUES ('$monitoring_id', '$schedule_date')";
    if (mysqli_query($conn, $insert_query)) {
        echo "Schedule added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
    
<!-- Table to display monitorings -->
<div style="margin-left: 400px">
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Monitoring ID</th>
            <th>User ID</th>
            <th>ID Number</th>
            <th>Student Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['monitoring_id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['id_number'] . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>
                    <form method='POST' action=''>
                        <input type='hidden' name='monitoring_id' value='" . $row['monitoring_id'] . "' />
                        <input type='datetime-local' name='schedule_date' required />
                        <button type='submit' name='submit_schedule'>Add Schedule</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data available</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>
