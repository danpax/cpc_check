<?php
// Include necessary files and start session
include 'navbar.php';
include '../db.php';

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointment data and user details
$sql = "SELECT a.*, u.name AS user_name
        FROM appointments a
        INNER JOIN users u ON a.student_id = u.id";
$result = $conn->query($sql);

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => htmlspecialchars($row['user_name']), // User name as the event title
        'start' => htmlspecialchars($row['visit_at']), // Event start date
        'id'    => htmlspecialchars($row['id']),      // Request ID (optional)
    ];
}

$conn->close();
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Your Calendar</h1>
    <div id="calendar"></div>
</div>

<!-- FullCalendar and Moment.js -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" integrity="sha512-hUhvpC5f8cgc04OZb55j0KNGh4eh7dLxd/dPSJ5VyzqDWxsayYbojWyl5Tkcgrmb/RVKCRJI1jNlRbVP4WWC4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            events: events, // Events from PHP
            themeSystem: 'bootstrap', // Optional: Bootstrap styling
            eventClick: function (info) {
                // Event click handler (optional)
                alert(`Event: ${info.event.title}\nStart: ${info.event.start.toLocaleString()}`);
            },
        });

        calendar.render();
    });
</script>
