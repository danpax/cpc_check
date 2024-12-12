<?php
include 'navbar.php';
include '../db.php';

// Function to add expired style class
function getExpiredStyle($expired_at) {
    return strtotime($expired_at) < time() ? "table-danger" : "";
}

// Add new medicine
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_medicine'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $stock = intval($_POST['stock']);
    $desc = $conn->real_escape_string($_POST['desc']);

    if (empty($name) || $stock <= 0 || empty($desc)) {
        echo "<div class='toast align-items-center text-bg-danger' role='alert'>
                <div class='d-flex'>
                    <div class='toast-body'>Invalid input values for adding medicine.</div>
                    <button type='button' class='btn-close me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
              </div>";
    } else {
        $sql = "INSERT INTO medicines (name, stock, `desc`) VALUES ('$name', $stock, '$desc')";
        if ($conn->query($sql)) {
            echo "<div class='toast align-items-center text-bg-success' role='alert'>
                    <div class='d-flex'>
                        <div class='toast-body'>Medicine added successfully!</div>
                        <button type='button' class='btn-close me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                    </div>
                  </div>";
        } else {
            echo "<div class='toast align-items-center text-bg-danger' role='alert'>
                    <div class='d-flex'>
                        <div class='toast-body'>Error adding medicine: " . $conn->error . "</div>
                        <button type='button' class='btn-close me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                    </div>
                  </div>";
        }
    }
}

// Fetch medicines
$sql = "SELECT * FROM medicines";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .expired {
            background-color: #f8d7da;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Medicine Inventory</h1>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
                + Add Medicine
            </button>
        </div>

        <input type="search" name="search" id="search" placeholder="Search for a medicine..." onkeyup="searchMedicines()" class="form-control mb-3">

        <table class="table table-hover table-bordered" id="medicineTable">
            <thead class="table-dark">
                <tr>
                    <th>Medicine</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Expiration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $expiredClass = getExpiredStyle($row['expired_at']);
                        echo "<tr class='$expiredClass'>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['desc']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['expired_at']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No medicines found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Add Medicine Modal -->
        <div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addMedicineModalLabel">Add New Medicine</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Medicine Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock:</label>
                                <input type="number" id="stock" name="stock" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Description:</label>
                                <textarea id="desc" name="desc" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="add_medicine" class="btn btn-primary">Add Medicine</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchMedicines() {
            var input = document.getElementById("search");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("medicineTable");
            var tr = table.getElementsByTagName("tr");

            for (var i = 1; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    var txtValue = td.textContent || td.innerText;
                    tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        }
    </script>
</body>
</html>
