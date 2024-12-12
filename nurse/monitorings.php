<?php
// Include the database connection and navbar
include 'navbar.php';
include '../db.php';

// Handle search input
$search_term = '';
if (isset($_GET['search'])) {
    $search_term = $conn->real_escape_string($_GET['search']);
}

// Query to fetch monitoring data with optional search filter
$sql_monitorings = "
    SELECT m.id AS monitoring_id, m.user_id, u.id_number, u.name 
    FROM monitorings m
    JOIN users u ON m.user_id = u.id
    WHERE u.id_number LIKE '%$search_term%' OR u.name LIKE '%$search_term%'
";
$result = $conn->query($sql_monitorings);
?>

<div class="container mt-4">
    <h1 class="mb-4 text-center">Monitored Students</h1>

    <!-- Search Form -->
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Search by ID Number or Name" 
                value="<?= htmlspecialchars($search_term) ?>"
            >
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Search
            </button>
        </div>
    </form>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">ID Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($monitoring = $result->fetch_assoc()): ?>
                        <tr class="text-center">
                            <td><?= htmlspecialchars($monitoring['id_number']); ?></td>
                            <td><?= htmlspecialchars($monitoring['name']); ?></td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="monitor_student.php?id=<?= $monitoring['user_id']; ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">No monitored students found.</div>
    <?php endif; ?>
</div>
