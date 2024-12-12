<?php
// Start session and check if the user is logged in

include 'navbar.php';
include '../db.php';
// Database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from session
$user_id = $_SESSION['user']['id'];

// Fetch visit_at dates for the logged-in user
$sql = "SELECT * FROM appointments 
INNER JOIN users ON appointments.student_id = users.id
WHERE student_id = ?";

// $appointment_sql = "SELECT * FROM appointments WHERE student_id = ?";
// $appointment_stmt = $conn->prepare($appointment_sql);
// $appointment_stmt->bind_param("i", $user_id);
// $appointment_stmt->execute();
// $appointment_result = $appointment_stmt->get_result();



$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['notes'], // Use the 'reason' as the event title
        'start' => $row['visit_at'], // The visit_at date
        'id'    => $row['id'],      // Optional, you can pass the request ID
    ];
}
$stmt->close();
$conn->close();
?>


    <div class="container mt-5">
        <h1 class="text-center">Your Calendar</h1>
        <div id="calendar"></div>
    </div>
    <!-- <?php print_r($appointment_result); ?> -->
    <!-- FullCalendar JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.js"></script> -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <!-- Moment.js for date formatting -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" integrity="sha512-hUhvpC5f8cgc04OZb55j0KNGh4eh7dLxd/dPSJ5VyzqDWxsayYbojWyl5Tkcgrmb/RVKCRJI1jNlRbVP4WWC4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery (optional for other Bootstrap/JS integrations) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get events from PHP
            const events = <?php echo json_encode($events); ?>;

            // Initialize FullCalendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: events, // Pass the events array from PHP
            });

            calendar.render();
        });
    </script>
